<?php


use App\Http\Controllers\ContenidoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\GeogebraController;
use App\Http\Controllers\PreguntaController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\RespuestaController;
use App\Http\Controllers\SesionController;

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

Route::post('/iniciarSesion', [SesionController::class, 'iniciarSesion'])->name('customLogin');

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
//Contenido
Route::get('/registrarContenido', [ContenidoController::class, 'vistaRegistrarContenido'])->name('contenidoIndex');
Route::post('/registrarContenido', [ContenidoController::class, 'registrarContenido'])->name('contenidoStorage');
//Exámen
Route::get('/registrarExamen/{profesorId}', [ExamenController::class, 'vistaRegistrarExamen'])->name('examenIndex');
Route::post('/registrarExamen', [ExamenController::class, 'registrarExamen'])->name('examenStorage');
//Pregunta
Route::get('/registrarPregunta/{preguntaId}', [PreguntaController::class, 'vistaRegistrarPregunta'])->name('preguntaIndex');
Route::post('/registrarPregunta', [PreguntaController::class, 'registrarPregunta'])->name('preguntaStorage');
//Respuesta
Route::post('/registrarRespuesta', [RespuestaController::class, 'registrarRespuesta'])->name('respuestaStorage');

//Consultas
//Estudiante
Route::get('/consultarEstudianteProfesor', [EstudianteController::class, 'consultarListaEstudiantesProfesor'])->name('estudianteProfList');
Route::get('/consultarEstudiante', [EstudianteController::class, 'consultarListaEstudiantes'])->name('estudianteList');
//Profesor
Route::get('/consultarProfesor', [ProfesorController::class, 'consultarListaProfesor'])->name('profesorList');
//Contenido
Route::get('/consultarContenido', [ContenidoController::class, 'consultarListaContenido'])->name('contenidoList');
Route::get('/consultarContenidoEstudiante', [ContenidoController::class, 'consultarListaContenidoEstudiante'])->name('contenidoEstList');
//Exámen
Route::get('/consultarExamenes', [ExamenController::class, 'consultarExamenes'])->name('examenList');

//Modificaciones
//Estudiante
Route::get('/modificarEstudianteProfesor/{estudiante}', [EstudianteController::class, 'mostrarEstudianteProfesor'])->name('estudianteProfShow');
Route::put('/modificarEstudianteProfesor/{estudiante}', [EstudianteController::class, 'modificarEstudianteProfesor'])->name('estudianteProfEdit');
Route::get('/modificarEstudiante/{estudiante}', [EstudianteController::class, 'mostrarEstudiante'])->name('estudianteShow');
Route::put('/modificarEstudiante/{estudiante}', [EstudianteController::class, 'modificarEstudiante'])->name('estudianteEdit');
//Profesor
Route::get('/modificarProfesor/{profesor}', [ProfesorController::class, 'mostrarProfesor'])->name('profesorShow');
Route::put('/modificarProfesor/{profesor}', [ProfesorController::class, 'modificarProfesor'])->name('profesorEdit');
//Contenido
Route::get('/modificarContenido/{contenido}', [ContenidoController::class, 'mostrarContenido'])->name('contenidoShow');
Route::put('/modificarContenido/{contenido}', [ContenidoController::class, 'modificarContenido'])->name('contenidoEdit');
//Exámen
Route::get('/modificarExamen/{examen}', [ExamenController::class, 'mostrarExamen'])->name('examenShow');
Route::put('/modificarExamen/{examen}', [ExamenController::class, 'modificarExamen'])->name('examenEdit');
//Pregunta
Route::get('/modificarPregunta/{pregunta}', [PreguntaController::class, 'mostrarPregunta'])->name('preguntaShow');
Route::put('/modificarPregunta/{pregunta}', [PreguntaController::class, 'modificarPregunta'])->name('preguntaEdit');
//Respuesta
Route::put('/marcarRespuestaCorrecta/{respuesta}', [RespuestaController::class, 'marcarRespuestaCorrecta'])->name('respuestaCorrecta');

//Eliminaciones
//Estudiante
Route::delete('/eliminarEstudianteProfesor/{estudiante}', [EstudianteController::class, 'eliminarEstudianteProfesor'])->name('estudianteProfDelete');
Route::delete('/eliminarEstudiante/{estudiante}', [EstudianteController::class, 'eliminarEstudiante'])->name('estudianteDelete');
//Profesor
Route::delete('/eliminarProfesor/{profesor}', [ProfesorController::class, 'eliminarProfesor'])->name('profesorDelete');
//Contenido
Route::delete('/eliminarContenido/{contenido}', [ContenidoController::class, 'eliminarContenido'])->name('contenidoDelete');
//Exámen
Route::delete('/eliminarExamen/{examen}', [ExamenController::class, 'eliminarExamen'])->name('examenDelete');
//Pregunta
Route::delete('/eliminarPregunta/{pregunta}', [PreguntaController::class, 'eliminarPregunta'])->name('preguntaDelete');
//Respuesta
Route::delete('/eliminarRespuesta/{respuesta}', [RespuestaController::class, 'eliminarRespuesta'])->name('respuestaDelete');

//Otros
//Examenes
Route::get('/listaExamenesRealizados', [EvaluacionController::class, 'listarExamenesRealizados'])->name('examenEstudiante');
Route::get('/listaExamenesPresentar', [EvaluacionController::class, 'listarExamenesAPresentar'])->name('examenEstudiante');
Route::get('/mostrarPregunta/{pregunta}', [EvaluacionController::class, 'vistaResponderPregunta'])->name('preguntaResponder');
Route::post('/comenzarExamen/{examen}', [EvaluacionController::class, 'comenzarExamen'])->name('examenStart');
Route::post('/terminarExamen', [EvaluacionController::class, 'terminarExamen'])->name('examenFinish');