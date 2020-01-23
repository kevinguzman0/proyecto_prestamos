<?php

namespace App\Http\Controllers;

use App\Solicitud;
use App\Perfil;
use App\User;
use App\Documento; 

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CreditoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function misSolicitudes($idCliente)
    {

        $perfil = Perfil::find($idCliente);

        if (!$perfil)
        {
            $mensajeError = 'Atención, la información de perfil del Cliente [ ' . $idCliente . ' ] no está registrada. Es imposible mostrar la información de solicitudes existente. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);        
        }
        else
        {

            $solicitudes = Perfil::find($idCliente)->solicitudes;

            if (count($solicitudes) == 0)
            {
                $mensajeVerde = 'El Cliente [ ' . $idCliente . ' ] no tiene Solicitudes registradas.';
                $data = compact('perfil', 'solicitudes', 'mensajeVerde');
            }
            else
            {
                $data = compact('perfil', 'solicitudes');
            }

            return view('creditos.solicitudes', $data);

        }

    }

    public function tablaDocumentos($idCliente, $idSolicitud)
    {

        $perfil = Perfil::find($idCliente);

        if(!$perfil)
        {
            $mensajeError = 'Atención, la información de perfil del Cliente [ ' . $idCliente . ' ] asociado a la Solicitud [ ' . $idSolicitud . ' ] no está disponible. Es imposible mostrar la información de documentos registrados. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);
        }
        else
        {

            $validarSolicitud = Solicitud::find($idSolicitud);

            if (!$validarSolicitud)
            {
                $mensajeError = 'Atención, la información de la Solicitud [ ' . $idSolicitud . ' ] asociada al Cliente [ ' . $idCliente . ' ] no está disponible. Es imposible mostrar la información de documentos registrados. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
                abort(404, $mensajeError);
            }
            else
            {
                $documentos = Solicitud::find($idSolicitud)->documentos;

                if (count($documentos) == 0)
                {
                    $mensajeVerde = 'La Solicitud [ ' . $idSolicitud . ' ] del Cliente [ ' . $idCliente . ' ] no tiene documentos registrados.';
                    $data = compact('perfil', 'idSolicitud', 'documentos', 'mensajeVerde');
                }
                else
                {
                    $data = compact('perfil', 'idSolicitud', 'documentos');
                }

                return view('creditos.documentos', $data);
            }

        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function solicitudNueva(Request $request)
    {

        $perfil = Perfil::find($request->idCliente);

        if (!$perfil)
        {
            $mensajeError = 'Atención, la información de perfil del Cliente [ ' . $solicitud->idCliente . ' ] asociado a la Solicitud [ ' . $solicitud->id . ' ] no está disponible. Es imposible continuar con el registro nuevas solicitudes. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);
        }
        else
        {

            $perfil->idPerfilUsuario = 2;
            $perfil->save();

            $solicitud = new Solicitud;
            $solicitud->monto = $request->monto;
            $solicitud->plazo = $request->plazo;
            $solicitud->cuota = $request->cuota;
            $solicitud->interes = $request->interes;
            $solicitud->idEstadoSolicitud = $request->idEstadoSolicitud;
            $solicitud->idCliente = $request->idCliente;
            $solicitud->save();

            $idCliente = $solicitud->idCliente;

            return redirect()->route('mis.solicitudes', compact('idCliente'));

        }

    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function documentoNuevo(Request $request, $idSolicitud)
    {

        $validarSolicitud = Solicitud::find($idSolicitud);

        if (!$validarSolicitud)
        {
            $mensajeError = 'Atención, la información de la Solicitud [ ' . $idSolicitud . ' ] no está disponible. Es imposible continuar con el registro de nuevos documentos. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);
        }
        else
        {

            $validatedData = Validator::make($request->all(),
                    [
                        'documento'=> 'required|mimes:jpeg,bmp,png,gif,jfif,pdf,doc,docx,xls,xlsx,zip,rar,7z|max:10240',
                        'descripcionDocumento' => 'required',
                    ]);

            if($validatedData->fails())
            {
                return redirect()->back()->withInput()->withErrors($validatedData);
            }
            else
            {

                $file = $request->file('documento');
                $ext = $request->file('documento')->getClientOriginalExtension();
                $originalFile = $request->file('documento')->getClientOriginalName();
                $timeStamp = date_create()->format('Ymd-His');
                $archivo = 'doc-id-' . $idSolicitud . '-' . $timeStamp . '.' . $ext;

                $documento = new Documento;
                $documento->idSolicitud = $idSolicitud;
                $documento->archivoOriginal = $originalFile;
                $documento->descripcionDocumento = $request->descripcionDocumento;
                $documento->revisado = 0;
                $documento->aprobado = -1;
                $documento->documento = strtolower($archivo);
                $documento->save();

                Storage::disk('public')->put($archivo, File::get($file));
                
                $mensajeVerde = 'Documento almacenado correctamente...';

                return redirect()->back()->with('mensajeVerde', $mensajeVerde);

            }

        }

    }

    public function documentoAprobado($idSolicitud, $idDocumento)
    {

        $documento = Documento::find($idDocumento);
        
        if (!$documento)
        {
            $mensajeError = 'Atención, la información del documento [ ' . $idDocumento . ' ] asociado a la Solicitud [ ' . $idSolicitud. ' ] no está disponible. Es imposible continuar con la actualización del documento. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);
        }
        else
        {

            $solicitud = Solicitud::find($idSolicitud);

            if (!$solicitud)
            {
                $mensajeError = 'Atención, la información de la Solicitud [ ' . $idSolicitud . ' ] asociada al Documento [ ' . $idDocumento . ' ] no está disponible. Es imposible continuar con la actualización del documento. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
                abort(404, $mensajeError);
            }
            else
            {

                $documento->aprobado = 1;
                $documento->revisado = 1;
                $documento->idAnalizadoPor = auth()->user()->id;
                $documento->analizadoEn = now();
                $documento->save();

                $solicitud->idEstadoSolicitud = 2;
                $solicitud->save();

                $mensajeVerde = 'Documento aprobado...';

                return redirect()->back()->with('mensajeVerde', $mensajeVerde);

            }

        }

    }

    public function documentoRechazado($idSolicitud, $idDocumento)
    {

        $documento = Documento::find($idDocumento);
        
        if (!$documento)
        {
            $mensajeError = 'Atención, la información del documento [ ' . $idDocumento . ' ] asociado a la Solicitud [ ' . $idSolicitud. ' ] no está disponible. Es imposible continuar con la actualización del documento. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);
        }
        else
        {

            $solicitud = Solicitud::find($idSolicitud);

            if (!$solicitud)
            {
                $mensajeError = 'Atención, la información de la Solicitud [ ' . $idSolicitud . ' ] asociada al Documento [ ' . $idDocumento . ' ] no está disponible. Es imposible continuar con la actualización del documento. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
                abort(404, $mensajeError);
            }
            else
            {

                $documento->aprobado = 0;
                $documento->revisado = 1;
                $documento->idAnalizadoPor = auth()->user()->id;
                $documento->analizadoEn = now();
                $documento->save();

                $solicitud->idEstadoSolicitud = 2;
                $solicitud->save();

                $mensajeVerde = 'Documento rechazado...';

                return redirect()->back()->with('mensajeVerde', $mensajeVerde);

            }

        }

    }

    public function documentoEliminar($idSolicitud, $idDocumento)
    {

        $documento = Documento::find($idDocumento);
        
        if (!$documento)
        {
            $mensajeError = 'Atención, la información del documento [ ' . $idDocumento . ' ] asociado a la Solicitud [ ' . $idSolicitud. ' ] no está disponible. Es imposible continuar con la eliminación del documento. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);
        }
        else
        {

            $validarSolicitud = Solicitud::find($idSolicitud);

            if (!$validarSolicitud)
            {
                $mensajeError = 'Atención, la información de la Solicitud [ ' . $idSolicitud . ' ] asociada al Documento [ ' . $idDocumento . ' ] no está disponible. Es imposible continuar con la eliminación del documento. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
                abort(404, $mensajeError);
            }
            else
            {

                $documento->delete();

                $archivo = $documento->documento;
                Storage::disk('public')->delete($archivo);

                $mensajeVerde = 'Documento eliminado...';
                
                return redirect()->back()->with('mensajeVerde', $mensajeVerde);

            }

        }

    }

    public function documentoDescargar($archivo)
    {

        $pathtoFile = public_path().'/storage/docUsuarios/'.$archivo;
        return response()->download($pathtoFile);

    }

    public function solicitudEliminar($idCliente, $idSolicitud)
    {
        
        $validarPerfil = Perfil::find($idCliente);

        if (!$validarPerfil)
        {
            $mensajeError = 'Atención, la información de perfil del Cliente [ ' . $idCliente . ' ] asociado a la Solicitud [ ' . $idSolicitud . ' ] no está disponible. Es imposible continuar con el proceso de eliminación de la solicitud. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);
        }
        else
        {

            $solicitud = Solicitud::find($idSolicitud);

            if (!$solicitud)
            {
                $mensaje = 'Atención, la Solicitud [ ' . $idSolicitud . ' ] no está disponible para su eliminación. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
                return redirect()->back()->with('mensajeVerde', $mensaje);
            }
            else
            {

                $documentos = Documento::all()->where('idSolicitud', '=', $idSolicitud);

                foreach ($documentos as $fila)
                {
                    $this->documentoEliminar($idSolicitud, $fila->id);
                }
               
                $solicitud->delete();

                $mensaje = 'La Solicitud [ ' . $idSolicitud . ' ] fue eliminada...';

                return redirect()->back()->with('mensajeVerde', $mensaje);
            }

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
                Storage::disk('public')->delete($archivo);

                $perfil->delete();
                $mensaje = 'El Usuario [ ' . $idUsuario . ' ] fue eliminado con toda su información de Perfil...';

            }

            return redirect()->back()->with('mensajeVerde', $mensaje);

        }

    }

    public function solicitudAprobar($idCliente, $idSolicitud)
    {
        
        $perfil = Perfil::find($idCliente);

        if (!$perfil)
        {
            $mensajeError = 'Atención, la información de perfil del Cliente [ ' . $idCliente . ' ] asociado a la Solicitud [ ' . $idSolicitud . ' ] no está disponible. Es imposible continuar con la actualización de la solicitud. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);
        }
        else
        {

            $solicitud = Solicitud::find($idSolicitud);

            if (!$solicitud)
            {
                $mensaje = 'Atención, la Solicitud [ ' . $idSolicitud . ' ] no está disponible para su actualización. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
                return redirect()->back()->with('mensajeVerde', $mensaje);
            }
            else
            {

                $documentosRechazados = Solicitud::findOrFail($idSolicitud)->documentos->where('aprobado', '=', 0)->count();

                if ($documentosRechazados > 0)
                {
                    $mensajeRojo = 'La Solicitud [ ' . $idSolicitud . ' ] no se puede aprobar ya que tiene [ ' . $documentosRechazados . ' ] documento(s) rechazado(s).';
                    return redirect()->back()->with('mensajeRojo', $mensajeRojo);
                }
                else
                {
            
                    $solicitud->idAnalizadoPor = auth()->user()->id;
                    $solicitud->analizadoEn = now();
                    $solicitud->idEstadoSolicitud = 5;
                    $solicitud->save();

                    $perfil->idPerfilUsuario = 3;
                    $perfil->save();

                    $mensajeVerde = 'Solicitud aprobada...';

                    return redirect()->back()->with('mensajeVerde', $mensajeVerde);

                }

            }

        }

    }

    public function solicitudRechazar($idCliente, $idSolicitud)
    {
        
        $perfil = Perfil::find($idCliente);

        if (!$perfil)
        {
            $mensajeError = 'Atención, la información de perfil del Cliente [ ' . $idCliente . ' ] asociado a la Solicitud [ ' . $idSolicitud . ' ] no está disponible. Es imposible continuar con el proceso de actualización de la solicitud. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);
        }
        else
        {

            $solicitud = Solicitud::find($idSolicitud);

            if (!$solicitud)
            {
                $mensaje = 'Atención, la Solicitud [ ' . $idSolicitud . ' ] no está disponible para su actualización. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
                return redirect()->back()->with('mensajeVerde', $mensaje);
            }
            else
            {

                $solicitud->idAnalizadoPor = auth()->user()->id;
                $solicitud->analizadoEn = now();
                $solicitud->idEstadoSolicitud = 4;
                $solicitud->save();

                $perfil->idPerfilUsuario = 2;
                $perfil->save();

                $mensajeVerde = 'Solicitud rechazada...';

                return redirect()->back()->with('mensajeVerde', $mensajeVerde);

            }

        }
    
    }

}
