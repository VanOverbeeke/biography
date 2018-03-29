<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name'
    ];

    public function users() {
        return $this->hasMany('App\User');
    }

    public function scopeDropdown($query) {
        return $query->select(['id','name'])->get()->mapWithKeys(function ($record) {
            return [$record['id'] => $record['name']];
        });
    }
}
