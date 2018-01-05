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

    public function delete(int $id)
    {
        return Picture::findOrFail($id)->delete();
    }

    public function edit($picture_id) {
        $picture = Picture::findOrFail($picture_id);
        return $picture;
    }

    public function store(array $request)
    {
        $picture = new Picture;
        $picture->fill($request);
        $picture->save();
        return response(
            '<h2>Picture addition success!</h2><h2><a href="'.route('picture.index').'">Return to index</a></h2>',
            200)
            ->header('Content-Type', 'text/html');
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
        $picture = Picture::findOrFail($id);
        $picture->update($request);
        $picture->save();
        return response(
            '<h2>Picture edit success!</h2><h2><a href="'.route('picture.index').'">Return to index</a></h2>',
            200)
            ->header('Content-Type', 'text/html');
    }

}
