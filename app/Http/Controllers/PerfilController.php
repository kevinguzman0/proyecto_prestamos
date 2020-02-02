<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

use Input;

class PerfilController extends Controller
{
    
    const REGISTRADO = 1;
    const INTERESADO = 2;
    const CLIENTE = 3;
    const DIRECTIVO = 4;
    const INACTIVO = 5;

    const SIN_VALIDAR = null;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function miPerfil($idCliente)
    {

        $usuario = User::find($idCliente);

        if (!$usuario)
        {
            $mensajeError = 'Atención, el Usuario [ ' . $idCliente . ' ] no está registrado. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);        
        }
        else
        {

            $perfil = Perfil::find($idCliente);

            if (!$perfil) 
            {
                $emailUsuario = $usuario->email;
                return view('perfiles.nuevo', compact('idCliente', 'emailUsuario'));
            }
            else
            {
                $storagePath = Storage::disk('public')->path('\\fotosPerfiles\\' . $perfil->foto);
                return view('perfiles.actualizar', compact('perfil', 'storagePath'));
            }

        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function gestionarPerfil(Request $request, $idCliente)
    {

        $perfil = Perfil::find($idCliente);

        if (!$perfil) 
        {

            $validatedData = Validator::make($request->all(),
                [
                    'cedula' => 'required|unique:perfiles',
                    'nombres' => 'required',
                    'apellidos' => 'required',
                    'email' => 'required|email|unique:perfiles',
                    'telefono1' => 'required',
                    'telefono2' => 'required',
                    'fechaNacimiento' => 'required',
                    'direccion' => 'required',
                    'barrio' => 'required',
                    'ciudad' => 'required',
                    'areaTrabajo' => 'required',
                    'cargoTrabajo' => 'required',
                    'afiliadoFondo' => 'required',
                    'foto'=> 'mimes:jpeg,bmp,png,gif,jfif|max:5120',
                ]);

            $perfil = new Perfil;
            $perfil->idEstadoPerfil = self::REGISTRADO;
            $mensaje = 'Perfil creado correctamente...';

        }
        else
        {

            $validatedData = Validator::make($request->all(),
                [
                    'cedula' => 'required',
                    'nombres' => 'required',
                    'apellidos' => 'required',
                    'email' => 'required|email',
                    'telefono1' => 'required',
                    'telefono2' => 'required',
                    'fechaNacimiento' => 'required',
                    'direccion' => 'required',
                    'barrio' => 'required',
                    'ciudad' => 'required',
                    'areaTrabajo' => 'required',
                    'cargoTrabajo' => 'required',
                    'afiliadoFondo' => 'required',
                    'foto'=> 'mimes:jpeg,bmp,png,gif|max:5120',

                ]);

            if($perfil->email != $request->email)
            {
                $user = User::find($perfil->id);
                $user->email_verified_at = self::SIN_VALIDAR;
                $user->email=$request->email;
                $user->save();
                return redirect()->route('salir');
            }

            $mensaje = 'Perfil actualizado correctamente...';

        }

        if($validatedData->fails())
        {
            return redirect()->back()->withInput()->withErrors($validatedData);
        }
        else
        {

            $perfil->id = $idCliente;
            $perfil->cedula = $request->cedula;
            $perfil->nombres = $request->nombres;
            $perfil->apellidos = $request->apellidos;
            $perfil->email = $request->email;
            $perfil->telefono1 = $request->telefono1;
            $perfil->telefono2 = $request->telefono2;
            $perfil->fechaNacimiento = $request->fechaNacimiento;
            $perfil->direccion = $request->direccion;
            $perfil->barrio = $request->barrio;
            $perfil->ciudad = $request->ciudad;
            $perfil->areaTrabajo = $request->areaTrabajo;
            $perfil->cargoTrabajo = $request->cargoTrabajo;
            $perfil->afiliadoFondo = $request->afiliadoFondo;

            if (Input::has('foto'))
            {
                
                $archivo = $perfil->foto;
                Storage::disk('public')->delete('\\fotosPerfiles\\' . $archivo);

                $file = $request->file('foto');
                $ext = $request->file('foto')->getClientOriginalExtension();
                $archivo = 'foto-id-' . $perfil->id . '.' . $ext;
                $perfil->foto = strtolower($archivo);
                Storage::disk('public')->put('\\fotosPerfiles\\' . $archivo, File::get($file));

            }

            $perfil->save();

            return redirect()->back()->with('mensajeVerde', $mensaje);

        }

    }
    
    public function cambiarPassword(Request $request)
    {

        $idUsuario = Auth::user()->id;

        $usuario = User::find($idUsuario);

        if (!$usuario) 
        {
            $mensajeError = 'Atención, la información de registro del Usuario [ ' . $idUsuario . ' ] no está disponible. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);        
        }
        else
        {

            $myPassword = $request->input("myPassword");
            $password = $request->input("password");
            $passwordConfirmation = $request->input("password_confirmation");

            $validatedData = Validator::make($request->all(),
                [
                    'myPassword' => 'required',
                    'password' => 'required|confirmed|min:8',
                ]);

            if($validatedData->fails())
            {
                return redirect()->back()->withInput()->withErrors($validatedData);
            }
            else
            {

                if (!Hash::check($myPassword, $usuario->password))
                {
                    $mensajeError = 'Atención, no ha pasado la comprobación de seguridad para cambiar su contraseña. Intente de nuevo o contáctese con el administrador del sistema para revisar esta situación.';
                    abort(404, $mensajeError);  
                }
                else
                {
                    $usuario->password = Hash::make($password);
                    $usuario->save();

                    return redirect()->route('salir');
                }

            }

        }        

    }

    public function usuarioDirectivo($idUsuario)
    {
        $perfil = Perfil::find($idUsuario);

        if (!$perfil)
        {
            $mensaje = 'Atención, el usuario [ ' . $idUsuario . ' ] no está disponible para su actualización. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            return redirect()->back()->with('mensajeVerde', $mensaje);
        }
        else
        {
            $perfil->idEstadoPerfil = self::DIRECTIVO;
            $perfil->save();

            $usuario = User::find($idUsuario);
            $usuario->assignRole('directivo');
            $usuario->removeRole('registrado');

            $mensajeVerde = 'Usuario definido como Directivo...';

            return redirect()->back()->with('mensajeVerde', $mensajeVerde);
        }

    }

    public function usuarioNoDirectivo($idUsuario)
    {
        $perfil = Perfil::find($idUsuario);

        if (!$perfil)
        {
            $mensaje = 'Atención, el usuario [ ' . $idUsuario . ' ] no está disponible para su actualización. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            return redirect()->back()->with('mensajeVerde', $mensaje);
        }
        else
        {
            $perfil->idEstadoPerfil = self::REGISTRADO;
            $perfil->save();

            $usuario = User::find($idUsuario);
            $usuario->assignRole('registrado');
            $usuario->removeRole('directivo');

            $mensajeVerde = 'Usuario registrado...';

            return redirect()->back()->with('mensajeVerde', $mensajeVerde);
        }

    }

    public function usuarioEliminar($idUsuario)
    {

        $usuario = User::find($idUsuario);
 
        if (!$usuario)
        {
            $mensajeError = 'Atención, la información de registro del Usuario [ ' . $idUsuario . ' ] no está disponible. Es imposible proceder con la eliminación del usuario. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);        
        }
        else
        {

            $solicitudes = Solicitud::all()->where('idCliente', '=', $idUsuario);

            foreach ($solicitudes as $fila)
            {
                $this->solicitudEliminar($idUsuario, $fila->id);
            }

            $usuario->delete();

            $perfil = Perfil::find($idUsuario);

            if (!$perfil) 
            {
                $mensaje = 'El Usuario [ ' . $idUsuario . ' ] fue eliminado...';
            }
            else
            {

                $archivo = $perfil->foto;
                Storage::disk('public')->delete('\\fotosPerfiles\\' . $archivo);

                $perfil->delete();
                $mensaje = 'El Usuario [ ' . $idUsuario . ' ] fue eliminado con toda su información de Perfil...';

            }

            return redirect()->back()->with('mensajeVerde', $mensaje);

        }

    }

    public function usuarioInactivar($idUsuario)
    {
        $perfil = Perfil::find($idUsuario);

        if (!$perfil)
        {
            $mensaje = 'Atención, el usuario [ ' . $idUsuario . ' ] no está disponible para su actualización. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            return redirect()->back()->with('mensajeVerde', $mensaje);
        }
        else
        {
            $perfil->idEstadoPerfil = self::INACTIVO;
            $perfil->save();

            $usuario = User::find($idUsuario);
            $usuario->assignRole('inactivo');
            //$usuario->syncRoles(['directivo', 'registrado', 'administrador']);
            $usuario->removeRole('directivo');
            $usuario->removeRole('registrado');
            $usuario->removeRole('administrador');

            $mensajeVerde = 'Usuario inactivado...';

            return redirect()->back()->with('mensajeVerde', $mensajeVerde);
        }

    }

    public function usuarioActivar($idUsuario)
    {
        $perfil = Perfil::find($idUsuario);

        if (!$perfil)
        {
            $mensaje = 'Atención, el usuario [ ' . $idUsuario . ' ] no está disponible para su actualización. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            return redirect()->back()->with('mensajeVerde', $mensaje);
        }
        else
        {
            $perfil->idEstadoPerfil = self::REGISTRADO;
            $perfil->save();

            $usuario = User::find($idUsuario);
            $usuario->removeRole('inactivo');
            $usuario->assignRole('registrado');
            

            $mensajeVerde = 'Usuario activado...';

            return redirect()->back()->with('mensajeVerde', $mensajeVerde);
        }

    }

    public function datosCorreo($idCliente)
    {

        $datosCliente = Perfil::find($idCliente);
        return view('perfiles.correo', compact('datosCliente'));

    }

    public function enviarCorreo(Request $request, $idCliente)
    {

        $validatedData = Validator::make($request->all(),
                    [
                        'asunto'=> 'required',
                        'mensaje' => 'required',
                    ]);

        if($validatedData->fails())
        {
            return redirect()->back()->withInput()->withErrors($validatedData);
        }

        else
        {

            $datosCliente = Perfil::find($idCliente);

            $mensajeVerde = 'Correo enviado...';

            $subject = "Asunto del correo";
            $for = $datosCliente->email;
            $msj=$request->mensaje;

            Mail::send('perfiles.email',$request->all(), function($msj) use($subject,$for){
                $msj->from("hernanarangoisaza@gmail.com","kevinguzman");
                $msj->subject($subject);
                $msj->to($for);
            });

            return redirect()->back()->with('mensajeVerde', $mensajeVerde);
        }

    }

}
