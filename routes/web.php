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

// -----------------------------------------------------------------------------------------------------------

Route::get('/', function () {
    return view('principales.inicio');
})->name('inicio');

Route::get('registrarse', function () {
    return view('principales.registrarse');
})->name('registrarse');

Route::get('ingresar', function () {
    return view('principales.ingresar');
})->name('ingresar');

Route::get('simulador', function () {
    return view('simulador.index');
})->name('simulador');

// -----------------------------------------------------------------------------------------------------------

Route::get('home', 'HomeController@index')->middleware('verified')->name('home');

Route::post('salir', 'Auth\LoginController@logout')->name('salir');

Route::post('tabla_pagos', 'TablaPagosController@vistaTablaPagos')->name('simulador.screen');

Route::get('tabla_pagos_pdf', 'TablaPagosController@pdfTablaPagos')->name('simulador.pdf');

Route::post('cuota_pagos', 'TablaPagosController@vistaCuotaCredito')->name('simulador.cuota');

Route::get('mi-perfil', 'UsuarioController@index')->middleware('auth')->name('usuario.perfil');

Route::post('usuario-store', 'UsuarioController@store')->middleware('auth')->name('usuario.store');

Route::get('mis-solicitudes', 'CreditoController@index')->middleware('auth')->name('usuario.solicitudes');

Route::post('credito-store', 'CreditoController@store')->middleware('auth')->name('credito.store');

Route::get('mis-documentos/{idSolicitud}', 'CreditoController@table')->middleware('auth')->name('documentos.tabla');

Route::post('documento-store/{idSolicitud}', 'CreditoController@documentStore')->middleware('auth')->name('documento.nuevo');

// -----------------------------------------------------------------------------------------------------------

// Borrar todas las cachés por consola
// php artisan optimize:clear
// php artisan clear-compiled

// -----------------------------------------------------------------------------------------------------------
