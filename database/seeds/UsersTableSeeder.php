<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('users')->insert([
//            'name' => 'Kevin Bowler',
//            'email' => 'kevin@kpbowler.co.uk',
//            'password' => bcrypt('secret'),
//            'api_token' => str_random(60),
//            'role_id' => 1,
//        ]);
        DB::table('users')->insert([
            'name' => 'Ben Cole',
            'email' => 'bencole0002@hotmail.co.uk',
            'password' => bcrypt('secret'),
            'api_token' => str_random(60),
            'role_id' => 4,
        ]);
    }
}
