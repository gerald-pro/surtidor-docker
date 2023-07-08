<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBombasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_bombas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_asignacion');
            $table->boolean('asignacion_vigente')->default(true);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('bomba_id')->unsigned();
            $table->foreign('bomba_id')->references('id')->on('bombas')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('user_bombas');
    }
}
