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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/guias','GuiasController@retornaGuias');

Route::get('/guias/post/{guiaId}','GuiasController@show');

Route::get('/login','PsnController@init');

Route::get('user/', function () {
    return view('user');
});
