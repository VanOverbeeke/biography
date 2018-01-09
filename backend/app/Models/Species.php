<?php
/**
 * Created by PhpStorm.
 * User: lennert
 * Date: 12/4/2017
 * Time: 11:00
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Picture;
//use Illuminate\Support\Facades\DB;

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

    protected $dates = ['deleted_at'];

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

    public function pictures() {
        return $this->morphMany('App\Models\Picture', 'imageable', 'imageable_type', 'imageable_id')->get();
    }

    public function scopeDropdown($query) {
        return $query->select(['id','name'])->get()->mapWithKeys(function ($record) {
            return [$record['id'] => $record['name']];
        });
    }

}