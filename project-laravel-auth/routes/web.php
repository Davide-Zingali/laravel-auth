<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// ---------------------------------------------------------------------------

Route::post('/update', 'HomeController@updateIcon') -> name('update-icon');

Route::get('/cleare', 'HomeController@clearIcon') -> name('clear-icon');

Route::get('/delete', 'HomeController@deleteIcons') -> name('delete-icon');
