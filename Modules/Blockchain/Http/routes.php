<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'blockchain', 'namespace' => 'Modules\Blockchain\Http\Controllers'], function()
{
    Route::get('/', 'BlockchainController@index')->name('blockchain');
    Route::get('/create', 'BlockchainController@create')->name('blockchain.create');
    Route::post('/store', 'BlockchainController@store')->name('blockchain.store');
    Route::get('/show-blocks/{hash}', 'BlockchainController@showBlocks')->name('blockchain.showblocks')->where('hash', '[a-zA-Z0-9]+');
    Route::get('/show-block/{id}', 'BlockchainController@showBlock')->name('blockchain.showblock')->where('id', '[a-zA-Z0-9]+');
});
