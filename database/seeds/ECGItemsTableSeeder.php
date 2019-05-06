<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ECGItemsTableSeeder extends Seeder
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
	        DB::table('ecg_items')->insert([
	            'model' => $faker->word,
	        	'price' => $faker->numberBetween(1,25),
	        	'energy_cg' => $faker->numberBetween(15,100),
	        	'item_type' => $faker->randomElements(array ('oven','freezer','lamp', 'solar panel'), 1)[0],
	        	'energy_type' => $faker->randomElements(array ('cons','gen'), 1)[0],
	        	'image' => 'noimage.png',
	        	'user_id' => 1,
	            'created_at' => now(),
	            'updated_at' => now(),
	        ]);
    	}
    }
}
