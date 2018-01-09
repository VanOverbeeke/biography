<?php

namespace App\Http\Controllers\Biography;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSpecies;
use App\Models\Genus;
use App\Models\Picture;
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
        [$species, $genusArray] = $this->repository->create();
        return view('species.create', compact(['species', 'genusArray']));
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
        $this->repository->store($requestParams);
        return response(
            '<h2>Species creation success!</h2><h2><a href="'.route('species.index').'">Return to index</a></h2>',
            200)
            ->header('Content-Type', 'text/html');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->edit($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($species_id)
    {
        $species = $this->repository->edit($species_id);
        return view('species.edit', compact(['species_id', 'species']));
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
        $this->repository->update($requestParams);
        return response(
            '<h2>Species edit success!</h2><h2><a href="'.route('species.index').'">Return to index</a></h2>',
            200)
            ->header('Content-Type', 'text/html');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $this->repository->delete($id);
        return response(
            '<h2>Species deletion success!</h2><h2><a href="'.route('species.index').'">Return to index</a></h2>',
            200)
            ->header('Content-Type', 'text/html');
    }


}
