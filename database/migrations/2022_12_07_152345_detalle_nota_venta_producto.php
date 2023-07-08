<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetalleNotaVentaProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_nota_venta_producto', function (Blueprint $table) {
            $table->id(); 
            $table->integer('cantidad');
            $table->decimal('subtotal',8,2)->nullable();
            $table->integer('nota_venta_producto_id')->unsigned();
            $table->foreign('nota_venta_producto_id')->references('id')->on('nota_venta_producto')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('producto_id')->unsigned();
            $table->foreign('producto_id')->references('id')->on('producto')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('detalle_nota_venta_producto');
    }
}
