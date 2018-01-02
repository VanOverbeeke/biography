<?php

namespace App\Http\Controllers\Biography;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePicture;
use App\Models\Genus;
use App\Models\Picture;
use App\Models\Biome;
use App\Repositories\Biography\Picture\PictureRepository;
use Illuminate\Http\Request;

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
        return view('/picture/index', compact(['pictureList', 'requestParams']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $picture = new Picture;
        return view('Picture.create', compact(['picture']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePicture $request)
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
    public function edit($picture_id)
    {
        $picture = Picture::find($picture_id);
        $genus_id = $picture->genus_id;
        $genus = Genus::find($picture->genus_id)->name;
        $biomes = Biome::all();
        $biomesArray = $picture->allBiomes();
        $name = $picture->name;
        return view('/Picture/edit', compact(['Picture_id', 'Picture', 'name', 'genus', 'biomes', 'biomesArray']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StorePicture|Request $request
     * @param $picture_id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePicture $request, $picture_id)
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
    public function delete($id) {
        $pictureRepository = new PictureRepository();
        $returnStatus = $pictureRepository->delete($id);
        if ($returnStatus) {
            return response('Picture deletion success!', 200)
                ->header('Content-Type', 'text/plain');
        }
    }

    /**
     *
     * @param $id
     * @return mixed
     */
    public function readDeleted($id) {
        $picture = Picture::withTrashed()->find($id);
        $picture = Picture::onlyTrashed()->find($id);
        return $picture;
    }

    public function restore($id) {
        $picture = Picture::withTrashed()
            ->where('id', $id)
            ->restore();
        return $picture;
    }

}
