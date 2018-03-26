<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Role::truncate();
        DB::table('assigned_roles')->truncate();

        $user = User::create([
            'name' => 'Sender Flores',
            'email' => 'safcrace@gmail.com',
            'password' => bcrypt(1234)
        ]);

        $role = Role::create([
            'name' => 'admin',
            'display_name' => 'Administrador',
            'descripcion' => 'Administrador del Sitio Web'
        ]);

        $user->roles()->save($role);
    }
}
