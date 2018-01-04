<?php

use Illuminate\Support\Facades\Route;


/*
 * General
 */
Route::get('/', function () {
    return view('welcome');
});
Route::get('/contact', function () {
    return view('contact');
});

/*
 * Resources
 */
Route::resource('genus', 'Biography\GenusController');
Route::resource('species', 'Biography\SpeciesController');
Route::resource('picture', 'Biography\PictureController');

/*
 * AJAX linkage
 */
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

