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

Route::group(
    [
        'middleware' => 'api',
        'namespace' => 'App\Http\Controllers',
        'prefix' => 'auth'
    ],
function ($router) {
    // Public access routing
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/refresh', 'AuthController@refresh');
});

Route::group(
    [
        'middleware' => 'api',
        'namespace' => 'App\Http\Controllers',
        'prefix' => 'search'
    ],
function ($router) {
    Route::get('/provinces', 'ProvinceController@getProvinceById');
    Route::get('/provinces-api', 'ProvinceController@getProvinceByIdApi');
    Route::get('/cities', 'CityController@getCitiesById');
    Route::get('/cities-api', 'CityController@getCitiesByIdApi');
});