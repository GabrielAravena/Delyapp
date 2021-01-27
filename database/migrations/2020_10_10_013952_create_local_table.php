<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('imagen')->nullable();
            $table->string('logo')->nullable();
            $table->decimal('valor_delivery')->nullable();
            $table->string('estado');
            $table->string('latitud');
            $table->string('longitud');
            $table->decimal('ingreso_mensual', 10, 2);
            $table->boolean('delivery')->nullable();
            $table->decimal('distancia_delivery', 8, 2)->nullable();
            $table->decimal('ganancia', 8, 2);
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
        Schema::dropIfExists('local');
    }
}
