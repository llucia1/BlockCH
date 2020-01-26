<?php

Route::group(['middleware' => 'web', 'prefix' => 'webminar', 'namespace' => 'Modules\Webminar\Http\Controllers'], function()
{
    Route::get('/', 'WebminarController@index')->name('webminar');
    Route::get('/show/', 'WebminarController@show')->name('webminar.show');
});
// Rutas que serán invocadas con axios
Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'api/webminar', 'namespace' => 'Modules\Webminar\Http\Controllers'], function()
{
    Route::get('/', 'WebminarController@index');
});