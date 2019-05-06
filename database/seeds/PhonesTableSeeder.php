<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PhonesTableSeeder extends Seeder
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
	        DB::table('phones')->insert([
	        	'user_id' => $faker->numberBetween(1,10),
	            'phone' => $faker->e164PhoneNumber,
	            'created_at' => now(),
	            'updated_at' => now(),
	        ]);
    	}
    }
}
