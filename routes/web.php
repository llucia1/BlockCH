<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group( ['middleware' => ['web', 'auth']],function()
{
    //rutas countries
    Route::post('countries/getPrefix', 'CountriesController@getPrefixByCountry');
    //ruta que devuelve los tipos de documemtos
    Route::get('get-document-type/{id}', 'DocumentTypeController@index')->where('id', '[0-9]+');
    //ruta para el acceso a documentos
    Route::get('/documents/{file}', function ($file) {
        return Storage::response("documents/$file");
    });

});

