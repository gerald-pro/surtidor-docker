<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientePremioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_premio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('premio_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('cantidad');
            $table->integer('puntos_canjeados');
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
        Schema::dropIfExists('cliente_premios');
    }
}
