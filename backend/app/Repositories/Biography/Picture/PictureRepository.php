<?php

namespace App\Repositories\Biography\Picture;

use App\Models\Picture;
use App\Repositories\Biography\Picture\PictureInterface as PictureInterface;

class PictureRepository implements PictureInterface
{

    public function getAll() {
        return Picture::all();
    }

    public function index(array $requestParams) {
        $pictureList = Picture::all();
        return $pictureList;
    }

    public function find(int $id) {
        return Picture::find($id)->get();
    }

    public function add(Picture $picture) {
        $this->picture[$picture->id] = $picture;
    }

    public function delete(int $id)
    {
        return Picture::find($id)->delete();
    }

    public function store(array $request)
    {
        $picture = new Picture;
        $picture->fill($request);
        $picture->save();
        return response('Picture addition success!', 200)
            ->header('Content-Type', 'text/plain');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(array $request)
    {
        $id = $request['id'];
        $picture = Picture::find($id);
        $picture->update($request);
        $picture->save();
        return response('Picture edit success!', 200)
            ->header('Content-Type', 'text/plain');
    }

}
