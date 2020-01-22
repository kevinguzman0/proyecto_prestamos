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

Route::get('/admin', 'HomeController@admin')->name('admin')->middleware('admin');

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
    return view('simulador.liquidador');
})->name('simulador');

Route::get('test-visor', function () {
    return view('test.visor');
})->name('test.visor');

// -----------------------------------------------------------------------------------------------------------

Route::get('/testConnection', function () {
try {
      DB::connection()->getPdo();
      if(DB::connection()->getDatabaseName()){
          echo "Yes! Successfully connected to the DB: " . DB::connection()->getDatabaseName();
          die;
      }else{
          die("Could not find the database. Please check your configuration.");
      }
  } catch (\Exception $e) {
      die($e->GetMessage());
  }
});

// -----------------------------------------------------------------------------------------------------------

Route::get('salir', 'Auth\LoginController@logout')->name('salir');

Route::middleware(['auth', 'verified'])->group(function () {

	// -----------------------------------------------------------------------------------------------------------

	Route::get('home', 'HomeController@index')->name('home');

	// -----------------------------------------------------------------------------------------------------------

	Route::post('tabla-pagos', 'SimuladorController@vistaTablaPagos')->name('simulador.screen');

	Route::get('tabla-pagos-pdf', 'SimuladorController@pdfTablaPagos')->name('simulador.pdf');

	Route::post('cuota-pagos', 'SimuladorController@vistaCuotaCredito')->name('simulador.cuota');

	// -----------------------------------------------------------------------------------------------------------

	Route::get('mi-perfil/{idCliente}', 'PerfilController@miPerfil')->name('mi.perfil');

	Route::post('gestionar-perfil/{idCliente}', 'PerfilController@gestionarPerfil')->name('gestionar.perfil');

	// -----------------------------------------------------------------------------------------------------------

	Route::get('mis-solicitudes/{idCliente}', 'CreditoController@tablaSolicitudes')->name('mis.solicitudes');

	Route::post('solicitud-nueva', 'CreditoController@solicitudNueva')->name('solicitud.nueva');

	Route::get('solicitud-eliminar/{idCliente}/{idSolicitud}', 'CreditoController@solicitudEliminar')->name('solicitud.eliminar');

	Route::get('solicitud-aprobar/{idCliente}/{idSolicitud}', 'CreditoController@solicitudAprobar')->name('solicitud.aprobar');

	Route::get('solicitud-rechazar/{idCliente}/{idSolicitud}', 'CreditoController@solicitudRechazar')->name('solicitud.rechazar');

	// -----------------------------------------------------------------------------------------------------------

	Route::get('mis-documentos/{idCliente}/{idSolicitud}', 'CreditoController@tablaDocumentos')->name('mis.documentos');

	Route::post('documento-nuevo/{idSolicitud}', 'CreditoController@documentoNuevo')->name('documento.nuevo');

	Route::get('documento-aprobar/{idSolicitud}/{idDocumento}', 'CreditoController@documentoAprobado')->name('documento.aprobar');

	Route::get('documento-rechazar/{idSolicitud}/{idDocumento}', 'CreditoController@documentoRechazado')->name('documento.rechazar');

	Route::get('documento-eliminar/{idSolicitud}/{idDocumento}', 'CreditoController@documentoEliminar')->name('documento.eliminar');

	Route::get('documento-descargar/{idDocumento}', 'CreditoController@documentoDescargar')->name('documento.descargar');

	// -----------------------------------------------------------------------------------------------------------

	Route::get('usuarios', 'GeneralController@tablaUsuarios')->name('usuarios.tabla');

	Route::get('perfiles', 'GeneralController@tablaPerfiles')->name('perfiles.tabla');

	Route::get('solicitudes', 'GeneralController@tablaSolicitudes')->name('solicitudes.tabla');

	Route::get('documentos', 'GeneralController@tablaDocumentos')->name('documentos.tabla');

	Route::get('usuario-eliminar/{idCliente}', 'GeneralController@usuarioEliminar')->name('usuario.eliminar');

	Route::get('usuario-validar/{idCliente}', 'GeneralController@usuarioValidar')->name('usuario.validar');

	// -----------------------------------------------------------------------------------------------------------

});

// -----------------------------------------------------------------------------------------------------------

// Borrar todas las cachés por consola
// php artisan optimize:clear
// php artisan clear-compiled

// -----------------------------------------------------------------------------------------------------------
