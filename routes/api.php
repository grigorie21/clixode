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

Route::group(['as' => 'file.', 'prefix' => 'file'], function() {
    Route::group(['as' => 'add.', 'prefix' => 'add'], function() {
        Route::post('url', 'File\AddController@url')->name('url');
//        Route::any('delete', 'File/AddController@delete')->name('delete');
//        Route::any('update', 'File/AddController@update')->name('update');
    });

//    Route::any('status', 'FileController@status')->name('status');
});
