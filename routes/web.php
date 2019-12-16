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

	$tablaConfiguraciones = new App\TablaConfiguraciones();
	$tablaConfiguraciones->nombreConfiguracion = 'configuracion #1';
	$tablaConfiguraciones->valorConfiguracion = 'valor #1';
	$tablaConfiguraciones->descripcionConfiguracion = 'descripcion #1';
	$tablaConfiguraciones->save();
    return view('inicio');
});
Route::get('/tabla4', function () {

    $usuario = new App\Usurios();
    $usuario->idPerfilUsuario = '1';
    $usuario->cedula = '1024551252';
    $usuario->nombres = 'jhon';
    $usuario->apellidos = '1024551252';
    $usuario->foto = '1222';
    $usuario->email = 'jhon@gmail.com';
    $usuario->telefono1 = '13883293';
    $usuario->telefono2 = '10737383';
    $usuario->fechaNacimientos = '2001/04/11';
    $usuario->direccion = 'cll 34 N 34-34';
    $usuario->barrio = 'madelena';
    $usuario->ciudad = 'bogota';
    $usuario->areaTrabajo = 'administrativa';
    $usuario->cargoTrabajo = 'sub-gerente';
    $usuario->save();
    return view('inicio');
});
/*
Route::get('/', function () {
    return view('welcome');
});
*/

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
