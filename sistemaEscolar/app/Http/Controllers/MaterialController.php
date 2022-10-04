<?php

namespace App\Http\Controllers;

use App\Enums\Funciones;
use App\Models\Material;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function __construct (){
        // $this->middleware('auth');
    }

    public function vistaRegistrarMaterial (){
        $enumLicenciatura = Material::getValues();
        return view('estudiante.registrar_estudiante', compact('enumLicencitura'));
    }

    public function registrarMaterial(Request $request){
        $nuevoMaterial = $request->validate([
            'funcion' => ['required', new EnumValue(Funciones::class)],
            'titulo' => 'required',
            'descripcion' => 'required',
            'archivo' => 'required|mimes:pdf',
        ]);
        Material::create($nuevoMaterial);
        return back()->with('success','Material creado');
    }

    public function consultarListaMaterial (Request $request){
        $material = [];
        $busqueda = $request->input('busqueda');
        if ($busqueda){
            $material = Material::query()->where('funcion', 'LIKE', "%{$busqueda}%")->get();
        }
        else {
            $material = Material::all();
        }
        return view('material.consultar_material', compact('material'));
    }

    public function modificarMaterial (Request $request, $material){
        $request->validate([
            'funcion' => ['required', new EnumValue(Funciones::class)],
        ]);
        $material= Material::find($material);
        $material->funcion = $request->get('funcion');
        $material->update();
        return redirect('/consultarMaterial')->with('success','Material modificado');
    }

    public function mostrarEstudiante (Material $estudiante){
        $enumFuncion = Funciones::getValues();
        return view('material.modificar_material', compact('material','enumFuncion'));
    }

    public function eliminarMaterial (Material $material){
        $material->delete();
        return redirect('/consultarMaterial')->with('success','Material eliminado');
    }
}
