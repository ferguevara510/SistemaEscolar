<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;

    public function examenes() {
        return $this->hasMany('App\Models\Examen');
    }

    public function usuario(){
        return $this->belongsTo('App\Models\User');
    }

    public $fillable=['nombreProfesor','apellidosProfesor','noPersonal','correoInstitucional','contrasena','licenciatura','entidad','areaAcademica','region'];
}
