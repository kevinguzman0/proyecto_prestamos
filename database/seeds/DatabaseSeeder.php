<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;
use App\str_random;

use App\User;

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
        //$faker->addProvider(new Faker\Provider\en_US\Person($faker));

        foreach (range(1,20) as $index) 
        {
            $usuario = User::create([
                'name' => $faker->userName,
                'email' => $faker->email,
                'email_verified_at' => $faker->optional()->dateTimeInInterval($startDate = '-1 years', $interval = '+ 5 days', $timezone = 'America/Bogota'),
                'password' => bcrypt('secret'),
                'remember_token' => str_random(10),
            ]);

            $usuario->assignRole('registrado');

        }

        /*
        $idUsers = DB::table('users')->pluck('id')->toArray();
        $emailUsers = DB::table('users')->pluck('email')->toArray();

        foreach (range(1,10) as $index) 
        {
            DB::table('perfiles')->insert([
                'id' => $faker->randomElement($idUsers),
                'idEstadoPerfil' => $faker->numberBetween($min = 1, $max = 5),
                'cedula' => $faker->dni,
                'nombres' => $faker->name,
                'apellidos' => $faker->name,
                'foto' => null,
                'email' => $faker->randomElement($emailUsers),
                'telefono1' => $faker->e164PhoneNumber,
                'telefono2' => $faker->e164PhoneNumber, 
                'fechaNacimiento' => $faker->optional()->dateTimeBetween($startDate = '-80 years', $endDate = '-18 years', $timezone = 'America/Bogota'),
                'direccion' => $faker->streetAddress,
                'barrio' => $faker->streetName,
                'ciudad' => $faker->city,
                'areaTrabajo' => $faker->catchPhrase,
                'cargoTrabajo' => $faker->jobTitle,
                'afiliadoFondo' => $faker->array_random([0, 1]),
            ]);
        }
        */

    }

}


