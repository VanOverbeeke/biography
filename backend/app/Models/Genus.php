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
use App\Models\Picture;
use PhpParser\ErrorHandler\Collecting;

class Genus extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $table = 'genus';

    public function species() {
        return $this->hasMany(Species::class);
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

    public function pictures()
    {
        return $this->morphMany('App\Models\Picture', 'imageable', 'imageable_type', 'imageable_id')->get();
    }

    public function scopeDropdown($query) {
        return $query->select(['id','name'])->get()->mapWithKeys(function ($record) {
            return [$record['id'] => $record['name']];
        });
    }

}