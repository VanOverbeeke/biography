<?php

namespace App\Http\Controllers\Biography;

use App\Http\Requests\StoreGenus;
use App\Models\Genus;
use App\Repositories\Biography\Genus\GenusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;

class GenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sortBy = $request->has('sortBy') ? $request->get('sortBy') : 'id';
        $filterBy = $request->has('filterBy') ? $request->get('filterBy') : 'all';
        if($filterBy==='all') {
            $genus = Genus::with(['species'])
                ->get()
                ->sortBy($sortBy);
        } else {
            $genus = Genus::whereHas('species', function ($query) use ($filterBy) {
                $query->where('species.id', 'LIKE', $filterBy);
            })
                ->get()
                ->sortBy($sortBy);
        }
        return view('/genus/index', compact(['genus', 'sortBy', 'filterBy']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('genus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGenus $request)
    {
        $genus = new Genus;
        $genus->name = $request->get('name');
        $genus->save();
        return response('Genus addition success!', 200)
            ->header('Content-Type', 'text/plain');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return view('genus.edit', compact(['genus']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $genusRepository = new GenusRepository();
        $returnStatus =  $genusRepository->delete($id);
        if ($returnStatus) {
            return response('Genus deletion success!', 200)
                ->header('Content-Type', 'text/plain');
        }
    }

    public function findSpecies()
    {
        $input = Input::get('genus_id');
        if ($input === 'None') {
            dd('NONE passed to findSpecies in GenusController');
        } else {
            $genus = Genus::find($input);
            $species = $genus->species();
        }
        $species = $species->get(['id','name']);
        return $species;
    }
}
