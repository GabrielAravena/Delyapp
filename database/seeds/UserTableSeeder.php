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
        $user->name = 'Usuario';
        $user->email = 'usuario@gmail.com';
        $user->password = Hash::make('usuario123');
        $user->save(); 
    }
}
