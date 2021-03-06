<?php

namespace App\Repositories\Biography\Species;

use App\Models\Genus;
use App\Models\Species;
use App\Models\Biome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
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
//        if (isset($requestParams['joinBiome'])) {
//            $joinBiome = $requestParams['joinBiome'];
//            $species = $species->join('species_biomes', 'species_id', 'on', 'biome_id');
//        }
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
        return Species::find($id)->get();
    }

    public function add(Species $species) {
        $this->species[$species->id] = $species;
    }

    public function delete(int $id)
    {
        return Species::find($id)->delete();
    }

    public function remove(int $id) {
        unset($this->species['id']);
    }

    public function getSpeciesByGenus(int $genus_id) {
        return array_filter($this->getAll()->toArray(), function ($species) use ($genus_id) {
            return $this->species->genus_id === $genus_id;
        });
    }

    public function getSpeciesByBiome(int $biome_id) {
        return array_filter($this->species, function ($species) use ($biome_id) {
            return in_array($biome_id, $this->species->biomes);
        });
    }

    public function addBiome($biome_id) {

    }

    public function store(array $request)
    {
        $species = new Species;
        $species->name = $request['name'];
        $species->genus_id = $request['genus_id'];
        $species->wiki = $request['wiki'];
        $species->age = $request['age'];
        $species->size = $request['size'];
        $species->weight = $request['weight'];
        $species->rrna = $request['rrna'];
        $species->save();
        $biomes = $request['biomes'];
        foreach ($biomes as $biome)
            $species->biomes()->attach($biome);
        $species->save();
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
        $id = $request['id'];
        $species = Species::find($id);
        $species->name = $request['name'];
        $species->genus_id = $request['genus_id'];
        $species->wiki = $request['wiki'];
        $species->age = $request['age'];
        $species->size = $request['size'];
        $species->weight = $request['weight'];
        $species->rrna = $request['rrna'];
        $species->save();
        $biomes = $request['biomes'];
        $species->biomes()->detach();
        foreach ($biomes as $biome)
            $species->biomes()->attach($biome);
        $species->save();
        return response('Species edit success!', 200)
            ->header('Content-Type', 'text/plain');
    }

    public function biomes() {
        $species_id = intval(Input::get('species_id'));
        $all = Biome::get();
        $biomes = Biome::whereHas('species', function($q) use($species_id) {
            $q->where('species_id', $species_id);
        })->get();
        $nonbiomes = $all->diff($biomes)->toArray();
        $biomes = $biomes->toArray();
        $response = array();
        foreach ($biomes as $biome) {
            $biome['checked'] = ' checked';
            $response[$biome['name']] = $biome;
        };
        foreach ($nonbiomes as $nonbiome) {
            $nonbiome['checked'] = '';
            $response[$nonbiome['name']] = $nonbiome;
        };
        ksort($response);
        return $response;
    }

}
