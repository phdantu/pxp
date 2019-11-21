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
    return redirect('/home');
});

Route::get('/guias','GuiasController@retornaGuias');

Route::get('/guias/post/{guiaId}','GuiasController@show');

Route::get('psn/','PsnController@init');

Route::get('game/{gameId}','PsnController@gameInfo');

Route::get('/profile','PsnController@primeiroAcesso');

Route::get('/compare/{psnUser}','PsnController@compare');

Route::get('login/', function () {
    return view('login');
});

Route::get('/new_user', function () {
    return view('new_user');
});
Route::post('/new_user', 'UserController@primeiroLogin');
Route::get('user/', function () {
    return view('user');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
