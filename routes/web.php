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


use Illuminate\Database\Eloquent\Model;

Auth::routes();

Route::get('/', function () {
    return view('inicio');
})->name('inicio');

Route::get('logueo', function () {
    return view('mylogin');
})->name('logueo');

Route::get('registro', function () {
    return view('myregistro');
})->name('registro');

Route::get('pagos', function () {
    return view('index');
});

Route::get('tabla', function(){
	return view('mitabla');
})->name('tabla');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::post('liquidador', 'TablaPagos@index')->name('liquidador');

Route::post('validarUsuario', 'ValidationUser@index')->name('validarUsuario');

Route::get('user', function(){
	return view('usuario');
})->name('usuario');