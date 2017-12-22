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

Route::get('/genus/index', [
    'uses' => 'Biography\GenusController@index',
    'as' => 'genus.index',
]);

Route::get('/genus/create', [
    'uses' => 'Biography\GenusController@create',
    'as' => 'genus.create'
]);

Route::post('/genus/create', [
    'uses' => 'Biography\GenusController@store',
    'as' => 'genus.store'
]);

Route::delete('/genus/delete/{genus_id}', [
    'uses' => 'Biography\GenusController@delete',
    'as' => 'genus.delete'
]);

////////////////////////////////////////////////////

Route::get('species/index/{species_id}', [
    'uses' => 'Biography\SpeciesController@index',
    'as' => 'species.index.one',
]);

Route::get('species/index', [
    'uses' => 'Biography\SpeciesController@index',
    'as' => 'species.index',
]);

Route::get('species', [
    'uses' => 'Biography\SpeciesController@store',
    'as' => 'species.store'
]);

Route::get('species/search', [
    'uses' => 'Biography\SpeciesController@search',
    'as' => 'species.search'
]);

Route::get('species/create', [
    'uses' => 'Biography\SpeciesController@create',
    'as' => 'species.create'
]);

Route::post('species/create', [
    'uses' => 'Biography\SpeciesController@store',
    'as' => 'species.create'
]);

Route::get('species/edit/{species_id}', [
    'uses' => 'Biography\SpeciesController@edit',
    'as' => 'species.edit'
]);

Route::get('species/update/{id}', [
    'uses' => 'Biography\SpeciesController@update',
    'as' => 'species.update'
]);

Route::delete('species/delete/{species_id}', [
    'uses' => 'Biography\SpeciesController@delete',
    'as' => 'species.delete'
]);

Route::get('species/{id}', [
    'uses' => 'Biography\SpeciesController@store',
    'as' => 'species.store'
]);

///////////////////////////////////  Functions

Route::get('/getSpecies', [
    'uses' => 'Biography\GenusController@findSpecies',
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

/////////////////////////////////    General

Route::get('/contact', function () {
    return view('contact');
});
