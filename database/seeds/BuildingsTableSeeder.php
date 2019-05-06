<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BuildingsTableSeeder extends Seeder
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
	        DB::table('buildings')->insert([
	        	'money_pack' => $faker->numberBetween(99,500),
	        	'price_kw' => $faker->numberBetween(1,10),
	        	'user_id' => 1,
	            'created_at' => now(),
	            'updated_at' => now(),
	        ]);
    	}
    }
}
