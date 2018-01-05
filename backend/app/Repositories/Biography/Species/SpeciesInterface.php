<?php

namespace App\Repositories\Biography\Species;

use App\Models\Species;

interface SpeciesInterface {

    public function add(Species $species);

    public function find(int $id);

    public function delete(int $id);

}