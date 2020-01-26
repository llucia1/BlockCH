<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'referrals', 'namespace' => 'Modules\Referrals\Http\Controllers'], function()
{
    Route::get('/', 'ReferralsController@index')->name('referrals');
    Route::get('/create', 'ReferralsController@create')->name('referrals.create');
    Route::get('/edit/{id}', 'ReferralsController@edit')->name('referrals.edit')->where('id', '[0-9]+');

});
// Rutas que serán invocadas con axios
Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'api/referrals', 'namespace' => 'Modules\Referrals\Http\Controllers'], function()
{
    Route::get('/', 'ReferralsController@index');
    Route::post('/store', 'ReferralsController@store');
    Route::post('/update/{id}', 'ReferralsController@update')->where('id', '[0-9]+');
    Route::get('/search/{query}', 'ReferralsController@search');
});