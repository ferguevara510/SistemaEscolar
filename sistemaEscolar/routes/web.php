<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\GeogebraController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/geogebra', [GeogebraController::class, 'vistaGeogebra'])->name('geogebra');

Route::get('/registrarEstudiante', [EstudianteController::class, 'vistaRegistrarEstudiante'])->name('estudianteIndex');
Route::post('/registrarEstudiante', [EstudianteController::class, 'registrarEstudiante'])->name('estudianteStorage');
Route::get('/registrarProfesor', [ProfesorController::class, 'vistaRegistrarProfesor'])->name('profesorIndex');
Route::post('/registrarProfesor', [ProfesorController::class, 'registrarProfesor'])->name('profesorStorage');

Route::get('/consultarEstudianteProfesor', [EstudianteController::class, 'consultarListaEstudiantesProfesor'])->name('estudianteProfList');
Route::get('/consultarEstudiante', [EstudianteController::class, 'consultarListaEstudiantes'])->name('estudianteList');
Route::get('/consultarProfesor', [ProfesorController::class, 'consultarListaProfesor'])->name('profesorList');

Route::get('/modificarEstudiante/{estudiante}', [EstudianteController::class, 'mostrarEstudiante'])->name('estudianteShow');
Route::put('/modificarEstudiante/{estudiante}', [EstudianteController::class, 'modificarEstudiante'])->name('estudianteEdit');
Route::get('/modificarProfesor/{profesor}', [ProfesorController::class, 'mostrarProfesor'])->name('profesorShow');
Route::put('/modificarProfesor/{profesor}', [ProfesorController::class, 'modificarProfesor'])->name('profesorEdit');

Route::delete('/eliminarEstudiante/{estudiante}', [EstudianteController::class, 'eliminarEstudiante'])->name('estudianteDelete');
Route::delete('/eliminarProfesor/{profesor}', [ProfesorController::class, 'eliminarProfesor'])->name('profesorDelete');