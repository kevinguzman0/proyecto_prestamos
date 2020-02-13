<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

use Carbon\Carbon;

class SpatieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	// ---------------------------------------------------------------------------------

        $datos = array(
            array('nombreEstado' => 'Presentada', 
                  'descripcionEstado' => 'Formulario diligenciado por primera vez. Puede estar completo o no con sus respectivos anexos.', 
                  'created_at'=> Carbon::now(), 
                  'updated_at'=> Carbon::now()),
            array('nombreEstado' => 'En estudio', 
                  'descripcionEstado' => 'Solicitud con documentación en estudio y pendiente de verificación.', 
                  'created_at'=> Carbon::now(), 
                  'updated_at'=> Carbon::now()),
            array('nombreEstado' => 'Con pendientes', 
                  'descripcionEstado' => 'Solicitud pre-aprobada que requiere completar documentación o verificar información presentada.', 
                  'created_at'=> Carbon::now(), 
                  'updated_at'=> Carbon::now()),
            array('nombreEstado' => 'Rechazada', 
                  'descripcionEstado' => 'Solicitud revisada y rechazada por no cumplimiento de los requisitos.', 
                  'created_at'=> Carbon::now(), 
                  'updated_at'=> Carbon::now()),
            array('nombreEstado' => 'Aprobada', 
                  'descripcionEstado' => 'Solicitud aprobada con documentación completa y sin revisiones o verificaciones pendientes.', 
                  'created_at'=> Carbon::now(), 
                  'updated_at'=> Carbon::now()),
            array('nombreEstado' => 'Desembolsada', 
                  'descripcionEstado' => 'Solicitud aprobada, con entrega efectiva de dinero al beneficiario y reportada a tesorería para los respectivos descuentos mensuales o quincenales.', 
                  'created_at'=> Carbon::now(), 
                  'updated_at'=> Carbon::now()),
            array('nombreEstado' => 'En espera', 
                  'descripcionEstado' => 'Solicitud aprobada con cumplimiento de requisitos. Queda en cola de espera para desembolso futuro cuando se tengan recursos financieros disponibles.', 
                  'created_at'=> Carbon::now(), 
                  'updated_at'=> Carbon::now()),
        );

        DB::table('estados_solicitud')->insert($datos);

    	// ---------------------------------------------------------------------------------

        Role::create(['name' => 'inactivo']);
        Role::create(['name' => 'administrador']);
        Role::create(['name' => 'directivo']);
        Role::create(['name' => 'registrado']);
        Role::create(['name' => 'perfilado']);
        Role::create(['name' => 'interesado']);
        Role::create(['name' => 'cliente']);

    	// ---------------------------------------------------------------------------------

        User::create([
        	'name' => 'administrador',
        	'email' => 'administrador@sistema.com',
        	'password' => bcrypt('1234+Qwer'),
        	'email_verified_at' => now()
        ]);

        // ADSI - Desarrollo - Usuario único administrador por defecto.
        $usuario = User::find(1)->assignRole('administrador');

    	// ---------------------------------------------------------------------------------

    }
}
