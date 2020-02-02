<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;
use App\str_random;

use App\User;
use App\Solicitud;
use App\Documento;
use App\Perfil;

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

        foreach (range(1,100) as $index) 
        {
            $usuario = User::create([
                'name' => $faker->userName,
                'email' => $faker->email,
                'email_verified_at' => $faker->optional()->dateTimeThisYear($timezone = 'America/Bogota'),
                'password' => bcrypt('12345678'),
                'remember_token' => null,
                'created_at' => $faker->optional()->dateTimeThisYear($timezone = 'America/Bogota'),
                'updated_at' => $faker->optional()->dateTimeThisYear($timezone = 'America/Bogota'),
            ]);

            $usuario->assignRole('registrado');

        }

        $userIds = User::pluck('id');

        foreach (range(1,75) as $index) 
        {
            $perfiles = Perfil::create([
                'id' => $faker->unique()->randomElement($userIds),
                'idEstadoPerfil' => $faker->numberBetween($min = 1, $max = 5),
                'cedula' => $faker->numberBetween($min = 1, $max = 100000000),    
                'nombres' => $faker->name,
                'apellidos' => $faker->lastName,
                'foto' => $faker->file($sourceDir = 'public\\storage\\fakerImages', $targetDir = 'public\\storage\\fotosPerfiles', false),
                'email' => $faker->email,
                'telefono1' => $faker->e164PhoneNumber,
                'telefono2' => $faker->e164PhoneNumber,
                'fechaNacimiento' => $faker->dateTime($max = 'now', $timezone = null),
                'direccion' => $faker->streetAddress,
                'barrio' => $faker->streetName,
                'ciudad' => $faker->city,
                'areaTrabajo' => $faker->catchPhrase,
                'cargoTrabajo' => $faker->jobTitle,
                'afiliadoFondo' => $faker->numberBetween(0, 1),
                'created_at' => $faker->optional()->dateTimeThisYear($timezone = 'America/Bogota'),
                'updated_at' => $faker->optional()->dateTimeThisYear($timezone = 'America/Bogota'),
            ]);
        }

        foreach (range(1,150) as $index) 
        {
            $solicitud = Solicitud::create([

                'idCliente' => $faker->randomElement($userIds),
                'idEstadoSolicitud' => $faker->numberBetween(1, 7),
                'monto' => $faker->numberBetween(500000, 100000000),
                'plazo' => $faker->numberBetween(6, 120),
                'cuota' => $faker->numberBetween(100000, 3000000),
                'interes' => $faker->randomFloat(2, 1, 100),
                'idAnalizadoPor' => $faker->randomElement($userIds),
                'analizadoEn' => $faker->optional()->dateTimeThisYear($timezone = 'America/Bogota'),
                'created_at' => $faker->optional()->dateTimeThisYear($timezone = 'America/Bogota'),
                'updated_at' => $faker->optional()->dateTimeThisYear($timezone = 'America/Bogota'),
            ]);
        }

        $idSolicitudes = Solicitud::pluck('id');

        foreach (range(1,50) as $index) 
        {
        	$documentos = Documento::create([

        		'idSolicitud' => $faker->unique()->randomElement($idSolicitudes),
        		'idCliente' => $faker->randomElement($userIds),
        		'documento' => $faker->file($sourceDir = 'public\\storage\\fakerDocuments', $targetDir = 'public\\storage\\archivosDocumentos', false),
        		'archivoOriginal' => $faker->catchPhrase,
        		'descripcionDocumento' => $faker->paragraph($nbSentences = 1, $variableNbSentences = true),
        		'revisado' => $faker->numberBetween(0, 1),
        		'aprobado' => $faker->numberBetween(-1, 1),
        		'idAnalizadoPor' => $faker->randomElement($userIds),
                'analizadoEn' => $faker->optional()->dateTimeThisYear($timezone = 'America/Bogota'),
                'created_at' => $faker->optional()->dateTimeThisYear($timezone = 'America/Bogota'),
                'updated_at' => $faker->optional()->dateTimeThisYear($timezone = 'America/Bogota'),
        	]);

        }

	}

}


