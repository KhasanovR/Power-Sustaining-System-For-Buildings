<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PhonesTableSeeder::class);
        $this->call(BuildingsTableSeeder::class);
        $this->call(MinMaxesTableSeeder::class);
        $this->call(ECGItemsTableSeeder::class);
         $this->call(PossessTableSeeder::class);
        // $this->call(SelectionsTableSeeder::class);
	}
}
