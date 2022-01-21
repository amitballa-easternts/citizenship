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

    /* Start Citizen */
    Route::resource('citizen', 'CitizenController', [
        'only' => ['show', 'store', 'update', 'destroy']
    ]);
    Route::post('citizen/{citizen}', 'CitizenController@update');
    Route::get('citizen', 'CitizenController@index');
    /* End Citizen */



    /* Start Administrator */
    Route::post('add-admin', 'Administrator@addAdministrator');
    Route::get('get-admin', 'Administrator@getAdministrator');
    Route::post('update-admin', 'Administrator@updateAdministrator');
    /* End Administrator */

    /* Start Login */
    Route::post('check-login', 'Login@checkLogin');
    /* End Login */

    /* Start Migrate */
    Route::get('migrate-list', 'Migrate@migrateList');
    Route::get('migrate-list-approved', 'Migrate@migrateListApproved');
    Route::get('migrate-list-disapproved', 'Migrate@migrateListDisapproved');
    Route::get('migrate-list-by-id/{migrate}', 'Migrate@migrateListById');
    Route::get('approved-migrate', 'Migrate@approvedMigrate');
    /* End Migrate */

    Route::get('one-to-one', 'CitizenController@oneToOne');
    Route::get('one-to-many', 'CitizenController@oneToMany');
});

//Route::get('test', 'TestController@index');
