<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->id = 1;
        $role->name = 'root';
        $role->description = 'Root';
        $role->save();

        $role = new Role();
        $role->id = 2;
        $role->name = 'admin';
        $role->description = 'Administrador';
        $role->save();        
        
        $role = new Role();
        $role->id = 3;
        $role->name = 'user';
        $role->description = 'User';
        $role->save();

    }
}
