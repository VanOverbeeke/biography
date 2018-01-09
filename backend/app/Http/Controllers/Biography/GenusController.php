<?php

namespace App\Http\Controllers\Biography;

use App\Http\Requests\StoreGenus;
use App\Models\Genus;
use App\Repositories\Biography\Genus\GenusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;

class GenusController extends Controller
{
    /**
     * @var GenusRepository $repository
     */
    public $repository;

    /**
     * GenusController constructor.
     * @param SpeciesRepository $repository
     */
    public function __construct(GenusRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $requestParams = $request->all();
        [$genusList, $sortBy, $filterBy] = $this->repository->index($requestParams);
        return view('genus.index', compact(['genusList', 'sortBy', 'filterBy']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genus = $this->repository->create();
        return view('genus.create', compact('genus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGenus $request)
    {
        $requestParams = $request->all();
        $this->repository->store($requestParams);
        return response(
            '<h2>Genus addition success!</h2><h2><a href="'.route('genus.index').'">Return to index</a></h2>',
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
    public function edit(int $id)
    {
        $genus = $this->repository->find($id);
        return view('genus.edit', compact(['genus']));
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
        $this->repository->update($request->all());
        return response(
            '<h2>Genus edit success!</h2><h2><a href="'.route('genus.index').'">Return to index</a></h2>',
            200)
            ->header('Content-Type', 'text/html');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        return response(
            '<h2>Genus deletion success!</h2><h2><a href="'.route('genus.index').'">Return to index</a></h2>',
            200)
            ->header('Content-Type', 'text/html');
    }

//    public function dropdown()
//    {
//        return $this->repository->dropdown();
//    }

}
