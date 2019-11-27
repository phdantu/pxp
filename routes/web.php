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


Route::get('/guias','GuiasController@retornaGuias');

Route::get('/guias/post/{guiaId}','GuiasController@show');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return redirect('/');
});

Auth::routes();

Route::get('psn/','PsnController@init');

Route::get('game/{gameId}','PsnController@gameInfo')->name('game');;

Route::get('/profile','PsnController@primeiroAcesso');

Route::get('/compare/{psnUser}','PsnController@compare');

Route::post('/notificacao/insert/','NotificacaoController@insert');

Route::get('challenges/', 'NotificacaoController@getByUser');
