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
    public function listarExamenesRealizados(){
        $user = Auth::user();
        $estudiante = Estudiante::query()->where('user_id','=',$user->id)->first();
        $examenes = $estudiante->examenes();
        return view('evaluacion.listar_examenes_realizados',compact('examenes'));
    }

    public function comenzarExamen(Request $request, Examen $examen){
        if(count($examen->preguntas) === 0){
            return redirect()->route('examenEstudiante')->with('error', 'El examen no tiene preguntas disponibles');
        }
        $request->session()->pull('preguntas');
        $request->session()->pull('examen');
        $request->session()->pull('estudiante');
        $user = Auth::user();
        $estudiante = Estudiante::query()->where('user_id','=',$user->id)->first();
        $evaluacionActual = Evaluacion::query()->where('examen_id', '=', $examen->id)->where('estudiante_id','=',$estudiante->id);
        if($evaluacionActual){
            return redirect()->route('examenEstudiante')->with('error', 'Ya realizaste este examen');
        }
        $evaluacion = ['calificacion' => 0, 'fechaAplicacion' => date('yyyy-MM-dd'), 'examen_id' => $examen->id, 'estudiante_id' => $estudiante->id];
        Evaluacion::create($evaluacion);
        $preguntas = [];
        foreach ($examen->preguntas() as $pregunta) {
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
        return redirect()->route('examenEstudiante',0);
    }

    public function vistaResponderPregunta(Request $request, $index){
        $preguntas = $request->session()->get('preguntas');
        
        return view('evaluacion.responder_pregunta', ['index' => $index, 'pregunta' => $preguntas[intval($index)]]);
    }

    public function finalizarExamen(Request $request){

    }

    public function responderPregunta(Request $request, $index){
        $preguntas = $request->session()->get('preguntas');
        $examen = $request->session()->get('examen');
        $pregunta = $preguntas[intval($index)];
        $user = Auth::user();
        $estudiante = Estudiante::query()->where('user_id','=',$user->id)->first();
        $examenEstudiante = ['pregunta_id' => $pregunta->id,'respuesta_id' => $request->get('respuesta_id'),'examen_id' => $examen->id,'estudiante_id' => $estudiante->id];
        ExamenEstudiante::create($examenEstudiante);

        return redirect()->route('examenEstudiante',intval($index) + 1);
    }

    public function listarExamenesAPresentar(){
        $user = Auth::user();
        $estudiante = Estudiante::query()->where('user_id','=',$user->id)->first();
        $id = $estudiante->id;
        $examenes = Examen::all();
        return view('evaluacion.listar_examenes_a_realizar',compact('examenes'));
    }
}
