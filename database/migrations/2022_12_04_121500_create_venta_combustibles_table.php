<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentaCombustiblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta_combustibles', function (Blueprint $table) {
            $table->id();
            $table->integer('id_cliente')->unsigned();
            $table->string('codigo')->unique();
            $table->datetime('fecha');
            $table->decimal('precio');
            $table->decimal('cantidad');
            $table->integer('user_bomba_id')->unsigned();
            $table->foreign('user_bomba_id')->references('id')->on('user_bombas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_cliente')->references('id')->on('clientes')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('venta_combustibles');
    }
}
