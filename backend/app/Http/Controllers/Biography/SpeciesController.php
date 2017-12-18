<?php

namespace App\Http\Controllers\Biography;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSpecies;
use App\Models\Genus;
use App\Models\Species;
use App\Models\Biome;
use App\Repositories\Biography\Genus\GenusRepository;
use App\Repositories\Biography\Species\SpeciesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class SpeciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $species_id="*")
    {
        $sortBy = $request->has('sortBy') ? $request->get('sortBy') : 'id';
        $filterBy = $request->has('filterBy') ? $request->get('filterBy') : 'all';
        if($species_id!='*') {
            $species = Species::with(['biomes', 'genus'])
                ->where('id', '=', $species_id)
                ->get();
        } elseif ($filterBy==='all') {
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

        return view('/species/index', compact(['species', 'sortBy', 'filterBy', 'selectID']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genusRepository = new GenusRepository();
        $genus_collection = $genusRepository->getAllWithProps(['id','name']);
        $genus_array = $genus_collection->mapWithKeys(function ($genus) {
            return [$genus['id'] => $genus['name']];
        });
        return view('/species/create', compact(['genus_array']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSpecies $request)
    {
        $species = new Species;
        $species->name = $request->get('name');
        $species->genus_id = $request->get('genus_id');
        $species->wiki = $request->get('wiki');
        $species->age = $request->get('age');
        $species->size = $request->get('size');
        $species->weight = $request->get('weight');
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
    public function edit(Request $request, $species_id='None')
    {
        $genusRepository = new GenusRepository();
        $genus_collection = $genusRepository->getAllWithProps(['id','name']);
        $genus_array = $genus_collection->mapWithKeys(function ($genus) {
            return [$genus['id'] => $genus['name']];
        });

        if($species_id==='None') {
            $species_name = 'Select genus first';
            $genus_id = 'None';
            $genus_name = 'Select genus';
        } else {
            $species = Species::where('id', '=', $species_id)
                ->get(['name', 'genus_id'])[0];
            $species_name = $species->name;
            $genus_id = $species->genus_id;
            $genus_name = Genus::where('id', '=', $genus_id)
                ->get(['name'])[0]
                ->name;
        }
        $data = \App\Models\Genus::select(['id', 'name'])->get()->toArray();
        return view('species.edit', compact(['species', 'species_id', 'species_name', 'genus_array', 'genus_id', 'genus_name']));
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
            'name' => 'string|required|unique:species|max:50',
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {
        $speciesRepository = new SpeciesRepository();
        $returnStatus = $speciesRepository->delete($id);
        if ($returnStatus) {
            return response('Species deletion success!', 200)
                ->header('Content-Type', 'text/plain');
        }
    }

    public function find() {
        $input = Input::get('genus_id');
        if ($input === 'None') {
            return [];
        } else {
            $genus = Genus::find($input);
            $species = $genus->species();
        }
        $species = Response::make($species->get(['id','name']));
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

    public function search() {
        return view('species.search');
    }

}
