<?php

namespace App\Http\Controllers;

use App\Models\Examen;
use App\Models\Pregunta;
use Illuminate\Http\Request;

class ExamenController extends Controller
{
    public function __construct (){
        $this->middleware('auth:admin');
    }

    public function vistaRegistrarExamen($profesorId){
        return view('examen.registrar_examen',compact('profesorId'));
    }

    public function registrarExamen(Request $request){
        $nuevoExamen = $request->validate([
            'titulo' => 'required',
            'numeroPreguntas' => 'required',
            'profesor_id' => 'required',
        ]);
        Examen::create($nuevoExamen);
        return back()->with('success','Estudiante creado');
    }

    public function consultarExamenes(Request $request){
        $examenes = [];
        $busqueda = $request->input('busqueda');
        if ($busqueda){
            $examenes = Examen::query()->where('titulo', 'LIKE', "%{$busqueda}%")->get();
        }
        else {
            $examenes = Examen::all();
        }
        return view('examen.consultar_examen', compact('examenes'));
    }

    public function eliminarExamen(Examen $examen){
        $examen->delete();
        return redirect()->route('examenList')->with('success','Examen eliminado');
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
            $respuestaPeticion['success'] = 'Examen modificado';
        }else{
            $respuestaPeticion['error'] = 'No puedes poner menos preguntas de las creadas';
        }
        
        return redirect()->route('examenShow', $examen->id)->with('success',$respuestaPeticion['success'])->with('error',$respuestaPeticion['error']);
    }
}
