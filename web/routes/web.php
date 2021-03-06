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

Route::get('/', 'HomeController@index');

// Route::get('/home', 'HomeController@home')->name('home');

// Route::get('/pass', 'HomeController@pass');
// Route::get('/productos', 'HomeController@productos');
// Route::get('/clientes', 'HomeController@clientes');
Route::prefix('clientes')->group(function () {
    Route::get('finalizar','ClienteController@finalizar');
});
Route::resource('clientes', 'ClienteController');
Route::resource('productos', 'ProductoController');

