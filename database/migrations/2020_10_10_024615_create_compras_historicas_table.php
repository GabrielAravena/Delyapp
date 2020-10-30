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
            $table->decimal('cantidad');
            $table->string('unidad_medida');
            $table->decimal('valor');
            $table->timestamps();

            $table->foreignId('inventarios_id')->constrained('inventarios');
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
