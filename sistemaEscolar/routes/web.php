<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/registrarEstudiante', [EstudianteController::class, 'vistaRegistrarEstudiante'])->name('estudianteIndex');
Route::post('/registrarEstudiante', [EstudianteController::class, 'registrarEstudiante'])->name('estudianteStorage');
Route::get('/registrarProfesor', [ProfesorController::class, 'vistaRegistrarProfesor'])->name('profesorIndex');
Route::post('/registrarProfesor', [ProfesorController::class, 'registrarProfesor'])->name('profesorStorage');

Route::get('/consultarEstudiante', [EstudianteController::class, 'consultarListaEstudiante'])->name('estudianteList');
Route::get('/consultarProfessor', [ProfesorController::class, 'consultarListaProfesor'])->name('profesoroList');

Route::get('/modificarEstudiante/{estudiante}', [EstudianteController::class, 'mostrarEstudiante'])->name('estudianteShow');
Route::put('/modificarEstudiante/{estudiante}', [EstudianteController::class, 'modificarEstudiante'])->name('estudianteEdit');
Route::get('/modificarProfesor/{profesor}', [ProfesorController::class, 'mostrarProfesor'])->name('profesorShow');
Route::put('/modificarProfesor/{profesor}', [ProfesorController::class, 'modificarProfesor'])->name('profesorEdit');

Route::delete('/eliminarEstudiante/{estudiante}', [EstudianteController::class, 'eliminarEstudiante'])->name('estudianteDelete');
Route::delete('/eliminarProfesor/{profesor}', [ProfesorController::class, 'eliminarProfesor'])->name('profesorDelete');