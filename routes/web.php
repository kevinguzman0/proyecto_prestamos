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
