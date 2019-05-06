<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SelectionsTableSeeder extends Seeder
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
	        DB::table('select')->insert([
	        	'user_id' => $faker->numberBetween(1,10),
	        	'building_season' => $faker->numberBetween(1,10),
                'ecg_items_id' => $faker->numberBetween(1,10),
	        	'is_sold' => $faker->numberBetween(0,1),
	            'created_at' => now(),
	            'updated_at' => now(),
	        ]);
    	}
    }
}
