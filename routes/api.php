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

Route::group(['middleware' => ['jwt.auth', 'cors']], function() {
    Route::resource('users', 'api\Users\UsersController');
    Route::resource('contents', 'api\Contents\ContentsController');
});

Route::group(['middleware' => ['api', 'cors']], function() {
    Route::post('users/register', 'api\Users\UsersController@register');
    Route::post('users/login', 'api\Users\UsersController@login');
    Route::post('users', 'api\Users\UsersController@store');
});
