<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    
    public function examenes() {
        return $this->belongsToMany('App\Models\Examen', 'evaluacions')->withPivot('id','calificacion','fechaAplicacion');
    }

    public function usuario(){
        return $this->belongsTo('App\Models\User');
    }

    public $fillable=['nombreEstudiante','apellidosEstudiante','matricula','correoInstitucional','contrasena','licenciatura','entidad','areaAcademica','region'];
}
