<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetalleCargas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_cargas', function (Blueprint $table) {
            $table->id();      
            $table->integer('cantidad');
            $table->decimal('precio_unitario',8,2);
            $table->integer('nota_cargas_id')->unsigned();
            $table->foreign('nota_cargas_id')->references('id')->on('nota_cargas')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('tanque_codigo')->unsigned();
            $table->foreign('tanque_codigo')->references('id')->on('tanques')->onDelete('cascade')->onUpdate('cascade');
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
        //
    }
}
