<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post("/home/update", "HomeController@update")->name('home/update');
// Auth::routes(); // J'ose pas les supprimer mais elles se sont créé et ne servent a rien je crois ^^

// Route::get('/home', 'HomeController@index')->name('home');

