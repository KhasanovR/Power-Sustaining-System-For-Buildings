<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();
    	foreach (range(1,10) as $index) {
	        DB::table('users')->insert([
	            'Fname' => $faker->firstName,
	            'Mname' => 'M',
	            'Lname' => $faker->lastName,
	            'Nickname' => $faker->userName,
	            'avatar' => 'avatar.png',
	            'email' => $faker->email(),
	            'password' => bcrypt('secret'),
	            'created_at' => now(),
	            'updated_at' => now(),
	        ]);
    	}
    }
}
