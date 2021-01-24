<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_ventas', function (Blueprint $table) {
            $table->id();
            $table->integer('local_id');
            $table->integer('users_id')->nullable();
            $table->bigInteger('invitado')->nullable();
            $table->integer('venta_id');
            $table->string('tipo');
            $table->decimal('valor', 12, 2);
            $table->boolean('delivery')->nullable();
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
        Schema::dropIfExists('registro_ventas');
    }
}
