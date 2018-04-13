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

Route::middleware('auth:api')->group(function () {

    Route::get('/roles', 'UserController@roles');
    Route::resource('/user', 'UserController');

    Route::resource('/admin', 'AdminController');
    Route::resource('/content', 'ContentController');

    Route::get('/event/categories', 'EventsController@categories');
    Route::resource('/event', 'EventsController');
});

Route::middleware('api')->post('/login', 'Auth\LoginController@authenticateApi');