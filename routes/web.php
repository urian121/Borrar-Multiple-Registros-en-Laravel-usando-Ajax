<?php
use Illuminate\Support\Facades\Route;



Route::get('/', 'AlumnosController@listAlumnos')->name('listAlumnos'); //Lista de Alumnos
Route::delete('/DeleteMultiple/', 'AlumnosController@DeleteMultiple');