<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->decimal('cantidad', 8, 2);
            $table->string('unidad_medida');
            $table->decimal('valor', 10, 2);
            $table->decimal('pmp', 10, 2);
            $table->decimal('ultimo_precio', 10, 2);
            $table->decimal('merma', 8, 2);
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
        Schema::dropIfExists('inventarios');
    }
}
