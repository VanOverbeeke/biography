<?php

namespace App;

use App\Http\Models\Species;
use Illuminate\Database\Eloquent\Model;

class Biome extends Model
{
    protected $fillable = [
        'name',
    ];

    public function species() {
        return $this->belongsToMany(Species::class);
    }
}
