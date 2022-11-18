<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use App\Models\Respuesta;
use Illuminate\Http\Request;

class PreguntaController extends Controller
{
    public function __construct (){
        $this->middleware('auth:profesor');
    }

    public function vistaRegistrarPregunta($examenId){
        return view('pregunta.registrar_pregunta',compact('examenId'));
    }

    public function registrarPregunta(Request $request){
        $nuevaPregunta = $request->validate([
            'descripcion' => 'required',
            'examen_id' => 'required',
        ]);
        $pregunta = Pregunta::create($nuevaPregunta);
        return redirect()->route('preguntaShow',$pregunta->id)->with('success','Pregunta registrada');
    }

    public function eliminarPregunta(Pregunta $pregunta){
        $idExamen = $pregunta->examen_id;
        $pregunta->delete();
        return redirect()->route('examenShow',$idExamen)->with('success','Pregunta eliminado');
    }

    public function mostrarPregunta(Pregunta $pregunta){
        $respuestas = Respuesta::query()->where('pregunta_id', '=', $pregunta->id)->get();
        return view('pregunta.modificar_pregunta',compact('pregunta', 'respuestas'));
    }

    public function modificarPregunta(Request $request, $pregunta){
        $request->validate([
            'descripcion' => 'required',
            'examen_id' => 'required',
        ]);
        $pregunta= Pregunta::find($pregunta);
        $pregunta->descripcion = $request->get('descripcion');
        $pregunta->examen_id = $request->get('examen_id');
        $pregunta->update();
        return redirect()->route('examenShow',$pregunta->examen_id)->with('success','Pregunta modificada');
    }
}