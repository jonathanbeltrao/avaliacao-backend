<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth:api'], function(){
    // User Routes
    Route::get('/logout', 'Api\AuthController@logout')->name('logout')->name('logout');
    Route::get('/user', 'Api\AuthController@user')->name('loggedUser');
});

// Create/Login User
Route::post('/register', 'Api\AuthController@register')->name('createUser');
Route::post('/login', 'Api\AuthController@login')->name('login');
