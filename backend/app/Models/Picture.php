<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{

    protected $fillable = [
        'imageable_id',
        'imageable_type',
        'path'
    ];

    protected $guarded = [
        'id'
    ];

    public function imageable() {
        return $this->morphTo();
    }
}
