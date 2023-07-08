<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetalleProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_productos', function (Blueprint $table) {
            $table->id(); 
            $table->integer('cantidad');
            $table->decimal('precio_compra',8,2);
            $table->integer('nota_producto_id')->unsigned();
            $table->foreign('nota_producto_id')->references('id')->on('nota_productos')->onDelete('cascade')->onUpdate('cascade');
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
        //
    }
}
