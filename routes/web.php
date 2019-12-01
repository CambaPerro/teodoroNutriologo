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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dieta','DietaController@index');

//CRUD ORDEN ALIMENTICIO
Route::get('/orden_alimenticio','OrdenAlimenticioController@index');
Route::post('/orden_alimenticio/registrar','OrdenAlimenticioController@store');
Route::put('/orden_alimenticio/actualizar','OrdenAlimenticioController@update');
Route::delete('/orden_alimenticio/eliminar_(id)','OrdenAlimenticioController@destroy');


Route::get('/categoria','CategoriaController@index');
Route::get('/actividad_fisica','ActividadFisicaController@index');
Route::get('/alimento','AlimentoController@index');
Route::get('/tipo_actividad','TipoActividadController@index');
Route::post('/orden_alimenticio/registrar', 'OrdenAlimenticioController@store');
Route::delete('/orden_alimenticio/eliminar_{id}','OrdenAlimenticioController@destroy');

Route::get('/orden_alimenticios',function(){
    return view('orden_alimenticio/index');
})->name('orden_alimenticios');

Route::get('/alimentos',function(){
    return view('alimento/index');
})->name('alimentos');

Route::get('/dietas',function(){
    return view('dieta/index');
})->name('dietas');

Route::get('/categorias',function(){
    return view('categoria/index');
})->name('categorias');

Route::get('/actividad_fisicas',function(){
    return view('actividad_fisica/index');
})->name('actividad_fisicas');

Route::get('/tipo_actividads',function(){
    return view('tipo_actividad/index');
})->name('tipo_actividads');
