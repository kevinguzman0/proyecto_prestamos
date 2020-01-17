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

Route::middleware(['auth', 'verified'])->group(function () {

	// -----------------------------------------------------------------------------------------------------------

	Route::get('home', 'HomeController@index')->name('home');

	Route::get('salir', 'Auth\LoginController@logout')->name('salir');

	// -----------------------------------------------------------------------------------------------------------

	Route::post('tabla-pagos', 'SimuladorController@vistaTablaPagos')->name('simulador.screen');

	Route::get('tabla-pagos-pdf', 'SimuladorController@pdfTablaPagos')->name('simulador.pdf');

	Route::post('cuota-pagos', 'SimuladorController@vistaCuotaCredito')->name('simulador.cuota');

	// -----------------------------------------------------------------------------------------------------------

	Route::get('mi-perfil', 'UsuarioController@miPerfil')->name('usuario.mi.perfil');

	Route::post('usuario-perfil', 'UsuarioController@usuarioPerfil')->name('usuario.perfil');

	// -----------------------------------------------------------------------------------------------------------

	Route::get('mis-solicitudes', 'CreditoController@tablaSolicitudes')->name('solicitudes.tabla');

	Route::get('mis-documentos/{idSolicitud}', 'CreditoController@tablaDocumentos')->name('documentos.tabla');

	Route::post('solicitud-nueva', 'CreditoController@solicitudNueva')->name('solicitud.nueva');

	Route::post('documento-nuevo/{idSolicitud}', 'CreditoController@documentoNuevo')->name('documento.nuevo');

	Route::get('solicitud-eliminar/{idSolicitud}', 'CreditoController@solicitudEliminar')->name('solicitud.eliminar');

	Route::get('documento-aprobar/{idDocumento}', 'CreditoController@documentoAprobado')->name('documento.aprobar');

	Route::get('documento-rechazar/{idDocumento}', 'CreditoController@documentoRechazado')->name('documento.rechazar');

	Route::get('documento-eliminar/{idDocumento}', 'CreditoController@documentoEliminar')->name('documento.eliminar');

	// -----------------------------------------------------------------------------------------------------------

	Route::get('clientes', 'ClienteController@index')->name('clientes.tabla');

	// -----------------------------------------------------------------------------------------------------------

});

// -----------------------------------------------------------------------------------------------------------

// Borrar todas las cachés por consola
// php artisan optimize:clear
// php artisan clear-compiled

// -----------------------------------------------------------------------------------------------------------