<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos_users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('productos_id')->constrained('productos');
            $table->foreignId('users_id')->constrained('users');
            $table->foreignId('ventas_id')->constrained('ventas');
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
        Schema::dropIfExists('productos_users');
    }
}
