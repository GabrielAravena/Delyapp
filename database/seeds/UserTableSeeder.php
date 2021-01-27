<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->id = 1;
        $user->name = 'Invitado';
        $user->email = 'Invitado';
        $user->password = 'Invitado';
        $user->save(); 

        $user = new User();
        $user->id = 2;
        $user->name = 'Admin';
        $user->email = 'admin@gmail.com';
        $user->password = Hash::make('admin123');
        $user->local_id = 1;
        $user->save(); 

        $user = new User();
        $user->id = 3;
        $user->name = 'Root';
        $user->email = 'root@gmail.com';
        $user->password = Hash::make('root1234');
        $user->save(); 

        $user = new User();
        $user->id = 4;
        $user->name = 'Usuario';
        $user->email = 'usuario@gmail.com';
        $user->password = Hash::make('usuario123');
        $user->direccion = 'Los Batallones 1602, Maipú, Santiago Metropolitan 9250000, Chile';
        $user->latitud = '-33.511342';
        $user->longitud = '-70.743356';
        $user->telefono = '972619115';
        $user->save(); 
    }
}
