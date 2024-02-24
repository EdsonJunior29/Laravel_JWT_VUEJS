<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('modelo_id');
            $table->string('place', 10)->unique();
            $table->boolean('disponivel');
            $table->integer('km');
            $table->timestamps();

            //Relacionamento 1 para muitos
            //1 modelo tem vários carros
            $table->foreign('modelo_id')->references('id')->on('modelos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carros');
    }
};
