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

    	$faker = Faker::create('es_ES');
        //$idCliente=DB::table('users')->pluck('id')->toArray();;
        //$idEstadoSolicitud=DB::table('estados_solicitud')->pluck('id')->toArray();;

    	foreach (range(1,10) as $index) {
	        DB::table('users')->insert([
	            'name' => $faker->name,
	            'email' => $faker->email,
	            'email_verified_at' => $faker->optional()->dateTimeInInterval($startDate = '-1 years', $interval = '+ 5 days', $timezone = 'America/Bogota'),
	            'password' => bcrypt('secret'),
	            'remember_token' => str_random(10),
	        ]);
    	}

        foreach (range(1,10) as $solicitudes) {
             DB::table('solicitudes')->insert([
                'idCliente' => random_int(\DB::table('users')->min('id'), \DB::table('users')->max('id')),
                'idEstadoSolicitud' => random_int(\DB::table('estados_solicitud')->min('id'), \DB::table('estados_solicitud')->max('id')),
                'monto' => $faker->numberBetween(1000, 72000000),
                'plazo' => $faker->numberBetween(1, 48),
                'cuota' => $faker->randomFloat(2, 1, 100),
                'interes' => $faker->randomFloat(2, 1, 100),
                'idAnalizadoPor' =>random_int(\DB::table('users')->min('id'), \DB::table('users')->max('id')),
                'analizadoEn' => $faker->optional()->dateTimeInInterval($startDate = '-1 years', $interval = '+ 5 days', $timezone = 'America/Bogota'),
            ]);
        }
	}
}
