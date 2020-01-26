<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'roles', 'namespace' => 'Modules\Roles\Http\Controllers'], function()
{
    Route::get('/', 'RolesController@index')->name('roles');
});
// Rutas que serán invocadas con axios
Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'api/roles', 'namespace' => 'Modules\Roles\Http\Controllers'], function()
{
    Route::get('/', 'RolesController@index');
    Route::post('/store', 'RolesController@store');
    Route::get('/search/{query}', 'RolesController@search');
});
