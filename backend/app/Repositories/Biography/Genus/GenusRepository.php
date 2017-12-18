<?php

namespace App\Repositories\Biography\Genus;

use App\Models\Genus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GenusRepository implements GenusInterface
{

    public function getAllWithProps(array $properties = []) {
        if ($properties) {
            return Genus::select($properties)->get();
        } else {
            return Genus::all();
        }
    }

    public function find(int $id) {
        return $this->find($id);
    }

    public function add(Genus $genus) {
        $this->species[$genus->id] = $genus;
    }

    public function delete(int $id)
    {
        return Genus::find($id)->delete();
    }

    public function remove(int $id) {
        unset($this->genus['id']);
    }
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

}
