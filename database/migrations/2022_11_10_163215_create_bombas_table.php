<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBombasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bombas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo');
            $table->string('nombre')->nullable();
            $table->string('combustible')->nullable();
            $table->string('descripcion')->nullable();
            $table->boolean('estado');
            $table->boolean('libre')->default(true);
            $table->foreignId('tanque_id','id')
            ->nulleable()
            ->constrained('tanques')
            ->on('tanques')
            ->onDelete('cascade');
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
        Schema::dropIfExists('bombas');
    }
}
