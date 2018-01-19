<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login', 'ApiAuthController@login');
Route::post('register', 'ApiAuthController@register');

Route::group(['middleware' => ['jwt.auth']], function() {
    Route::get('logout', 'ApiAuthController@logout');

    Route::get('debts/all', 'DebtController@all');
    Route::get('debt/{id}', 'DebtController@get');
    Route::get('debt/delete/{id}', 'DebtController@destroy');

    Route::post('debt/save/', 'DebtController@create');
    Route::post('debt/update/{id}', 'DebtController@update');


    Route::get('test', function(){
        return response()->json(['message'=>'Funcionou! :)']);
    });
});