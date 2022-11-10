<?php

namespace App\Http\Controllers;

use App\Enums\Funcion;
use App\Models\Contenido;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Http\Request;

class ContenidoController extends Controller
{
    public function __construct (){
        $this->middleware('auth');
    }

    public function vistaRegistrarContenido (){
        $enumFuncion= Funcion::getValues();
        return view('contenido.registrar_contenido', compact('enumFuncion'));
    }

    public function registrarContenido (Request $request){
        $nuevoContenido= $request->validate([
            'funcion' => ['required', new EnumValue(Funcion::class)],
            'titulo' => 'required',
            'descripcion' => 'required',
            'archivo' => 'required|mimes:pdf',
        ]);
        $fileName = time().".".$request->archivo->extension();
        $request->archivo->move(public_path('archivo'),$fileName);
        $nuevoContenido['archivo'] = $fileName;
        Contenido::create($nuevoContenido);
        return back()->with('success','Contenido creado');
    }

    public function consultarListaContenido (Request $request){
        $contenidos = [];
        $busqueda = $request->input('busqueda');
        if ($busqueda){
            $contenidos = Contenido::query()->where('funcion', 'LIKE', "%{$busqueda}%")->get();
        }
        else {
            $contenidos = Contenido::all();
        }
        return view('contenido.consultar_contenido', compact('contenidos'));
    }

    public function consultarListaContenidoEstudiante (Request $request){
        $contenidos = [];
        $busqueda = $request->input('busqueda');
        if ($busqueda){
            $contenidos = Contenido::query()->where('funcion', 'LIKE', "%{$busqueda}%")->get();
        }
        else {
            $contenidos = Contenido::all();
        }
        return view('contenido.consultar_contenido_estudiante', compact('contenidos'));
    }

    public function modificarContenido (Request $request, $contenido){
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'archivo' => 'required|mimes:pdf',
            'funcion' => ['required', new EnumValue(Funcion::class)],
        ]);
        $contenido= Contenido::find($contenido);
        $contenido->titulo = $request->get('titulo');
        $contenido->descripcion = $request->get('descripcion');
        $contenido->funcion = $request->get('funcion');
        if(isset($request->archivo)){
            $fileName = time().".".$request->archivo->extension();
            $request->archivo->move(public_path('archivo'),$fileName);
            $contenido->archivo = $fileName;
        }
        $contenido->update();
        return redirect('/consultarContenido')->with('success','Contenido modificado');
    }

    public function mostrarContenido (Contenido $contenido){
        $enumFuncion = Funcion::getValues();
        return view('contenido.modificar_contenido', compact('contenido','enumFuncion'));
    }

    public function eliminarContenido (Contenido $contenido){
        $contenido->delete();
        return redirect('/consultarContenido')->with('success','Contenido eliminado');
    }
}
