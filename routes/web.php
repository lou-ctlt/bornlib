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

Route::get('/admin','Admin\UserController@index')->name('Admin');
Route::get('/admin/user/delete','Admin\UserController@deleteUser')->name('DeleteUser');
Route::get('/admin/user/show','Admin\UserController@showUser')->name('ShowUser');
Route::get('/admin/user/edit','Admin\UserController@editUser')->name('EditUser');
Route::post('admin/user/update','Admin\UserController@updateUser')->name('UpdateUser');

