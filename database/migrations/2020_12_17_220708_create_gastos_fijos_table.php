<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGastosFijosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos_fijos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->decimal('monto');
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
        Schema::dropIfExists('gastos_fijos');
    }
}
