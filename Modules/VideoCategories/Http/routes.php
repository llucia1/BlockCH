<?php

Route::group(['middleware' => 'web', 'prefix' => 'videocategories', 'namespace' => 'Modules\VideoCategories\Http\Controllers'], function()
{
    Route::get('/', 'VideoCategoriesController@index')->name('videocategories');
    Route::get('/create', 'VideoCategoriesController@create')->name('videocategories.create');
    Route::get('/edit/{id}', 'VideoCategoriesController@edit')->name('videocategories.edit')->where('id', '[0-9]+');
});
// Rutas que serán invocadas con axios
Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'api/videocategories', 'namespace' => 'Modules\VideoCategories\Http\Controllers'], function()
{
    Route::get('/', 'VideoCategoriesController@index');
    Route::post('/store', 'VideoCategoriesController@store');
    Route::post('/update/{id}', 'VideoCategoriesController@update')->where('id', '[0-9]+');
    Route::get('/search/{query}', 'VideoCategoriesController@search');
});