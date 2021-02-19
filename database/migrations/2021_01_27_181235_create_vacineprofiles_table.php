<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacineProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacineprofiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_paciente')->nullable();
            $table->string('nombre_doctor')->nullable();
            $table->unsignedInteger('id_vaccine')->nullable();
            $table->unsignedInteger('id_user')->nullable();
            $table->string('tipo_inmun')->nullable();
            $table->unsignedInteger('dosis')->nullable();
            $table->text('hospital')->nullable();
            $table->timestamp('fec_inmun');


            $table->string("estado")->nullable();
            $table->foreign('id_vaccine')->references('id')->on('vaccines');
            $table->foreign('id_user')->references('id')->on('users');
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
        Schema::dropIfExists('vacineprofiles');
    }
}
