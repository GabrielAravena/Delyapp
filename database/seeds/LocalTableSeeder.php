<?php

use Illuminate\Database\Seeder;
use App\Local;

class LocalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $local = new Local();
        $local->nombre = 'Locos por el bajón';
        $local->direccion = 'Direccion de prueba';
        $local->telefono = '+56972619115';
        $local->estado = 'activado';
        $local->latitud = '-33.511342';
        $local->longitud = '-70.743356';
        $local->ingreso_mensual = '1000000';
        $local->delivery = 1;
        $local->save();
    }
}
