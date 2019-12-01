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
//crud categoria
Route::get('/categoria','CategoriaController@index');
Route::post('/categoria/registrar','CategoriaController@store');
Route::put('/categoria/actualizar','CategoriaController@update');
Route::delete('/categoria/eliminar_{id}','CategoriaController@destroy');
//actividad fisica
Route::get('/actividad_fisica','ActividadFisicaController@index');
Route::get('/alimento','AlimentoController@index');
Route::get('/tipo_actividad','TipoActividadController@index');
Route::post('/orden_alimenticio/registrar', 'OrdenAlimenticioController@store');
Route::get('/orden_alimenticio','OrdenAlimenticioController@index');
Route::delete('/orden_alimenticio/eliminar_{id}','OrdenAlimenticioController@destroy');



/*vistas*/
Route::get('/orden_alimenticios',function(){
    return view('orden_alimenticio/index');
})->name('orden_alimenticios');

Route::get('/alimentos',function(){
    return view('alimento/index');
})->name('alimentos');

Route::get('/dietas',function(){
    return view('dieta/index');
})->name('dietas');
/*url de las vistas*/ 
Route::get('/categorias',function(){
    return view('categoria/index');
})->name('categorias');

Route::get('/actividad_fisicas',function(){
    return view('actividad_fisica/index');
})->name('actividad_fisicas');

Route::get('/tipo_actividads',function(){
    return view('tipo_actividad/index');
})->name('tipo_actividads');
