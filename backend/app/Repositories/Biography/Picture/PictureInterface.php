<?php

namespace App\Repositories\Biography\Picture;

use App\Models\Picture;

interface PictureInterface {

    public function add(Picture $picture);

    public function find(int $id);

    public function delete(int $id);

}