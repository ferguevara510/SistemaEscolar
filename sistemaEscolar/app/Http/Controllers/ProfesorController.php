<?php

namespace App\Http\Controllers;

use App\Enums\AreaAcademica;
use App\Enums\Entidad;
use App\Enums\Licenciatura;
use App\Enums\Region;
use App\Models\Profesor;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Http\Request;

class ProfesorController extends Controller
{
    public function __construct (){
        // $this->middleware('auth');
    }

    public function vistaRegistrarProfesor (){
        $enumLicenciatura = Licenciatura::getValues();
        $enumEntidad = Entidad::getValues();
        $enumAreaAcademica = AreaAcademica::getValues();
        $enumRegion = Region::getValues();
        return view('profesor.registrar_profesor', compact('enumLicencitura','enumEntidad','enumAreaAcademica','enumRegion'));
    }

    public function registrarProfesor (Request $request){
        $nuevoProfesor = $request->validate([
            'licenciatura' => ['required', new EnumValue(Licenciatura::class)],
            'entidad' => ['required', new EnumValue(Entidad::class)],
            'areaAcademica' => ['required', new EnumValue(AreaAcademica::class)],
            'region' => ['required', new EnumValue(Region::class)],
            'nombreProfesor' => 'required',
            'apellidosProfesor' => 'required',
            'noPersonal' => 'required',
            'correoInstitucional' => 'required',
            'contrasena' => 'required',
        ]);
        Profesor::create($nuevoProfesor);
        return back()->with('success','Profesor creado');
    }

    public function consultarListaProfesor (Request $request){
        $profesor = [];
        $busqueda = $request->input('busqueda');
        if ($busqueda){
            $profesor = Profesor::query()->where('nombreProfesor', 'LIKE', "%{$busqueda}%")->get();
        }
        else {
            $profesor = Profesor::all();
        }
        return view('profesor.consultar_profesor', compact('profesor'));
    }

    public function modificarProfesor (Request $request, $profesor){
        $request->validate([
            'licenciatura' => ['required', new EnumValue(Licenciatura::class)],
            'entidad' => ['required', new EnumValue(Entidad::class)],
            'areaAcademica' => ['required', new EnumValue(AreaAcademica::class)],
            'region' => ['required', new EnumValue(Region::class)],
        ]);
        $profesor= Profesor::find($profesor);
        $profesor->licenciatura = $request->get('licenciatura');
        $profesor->entidad = $request->get('entidad');
        $profesor->areaAcademica = $request->get('areaAcademica');
        $profesor->region = $request->get('region');
        $profesor->update();
        return redirect('/consultarProfesor')->with('success','Profesor modificado');
    }

    public function mostrarProfesor (Profesor $profesor){
        $enumLicenciatura = Licenciatura::getValues();
        $enumEntidad = Entidad::getValues();
        $enumAreaAcademica = AreaAcademica::getValues();
        $enumRegion = Region::getValues();
        return view('profesor.modificar_profesor', compact('profesor','enumLicencitura','enumEntidad','enumAreaAcademica','enumRegion'));
    }

    public function eliminarProfesor (Profesor $profesor){
        $profesor->delete();
        return redirect('/consultarProorfes')->with('success','Profesor eliminado');
    }
}
