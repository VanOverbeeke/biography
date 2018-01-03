<?php

namespace App\Repositories\Biography\Picture;

use App\Models\Genus;
use App\Models\Picture;
use App\Models\Biome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use App\Repositories\Biography\Picture\PictureInterface as PictureInterface;

class PictureRepository implements PictureInterface
{

    public function getAll() {
        return Picture::all();
    }

    public function index(array $requestParams) {
        $picture = Picture::all();
        $pictureList = $picture;
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

    public function remove(int $id) {
        unset($this->picture['id']);
    }

    public function store(array $request)
    {
        $picture = new Picture;
        $picture->path = $request['path'];
        $picture->imageable_id = $request['imageable_id'];
        $picture->imageable_type = $request['imageable_type'];
        $picture->save();
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
        $picture->name = $request['name'];
        $picture->genus_id = $request['genus_id'];
        $picture->wiki = $request['wiki'];
        $picture->age = $request['age'];
        $picture->size = $request['size'];
        $picture->weight = $request['weight'];
        $picture->rrna = $request['rrna'];
        $picture->save();
        $biomes = $request['biomes'];
        $picture->biomes()->detach();
        foreach ($biomes as $biome)
            $picture->biomes()->attach($biome);
        $picture->save();
        return response('Picture edit success!', 200)
            ->header('Content-Type', 'text/plain');
    }

    public function biomes() {
        $picture_id = intval(Input::get('Picture_id'));
        $all = Biome::get();
        $biomes = Biome::whereHas('Picture', function($q) use($picture_id) {
            $q->where('Picture_id', $picture_id);
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

}
