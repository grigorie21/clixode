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

Route::group(['as' => 'bucket-image.', 'prefix' => 'bucket-image'], function() {
    Route::get('/', 'BucketImageController@index')->name('index');
    Route::get('{model}', 'BucketImageController@show')->name('show');
});

Route::group(['as' => 'bucket-file.', 'prefix' => 'bucket-file', 'namespace' => 'File'], function() {
    Route::get('/', 'BucketFileController@index')->name('index');
    Route::get('{model}', 'BucketFileController@show')->name('show');
});


Route::group(['as' => 'file.', 'prefix' => 'file', 'namespace' => 'File'], function() {
    Route::group(['as' => 'add.', 'prefix' => 'add'], function() {
        Route::post('url', 'AddController@url')->name('url');
        Route::get('task/status/{id}', 'AddController@status')->name('status');
//        Route::post('upload', 'File\AddController@upload')->name('upload')->middleware('web');
//        Route::any('delete', 'File/AddController@delete')->name('delete');
//        Route::any('update', 'File/AddController@update')->name('update');
    });
    Route::get('/', 'FileController@index')->name('index');
    Route::get('{model}', 'FileController@show')->name('show');

//    Route::any('status', 'FileController@status')->name('status');
});
