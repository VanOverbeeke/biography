<?php

use App\Http\Controllers\SpeciesController;
use App\Models\Genus;
use App\Models\Species;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Response;

Route::get('/', function () {
    return view('welcome');
});

Route::get('genus/index', [
    'uses' => 'Biography\GenusController@index',
    'as' => 'genus.index',
]);

Route::get('genus', [
    'uses' => 'Biography\GenusController@store',
    'as' => 'genus.store'
]);

Route::get('genus/create', [
    'uses' => 'Biography\GenusController@create',
    'as' => 'genus.create'
]);

Route::get('species/index', [
    'uses' => 'Biography\SpeciesController@index',
    'as' => 'species.index',
]);

Route::get('species', [
    'uses' => 'Biography\SpeciesController@store',
    'as' => 'species.store'
]);

Route::get('species/create', [
    'uses' => 'Biography\SpeciesController@create',
    'as' => 'species.create'
]);

Route::get('species/edit', [
    'uses' => 'Biography\SpeciesController@edit',
    'as' => 'species.edit'
]);

Route::post('species/update', [
    'uses' => 'Biography\SpeciesController@update',
    'as' => 'species.update'
]);

Route::get('/getSpecies', [
    'uses' => 'Biography\SpeciesController@find',
    'as' => 'species.find'
]);

Route::get('/getBiomes', [
    'uses' => 'Biography\SpeciesController@biomes',
    'as' => 'species.biomes'
]);

Route::get('/getMetrics', [
    'uses' => 'Biography\SpeciesController@metrics',
    'as' => 'species.metrics'
]);

Route::get('/contact', function () {
    return view('contact');
});
