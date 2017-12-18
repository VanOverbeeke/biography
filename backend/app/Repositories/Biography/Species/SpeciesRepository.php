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
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getFiltered(Request $request)
    {
        $sortBy = $request->has('sortBy') ? $request->get('sortBy') : 'id';
        $filterBy = $request->has('filterBy') ? $request->get('filterBy') : 'all';
        if($filterBy==='all') {
            $species = Species::with(['biomes', 'genus'])
                ->get()
                ->sortBy($sortBy);
        } else {
            $species = Species::whereHas('biomes', function ($query) use ($filterBy) {
                $query->where('biomes.id', 'LIKE', $filterBy);
            })
                ->get()
                ->sortBy($sortBy);
        }
        return view('/species/index', compact(['species', 'sortBy', 'filterBy']));
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
            'name' => 'string|required|unique:species|max:50',
            'genus_id' => 'required|exists:genus,id',
            'wiki' => 'nullable|url',
            'age' => 'nullable|numeric',
            'size' => 'nullable|numeric',
            'weight' => 'nullable|numeric'
        ]);
        $species = new Species;
        $species->name = $validatedData['name'];
        $species->genus_id = $validatedData['genus_id'];
        $species->wiki = $validatedData['wiki'];
        $species->age = $validatedData['age'];
        $species->size = $validatedData['size'];
        $species->weight = $validatedData['weight'];
        $species->save();
        $biomes = $request->get('biomes');
        $species->biomes()->detach();
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

    public function findFiltered($genus_id) {
        $input = Input::get('genus_id');
        if ($input === 'None') {
            $species = [];
        } else {
            $species = Genus::find($input)->species()->get(['id','name']);
        }
        return $species;
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

    public function metrics() {
        $species_id = intval(Input::get('species_id'));
        $species = Species::where('id', '=', $species_id)->get()[0];
        $response = array();
        $response['weight'] = [
            'name'=>'weight',
            'label'=>'Weight (kg)',
            'type'=>'number',
            'old'=>$species->weight
        ];
        $response['size'] = [
            'name'=>'size',
            'label'=>'Size (m)',
            'type'=>'number',
            'old'=>$species->size
        ];
        $response['age'] = [
            'name'=>'age',
            'label'=>'Age (y)',
            'type'=>'number',
            'old'=>$species->age
        ];
        $response['wiki'] = [
            'name'=>'wiki',
            'label'=>'Wikipedia',
            'type'=>'url',
            'old'=>$species->wiki
        ];
        return $response;
    }

}
