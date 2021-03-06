<?php

// Index page
Route::get('/', 'IndexController@index')->name('index')->middleware('auth.user');

// Auth
Route::group(['as' => 'auth.'], function () {
    Route::get('login', 'AuthController@login')->name('login');
    Route::post('login', 'AuthController@login')->name('login');
});

// Image
Route::group(['prefix' => 'image', 'as' => 'image.', 'middleware' => 'auth.user'], function () {
    Route::get('/', 'ImageController@index')->name('index');
    Route::get('create', 'ImageController@create')->name('create');
    Route::get('edit/{model}', 'ImageController@edit')->name('edit');
});

// File
Route::group(['prefix' => 'file', 'as' => 'file.', 'middleware' => 'auth.user'], function () {
    Route::get('download', 'FileController@download')->name('download');
    Route::get('/', 'FileController@index')->name('index');
});

// API
Route::group(['prefix' => 'api', 'as' => 'api.', 'middleware' => 'auth.user'], function () {
    Route::group(['prefix' => 'file', 'as' => 'file.'], function () {
        Route::get('download', 'API\File\AddController@index')->name('download');
    });
});
