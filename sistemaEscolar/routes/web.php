<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\GeogebraController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProfesorController;

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
    return view('home');
});

Auth::routes();

//Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/homeProfesor', [App\Http\Controllers\HomeController::class, 'indexProfesor'])->name('homeProfesor');
Route::get('/homeEstudiante', [App\Http\Controllers\HomeController::class, 'indexEstudiante'])->name('homeEstudiante');

//Geogebra
Route::get('/geogebra', [GeogebraController::class, 'vistaGeogebra'])->name('geogebra');

//Registros
//Estudiante
Route::get('/registrarEstudianteProfesor', [EstudianteController::class, 'vistaRegistrarEstudianteProfesor'])->name('estudianteProfIndex');
Route::post('/registrarEstudianteProfesor', [EstudianteController::class, 'registrarEstudianteProfesor'])->name('estudianteProfStorage');
Route::get('/registrarEstudiante', [EstudianteController::class, 'vistaRegistrarEstudiante'])->name('estudianteIndex');
Route::post('/registrarEstudiante', [EstudianteController::class, 'registrarEstudiante'])->name('estudianteStorage');
//Profesor
Route::get('/registrarProfesor', [ProfesorController::class, 'vistaRegistrarProfesor'])->name('profesorIndex');
Route::post('/registrarProfesor', [ProfesorController::class, 'registrarProfesor'])->name('profesorStorage');
//Material
Route::get('/registrarMaterial', [MaterialController::class, 'vistaRegistrarMaterial'])->name('materialIndex');
Route::post('/registrarMaterial', [MaterialController::class, 'registrarMaterial'])->name('materialStorage');

//Consultas
//Estudiante
Route::get('/consultarEstudianteProfesor', [EstudianteController::class, 'consultarListaEstudiantesProfesor'])->name('estudianteProfList');
Route::get('/consultarEstudiante', [EstudianteController::class, 'consultarListaEstudiantes'])->name('estudianteList');
//Profesor
Route::get('/consultarProfesor', [ProfesorController::class, 'consultarListaProfesor'])->name('profesorList');
//Material
Route::get('/consultarMaterial', [MaterialController::class, 'consultarListaMaterial'])->name('materialList');
Route::get('/consultarMaterialEstudiante', [MaterialController::class, 'consultarListaMaterialEstudiante'])->name('materialEstList');

//Modificaciones
//Estudiante
Route::get('/modificarEstudianteProfesor/{estudiante}', [EstudianteController::class, 'mostrarEstudianteProfesor'])->name('estudianteProfShow');
Route::put('/modificarEstudianteProfesor/{estudiante}', [EstudianteController::class, 'modificarEstudianteProfesor'])->name('estudianteProfEdit');
Route::get('/modificarEstudiante/{estudiante}', [EstudianteController::class, 'mostrarEstudiante'])->name('estudianteShow');
Route::put('/modificarEstudiante/{estudiante}', [EstudianteController::class, 'modificarEstudiante'])->name('estudianteEdit');
//Profesor
Route::get('/modificarProfesor/{profesor}', [ProfesorController::class, 'mostrarProfesor'])->name('profesorShow');
Route::put('/modificarProfesor/{profesor}', [ProfesorController::class, 'modificarProfesor'])->name('profesorEdit');
//Material
Route::get('/modificarMaterial/{material}', [MaterialController::class, 'mostrarMaterial'])->name('materialShow');
Route::put('/modificarMaterial/{material}', [MaterialController::class, 'modificarMaterial'])->name('materialEdit');

//Eliminaciones
//Estudiante
Route::delete('/eliminarEstudianteProfesor/{estudiante}', [EstudianteController::class, 'eliminarEstudianteProfesor'])->name('estudianteProfDelete');
Route::delete('/eliminarEstudiante/{estudiante}', [EstudianteController::class, 'eliminarEstudiante'])->name('estudianteDelete');
//Profesor
Route::delete('/eliminarProfesor/{profesor}', [ProfesorController::class, 'eliminarProfesor'])->name('profesorDelete');
//Material
Route::delete('/eliminarMaterial/{material}', [MaterialController::class, 'eliminarMaterial'])->name('materialDelete');