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
Route::post('/dieta/registrar','DietaController@store');

//CRUD ORDEN ALIMENTICIO
Route::get('/orden_alimento','OrdenAlimentoController@index');
Route::get('/orden_alimento/listar_alimento','OrdenAlimentoController@listar_alimento');
Route::post('/orden_alimento/registrar','OrdenAlimentoController@store');
Route::put('/orden_alimento/actualizar','OrdenAlimentoController@update');
Route::delete('/orden_alimento/eliminar_{id}','OrdenAlimentoController@destroy');
Route::put('/orden_alimento/eliminar_detalle','OrdenAlimentoController@destroy_detalle');
Route::get('/alimento/select','AlimentoController@select');
Route::get('/alimento/listar','AlimentoController@listar');
//CRUD CATEGORIA
Route::get('/categoria','CategoriaController@index');
Route::get('/categoria/select','CategoriaController@select');
Route::post('/categoria/registrar','CategoriaController@store');
Route::put('/categoria/actualizar','CategoriaController@update');
Route::delete('/categoria/eliminar_{id}','CategoriaController@destroy');
//actividad fisica
Route::get('/actividad_fisica','ActividadFisicaController@index');
Route::post('/actividad_fisica/registrar','ActividadFisicaController@store');
Route::put('/actividad_fisica/actualizar','ActividadFisicaController@update');
Route::delete('/actividad_fisica/eliminar_{id}','ActividadFisicaController@destroy');

//TIPO ACTIVIDAD
Route::get('/tipo_actividad','TipoActividadController@index');
Route::post('/tipo_actividad/registrar','TipoActividadController@store');
Route::put('/tipo_actividad/actualizar','TipoActividadController@update');
Route::delete('/tipo_actividad/eliminar_{id}','TipoActividadController@destroy');



//  CRUD ALIMENTO
Route::get('/alimento','AlimentoController@index');
Route::post('/alimento/registrar','AlimentoController@store');
Route::put('/alimento/actualizar','AlimentoController@update');
Route::delete('/alimento/eliminar_{id}','AlimentoController@destroy');
//CRUD TIPO DE TIPO ACTIVIDAD
Route::get('/tipo_actividad','TipoActividadController@index');
Route::get('/tipo_actividad/select','TipoActividadController@select');

//CRUD MENU
Route::get('/menu','MenuController@index');
Route::get('/menu/listar_menu','MenuController@listar_menu');
Route::get('/menu/listar_alimento','MenuController@listar_alimento');
Route::post('/menu/registrar','MenuController@store');
Route::put('/menu/actualizar','MenuController@update');
Route::delete('/menu/eliminar_{id}','MenuController@destroy');

//CRUD Perfil de Usuario
Route::post('/user/guardarImg','UsuarioController@guardar_imagen');

Route::get('/user','UsuarioController@index');
// Route::get('/menu/listar_menu','UsuarioController@listar_menu');
// Route::get('/menu/listar_alimento','UsuarioController@listar_alimento');
// Route::post('/menu/registrar','UsuarioController@store');
// Route::put('/menu/actualizar','UsuarioController@update');
// Route::delete('/menu/eliminar_{id}','UsuarioController@destroy');




Route::get('/nivel_actividad/select','NivelActividadController@select');
// Route:get('/nombre para url',functio(){
    // return view('direccion del views');
// })->name('nombre para url');

/*rutas de las vistas */
Route::get('/orden_alimentos',function(){
    return view('orden_alimento/index');
})->name('orden_alimentos');

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

Route::get('/menus',function(){
    return view('menu/index');
})->name('menus');

Route::get('/perfils',function(){
    return view('perfil/index');
})->name('perfils');
