<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeleconsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teleconsultas', function (Blueprint $table) {
            $table->increments('id');
            $table->string("tipo")->nullable();//cita en consultorio o a domicilio

            $table->text("link_google")->nullable();
            
            $table->unsignedInteger("id_doctor");
            $table->unsignedInteger("id_paciente");

            $table->string("especialidad")->nullable();

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
        Schema::dropIfExists('teleconsultas');
    }
}
