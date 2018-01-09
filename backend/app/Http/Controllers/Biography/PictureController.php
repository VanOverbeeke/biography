<?php

namespace App\Http\Controllers\Biography;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePicture;
use App\Models\Genus;
use App\Models\Species;
use App\Models\Picture;
use App\Models\Biome;
use App\Repositories\Biography\Picture\PictureRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PictureController extends Controller
{
    /**
     * @var PictureRepository $repository
     */
    public $repository;

    /**
     * PictureController constructor.
     * @param PictureRepository $repository
     */
    public function __construct(PictureRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request) {
        $requestParams = $request->all();
        $pictureList = $this->repository->index($requestParams);
        return view('picture.index', compact(['pictureList', 'requestParams']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $picture = $this->repository->create();
        return view('picture.create', compact(['picture']));
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
    public function edit($picture_id)
    {
        $picture = $this->repository->edit($picture_id);
        return view('picture.edit', compact(['picture']));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePicture $request)
    {
        $request = $request->all();
        $this->repository->store($request);
        return response(
            '<h2>Picture addition success!</h2><h2><a href="'.route('picture.index').'">Return to index</a></h2>',
            200)
            ->header('Content-Type', 'text/html');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StorePicture|Request $request
     * @param $picture_id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePicture $request)
    {
        $requestParams = $request->all();
        $this->repository->update($requestParams);
        return response(
            '<h2>Picture edit success!</h2><h2><a href="'.route('picture.index').'">Return to index</a></h2>',
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
            '<h2>Picture deletion success!</h2><h2><a href="'.route('picture.index').'">Return to index</a></h2>',
            200)
            ->header('Content-Type', 'text/html');
    }

}
