<?php

namespace App\Http\Controllers;

use App\Models\Respuesta;
use Illuminate\Http\Request;

class RespuestaController extends Controller
{
    public function __construct (){
        $this->middleware('auth:profesor');
    }
    
    public function registrarRespuesta(Request $request){
        $nuevaRespuesta = $request->validate([
            'descripcion' => 'required',
            'pregunta_id' => 'required',
        ]);
        $idPregunta = $nuevaRespuesta['pregunta_id'];
        $nuevaRespuesta['opcion'] = 'A';
        Respuesta::create($nuevaRespuesta);
        return redirect()->route('preguntaShow',$idPregunta)->with('success','Respuesta registrada');
    }

    public function eliminarRespuesta(Respuesta $respuesta){
        $idPregunta = $respuesta->pregunta_id;
        $respuesta->delete();
        return redirect()->route('preguntaShow',$idPregunta)->with('success','Respuesta eliminada');
    }

    public function marcarRespuestaCorrecta(Respuesta $respuesta){
        Respuesta::where('pregunta_id',$respuesta->pregunta_id)->update(['esCorrecto' => false]);
        $respuesta->esCorrecto = true;
        $respuesta->update();
        return redirect()->route('preguntaShow',$respuesta->pregunta_id)->with('success','Respuesta marcada como correcta');
    }
}
