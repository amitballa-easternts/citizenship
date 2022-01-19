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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */
//Route::get("test", [TestController::class, "index"]);

Route::group(['prefix' => 'v1',], function () {


    //Route::get("test", [TestController::class, "index"]);
    //Route::post('citizen', 'CitizenController@store');
    //Route::resource('citizen', 'CitizenController');
    //Route::get('citizen', 'CitizenController@show');
    //Route::apiResource('citizen', 'CitizenController');

    //Route::apiResource('citizen', 'CitizenController');

    Route::resource('citizen', 'CitizenController', [
        'only' => ['show', 'store', 'update', 'destroy']
    ]);
    Route::post('citizen/{citizen}', 'CitizenController@update');
});

//Route::get('test', 'TestController@index');
