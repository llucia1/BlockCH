<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'home', 'namespace' => 'Modules\Home\Http\Controllers'], function()
{
    Route::get('/', 'HomeController@index')->name('home');
});

Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Modules\Home\Http\Controllers'], function()
{
    Route::get('/', 'HomeController@index')->name('home');
});

