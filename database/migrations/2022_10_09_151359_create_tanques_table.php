<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTanquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanques', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->text('descripcion')->nullable();
            $table->double('capacidad', 8, 2);
            $table->double('cantidad_disponible', 8, 2);
            $table->double('cantidad_min', 8, 2)->nullable();
            $table->boolean('estado');
            $table->datetime('fecha_carga')->nullable();
            $table->foreignId('combustible_id')->constrained('combustibles');

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
        Schema::dropIfExists('tanques');
    }
}
