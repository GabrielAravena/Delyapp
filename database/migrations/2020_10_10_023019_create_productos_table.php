<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->decimal('precio')->nullable();
            $table->decimal('precio_sugerido')->nullable();
            $table->decimal('tiempo_preparacion')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('estado');
            $table->string('imagen')->nullable();
            $table->string('categoria')->nullable();
            $table->timestamps();
            
            $table->foreignId('local_id')->constrained('local');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
