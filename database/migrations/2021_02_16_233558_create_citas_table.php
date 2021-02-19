<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->increments('id');
            $table->string("tipo")->nullable();//cita en consultorio o a domicilio

            $table->text("descripcion")->nullable();
            $table->unsignedInteger("id_doctor");
            $table->unsignedInteger("id_paciente");

            $table->string("especialidad")->nullable();
            $table->string("hospital")->nullable();
            $table->string("piso")->nullable();
            $table->string("consultorio")->nullable();

            $table->text("vacuna")->nullable();
            $table->text("farmaceutica")->nullable();
            
            $table->string("dosis_actual")->nullable(); 
            $table->string("dosis_proxima")->nullable(); 
            
            
            $table->text("direccion")->nullable();

            $table->timestamp("fecha_ultima_dosis")->nullable();
            $table->timestamp("fecha_programada")->nullable();
            

            $table->string("estado")->nullable();
            $table->foreign('id_doctor')->references('id')->on('users');
            $table->foreign('id_paciente')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citas');
    }
}
