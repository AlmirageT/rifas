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

Route::view('/', 'welcome');
Route::view('galeria', 'galeria');
Route::view('bases-legales', 'bases');
Route::view('propiedades', 'propiedad');
Route::get('rifa', 'ComprarRifaController@index');
Route::post('comprar-numeros','ComprarRifaController@envioEmail');
//tabla de boletas creadas para revisión de compra
Route::post('enviar-consulta','CorreoConsultaController@enviarCorreo');
Route::group(['prefix'=>'administrador'], function(){
	Route::view('/','admin.home');

	Route::group(['prefix'=>'transacciones'], function(){
		Route::group(['prefix'=>'boletas'], function(){
			Route::get('/','ListadoBoletaController@index');
			Route::get('detalle-boleta/{idBoleta}','ListadoBoletaController@detalle');
			Route::get('enviar-boleta/{idBoleta}','ListadoBoletaController@enviarBoleta');
			Route::get('liberar-boleta/{idBoleta}','ListadoBoletaController@liberarBoleta');
			Route::get('validadas','BoletasValidadasController@index');
			Route::get('validadas/detalle-boleta/{idBoleta}','ListadoBoletaController@detalle');
			Route::get('compradas','BoletasCompradasController@index');
			Route::get('compradas/detalle-boleta/{idBoleta}','ListadoBoletaController@detalle');
			Route::get('compradas/enviar-boleta/{idBoleta}','ListadoBoletaController@enviarBoleta');
			Route::get('compradas/liberar-boleta/{idBoleta}','ListadoBoletaController@liberarBoleta');

		});
	});
});
//script para crear los 100.000 numeros
//Route::get('generar-numeros','ComprarRifaController@numeros');
Route::post('datatable-boletas','ListadoBoletaController@listaBoletas');
Route::post('datatable-boletas-validadas','BoletasValidadasController@listaBoletas');
Route::post('datatable-boletas-compradas','BoletasCompradasController@listaBoletas');

//rutas login
Route::get('login','LoginController@index');
Route::post('ingreso-mi-portal','LoginController@ingresoPortal');
Route::post('logout','LoginController@logout');