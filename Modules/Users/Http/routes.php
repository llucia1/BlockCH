<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'users', 'namespace' => 'Modules\Users\Http\Controllers'], function()
{
    Route::get('/', 'UsersController@index')->name('users');
    Route::get('/create', 'UsersController@create')->name('users.create');
    Route::get('/edit/{id}', 'UsersController@edit')->name('users.edit')->where('id', '[0-9]+');
    Route::post('/store', 'UsersController@store');
});

// Rutas que serán invocadas con axios
Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'api/users', 'namespace' => 'Modules\Users\Http\Controllers'], function()
{
    Route::get('/', 'UsersController@index');
    Route::post('/store', 'UsersController@store');
    Route::post('/update/{id}', 'UsersController@update')->where('id', '[0-9]+');
    Route::post('/disabled/{id}', 'UsersController@disabled')->where('id', '[0-9]+');
    Route::get('/delete-course/{idCourse}', 'UsersController@deleteCourse')->where('idCourse', '[0-9]+');
    Route::get('/search/{query}', 'UsersController@search');
    Route::post('/set-course-to-user/{idUser}', 'UsersController@setCourseToUser')->where('idUser', '[0-9]+');
});
//rutas para el registro o alta de un usuario nuevo,!!sin compra
Route::group(['middleware' => 'web', 'namespace' => 'Modules\Users\Http\Controllers'], function()
{
    Route::get('/register/{referral?}', 'UsersController@register')->where('referral', '[a-zA-Z0-9]+');
    Route::post('/register-store', 'UsersController@registerStore');
    Route::get('/register-end/{id?}', 'UsersController@registerEnd')->where('id', '[0-9]+');
});
//rutas para el final del registro
Route::group(['middleware' => 'web', 'prefix' => 'user', 'namespace' => 'Modules\Users\Http\Controllers'], function()
{
    Route::get('/end-register/{id}', 'UsersController@endRegister')->where('id', '[0-9]+');
});
//rutas para el alta mediante la compra de un curso
Route::group(['middleware' => 'web', 'prefix' => 'new-account', 'namespace' => 'Modules\Users\Http\Controllers'], function()
{
    Route::get('/sign-up-form/{id}/{referral?}', 'UserCourseController@index')->where('id', '[0-9]+')->where('referral', '[a-zA-Z0-9]+');
    Route::post('/store', 'UserCourseController@store');
    Route::get('/resume-buy/{token}/{referral?}', 'UserCourseController@order')->where('token', '[a-zA-Z0-9]+')->where('referral', '[a-zA-Z0-9]+');
    Route::get('/cancelled-buy/{token}', 'UserCourseController@cancel')->name('new-account.cancelledbuy')->where('token', '[a-zA-Z0-9]+');
    Route::get('/accepted-buy/{token}/{referral?}', 'UserCourseController@accept')->name('new-account.acceptedbuy')->where('token', '[a-zA-Z0-9]+')->where('referral', '[a-zA-Z0-9]+');
    Route::get('/set-redsys/{token}/{referral?}', 'UserCourseController@setRedsys')->name('new-account.setredsys')->where('token', '[a-zA-Z0-9]+')->where('referral', '[a-zA-Z0-9]+');
});
//rutas para la comopra de cursos siendo ya usuarioy logado
Route::group(['middleware' => 'web', 'prefix' => 'new-buy', 'namespace' => 'Modules\Users\Http\Controllers'], function()
{
    Route::post('/store', 'UserCourseController@store')->name('newbuysotre');
    Route::get('/resume-buy/{token}', 'UserCourseController@order')->where('token', '[a-zA-Z0-9]+')->where('referral', '[a-zA-Z0-9]+');
    Route::get('/cancelled-buy/{token}', 'UserCourseController@cancel')->name('new-buy.cancelledbuy')->where('token', '[a-zA-Z0-9]+');
    Route::get('/accepted-buy/{token}', 'UserCourseController@accept')->name('new-buy.acceptedbuy')->where('token', '[a-zA-Z0-9]+')->where('referral', '[a-zA-Z0-9]+');
    Route::get('/set-redsys/{token}', 'UserCourseController@setRedsys')->name('new-account.setredsys')->where('token', '[a-zA-Z0-9]+')->where('referral', '[a-zA-Z0-9]+');
});
