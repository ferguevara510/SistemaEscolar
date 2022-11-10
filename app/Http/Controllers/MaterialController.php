<?php

namespace App\Http\Controllers;

use App\Enums\Funcion;
use App\Models\Material;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function __construct (){
        $this->middleware('auth');
    }

    public function vistaRegistrarMaterial (){
        $enumFuncion= Material::getValues();
        return view('material.registrar_material', compact('enumFuncion'));
    }

    public function registrarMaterial(Request $request){
        $nuevoMaterial = $request->validate([
            'funcion' => ['required', new EnumValue(Funcion::class)],
            'titulo' => 'required',
            'descripcion' => 'required',
            'archivo' => 'required|mimes:pdf',
        ]);
        $fileName = time().".".$request->archivo->extension();
        $request->archivo->move(public_path('archivo'),$fileName);
        $nuevoMaterial['archivo'] = $fileName;
        Material::create($nuevoMaterial);
        return back()->with('success','Material creado');
    }

    public function consultarListaMaterial (Request $request){
        $materials = [];
        $busqueda = $request->input('busqueda');
        if ($busqueda){
            $materials = Material::query()->where('funcion', 'LIKE', "%{$busqueda}%")->get();
        }
        else {
            $materials = Material::all();
        }
        return view('material.consultar_material', compact('materials'));
    }

    public function consultarListaMaterialEstudiante (Request $request){
        $materials = [];
        $busqueda = $request->input('busqueda');
        if ($busqueda){
            $materials = Material::query()->where('funcion', 'LIKE', "%{$busqueda}%")->get();
        }
        else {
            $materials = Material::all();
        }
        return view('material.consultar_material_estudiante', compact('materials'));
    }

    public function modificarMaterial (Request $request, $material){
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'archivo' => 'required|mimes:pdf',
            'funcion' => ['required', new EnumValue(Funcion::class)],
        ]);
        $material= Material::find($material);
        $material->titulo = $request->get('titulo');
        $material->descripcion = $request->get('descripcion');
        $material->funcion = $request->get('funcion');
        if(isset($request->archivo)){
            $fileName = time().".".$request->archivo->extension();
            $request->archivo->move(public_path('archivo'),$fileName);
            $material->archivo = $fileName;
        }
        $material->update();
        return redirect('/consultarMaterial')->with('success','Material modificado');
    }

    public function mostrarMaterial (Material $material){
        $enumFuncion = Funcion::getValues();
        return view('material.modificar_material', compact('material','enumFuncion'));
    }

    public function eliminarMaterial (Material $material){
        $material->delete();
        return redirect('/consultarMaterial')->with('success','Material eliminado');
    }
}
