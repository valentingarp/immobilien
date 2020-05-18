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
    //return view('welcome');
    return view('auth/login');
});

Auth::routes();

Route::group(['middleware'=>'auth'],function(){
	Route::get('/home', 'HomeController@index')->name('home');
});
//Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>'auth','middleware'=>'Admin'],function(){
	Route::resource('administrador/persona','Administrador\PersonaController');
	Route::get('administrador/json_provincia','Administrador\PersonaController@provincia');
    Route::get('administrador/json_distrito','Administrador\PersonaController@distrito');
    Route::resource('administrador/cliente','Administrador\ClienteController');
    Route::resource('administrador/usuario','Administrador\UsuarioController');
	Route::resource('administrador/servicio','Administrador\ServicioController');
	Route::resource('administrador/procesoservicio','Administrador\ProcesoController');
	Route::resource('administrador/servicioactividad','Administrador\ServicioActividadController');
	Route::resource('administrador/fase','Administrador\FaseController');
	Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/home','HomeController@changepass');
	Route::get('administrador/changepass',function(){return view('administrador.changepass');});
	Route::post('/administrador/changepass','HomeController@changepass');
	Route::resource('administrador/procesofase','Administrador\ProcesoFaseController');
	Route::resource('administrador/proyecto','Administrador\ProyectoController');
	Route::get('administrador/json_servicio','Administrador\ProyectoController@servicio');
	Route::get('administrador/json_actividad','Administrador\ProyectoController@actividad');
	Route::post('administrador/proyecto/create','Administrador\ProyectoController@buscacliente')->name('administrador.proyecto.create');
	Route::get('/autocompletepersonal', array('as' => 'autocompletepersonal', 'uses'=>'Administrador\ProyectoController@buscapersonal'));
});
