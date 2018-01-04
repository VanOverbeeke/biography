<?php

namespace App\Http\Controllers\Biography;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSpecies;
use App\Models\Genus;
use App\Models\Species;
use App\Models\Biome;
use App\Repositories\Biography\Species\SpeciesRepository;
use Illuminate\Http\Request;

class SpeciesController extends Controller
{
    /**
     * @var SpeciesRepository $repository
     */
    public $repository;

    /**
     * SpeciesController constructor.
     * @param SpeciesRepository $repository
     */
    public function __construct(SpeciesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request) {
        $requestParams = $request->all();
        $speciesList = $this->repository->index($requestParams);
        return view('species.index', compact(['speciesList', 'requestParams']));
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
        $requestParams = $request->all();
        return $this->repository->store($requestParams);
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
        return view('species.edit', compact(['species_id', 'species', 'name', 'genus', 'biomes', 'biomesArray']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreSpecies|Request $request
     * @param $species_id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSpecies $request)
    {
        $requestParams = $request->all();
        return $this->repository->update($requestParams);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $speciesRepository = new SpeciesRepository();
        $returnStatus = $speciesRepository->delete($id);
        if ($returnStatus) {
            return response('Species deletion success!', 200)
                ->header('Content-Type', 'text/plain');
        }
    }

    /**
     *
     * @param $id
     * @return mixed
     */
    public function readDeleted($id) {
        $species = Species::withTrashed()->find($id);
        $species = Species::onlyTrashed()->find($id);
        return $species;
    }

    public function restore($id) {
        $species = Species::withTrashed()
            ->where('id', $id)
            ->restore();
        return $species;
    }

}
