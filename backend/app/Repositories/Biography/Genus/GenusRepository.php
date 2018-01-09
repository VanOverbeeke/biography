<?php

namespace App\Repositories\Biography\Genus;

use App\Models\Genus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GenusRepository implements GenusInterface
{

    public function find(int $id) {
        return $this->findOrFail($id);
    }

    public function add(Genus $genus) {
        $this->species[$genus->id] = $genus;
    }

    public function create() {
        return new Genus;
    }

    public function delete(int $id)
    {
        return Genus::findOrFail($id)->delete();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(array $requestParams)
    {
        $filterBy = (isset($requestParams['filterBy'])) ? $requestParams['filterBy'] : '%';
        $sortBy = (isset($requestParams['sortBy'])) ? $requestParams['sortBy'] : 'id';
        $genusList = $genusList = Genus::with(['species']);
        if (!$filterBy==='%') {
            $genusList = $genusList->whereHas('species', function ($query) use ($filterBy) {
                    $query->where('species.id', 'LIKE', $filterBy);
            });
        }
        $genusList = $genusList->get()->sortBy($sortBy);
        return [$genusList, $sortBy, $filterBy];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(array $requestParams)
    {
        $genus = new Genus;
        $genus->fill($requestParams);
        $genus->save();
    }

    public function update($requestParams)
    {
        $genus = Genus::findOrFail($requestParams['id']);
        $genus->update($requestParams);
        return $genus->save();
    }


//    public function dropdown()
//    {
//        return Genus::select(['id','name'])->get()->mapWithKeys(function ($genus) {
//            return [$genus['id'] => $genus['name']];
//        });
//    }

}
