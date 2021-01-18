<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleDesperdiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_desperdicios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->decimal('cantidad');
            $table->decimal('desperdicio');
            $table->string('unidad_medida');
            $table->decimal('valor_desperdiciado');
            $table->foreignId('desperdicio_id')->constrained('desperdicios');
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
        Schema::dropIfExists('detalle_desperdicios');
    }
}
