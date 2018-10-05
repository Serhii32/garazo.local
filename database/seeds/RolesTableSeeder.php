<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = new Role();
	    $role_admin->name = 'Администратор';
	    $role_admin->save();
	    $role_user = new Role();
	    $role_user->name = 'Пользователь';
	    $role_user->save();
	}
}
