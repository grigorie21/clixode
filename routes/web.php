<?php

Route::group(['as' => 'download.'], function () {
    Route::get('file/{slug}', 'DownloadController@file')->name('file');
    Route::get('image/{slug}', 'DownloadController@image')->name('image');
});

// Auth
Route::group(['as' => 'auth.'], function () {
    Route::get('/', 'AuthController@login')->name('login');
    Route::post('/', 'AuthController@login')->name('login');
});

// Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => 'auth.user'], function () {
    // Index page
    Route::get('/', 'IndexController@index')->name('index');

    // Image
    Route::group(['prefix' => 'image', 'as' => 'image.'], function () {
        Route::get('/', 'ImageController@index')->name('index');
        Route::get('create', 'ImageController@create')->name('create');
        Route::get('edit/{model}', 'ImageController@edit')->name('edit');
    });

    // File
    Route::group(['prefix' => 'file', 'as' => 'file.'], function () {
        Route::get('/', 'FileController@index')->name('index');
        Route::get('create', 'FileController@create')->name('create');
        Route::get('edit/{model}', 'FileController@edit')->name('edit');
        Route::get('{id}', 'FileController@show')->name('show');
        Route::post('upload', 'FileController@upload')->name('upload');
        Route::delete('{id}', 'FileController@delete')->name('delete');
    });
});

// Api
Route::group(['prefix' => 'api', 'as' => 'api.', 'namespace' => 'API'], function () {
    Route::group(['prefix' => 'file', 'as' => 'file.', 'namespace' => 'File'], function () {
        Route::post('download', 'AddController@url')->name('download');
        Route::get('status/{id}', 'AddController@status')->name('status');
    });
});
