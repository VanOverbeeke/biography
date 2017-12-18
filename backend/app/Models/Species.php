<?php
/**
 * Created by PhpStorm.
 * User: lennert
 * Date: 12/4/2017
 * Time: 11:00
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    protected $table = 'species';

    protected $fillable = [
        'name',
        'genus_id',
        'wiki',
        'age',
        'size',
        'weight'
    ];


    public function genus() {
        return $this->belongsTo(Genus::class);
    }

    public function biomes() {
        return $this->belongsToMany(Biome::class, 'biome_species', 'species_id', 'biome_id');
    }

}