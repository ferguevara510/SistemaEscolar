<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;

    public function estudiante(){
        return $this->belongsTo('App\Models\Estudiante');
    }

    public function examen(){
        return $this->belongsTo('App\Models\Examen');
    }

    public $fillable=['calificacion','fechaAplicacion','examen_id','estudiante_id'];
}
