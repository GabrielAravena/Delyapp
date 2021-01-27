<?php

use Illuminate\Database\Seeder;
use App\Role_user;

class Role_userTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = new Role_user();
        $role_user->role_id = 1;
        $role_user->user_id = 3;
        $role_user->save(); 

        $role_user = new Role_user();
        $role_user->role_id = 2;
        $role_user->user_id = 2;
        $role_user->save(); 

        $role_user = new Role_user();
        $role_user->role_id = 3;
        $role_user->user_id = 4;
        $role_user->save(); 
    }
}
