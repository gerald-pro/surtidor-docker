<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo')->unique();
            $table->date('fecha');
            $table->integer('cantidad_total')->requiered();
            $table->integer('cantidad_tanque')->requiered();
            $table->double('precio_unitario')->requiered(); //por litro
            $table->double('precio_total')->requiered();
            $table->foreignId('tanque_id')
            ->nulleable()
            ->constrained('tanques')
            ->on('tanques')
            ->onDelete('cascade');
            $table->integer('combustible_id')->unsigned();
            $table->foreign('combustible_id')->references('id')->on('combustibles')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('cargas');
    }
}
