<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker::create();
        foreach (range(1,1000) as $index) {
	        DB::table('users')->insert([
	            'first_name' => $faker->name,
	            'last_name' => $faker->name,
	            'email' => $faker->email,
	            'address' => $faker->address,
	            'upload_id' => 1,
	        ]);
		}
    }
}
