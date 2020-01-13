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

// -----------------------------------------------------------------------------------------------------------
// RUTAS REVISADAS Y MEJORADAS
// -----------------------------------------------------------------------------------------------------------

Auth::routes(['verify' => true]);
 
Route::get('/home', 'HomeController@index')->middleware('verified')->name('home');

Route::get('/', function () {
    return view('inicio');
})->name('inicio');

Route::get('registrarse', function () {
    return view('registrarse');
})->name('registrarse');

Route::get('ingresar', function () {
    return view('ingresar');
})->name('ingresar');

Route::post('salir', '\App\Http\Controllers\Auth\LoginController@logout')->name('salir');

Route::get('simulador', function () {
    return view('simulador');
})->name('simulador');

Route::post('tabla_pagos', 'GeneradorTablaPagosController@generarVistaTablaPagos')->name('tablaPagosView');

Route::post('cuota_pagos', 'GeneradorTablaPagosController@generarVistaCuotaCredito')->name('cuotaPagosView');

Route::get('tabla_pagos_pdf', 'GeneradorTablaPagosPdfController@generarPdfTablaPagos')->name('tablaPagosPdf');

Route::get('crear_solicitud', 'ValidationSolicitudController@create')->middleware('auth')->name('crearSolicitud');

Route::post('validar_solicitud', 'ValidationSolicitudController@store')->middleware('auth')->name('validarSolicitud');

// -----------------------------------------------------------------------------------------------------------

Route::get('/mi-perfil', 'UsuarioController@index')->middleware('auth')->name('usuarios.perfil');

Route::post('', 'UsuarioController@store')->middleware('auth')->name('usuario.store');

Route::get('docUsuarios/{filename}', 'UsuarioController@displayImage')->name('image.displayImage');