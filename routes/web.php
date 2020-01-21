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

Route::middleware(['auth', 'verified'])->group(function () {

	// -----------------------------------------------------------------------------------------------------------

	Route::get('home', 'HomeController@index')->name('home');

	Route::get('salir', 'Auth\LoginController@logout')->name('salir');

	// -----------------------------------------------------------------------------------------------------------

	Route::post('tabla-pagos', 'SimuladorController@vistaTablaPagos')->name('simulador.screen');

	Route::get('tabla-pagos-pdf', 'SimuladorController@pdfTablaPagos')->name('simulador.pdf');

	Route::post('cuota-pagos', 'SimuladorController@vistaCuotaCredito')->name('simulador.cuota');

	// -----------------------------------------------------------------------------------------------------------

	Route::get('mi-perfil', 'PerfilController@miPerfil')->name('mi.perfil');

	Route::post('gestionar-perfil', 'PerfilController@gestionarPerfil')->name('gestionar.perfil');

	// -----------------------------------------------------------------------------------------------------------

	Route::get('mis-solicitudes/{idCliente}', 'CreditoController@tablaSolicitudes')->name('solicitudes.tabla');

	Route::post('solicitud-nueva', 'CreditoController@solicitudNueva')->name('solicitud.nueva');

	Route::get('solicitud-eliminar/{idCliente}/{idSolicitud}', 'CreditoController@solicitudEliminar')->name('solicitud.eliminar');

	// -----------------------------------------------------------------------------------------------------------

	Route::get('mis-documentos/{idCliente}/{idSolicitud}', 'CreditoController@tablaDocumentos')->name('documentos.tabla');

	Route::post('documento-nuevo/{idSolicitud}', 'CreditoController@documentoNuevo')->name('documento.nuevo');

	Route::get('documento-aprobar/{idSolicitud}/{idDocumento}', 'CreditoController@documentoAprobado')->name('documento.aprobar');

	Route::get('documento-rechazar/{idSolicitud}/{idDocumento}', 'CreditoController@documentoRechazado')->name('documento.rechazar');

	Route::get('documento-eliminar/{idSolicitud}/{idDocumento}', 'CreditoController@documentoEliminar')->name('documento.eliminar');

	// -----------------------------------------------------------------------------------------------------------

	Route::get('clientes', 'ClienteController@tablaClientes')->name('clientes.tabla');

	// -----------------------------------------------------------------------------------------------------------

});

// -----------------------------------------------------------------------------------------------------------

// Borrar todas las cachés por consola
// php artisan optimize:clear
// php artisan clear-compiled

// -----------------------------------------------------------------------------------------------------------
