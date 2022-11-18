<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Evaluacion;
use App\Models\Examen;
use App\Models\ExamenEstudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluacionController extends Controller
{
    public function __construct (){
        $this->middleware('auth:estudiante');
    }

    public function listarExamenesRealizados(){
        $user = Auth::user();
        $estudiante = Estudiante::query()->where('user_id','=',$user->id)->first();
        $examenes = $estudiante->examenes;
        return view('evaluacion.listar_examenes_realizados',compact('examenes'));
    }

    public function comenzarExamen(Request $request, Examen $examen){
        if(count($examen->preguntas) === 0){
            return redirect()->route('examenEstudiante')->with('error', 'La practica no tiene preguntas disponibles');
        }
        $request->session()->pull('preguntas');
        $request->session()->pull('examen');
        $request->session()->pull('estudiante');
        $user = Auth::user();
        $estudiante = Estudiante::query()->where('user_id','=',$user->id)->first();
        $evaluacionActual = Evaluacion::query()->where('examen_id', '=', $examen->id)->where('estudiante_id','=',$estudiante->id)->first();
        if($evaluacionActual){
            return redirect()->route('examenEstudiante')->with('error', 'Ya realizaste esta practica');
        }
        $evaluacion = ['calificacion' => 0, 'fechaAplicacion' => date('Y-m-d'), 'examen_id' => $examen->id, 'estudiante_id' => $estudiante->id];
        Evaluacion::create($evaluacion);
        $preguntas = [];
        foreach ($examen->preguntas as $pregunta) {
            $examenEstudiante = [];
            $examenEstudiante['pregunta_id'] = $pregunta->id;
            $examenEstudiante['respuesta_id'] = null;
            $examenEstudiante['examen_id'] = $examen->id;
            $examenEstudiante['estudiante_id'] = $estudiante->id;
            ExamenEstudiante::create($examenEstudiante);
            $preguntas[] = $pregunta;
        }
        $request->session()->put('preguntas',$preguntas);
        $request->session()->put('examen',$examen);
        $request->session()->put('estudiante',$estudiante);
        return redirect()->route('preguntaResponder',0);
    }

    public function vistaResponderPregunta(Request $request, $pregunta){
        $preguntas = $request->session()->get('preguntas');
        $examen = $request->session()->get("examen");
        return view('evaluacion.responder_pregunta', ['index' => $pregunta, 'pregunta' => $preguntas[intval($pregunta)], "total" => $examen->numeroPreguntas]);
    }

    public function finalizarExamen(Request $request){
        $examen = $request->session()->get('examen');
        $preguntas = $request->session()->get('preguntas');
        $pregunta = end($preguntas);
        $estudiante = $request->session()->get('estudiante');
        ExamenEstudiante::where('pregunta_id', $pregunta->id)->where('examen_id', $examen->id)->where('estudiante_id',$estudiante->id)->update(['respuesta_id' => $request->get('respuesta_id')]);
        $respuestas = ExamenEstudiante::where('examen_id','=',$examen->id)->where('estudiante_id','=',$estudiante->id)->get();
        $numeroCorrectas = 0;
        foreach ($respuestas as $respuesta) {
            if($respuesta->respuesta->esCorrecto){
                $numeroCorrectas++;
            }
        }
        $calificacion = $numeroCorrectas / $examen->numeroPreguntas;
        $calificacion = round($calificacion,2);
        $calificacion = $calificacion * 10;
        Evaluacion::where('examen_id', $examen->id)->where('estudiante_id',$estudiante->id)->update(['calificacion' => $calificacion]);
        $request->session()->pull('preguntas');
        $request->session()->pull('examen');
        $request->session()->pull('estudiante');
        return redirect()->route('examenEstudiante');
    }

    public function responderPregunta(Request $request, $pregunta){
        $index = $pregunta;
        $preguntas = $request->session()->get('preguntas');
        $examen = $request->session()->get('examen');
        $pregunta = $preguntas[intval($index)];
        $estudiante = $request->session()->get('estudiante');
        ExamenEstudiante::where('pregunta_id', $pregunta->id)->where('examen_id', $examen->id)->where('estudiante_id',$estudiante->id)->update(['respuesta_id' => $request->get('respuesta_id')]);
        return redirect()->route('preguntaResponder',intval($index) + 1);
    }

    public function listarExamenesAPresentar(){
        $user = Auth::user();
        $estudiante = Estudiante::query()->where('user_id','=',$user->id)->first();
        $id = $estudiante->id;
        $examenes = Examen::all();
        return view('evaluacion.listar_examenes_a_realizar',compact('examenes'));
    }
}
