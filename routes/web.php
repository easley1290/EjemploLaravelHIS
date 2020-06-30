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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('index');

// API's ufv
Route::get('/ufv', 'UfvController@index')->name('ufv');
Route::get('/anadir-ufv', 'UfvController@create')->name('ufv.anadir-ufv');
Route::post('/anadir-ufv', 'UfvController@store')->name('ufv.store');

Route::get('/editar-ufv/{id}/editar', 'UfvController@edit')->name('ufv.edit');
Route::patch('/editar-ufv/{id}/editar', 'UfvController@update')->name('ufv.update');

Route::delete('/borrar-ufv/{id}', 'UfvController@destroy')->name('ufv.destroy');

Route::get('/importar-archivo-ufv', 'UfvController@viewImport')->name('ufv.vista-importar');

Route::post('/importar-archivo-ufv', 'UfvController@import')->name('ufv.importar-archivo');

//API's incapacidades-temporales

Route::get('/incapacidades-temporales', 'IncTemporalesController@index')->name('incTemporal');
Route::get('/anadir-incapacidad-temporal', 'IncTemporalesController@create')->name('incTemporal.anadir');
Route::post('/anadir-incapacidad-temporal', 'IncTemporalesController@store')->name('incTemporal.store');

Route::get('/editar-incapacidad-temporal/{id}/editar', 'IncTemporalesController@edit')->name('incTemporal.edit');
Route::patch('/editar-incapacidad-temporal/{id}/editar', 'IncTemporalesController@update')->name('incTemporal.update');

Route::delete('/borrar-incapacidad-temporal/{id}', 'IncTemporalesController@destroy')->name('incTemporal.destroy');


//API's empresas
Route::get('/empresas', 'EmpresaController@index')->name('empresa');


//API's planillas
Route::get('/planillas', 'PlanillaController@index')->name('planilla');
Route::get('/anadir-planilla', 'PlanillaController@create')->name('planilla.anadir');
Route::post('/anadir-planilla', 'PlanillaController@store')->name('planilla.store');

Route::get('/detalle-planilla/{id}/detalle', 'PlanillaController@show')->name('planilla.detalle');

Route::get('/editar-planilla/{id}/editar', 'PlanillaController@edit')->name('planilla.edit');
Route::patch('/editar-planilla/{id}/editar', 'PlanillaController@update')->name('planilla.update');

Route::post('/editar-planilla/{id}/darBaja', 'PlanillaController@baja')->name('planilla.darBaja');


//API's cotizante
Route::get('/cotizantes-alta', 'CotizanteController@index')->name('cotizante');
Route::get('/cotizantes-baja', 'CotizanteController@indexBaja')->name('cotizante.baja');

Route::get('/anadir-cotizante', 'CotizanteController@create')->name('cotizante.anadir');
Route::post('/anadir-cotizante', 'CotizanteController@store')->name('cotizante.store');

Route::get('/editar-cotizante/{id}/editar', 'CotizanteController@edit')->name('cotizante.edit');
Route::patch('/editar-cotizante/{id}/editar', 'CotizanteController@update')->name('cotizante.update');

Route::get('/editar-cotizante-baja/{id}/editarBaja', 'CotizanteController@editBaja')->name('cotizante.edit.baja');
Route::patch('/editar-cotizante-baja/{id}/editarBaja', 'CotizanteController@updateBaja')->name('cotizante.update.baja');

Route::post('/editar-cotizante/{id}/darBaja', 'CotizanteController@baja')->name('cotizante.darBaja');

Route::post('/editar-cotizante-baja/{id}/darAlta', 'CotizanteController@alta')->name('cotizante.darAlta');

//API's registro de incapacidades a cotizantes
Route::get('/registro-incapacidades', 'IncapacidadesCotizanteController@index')->name('incapacidadCotizante');
Route::get('/anadir-incapacidad-cotizante', 'IncapacidadesCotizanteController@create')->name('incapacidadCotizante.anadir');
Route::get('/anadir-incapacidad-cotizante/{id}/anadir', 'IncapacidadesCotizanteController@show')->name('incapacidadCotizante.show');

Route::get('/anadir-incapacidad-cotizante-segundo/{id}/anadirSecond', 'IncapacidadesCotizanteController@show2')->name('incapacidadCotizante.showSecond');

Route::post('/anadir-incapacidad-cotizante', 'IncapacidadesCotizanteController@store')->name('incapacidadCotizante.store');


//API's Dominios
Route::get('/dominios', 'DominiosController@index')->name('dominios');
Route::get('/anadir-dominio', 'DominiosController@create')->name('dominios.anadir');
Route::post('/anadir-dominio', 'DominiosController@store')->name('dominios.store');

Route::get('/editar-dominio/{id}/editar', 'DominiosController@edit')->name('dominios.edit');
Route::patch('/editar-dominio/{id}/editar', 'DominiosController@update')->name('dominios.update');

Route::delete('/borrar-dominio/{id}', 'DominiosController@destroy')->name('dominios.destroy');

//APi's Subdominios
Route::get('/subdominios', 'SubdominiosController@index')->name('subdominios');
Route::get('/anadir-subdominio', 'SubdominiosController@create')->name('subdominios.anadir');
Route::post('/anadir-subdominio', 'SubdominiosController@store')->name('subdominios.store');

Route::get('/editar-subdominios/{id}/editar', 'SubdominiosController@edit')->name('subdominios.edit');
Route::patch('/editar-subdominios/{id}/editar', 'SubdominiosController@update')->name('subdominios.update');

Route::delete('/borrar-subdominios/{id}', 'SubdominiosController@destroy')->name('subdominios.destroy');
