<?php

namespace App\Repositories\Biography\Picture;

use App\Models\Picture;
use App\Repositories\Biography\Picture\PictureInterface as PictureInterface;

class PictureRepository implements PictureInterface
{

    public function index(array $requestParams) {
        $pictureList = Picture::all();
        return $pictureList;
    }

    public function find(int $id) {
        return Picture::findOrFail($id)->get();
    }

    public function add(Picture $picture) {
        $this->picture[$picture->id] = $picture;
    }

    public function create() {
        $picture = new Picture;
        return $picture;
    }

    public function edit($picture_id) {
        $picture = Picture::findOrFail($picture_id);
        return $picture;
    }

    public function store(array $request)
    {
        $picture = new Picture;
        $picture->fill($request);
        return $picture->save();
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
        $picture = Picture::findOrFail($request['id']);
        $picture->update($request);
        return $picture->save();
    }

    public function delete(int $id)
    {
        return Picture::findOrFail($id)->delete();
    }


}
