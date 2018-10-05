<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;

class UsersTableInsertAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->role_id = 1;
	    $admin->name = 'Администратор';
	    $admin->email = 'admin@test.com';
	    $admin->email_verified_at = Carbon::now()->toDateTimeString();
    	$admin->password = bcrypt('123456');
    	$admin->created_at = Carbon::now()->toDateTimeString();
    	$admin->updated_at = Carbon::now()->toDateTimeString();
	    $admin->save();
    }
}
