<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
            'role_id' => 1,
            'username' => 'superadmin',
            'password' => bcrypt(12345678)
        ]);
    }
}
