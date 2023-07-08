<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FacturaProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_producto', function (Blueprint $table) {
            $table->id();
            $table->integer('nro_factura'); 
            $table->dateTime('fecha_emision');
            $table->string('lugar_emision');
            $table->string('numero_autorizacion');
            $table->decimal('total',8,2);
            $table->string('codigo_control');
            $table->integer('nit');
            $table->dateTime('fecha_limite_emision');
            $table->string('nombre_razon_social');
            $table->integer('nota_venta_producto_id')->unsigned();
            $table->foreign('nota_venta_producto_id')->references('id')->on('nota_venta_producto')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('factura_producto');
    }
}
