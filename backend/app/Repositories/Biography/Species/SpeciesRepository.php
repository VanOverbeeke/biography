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

    public function index(array $queryParams) {
        $species = Species::with(['biomes', 'genus']);
        if ($queryParams['species_id']) {
            $species = $species->where('id', '=', $queryParams['species_id']);
        }
        if ($queryParams['filterByBiomes']) {
            $filterByBiomes = $queryParams['filterByBiomes'];
            $species = $species->whereHas('biomes', function ($query) use ($filterByBiomes) {
                $query->where('biomes.id', 'LIKE', $filterByBiomes);
            });
        }
        if ($queryParams['sortBy']) {
            $species = $species->orderBy($queryParams['sortBy']);
        }
        $species = $species->get();
        return view('/species/index', compact(['species', 'queryParams']));
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

    public function store(Request $request)
    {
        $species = new Species;
        $species->name = $request->get('name');
        $species->genus_id = $request->get('genus_id');
        $species->wiki = $request->get('wiki');
        $species->age = $request->get('age');
        $species->size = $request->get('size');
        $species->weight = $request->get('weight');
        $species->rrna = $request->get('rrna');
        $species->save();
        $biomes = $request->get('biomes');
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
    public function update(Request $request)
    {
        $id = $request['species_id'];
        $validatedData = $request->validate([
//            'name' => 'string|required|unique:species|max:50',
            'genus_id' => 'required|exists:genus,id',
            'wiki' => 'nullable|url',
            'age' => 'nullable|numeric',
            'size' => 'nullable|numeric',
            'weight' => 'nullable|numeric'
        ]);
        $species = Species::find($id);
//        $species->name = $validatedData['name'];
        $species->genus_id = $validatedData['genus_id'];
        $species->wiki = $validatedData['wiki'];
        $species->age = $validatedData['age'];
        $species->size = $validatedData['size'];
        $species->weight = $validatedData['weight'];

        $species->save();
        $biomes = $request['biomes'];
        $species->biomes()->detach();
        foreach ($biomes as $biome)
            $species->biomes()->attach($biome);
        $species->save();
        return response('Species edit success!', 200)
            ->header('Content-Type', 'text/plain');
    }

    public function query( string $query, array $queryParams) {
        $species = Species::where('name', 'like', "%$query%")->get();
        $genusList = Genus::where('name', 'like', "%$query%")->pluck('id')->toArray();
        $speciesByGenus = Species::whereIn('genus_id', $genusList )->get();
        $species = $species->merge($speciesByGenus);
        $queryParams = [
            'species_id' => 0,
            'genus_id' => 0,
            'filterByBiomes' => 0,
            'sortBy' => 0,
        ];
        return view('/species/index', compact(['species', 'queryParams']));
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
