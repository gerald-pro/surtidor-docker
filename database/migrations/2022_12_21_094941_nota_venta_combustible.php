<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NotaVentaCombustible extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_venta_combustible', function (Blueprint $table) {
            $table->id(); 
            $table->dateTime('fecha');
            $table->decimal('total',8,2); 
            $table->decimal('cantidad_combustible',8,2);
            
            $table->foreignId('cliente_id')->nullable()->constrained('clientes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('vehiculo_id')->nullable()->constrained('vehiculos')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('placa')->nullable();
            
            $table->integer('user_bombas_id')->unsigned()->nullable();
            $table->foreign('user_bombas_id')->references('id')->on('user_bombas')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('turno_id')->unsigned()->nullable();
            $table->foreign('turno_id')->references('id')->on('turnos')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('nota_venta_combustible');
    }
}
