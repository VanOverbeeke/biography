<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
//Route::resource('user', 'Auth\LoginController');

/*
 * AJAX linkage
 */

Route::get('/getBiomes', [
    'uses' => 'Biography\SpeciesController@biomes',
    'as' => 'species.biomes'
]);
Route::get('/getMetrics', [
    'uses' => 'Biography\SpeciesController@metrics',
    'as' => 'species.metrics'
]);


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
