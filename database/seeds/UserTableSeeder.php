<?php

use Illuminate\Database\Seeder;
use App\User;

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
    }
}
