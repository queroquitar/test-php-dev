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
    return view('home');
});

Route::get('home', 'HomeController@index')->name('home.index');
Route::get('users/login', 'UsersController@login')->name('users.login');
Route::get('users/logout', 'UsersController@logout')->name('users.logout');
Route::get('login', 'UsersController@login')->name('login');
Route::post('users/dologin', 'UsersController@doLogin')->name('users.dologin');
Route::get('users/create', 'UsersController@create')->name('users.create');
Route::post('users/store', 'UsersController@store')->name('users.store');

Route::group(['middleware' => 'auth'], function() {
    Route::resource('home', 'HomeController');
    Route::resource('contacts', 'ContactsController');
    Route::get('users/{id}/edit', 'UsersController@edit')->name('users.edit');
    Route::put('users/{id}', 'UsersController@update')->name('users.update');
});
