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

        $idCliente = random_int(\DB::table('users')->min('id'), \DB::table('users')->max('id'));
        $idEstadoSolicitud=random_int(\DB::table('estados_solicitud')->min('id'), \DB::table('estados_solicitud')->max('id'));

        $idSolicitud = random_int(\DB::table('solicitudes')->min('id'), \DB::table('solicitudes')->max('id'));
        $idSolicitudCliente = random_int(\DB::table('solicitudes')->min('idCliente'), \DB::table('solicitudes')->max('idCliente'));

        foreach (range(1,20) as $index) 
        {
            $usuario = User::create([
                'name' => $faker->userName,
                'email' => $faker->email,
                'email_verified_at' => $faker->optional()->dateTimeInInterval($startDate = '-1 years', $interval = '+ 5 days', $timezone = 'America/Bogota'),
                'password' => bcrypt('12345678'),
                'remember_token' => null,
                'created_at' => $faker->dateTimeInInterval($startDate = '-1 years', $interval = '+ 5 days', $timezone = 'America/Bogota'),
                'updated_at' => $faker->dateTimeInInterval($startDate = '-1 years', $interval = '+ 5 days', $timezone = 'America/Bogota'),
            ]);

            $usuario->assignRole('registrado');

        }

        foreach (range(1,50) as $index) {

            $solicitud = Solicitud::create([

                'idCliente' => $idCliente,
                'idEstadoSolicitud' => $idEstadoSolicitud,
                'monto' => $faker->numberBetween(1000, 72000000),
                'plazo' => $faker->numberBetween(1, 48),
                'cuota' => $faker->randomFloat(2, 1, 100),
                'interes' => $faker->randomFloat(2, 1, 100),
                'idAnalizadoPor' => $idCliente,
                'analizadoEn' => $faker->optional()->dateTimeInInterval($startDate = '-1 years', $interval = '+ 5 days', $timezone = 'America/Bogota'),

            ]);
        }

        foreach (range(1,50) as $index) {
        	
        	$documentos = Documento::create([

        		'idSolicitud' => $idSolicitud,
        		'idCliente' => $idSolicitudCliente,
        		'documento' => $faker->regexify('[A-Za-z0-9]{20}'),
        		'archivoOriginal' => $faker->regexify('[A-Za-z0-9]{20}'),
        		'descripcionDocumento' => $faker->regexify('[A-Za-z0-9]{100}'),
        		'revisado' => $faker->numberBetween(0, 1),
        		'aprobado' => $faker->numberBetween(-1, 1),
        		'idAnalizadoPor' => $idCliente,
        		'analizadoEn' => $faker->optional()->dateTimeInInterval($startDate = '-1 years', $interval = '+ 5 days', $timezone = 'America/Bogota'),

        	]);

        }        

        foreach (range(1,20) as $index) 
        {
            $perfiles = Perfil::create([

                'id' => $faker->$idCliente,
                'idEstadoPerfil' => '$faker->numberBetween($min = 1, $max = 5)',
                'cedula' => '$faker->numberBetween($min = 1, $max = 100000000)',	
                'nombres' => '$faker->name',
                'apellidos' => '$faker->lastName',
                'foto' => '$faker->regexify("[A-Za-z0-9]{20}")',
                'email' => '$faker->email',
                'telefono1' => '$faker->e164PhoneNumber',
                'telefono2' => '$faker->e164PhoneNumber', 
                'fechaNacimiento' => $faker->dateTime($max = 'now', $timezone = null),
                'direccion' => '$faker->streetAddress',
                'barrio' => '$faker->streetName',
                'ciudad' => '$faker->city',
                'areaTrabajo' => '$faker->catchPhrase',
                'cargoTrabajo' => '$faker->jobTitle',
                'afiliadoFondo' => $faker->numberBetween(0, 1),

            ]);
        }
        
	}

}


