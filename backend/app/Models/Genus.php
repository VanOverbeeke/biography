<?php
/**
 * Created by PhpStorm.
 * User: lennert
 * Date: 12/4/2017
 * Time: 11:00
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Repositories\Biography\Genus\GenusRepository;
use App\Models\Species;
use App\Models\Biome;

class Genus extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $table = 'genus';

    public function species() {
        return $this->hasMany(Species::class);
    }

    public function genusArray(){
        $genusRepository = new GenusRepository();
        $genusCollection = $genusRepository->getAllWithProps(['id','name']);
        $genusArray = $genusCollection->mapWithKeys(function ($genus) {
            return [$genus['id'] => $genus['name']];
        });
        return $genusArray;
    }

    public function biomes() {
        $biomes = [];
        foreach ($this->species as $specie) {
            foreach ($specie->biomes as $biome) {
                array_push($biomes, $biome->name);
            }
        }
        return array_unique($biomes);
    }

}