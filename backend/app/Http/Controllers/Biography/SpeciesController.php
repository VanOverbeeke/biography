<?php

namespace App\Http\Controllers\Biography;

use App\Http\Controllers\Controller;
use App\Models\Genus;
use App\Models\Species;
use App\Models\Biome;
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
    public function index(Request $request)
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/species/create', compact(['species']));
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
        return view('species.edit', compact(['species']));
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

}
