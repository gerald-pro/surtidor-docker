<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCombustiblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combustibles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->string('tipo');
            $table->decimal('precio_compra')->nullable();
            $table->decimal('precio_venta');
            $table->string('unidad_medida')->nullable();
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
        Schema::dropIfExists('combustibles');
    }
}