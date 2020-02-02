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
    return view('simulador.liquidador');
})->name('simulador');

Route::get('validar-email', function () {
    return view('errors.verify');
})->name('validar.email');

// -----------------------------------------------------------------------------------------------------------

Route::get('salir', 'Auth\LoginController@logout')->name('salir');

Route::post('tabla-pagos', 'SimuladorController@vistaTablaPagos')->name('simulador.screen');

Route::post('cuota-pagos', 'SimuladorController@vistaCuotaCredito')->name('simulador.cuota');

// -----------------------------------------------------------------------------------------------------------

Route::middleware(['auth', 'verified'])->group(function () {

	Route::get('home', 'HomeController@index')->name('home');

	// -----------------------------------------------------------------------------------------------------------

	Route::get('tabla-pagos-pdf', 'SimuladorController@pdfTablaPagos')->name('simulador.pdf');

	// -----------------------------------------------------------------------------------------------------------

	Route::get('mi-perfil/{idCliente}', 'PerfilController@miPerfil')->name('mi.perfil');

	Route::post('gestionar-perfil/{idCliente}', 'PerfilController@gestionarPerfil')->name('gestionar.perfil');

	Route::get('mi-password', function () {
	    return view('perfiles.password');
	})->name('cambiar.mi.password');

	Route::post('cambiar-password', 'PerfilController@cambiarPassword')->name('cambiar.password');

	// -----------------------------------------------------------------------------------------------------------

	Route::middleware('role:directivo|administrador')->group(function () {

		Route::get('usuario-inactivar/{idCliente}', 'PerfilController@usuarioInactivar')->name('usuario.inactivar');

		Route::get('usuario-activar/{idCliente}', 'PerfilController@usuarioActivar')->name('usuario.activar');

		Route::middleware('role:directivo')->group(function () {

			Route::get('usuario-eliminar/{idCliente}', 'PerfilController@usuarioEliminar')->name('usuario.eliminar');

			Route::get('datos-correo/{idCliente}', 'PerfilController@datosCorreo')->name('datos.correo');

			Route::post('enviar-correo/{idCliente}', 'PerfilController@enviarCorreo')->name('enviar.correo');

		});

	});

	// -----------------------------------------------------------------------------------------------------------

	Route::middleware('role:administrador')->group(function () {

		Route::get('usuario-directivo/{idCliente}', 'PerfilController@usuarioDirectivo')->name('usuario.directivo');

		Route::get('usuario-no-directivo/{idCliente}', 'PerfilController@usuarioNoDirectivo')->name('usuario.no.directivo');

	});

	// -----------------------------------------------------------------------------------------------------------

	Route::middleware('role:registrado|directivo')->group(function () {

		Route::get('mis-solicitudes/{idCliente}', 'CreditoController@misSolicitudes')->name('mis.solicitudes');

		Route::post('solicitud-nueva', 'CreditoController@solicitudNueva')->name('solicitud.nueva');

		Route::get('solicitud-eliminar/{idCliente}/{idSolicitud}', 'CreditoController@solicitudEliminar')->name('solicitud.eliminar');

		Route::get('solicitud-aprobar/{idCliente}/{idSolicitud}', 'CreditoController@solicitudAprobar')->name('solicitud.aprobar');

		Route::get('solicitud-rechazar/{idCliente}/{idSolicitud}', 'CreditoController@solicitudRechazar')->name('solicitud.rechazar');

		Route::get('solicitud-pendiente/{idCliente}/{idSolicitud}', 'CreditoController@solicitudPendiente')->name('solicitud.pendiente');

		Route::get('solicitud-desembolsada/{idCliente}/{idSolicitud}', 'CreditoController@solicitudDesembolsada')->name('solicitud.desembolsada');

		Route::get('solicitud-espera/{idCliente}/{idSolicitud}', 'CreditoController@solicitudEnEspera')->name('solicitud.espera');

		// -----------------------------------------------------------------------------------------------------------

		Route::get('mis-documentos/{idCliente}/{idSolicitud}', 'CreditoController@tablaDocumentos')->name('mis.documentos');

		Route::post('documento-nuevo/{idSolicitud}', 'CreditoController@documentoNuevo')->name('documento.nuevo');

		Route::get('documento-aprobar/{idSolicitud}/{idDocumento}', 'CreditoController@documentoAprobado')->name('documento.aprobar');

		Route::get('documento-rechazar/{idSolicitud}/{idDocumento}', 'CreditoController@documentoRechazado')->name('documento.rechazar');

		Route::get('documento-eliminar/{idSolicitud}/{idDocumento}', 'CreditoController@documentoEliminar')->name('documento.eliminar');

		Route::get('documento-descargar/{idDocumento}', 'CreditoController@documentoDescargar')->name('documento.descargar');

	});

	// -----------------------------------------------------------------------------------------------------------

	Route::middleware('role:administrador|directivo')->group(function () {

		Route::get('usuarios', 'GeneralController@tablaUsuarios')->name('usuarios.tabla');

		Route::get('perfiles', 'GeneralController@tablaPerfiles')->name('perfiles.tabla');

		Route::post('perfiles/busqueda', 'GeneralController@buscadorPerfiles')->name('perfiles.buscar');

		Route::post('perfiles', 'GeneralController@tablaPerfiles')->name('perfiles.todos');

		Route::post('perfiles/filtrado', 'GeneralController@filtrosPerfiles')->name('perfiles.filtrar');

		Route::post('usuarios/busqueda', 'GeneralController@buscadorUsuarios')->name('usuarios.buscar');

		Route::post('usuarios', 'GeneralController@tablaUsuarios')->name('usuarios.todos');

		Route::post('usuarios/filtrado', 'GeneralController@filtrosUsuarios')->name('usuarios.filtrar');

		Route::post('documentos/busqueda', 'GeneralController@buscadorDocumentos')->name('documentos.buscar');

		Route::post('documentos', 'GeneralController@tablaDocumentos')->name('documentos.todos');

		Route::post('documentos/filtrado', 'GeneralController@filtrosDocumentos')->name('documentos.filtrar');

		Route::post('solicitudes/busqueda', 'GeneralController@buscadorSolicitudes')->name('solicitudes.buscar');

		Route::post('solicitudes', 'GeneralController@tablaSolicitudes')->name('solicitudes.todos');

		Route::post('solicitudes/filtrado', 'GeneralController@filtrosSolicitudes')->name('solicitudes.filtrar');
		
		Route::middleware('role:directivo')->group(function () {

			Route::get('solicitudes', 'GeneralController@tablaSolicitudes')->name('solicitudes.tabla');

			Route::get('documentos', 'GeneralController@tablaDocumentos')->name('documentos.tabla');

			Route::get('usuario-validar/{idCliente}', 'GeneralController@usuarioValidar')->name('usuario.validar');

		});

	});

	// -----------------------------------------------------------------------------------------------------------

});

// -----------------------------------------------------------------------------------------------------------

// Borrar todas las cachés por consola
// php artisan optimize:clear
// php artisan clear-compiled

// Validar en el archivo de entorno el contenido de las variables principales para manejo de correos.
// Validar credenciales de MySql.

// Ejecutar una vez inicialmente para que funcionen las rutas de imagenes y documentos.
// php artisan storage:link 

// Ejecutar inicialmente para crear base de datos, tablas, datos iniciales y datos de prueba.
// php artisan migrate:refresh --seed

// Ejecutar inicialmente para crear base de datos, tablas y datos iniciales.
// Pasar a comentario el código de los Fakers y solo dejar el llamado a SpatieSeeder.
// php artisan migrate:refresh --seed

// Antes de pasar a producción el proyecto
// Borrar o desactivar barra de depuración.
// Pasar la variable de entorno DEBUG a false.
// Borrar las cachés, logs, sesiones y archivos de la barra de depuración.

// Usar dd( .... ) o @if( dd ( .... ) ) @endif para verificar valor de variables.

// Usar consola para depuración 
// php artisan tinker

// -----------------------------------------------------------------------------------------------------------
