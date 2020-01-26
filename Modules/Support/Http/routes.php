<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'support', 'namespace' => 'Modules\Support\Http\Controllers'], function()
{
    Route::get('/{state?}', 'SupportController@index')->name('support')->where('state', '[0-9]+');
    Route::get('/create', 'SupportController@create')->name('support.create');
    Route::get('/edit/{id}', 'SupportController@edit')->name('support.edit')->where('id', '[0-9]+');
});
// Rutas que serán invocadas con axios
Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'api/support', 'namespace' => 'Modules\Support\Http\Controllers'], function()
{
    Route::get('/{state?}', 'SupportController@index')->where('state', '[0-9]+');
});
