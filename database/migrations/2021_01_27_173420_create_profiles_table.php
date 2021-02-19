<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            //$table->string('name');
            $table->integer('age')->unsigned()->nullable();
            $table->decimal('height',6,2)->nullable();
            $table->decimal('weight',6,2)->nullable();
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();
            $table->text('reference')->nullable();
            //foreign key with users table
            $table->string('url_image')->nullable();
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('profiles');
    }
}
