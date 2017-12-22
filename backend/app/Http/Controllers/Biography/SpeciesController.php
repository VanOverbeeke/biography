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
        $species = new Species;
        $tempGenus = new Genus;
        $genusArray = $tempGenus->genusArray();
        $speciesArray = Species::all();
        $biomes = Biome::all();
        return view('species.create', compact(['species', 'speciesArray', 'genusArray', 'biomes']));
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
    public function edit($species_id)
    {
        $species = Species::find($species_id);
        $genus_id = $species->genus_id;
        $genus = Genus::find($species->genus_id)->name;
        $biomes = Biome::all();
        $biomesArray = $species->allBiomes();
        $name = $species->name;
        return view('/species/edit', compact(['species_id', 'species', 'name', 'genus', 'biomes', 'biomesArray']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSpecies $request, $species_id)
    {
        $species = Species::find($species_id);
        $species->name = $request->get('name');
        $species->genus_id = $request->get('genus_id');
        $species->wiki = $request->get('wiki');
        $species->age = $request->get('age');
        $species->size = $request->get('size');
        $species->weight = $request->get('weight');
        $species->rrna = $request->get('rrna');
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
        $response['rrna'] = [
            'name'=>'rrna',
            'label'=>'rRNA',
            'type'=>'text',
            'old'=>$species->rrna
        ];
        return $response;
    }

    public function search() {
        $tempGenus = new Genus;
        $genusArray = $tempGenus->genusArray();
        $speciesArray = Species::all();
        return view('species.search', compact(['speciesArray', 'genusArray']));
    }

}
