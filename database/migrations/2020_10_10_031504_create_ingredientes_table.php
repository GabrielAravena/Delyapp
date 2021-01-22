<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->decimal('cantidad', 8, 2);
            $table->string('unidad_medida');
            $table->decimal('valor', 10, 2)->nullable();
            $table->decimal('merma', 8, 2);
            $table->timestamps();

            $table->foreignId('producto_id')->constrained('productos');
            $table->foreignId('inventario_id')->constrained('inventarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredientes');
    }
}
