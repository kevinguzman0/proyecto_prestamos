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

Route::get('/tabla1', function () {

	$tablaConfiguracion = new App\TablaConfiguraciones();
	$tablaConfiguracion->nombreConfiguracion = 'configuracion #1';
	$tablaConfiguracion->valorConfiguracion = 'valor #1';
	$tablaConfiguracion->descripcionConfiguracion = 'descripcion #1';
	$tablaConfiguracion->save();
    return 'Registro de tabla de configuraciones creado...';
});

Route::get('/tabla2', function () {

	$perfilUsuario = new App\PerfilesUsuario();
	$perfilUsuario->nombrePerfil = 'perfil #1';
	$perfilUsuario->descripcionPerfil = 'descripcion #1';
	$perfilUsuario->save();
    return 'Registro de perfil de usuario creado...';
});

Route::get('/tabla3', function () {

	$estadoSolicitud = new App\EstadoSolicitudes();
	$estadoSolicitud->nombreEstado = 'estado #1';
	$estadoSolicitud->descripcionEstado = 'descripcion #1';
	$estadoSolicitud->save();
    return 'egistro de estado de solicitud creado...';
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('inicio', function () {
    return view('inicio');
});

Route::get('logueo', function () {
    return view('mylogin');
});

Route::get('registro', function () {
    return view('myregistro');
});

Route::get('pagos', function () {
    return view('index');
});
Route::get('tabla', function () {
    return view('operaciones');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::post('operaciones', 'tablapagos@index')->name('operaciones');
