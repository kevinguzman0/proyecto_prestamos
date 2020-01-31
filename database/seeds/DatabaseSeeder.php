<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

use App\str_random;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(SpatieSeeder::class);

    	$faker = Faker::create();

    	foreach (range(1,10) as $index) {
	        DB::table('users')->insert([
	            'name' => $faker->name,
	            'email' => $faker->email,
	            'email_verified_at' => $faker->optional()->dateTimeInInterval($startDate = '-1 years', $interval = '+ 5 days', $timezone = 'America/Bogota'),
	            'password' => bcrypt('secret'),
	            'remember_token' => str_random(10),
	        ]);
    	}
	}

    }
}
