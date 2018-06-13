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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('auth/login', 'AuthController@authenticate');

Route::middleware('jwt.auth')->group(function(){
    Route::get('/user/{id?}',"UserController@get");
    Route::post('/user',"UserController@post");
    Route::delete('/user/{id}',"UserController@delete");
    Route::get('/mongo/{id?}',"MongoController@get");
    Route::post('/mongo',"MongoController@post");
    Route::delete('/mongo/{id}',"MongoController@delete");
});