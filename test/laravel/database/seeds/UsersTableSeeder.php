<?php

use Illuminate\Database\Seeder;
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
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('11111111'),
            'profile' => 'img10.jpg',
            'type' => '0',
            'phone' => '09795476020',
            'address' =>'yangon',
            'dob' => '1998-7-31',
            'create_user_id' => '1',
            'updated_user_id' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
