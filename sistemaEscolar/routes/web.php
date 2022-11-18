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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::post('/iniciarSesion', [SesionController::class, 'iniciarSesion'])->name('customLogin');

//Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth:admin');
Route::get('/homeProfesor', [App\Http\Controllers\HomeController::class, 'indexProfesor'])->name('homeProfesor')->middleware('auth:profesor');
Route::get('/homeEstudiante', [App\Http\Controllers\HomeController::class, 'indexEstudiante'])->name('homeEstudiante')->middleware('auth:estudiante');

//Geogebra
Route::get('/geogebra', [GeogebraController::class, 'vistaGeogebra'])->name('geogebra');

//Registros
//Estudiante
Route::get('/registrarEstudianteProfesor', [EstudianteController::class, 'vistaRegistrarEstudianteProfesor'])->name('estudianteProfIndex')->middleware('auth:profesor');
Route::post('/registrarEstudianteProfesor', [EstudianteController::class, 'registrarEstudianteProfesor'])->name('estudianteProfStorage')->middleware('auth:profesor');
Route::get('/registrarEstudiante', [EstudianteController::class, 'vistaRegistrarEstudiante'])->name('estudianteIndex')->middleware('auth:admin');
Route::post('/registrarEstudiante', [EstudianteController::class, 'registrarEstudiante'])->name('estudianteStorage')->middleware('auth:admin');
//Profesor
Route::get('/registrarProfesor', [ProfesorController::class, 'vistaRegistrarProfesor'])->name('profesorIndex')->middleware('auth:admin');
Route::post('/registrarProfesor', [ProfesorController::class, 'registrarProfesor'])->name('profesorStorage')->middleware('auth:admin');
//Contenido
Route::get('/registrarContenido', [ContenidoController::class, 'vistaRegistrarContenido'])->name('contenidoIndex')->middleware('auth:profesor');
Route::post('/registrarContenido', [ContenidoController::class, 'registrarContenido'])->name('contenidoStorage')->middleware('auth:profesor');
//Exámen
Route::get('/registrarExamen', [ExamenController::class, 'vistaRegistrarExamen'])->name('examenIndex')->middleware('auth:profesor');
Route::post('/registrarExamen', [ExamenController::class, 'registrarExamen'])->name('examenStorage')->middleware('auth:profesor');
//Pregunta
Route::get('/registrarPregunta/{examenId}', [PreguntaController::class, 'vistaRegistrarPregunta'])->name('preguntaIndex');
Route::post('/registrarPregunta', [PreguntaController::class, 'registrarPregunta'])->name('preguntaStorage')->middleware('auth:profesor');
//Respuesta
Route::post('/registrarRespuesta', [RespuestaController::class, 'registrarRespuesta'])->name('respuestaStorage')->middleware('auth:profesor');

//Consultas
//Estudiante
Route::get('/consultarEstudianteProfesor', [EstudianteController::class, 'consultarListaEstudiantesProfesor'])->name('estudianteProfList')->middleware('auth:profesor');
Route::get('/consultarEstudiante', [EstudianteController::class, 'consultarListaEstudiantes'])->name('estudianteList')->middleware('auth:admin');
//Profesor
Route::get('/consultarProfesor', [ProfesorController::class, 'consultarListaProfesor'])->name('profesorList')->middleware('auth:admin');
//Contenido
Route::get('/consultarContenido', [ContenidoController::class, 'consultarListaContenido'])->name('contenidoList')->middleware('auth:profesor');
Route::get('/consultarContenidoEstudiante', [ContenidoController::class, 'consultarListaContenidoEstudiante'])->name('contenidoEstList')->middleware('auth:estudiante');
//Exámen
Route::get('/consultarExamenes', [ExamenController::class, 'consultarExamenes'])->name('examenList');

//Modificaciones
//Estudiante
Route::get('/modificarEstudianteProfesor/{estudiante}', [EstudianteController::class, 'mostrarEstudianteProfesor'])->name('estudianteProfShow')->middleware('auth:profesor');
Route::put('/modificarEstudianteProfesor/{estudiante}', [EstudianteController::class, 'modificarEstudianteProfesor'])->name('estudianteProfEdit')->middleware('auth:profesor');
Route::get('/modificarEstudiante/{estudiante}', [EstudianteController::class, 'mostrarEstudiante'])->name('estudianteShow')->middleware('auth:admin');
Route::put('/modificarEstudiante/{estudiante}', [EstudianteController::class, 'modificarEstudiante'])->name('estudianteEdit')->middleware('auth:admin');
Route::get('/cambiarContraseña/{estudiante}', [EstudianteController::class, 'vistaCambioContraseña'])->name('estudianteContraseña')->middleware('auth:admin');
Route::put('/cambiarContraseña/{estudiante}', [EstudianteController::class, 'cambiarContraseña'])->name('estudianteCambiarContraseña')->middleware('auth:admin');
Route::get('/cambiarContraseñaEstudianteProfesor/{estudiante}', [EstudianteController::class, 'vistaEstudianteProfesorCambioContraseña'])->name('estudianteProfesorContraseña')->middleware('auth:profesor');;
Route::put('/cambiarContraseñaEstudianteProfesor/{estudiante}', [EstudianteController::class, 'cambiarContraseñaEstudianteProfesor'])->name('estudianteProfesorCambiarContraseña')->middleware('auth:profesor');;
//Profesor
Route::get('/modificarProfesor/{profesor}', [ProfesorController::class, 'mostrarProfesor'])->name('profesorShow')->middleware('auth:admin');
Route::put('/modificarProfesor/{profesor}', [ProfesorController::class, 'modificarProfesor'])->name('profesorEdit')->middleware('auth:admin');
Route::get('/cambiarContraseñaProfesor/{profesor}', [ProfesorController::class, 'vistaCambioContraseña'])->name('profesorContrasena')->middleware('auth');
Route::put('/cambiarContraseñaProfesor/{profesor}', [ProfesorController::class, 'cambiarContraseña'])->name('profesorCambiarContrasena')->middleware('auth');
//Contenido
Route::get('/modificarContenido/{contenido}', [ContenidoController::class, 'mostrarContenido'])->name('contenidoShow')->middleware('auth:profesor');
Route::put('/modificarContenido/{contenido}', [ContenidoController::class, 'modificarContenido'])->name('contenidoEdit')->middleware('auth:profesor');
//Exámen
Route::get('/modificarExamen/{examen}', [ExamenController::class, 'mostrarExamen'])->name('examenShow')->middleware('auth:profesor');
Route::put('/modificarExamen/{examen}', [ExamenController::class, 'modificarExamen'])->name('examenEdit')->middleware('auth:profesor');
//Pregunta
Route::get('/modificarPregunta/{pregunta}', [PreguntaController::class, 'mostrarPregunta'])->name('preguntaShow')->middleware('auth:profesor');
Route::put('/modificarPregunta/{pregunta}', [PreguntaController::class, 'modificarPregunta'])->name('preguntaEdit')->middleware('auth:profesor');
//Respuesta
Route::put('/marcarRespuestaCorrecta/{respuesta}', [RespuestaController::class, 'marcarRespuestaCorrecta'])->name('respuestaCorrecta')->middleware('auth:profesor');

//Eliminaciones
//Estudiante
Route::delete('/eliminarEstudianteProfesor/{estudiante}', [EstudianteController::class, 'eliminarEstudianteProfesor'])->name('estudianteProfDelete')->middleware('auth:profesor');
Route::delete('/eliminarEstudiante/{estudiante}', [EstudianteController::class, 'eliminarEstudiante'])->name('estudianteDelete')->middleware('auth:admin');
//Profesor
Route::delete('/eliminarProfesor/{profesor}', [ProfesorController::class, 'eliminarProfesor'])->name('profesorDelete')->middleware('auth:admin');
//Contenido
Route::delete('/eliminarContenido/{contenido}', [ContenidoController::class, 'eliminarContenido'])->name('contenidoDelete')->middleware('auth:profesor');
//Exámen
Route::delete('/eliminarExamen/{examen}', [ExamenController::class, 'eliminarExamen'])->name('examenDelete')->middleware('auth:profesor');
//Pregunta
Route::delete('/eliminarPregunta/{pregunta}', [PreguntaController::class, 'eliminarPregunta'])->name('preguntaDelete')->middleware('auth:profesor');
//Respuesta
Route::delete('/eliminarRespuesta/{respuesta}', [RespuestaController::class, 'eliminarRespuesta'])->name('respuestaDelete')->middleware('auth:profesor');

//Otros
//Examenes
Route::get('/listaExamenesRealizados', [EvaluacionController::class, 'listarExamenesRealizados'])->name('examenEstudiante');
Route::get('/listaExamenesPresentar', [EvaluacionController::class, 'listarExamenesAPresentar'])->name('examenPresentar');
Route::get('/mostrarPregunta/{pregunta}', [EvaluacionController::class, 'vistaResponderPregunta'])->name('preguntaResponder');
Route::post('/comenzarExamen/{examen}', [EvaluacionController::class, 'comenzarExamen'])->name('examenStart');
Route::post('/terminarExamen', [EvaluacionController::class, 'finalizarExamen'])->name('examenFinish');
Route::post('/responderPregunta/{pregunta}', [EvaluacionController::class, 'responderPregunta'])->name('respuestaExamen');
Route::post('/habilitarExamen/{examen}/{estudiante}', [ExamenController::class, 'habilitarExamen'])->name('examenHabilitar');
Route::get('/resultadosEstudiantes/{examen}', [ExamenController::class, 'listarResultadosExamenes'])->name('examenResultados');