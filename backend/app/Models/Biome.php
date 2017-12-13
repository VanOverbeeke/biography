<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biome extends Model
{
    protected $fillable = [
        'name',
    ];

    public function species() {
        return $this->belongsToMany(Species::class);
    }

    public function hasSpecies($species_id) {
        return $this->species()->where('species_id', '=', $species_id)->exists();
    }
}
