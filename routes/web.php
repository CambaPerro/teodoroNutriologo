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
Route::get('/orden_alimenticio','OrdenAlimenticioController@index');

Route::get('/orden',function(){
    return view('orden_alimenticio/index');
})->name('orden');

Route::get('/alimentos',function(){
    return view('alimento/index');
})->name('alimentos');

Route::get('/dietas',function(){
    return view('dieta/index');
})->name('dietas');
