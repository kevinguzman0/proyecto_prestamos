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
    return view('logueo');
})->name('logueo');

Route::get('registro', function () {
    return view('registro');
})->name('registro');

Route::get('pagos', function () {
    return view('index');
});

Route::get('tabla', function(){
	return view('miTabla');
})->name('tabla');

Route::get('misolicitud', function(){
	return view('miSolicitud');
})->name('solicitud');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::post('validar_solicitud', 'ValidationSolicitudController@create')->name('validarSolicitud');

Route::get('crear_usuario', 'ValidationUserController@create')->name('crearUsuario');

Route::post('validar_usuario', 'ValidationUserController@store')->name('validarUsuario');

Route::post('liquidador', 'TablaPagosController@generar')->name('liquidador');

Route::get('pdf', 'GeneradorController@pdf')->name('pdf');

// instalar dompdf
// composer require barryvdh/laravel-dompdf
