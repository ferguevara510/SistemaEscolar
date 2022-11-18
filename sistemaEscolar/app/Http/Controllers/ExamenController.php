<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Evaluacion;
use App\Models\Examen;
use App\Models\ExamenEstudiante;
use App\Models\Pregunta;
use App\Models\Profesor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamenController extends Controller
{
    public function __construct (){
        $this->middleware('auth:profesor');
    }

    public function vistaRegistrarExamen(){
        $user = Auth::user();
        $profesor = Profesor::query()->where('user_id','=',$user->id)->first();
        $profesorId = $profesor->id;
        return view('examen.registrar_examen',compact('profesorId'));
    }

    public function registrarExamen(Request $request){
        $nuevoExamen = $request->validate([
            'titulo' => 'required',
            'numeroPreguntas' => 'required',
            'profesor_id' => 'required',
        ]);
        $examen = Examen::create($nuevoExamen);
        return redirect()->route('examenShow',$examen->id)->with('success','Practica creada');
    }

    public function consultarExamenes(Request $request){
        $examenes = [];
        $busqueda = $request->input('busqueda');
        $user = Auth::user();
        $profesor = Profesor::query()->where('user_id','=',$user->id)->first();
        if ($busqueda){
            $examenes = Examen::query()->where('titulo', 'LIKE', "%{$busqueda}%")->where('profesor_id','=',$profesor->id)->get();
        }else {
            $examenes = Examen::query()->where('profesor_id','=',$profesor->id)->get();
        }
        return view('examen.consultar_examen', compact('examenes'));
    }

    public function eliminarExamen(Examen $examen){
        $examen->delete();
        return redirect()->route('examenList')->with('success','Practica eliminada');
    }

    public function mostrarExamen(Examen $examen){
        $preguntas = Pregunta::query()->where('examen_id', '=', $examen->id)->get();
        return view('examen.modificar_examen', compact('examen', 'preguntas'));
    }

    public function modificarExamen(Request $request, $examen){
        $respuestaPeticion = ['success' => null, 'error' => null];
        $request->validate([
            'titulo' => 'required',
            'numeroPreguntas' => 'required',
            'profesor_id' => 'required',
        ]);
        $examen= Examen::find($examen);
        $preguntas = count(Pregunta::query()->where(['examen_id' => $examen->id])->get());
        if($request->get('numeroPreguntas') >= $preguntas){
            $examen->titulo = $request->get('titulo');
            $examen->numeroPreguntas= $request->get('numeroPreguntas');
            $examen->profesor_id = $request->get('profesor_id');
            $examen->update();
            $respuestaPeticion['success'] = 'Practica modificada';
        }else{
            $respuestaPeticion['error'] = 'No puedes poner menos preguntas de las creadas';
        }
        
        return redirect()->route('examenShow', $examen->id)->with('success',$respuestaPeticion['success'])->with('error',$respuestaPeticion['error']);
    }

    public function habilitarExamen(Request $request,$examen,$estudiante){
        $evaluacion = Evaluacion::where('examen_id','=',$examen)->where('estudiante_id','=',$estudiante)->first();
        $evaluacion->delete();

        $respuestas = ExamenEstudiante::where('examen_id','=',$examen)->where('estudiante_id','=',$estudiante)->get();
        foreach($respuestas as $respuesta){
            $respuesta->delete();
        }

        $estudiante = Estudiante::find($estudiante);

        return redirect()->route('examenResultados', $examen)->with('success', "Practica habilidatada para el alumno con matricula {$estudiante->matricula}");
    }

    public function listarResultadosExamenes(Request $request, Examen $examen){
        return view('examen.consultar_examenes_estudiantes',compact('examen'));
    }
}
