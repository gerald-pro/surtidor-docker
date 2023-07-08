<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotaCargas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_cargas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha');
            $table->decimal('total',8,2);
            $table->integer('combustible_id')->unsigned();
            $table->foreign('combustible_id')->references('id')->on('combustibles')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('nota_cargas');
    }
}
