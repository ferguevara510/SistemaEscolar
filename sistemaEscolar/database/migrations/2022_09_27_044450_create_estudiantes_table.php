<?php

use App\Enums\AreaAcademica;
use App\Enums\Entidad;
use App\Enums\Licenciatura;
use App\Enums\Region;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('licenciatura', Licenciatura::getValues())->nullable();
            $table->enum('entidad', Entidad::getValues())->nullable();
            $table->enum('areaAcademica', AreaAcademica::getValues())->nullable();
            $table->enum('region', Region::getValues())->nullable();
            $table->string('nombreEstudiante', 100);
            $table->string('apellidosEstudiante', 100);
            $table->string('matricula', 10);
            $table->string('correoInstitucional', 150);
            $table->string('contrasena');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estudiantes');
    }
};
