<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Asistencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id(); 
            $table->dateTime('fecha_entrada');
            $table->dateTime('fecha_salida')->nullable();
            $table->integer('user_turno_id')->unsigned();            
            $table->foreign('user_turno_id')->references('id')->on('users_turnos');
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
        Schema::dropIfExists('asistencias'); 
    }
}
