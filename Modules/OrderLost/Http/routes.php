<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'orderlost', 'namespace' => 'Modules\OrderLost\Http\Controllers'], function()
{
    Route::get('/', 'OrderLostController@index')->name('orderlost');
});
// Rutas que serán invocadas con axios
Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'api/orderlost', 'namespace' => 'Modules\OrderLost\Http\Controllers'], function()
{
    Route::get('/', 'OrderLostController@index')->name('orderlost');
});