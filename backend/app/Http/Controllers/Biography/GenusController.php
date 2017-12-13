<?php

namespace App\Http\Controllers\Biography;

use App\Models\Genus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return view('/genus/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'string|required|unique:genus|max:50',
        ]);
        $genus = new Genus;
        $genus->name = $validatedData->get('name');
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
    public function destroy($id)
    {
        //
    }
}