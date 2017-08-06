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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1/'], function () {
    Route::post('faset', 'FasetVisitController@visit');
    Route::get('faset', 'FasetVisitController@list');
    Route::get('faset/{id}', 'FasetVisitController@show');
    Route::resource('users', 'UserController', ['except' => ['create', 'edit']]);
});
