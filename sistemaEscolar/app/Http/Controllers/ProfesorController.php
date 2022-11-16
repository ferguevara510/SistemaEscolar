<?php

namespace App\Http\Controllers;

use App\Enums\AreaAcademica;
use App\Enums\Entidad;
use App\Enums\Licenciatura;
use App\Enums\Region;
use App\Enums\TipoUsuario;
use App\Models\Profesor;
use App\Models\User;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfesorController extends Controller
{
    public function __construct (){
        $this->middleware('auth');
    }

    public function vistaRegistrarProfesor (){
        $enumLicenciatura = Licenciatura::getValues();
        $enumEntidad = Entidad::getValues();
        $enumAreaAcademica = AreaAcademica::getValues();
        $enumRegion = Region::getValues();
        return view('profesor.registrar_profesor', compact('enumLicenciatura','enumEntidad','enumAreaAcademica','enumRegion'));
    }

    public function registrarProfesor (Request $request){
        $nuevoProfesor = $request->validate([
            'licenciatura' => ['required', new EnumValue(Licenciatura::class)],
            'entidad' => ['required', new EnumValue(Entidad::class)],
            'areaAcademica' => ['required', new EnumValue(AreaAcademica::class)],
            'region' => ['required', new EnumValue(Region::class)],
            'nombreProfesor' => 'required',
            'apellidosProfesor' => 'required',
            'noPersonal' =>  ['required', 'unique:profesors'],
            'correoInstitucional' => ['required', 'email', 'unique:profesors'],
            'contrasena' => 'required',
        ]);

        $usuarioExistente = User::query()->where('email','=',$nuevoProfesor['correoInstitucional'])->first();
        if($usuarioExistente){
            return back()->with('error','El correo ya esta ocupado');
        }

        $newUser = [
            'name' => $nuevoProfesor['nombreProfesor'],
            'email' => $nuevoProfesor['correoInstitucional'],
            'password' => Hash::make($nuevoProfesor['contrasena']),
            'tipoUsuario' => TipoUsuario::Profesor,
        ];
        $user = User::create($newUser);
        $nuevoProfesor['user_id'] = $user->id;
        Profesor::create($nuevoProfesor);
        return back()->with('success','Profesor creado');
    }

    public function consultarListaProfesor (Request $request){
        $profesors = [];
        $busqueda = $request->input('busqueda');
        if ($busqueda){
            $profesors = Profesor::query()->where('nombreProfesor', 'LIKE', "%{$busqueda}%")->get();
        }
        else {
            $profesors = Profesor::all();
        }
        return view('profesor.consultar_profesor', compact('profesors'));
    }

    public function modificarProfesor (Request $request, $profesor){
        $request->validate([
            'nombreProfesor' => 'required',
            'apellidosProfesor' => 'required',
            'noPersonal' =>  ['required', 'unique:profesors'],
            'correoInstitucional' => ['required', 'email', 'unique:profesors'],
            'contrasena' => 'required',
            'licenciatura' => ['required', new EnumValue(Licenciatura::class)],
            'entidad' => ['required', new EnumValue(Entidad::class)],
            'areaAcademica' => ['required', new EnumValue(AreaAcademica::class)],
            'region' => ['required', new EnumValue(Region::class)],
        ]);

        $profesor= Profesor::find($profesor);
        $usuarioExistente = User::query()->where('email','=',$request->get('correoInstitucional'))->where('id', '!=', $profesor->user_id)->first();
        if($usuarioExistente){
            return back()->with('error','El correo ya esta ocupado');
        }

        $usuario = User::find($profesor->user_id);
        $usuario->name = $request->get('nombreEstudiante');
        $usuario->email = $request->get('correoInstitucional');

        $profesor->nombreProfesor = $request->get('nombreProfesor');
        $profesor->apellidosProfesor= $request->get('apellidosProfesor');
        $profesor->noPersonal = $request->get('noPersonal');
        $profesor->correoInstitucional = $request->get('correoInstitucional');
        $profesor->contrasena = $request->get('contrasena');
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
        return view('profesor.modificar_profesor', compact('profesor','enumLicenciatura','enumEntidad','enumAreaAcademica','enumRegion'));
    }

    public function eliminarProfesor (Profesor $profesor){
        $profesor->delete();
        return redirect('/consultarProfesor')->with('success','Profesor eliminado');
    }
}
