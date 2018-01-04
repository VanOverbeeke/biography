<?php

namespace App\Repositories\Biography\Species;

use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\Genus;
use App\Models\Species;
use App\Models\Biome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use App\Repositories\Biography\Species\SpeciesInterface as SpeciesInterface;

class SpeciesRepository implements SpeciesInterface
{

    public function getAll() {
        return Species::all();
    }

    public function index(array $requestParams) {
        $species = Species::with(['biomes', 'genus']);
        if (isset($requestParams['oneBiome']) and ($requestParams['oneBiome'] != 0)) {
            $oneBiome = $requestParams['oneBiome'];
            $species = $species->whereHas('biomes', function ($query) use ($oneBiome) {
                $query->where('biomes.id', $oneBiome);
            });
        }
        if (isset($requestParams['query'])) {
            $genusList = Genus::where('name', 'like', '%'.$requestParams['query'].'%')->pluck('id')->toArray();
            $species = $species->where(function($q) use ($genusList, $requestParams) {
                $q->whereIn('genus_id', $genusList )->orWhere('name', 'like', '%'.$requestParams['query'].'%');
            });
        }
        if (isset($requestParams['ageLarger'])) {
            $species = $species->where('age', '>=', $requestParams['ageLarger']);
        }
        if (isset($requestParams['ageSmaller'])) {
            $species = $species->where('age', '<=', $requestParams['ageSmaller']);
        }
        if (isset($requestParams['ageEqual'])) {
            $species = $species->where('age', '=', $requestParams['ageEqual']);
        }
        if (isset($requestParams['sizeLarger'])) {
            $species = $species->where('size', '>=', $requestParams['sizeLarger']);
        }
        if (isset($requestParams['sizeSmaller'])) {
            $species = $species->where('size', '<=', $requestParams['sizeSmaller']);
        }
        if (isset($requestParams['sizeEqual'])) {
            $species = $species->where('size', '=', $requestParams['sizeEqual']);
        }
        if (isset($requestParams['weightLarger'])) {
            $species = $species->where('weight', '>=', $requestParams['weightLarger']);
        }
        if (isset($requestParams['weightSmaller'])) {
            $species = $species->where('weight', '<=', $requestParams['weightSmaller']);
        }
        if (isset($requestParams['weightEqual'])) {
            $species = $species->where('weight', '=', $requestParams['weightEqual']);
        }
        if (isset($requestParams['sortBy'])) {
            $sortDir = ($requestParams['sortDir']) ? 'ASC' : 'DESC';
            $species = $species->orderBy($requestParams['sortBy'], $sortDir);
        }
        $speciesList = $species->get();
        return $speciesList;
    }

    public function find(int $id) {
        return Species::findOrFail($id)->get();
    }

    public function add(Species $species) {
        $this->species[$species->id] = $species;
    }

    public function delete(int $id)
    {
        return Species::findOrFail($id)->delete();
    }

    public function store(array $request)
    {
        $species = new Species;
        $species->fill($request);
        $species->save();
        $species->biomes()->attach($request['biomes']);
        return response('Species addition success!', 200)
            ->header('Content-Type', 'text/plain');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(array $request)
    {
        $species = Species::findOrFail($request['id']);
        $species->update($request);
        $species->save();
        $species->biomes()->sync($request['biomes']);
        return response('Species edit success!', 200)
            ->header('Content-Type', 'text/plain');
    }

}
