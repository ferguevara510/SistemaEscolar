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
        return view('profesor.registrar_profesor',compact('enumLicenciatura','enumEntidad','enumAreaAcademica','enumRegion'));
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
        return view('profesor.consultar_profesor',compact('profesors'));
    }

    public function modificarProfesor (Request $request, $profesor){
        $request->validate([
            'nombreProfesor' => 'required',
            'apellidosProfesor' => 'required',
            'noPersonal' =>  ['required'],
            'correoInstitucional' => ['required', 'email'],
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

        $profesorExistente = Profesor::query()->where('noPersonal','=',$request->get('noPersonal'))->where('id', '!=', $profesor->id)->first();
        if($profesorExistente){
            return back()->with('error', 'El numero de personal esta ocupada');
        }

        $usuario = User::find($profesor->user_id);
        $usuario->name = $request->get('nombreProfesor');
        $usuario->email = $request->get('correoInstitucional');
        $profesor->nombreProfesor = $request->get('nombreProfesor');
        $profesor->apellidosProfesor= $request->get('apellidosProfesor');
        $profesor->noPersonal = $request->get('noPersonal');
        $profesor->correoInstitucional = $request->get('correoInstitucional');
        $profesor->licenciatura = $request->get('licenciatura');
        $profesor->entidad = $request->get('entidad');
        $profesor->areaAcademica = $request->get('areaAcademica');
        $profesor->region = $request->get('region');
        $profesor->update();
        return redirect('/consultarProfesor')->with('success',"Profesor modificado {$profesor->nombreProfesor}, {$profesor->apellidosProfesor}, {$profesor->noPersonal}, {$profesor->correoInstitucional}, {$profesor->licenciatura}, {$profesor->entidad}, {$profesor->areaAcademica}, {$profesor->region}");
    }

    public function vistaCambioContraseña(Request $request, Profesor $profesor){
        return view('profesor.cambiar_contraseña', compact('profesor'));
    }

    public function cambiarContraseña(Request $request, Profesor $profesor){
        $request->validate([
            'contrasena' => ['required'],
        ]);
        $contraseña = Hash::make($request->get('contrasena'));
        $user = User::find($profesor->user_id);
        $user->password = $contraseña;
        $user->update();
        $profesor->contrasena = $contraseña;
        $profesor->update();

        return redirect()->route('profesorList')->with('success',"Contraseña modificada {$profesor->nombreProfesor}, {$profesor->apellidosProfesor}, {$profesor->noPersonal}, {$profesor->correoInstitucional}");
    }

    public function mostrarProfesor (Profesor $profesor){
        $enumLicenciatura = Licenciatura::getValues();
        $enumEntidad = Entidad::getValues();
        $enumAreaAcademica = AreaAcademica::getValues();
        $enumRegion = Region::getValues();
        return view('profesor.modificar_profesor',compact('profesor','enumLicenciatura','enumEntidad','enumAreaAcademica','enumRegion'));
    }

    public function eliminarProfesor (Profesor $profesor){
        $profesor->delete();
        return redirect('/consultarProfesor')->with('success',"Profesor eliminado {$profesor->nombreProfesor}, {$profesor->apellidosProfesor}, {$profesor->noPersonal}, {$profesor->correoInstitucional}, {$profesor->licenciatura}, {$profesor->entidad}, {$profesor->areaAcademica}, {$profesor->region}");
    }
}
