<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MinMaxesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        DB::table('minmaxes')->insert([
            'item_type' => 'freezer',
        	'min' => $faker->numberBetween(0,5),
        	'max' => $faker->numberBetween(5,10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
         DB::table('minmaxes')->insert([
            'item_type' => 'oven',
        	'min' => $faker->numberBetween(0,5),
        	'max' => $faker->numberBetween(5,10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
          DB::table('minmaxes')->insert([
            'item_type' => 'solar panel',
        	'min' => $faker->numberBetween(0,5),
        	'max' => $faker->numberBetween(5,10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
           DB::table('minmaxes')->insert([
            'item_type' => 'lamp',
        	'min' => $faker->numberBetween(0,5),
        	'max' => $faker->numberBetween(5,10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
