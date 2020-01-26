<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'mycredits', 'namespace' => 'Modules\MyCredits\Http\Controllers'], function()
{
    Route::get('/', 'MyCreditsController@index')->name('mycredits');
});
// Rutas que serán invocadas con axios
Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'api/mycredits', 'namespace' => 'Modules\MyCredits\Http\Controllers'], function()
{
    Route::get('/', 'MyCreditsController@index');
});