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
        'weight',
        'rrna'
    ];

    public function genus() {
        return $this->belongsTo(Genus::class);
    }

    public function biomes() {
        return $this->belongsToMany(Biome::class, 'biome_species', 'species_id', 'biome_id');
    }

    public function allBiomes() {
        $speciesBiomes = $this->biomes()->pluck('biome_id')->toArray();
        $biomesList = Biome::all();
        foreach ($biomesList as $biome) {
            if (in_array($biome->id, $speciesBiomes)) {
                $biome['checked'] = 'checked';
            } else {
                $biome['checked'] = '';
            }
        }
        return $biomesList;
    }

}