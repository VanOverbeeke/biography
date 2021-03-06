<?php

namespace App\Repositories\Biography\Genus;

use App\Models\Genus;

interface GenusInterface {

    public function getAllWithProps(array $properties);

    public function add(Genus $genus);

    public function find(int $id);

    public function delete(int $id);

}