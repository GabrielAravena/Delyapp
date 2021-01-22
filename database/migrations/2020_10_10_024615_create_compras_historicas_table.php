<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasHistoricasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras_historicas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->decimal('cantidad', 8, 2);
            $table->string('unidad_medida');
            $table->decimal('valor', 10, 2);
            $table->timestamps();

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
        Schema::dropIfExists('compras_historicas');
    }
}
