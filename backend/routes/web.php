<?php

use App\Http\Controllers\SpeciesController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('details/{sortBy}', [
    'uses' => 'Biography\SpeciesController@show_table',
    'as' => 'show_table'
]);


Route::get('species/create', [
    'uses' => 'Biography\SpeciesController@create',
    'as' => 'create_species'
]);

Route::get('species', [
    'uses' => 'Biography\SpeciesController@store',
    'as' => 'store_species'
]);

Route::get('/contact', function () {
    return view('contact');
});
