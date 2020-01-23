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

Auth::routes(['verify' => true]);

Route::get('/',function(){
    return view ("welcome");
});

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/admin/dashboard','Admin\UserController@index')->name('Admin');
Route::get('/admin/user/delete','Admin\UserController@deleteUser')->name('DeleteUser');
Route::get('/admin/user/show','Admin\UserController@showUser')->name('ShowUser');
Route::get('/admin/user/edit','Admin\UserController@editUser')->name('EditUser');
Route::get('/admin/user/add','Admin\UserController@addUser')->name('AddUser');

Route::post('admin/user/update','Admin\UserController@updateUser')->name('UpdateUser');
Route::post('/admin/user/store','Admin\UserController@storeUser')->name('StoreUser');

//ROUTE USER
Route::group(['middleware' => ['auth', 'user'], 'prefix' => 'user'], function () {
    Route::get('/', 'HomeController@index')->name('user_dashboard');
});
//ROUTE ADMIN
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('/', 'HomeController@index')->name('admin_dashboard');
});





Route::post("/user/update", "UserController@update")->name('userUpdate')->middleware('verified');;

Route::get("/myaccount", "MyaccountController@index")->name("myaccount")->middleware('verified');;

Route::post("/reservation", "UserController@reservation")->name("reservation");

Route::post("/finreservation", "UserController@finreservation")->name("finreservation");

Route::get('/contact', 'ContactController@index')->name('contact');

Route::post('/delete', 'UserController@delete')->name('delete');

Route::get('/about', 'AboutController@index')->name('about');
Route::get('/home2', 'HomeController@move')->name('home2');
