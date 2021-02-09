<?php
use Illuminate\Support\Facades\Route;



Route::get('/', 'AlumnosController@index')->name('linkverAlumnos'); //Lista de Alumnos
Route::get('/pruebas', 'AlumnosController@prueba')->name('prueba'); //Lista de Alumnos
Route::post('alumnos/BorradoMultiple', 'AlumnosController@borradoMultiplesAjax')->name('borradoMultiplesAjax'); //borrar con ajax

Route::delete('myproductsDeleteAll', 'AlumnosController@deleteAll');
