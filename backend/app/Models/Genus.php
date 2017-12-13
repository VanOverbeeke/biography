<?php
/**
 * Created by PhpStorm.
 * User: lennert
 * Date: 12/4/2017
 * Time: 11:00
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Genus extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $table = 'genus';

    public function species() {
        return $this->hasMany(Species::class);
    }
}