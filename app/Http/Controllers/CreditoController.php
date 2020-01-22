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
    public function tablaSolicitudes($idCliente)
    {

        $perfil = Perfil::find($idCliente);

        if ($perfil == null)
        {
            $mensajeError = 'Atención, la información de perfil del Cliente [ ' . $idCliente . ' ] no está registrada. Es imposible mostrar la información de solicitudes existente. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);        
        }

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

    public function tablaDocumentos($idCliente, $idSolicitud)
    {

        try
        {
            $perfil = Perfil::findOrFail($idCliente);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) 
        {
            $mensajeError = 'Atención, la información de perfil del Cliente [ ' . $idCliente . ' ] asociado a la Solicitud [ ' . $idSolicitud . ' ] no está disponible. Es imposible mostrar la información de documentos registrados. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);
        }

        try
        {
            $validarSolicitud = Solicitud::findOrFail($idSolicitud);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) 
        {
            $mensajeError = 'Atención, la información de la Solicitud [ ' . $idSolicitud . ' ] asociada al Cliente [ ' . $idCliente . ' ] no está disponible. Es imposible mostrar la información de documentos registrados. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);
        }

        $documentos = Solicitud::findOrFail($idSolicitud)->documentos;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function solicitudNueva(Request $request)
    {

        $solicitud = new Solicitud;
        $solicitud->monto = $request->monto;
        $solicitud->plazo = $request->plazo;
        $solicitud->cuota = $request->cuota;
        $solicitud->interes = $request->interes;
        $solicitud->idEstadoSolicitud = $request->idEstadoSolicitud;
        $solicitud->idCliente = $request->idCliente;
        
        $solicitud->save();

        $perfil = Perfil::find($request->idCliente);

        if ($perfil == null)
        {
            $mensajeError = 'Atención, la información de perfil del Cliente [ ' . $solicitud->idCliente . ' ] asociado a la Solicitud [ ' . $solicitud->id . ' ] no está disponible. Es imposible continuar con el proceso de actualización de estado del Cliente. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);
        }

        $perfil->idPerfilUsuario = 2;
        $perfil->save();
        $idCliente = $solicitud->idCliente;

        return redirect()->route('mis.solicitudes', compact('idCliente'));

    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function documentoNuevo(Request $request, $idSolicitud)
    {

        try
        {
            $validarSolicitud = Solicitud::findOrFail($idSolicitud);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) 
        {
            $mensajeError = 'Atención, la información de la Solicitud [ ' . $idSolicitud . ' ] no está disponible. Es imposible continuar con el registro de nuevos documentos. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);
        }

        $validatedData = Validator::make($request->all(),
                [
                    'documento'=> 'required|mimes:jpeg,bmp,png,gif,jfif,pdf,doc,docx,xls,xlsx,zip,rar,7z|max:10240',
                    'descripcionDocumento' => 'required',
                ]);

        if($validatedData->fails())
        {
            return redirect()->back()->withInput()->withErrors($validatedData);
        }

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

        Storage::disk('public')->put($archivo, File::get($file));
        $documento->save();
        
        $mensajeVerde = 'Documento almacenado correctamente...';

        return redirect()->back()->with('mensajeVerde', $mensajeVerde);

    }

    public function documentoAprobado($idSolicitud, $idDocumento)
    {

        try
        {
            $documento = Documento::findOrFail($idDocumento);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) 
        {
            $mensajeError = 'Atención, la información del documento [ ' . $idDocumento . ' ] asociado a la Solicitud [ ' . $idSolicitud. ' ] no está disponible. Es imposible continuar con la actualización del documento. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);
        }

        try
        {
            $solicitud = Solicitud::findOrFail($idSolicitud);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) 
        {
            $mensajeError = 'Atención, la información de la Solicitud [ ' . $idSolicitud . ' ] asociada al Documento [ ' . $idDocumento . ' ] no está disponible. Es imposible continuar con la actualización del documento. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);
        }

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

    public function documentoRechazado($idSolicitud, $idDocumento)
    {

       try
        {
            $documento = Documento::findOrFail($idDocumento);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) 
        {
            $mensajeError = 'Atención, la información del documento [ ' . $idDocumento . ' ] asociado a la Solicitud [ ' . $idSolicitud. ' ] no está disponible. Es imposible continuar con la actualización del documento. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);
        }

        try
        {
            $solicitud = Solicitud::findOrFail($idSolicitud);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) 
        {
            $mensajeError = 'Atención, la información de la Solicitud [ ' . $idSolicitud . ' ] asociada al Documento [ ' . $idDocumento . ' ] no está disponible. Es imposible continuar con la actualización del documento. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);
        }

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

    public function documentoEliminar($idSolicitud, $idDocumento)
    {

       try
        {
            $documento = Documento::findOrFail($idDocumento);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) 
        {
            $mensajeError = 'Atención, la información del documento [ ' . $idDocumento . ' ] asociado a la Solicitud [ ' . $idSolicitud. ' ] no está disponible. Es imposible continuar con la actualización del documento. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);
        }

        try
        {
            $validarSolicitud = Solicitud::findOrFail($idSolicitud);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) 
        {
            $mensajeError = 'Atención, la información de la Solicitud [ ' . $idSolicitud . ' ] asociada al Documento [ ' . $idDocumento . ' ] no está disponible. Es imposible continuar con la eliminación del documento. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);
        }

        $archivo = $documento->documento;
        Storage::disk('public')->delete($archivo);
        $documento->delete();

        $mensajeVerde = 'Documento eliminado...';
        
        return redirect()->back()->with('mensajeVerde', $mensajeVerde);

    }

    public function documentoDescargar($archivo){

        $archivosMensaje = array('doc', 'docx', 'xls', 'xlsx', 'zip', 'rar', '7z');

        $pathtoFile = public_path().'/storage/docUsuarios/'.$archivo;
        return response()->download($pathtoFile);

    }

    public function solicitudEliminar($idCliente, $idSolicitud)
    {
        
        try
        {
            $validarPerfil = Perfil::findOrFail($idCliente);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) 
        {
            $mensajeError = 'Atención, la información de perfil del Cliente [ ' . $idCliente . ' ] asociado a la Solicitud [ ' . $idSolicitud . ' ] no está disponible. Es imposible continuar con el proceso de eliminación de la solicitud. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);
        }

        try
        {
            $solicitud = Solicitud::findOrFail($idSolicitud);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) 
        {
            $mensaje = 'Atención, la Solicitud [ ' . $idSolicitud . ' ] no está disponible para su eliminación. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            return redirect()->back()->with('mensajeVerde', $mensaje);
        }

        $documentos = Solicitud::findOrFail($idSolicitud)->documentos;

        if (count($documentos) > 0)
        {
            foreach ($documentos as $fila)
            {
                $this->documentoEliminar($idSolicitud, $fila->id);
            }
   
        }
        
        $solicitud->delete();

        $mensaje = 'La Solicitud [ ' . $idSolicitud . ' ] fue eliminada...';

        return redirect()->back()->with('mensajeVerde', $mensaje);

    }

    public function usuarioEliminar($idUsuario)
    {

        $usuario = User::find($idUsuario);
 
        if ($usuario == null)
        {
            $mensajeError = 'Atención, la información de registro del Usuario [ ' . $idUsuario . ' ] no está disponible. Es imposible proceder con la eliminación del usuario. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);        
        }

        $perfil = Perfil::find($idUsuario);

        if ($perfil != null) 
        {
            $perfil->delete();
            $mensaje = 'El Usuario [ ' . $idUsuario . ' ] fue eliminado con toda su información de Perfil...';
        }
        else
        {
            $mensaje = 'El Usuario [ ' . $idUsuario . ' ] fue eliminado...';
        }

        $archivo = $perfil->foto;
        Storage::disk('public')->delete($archivo);

        $usuario->delete();

        $solicitudes = Solicitud::findOrFail($idUsuario);

        if (count($solicitudes) > 0)
        {
            foreach ($solicitudes as $fila)
            {
                $this->solicitudEliminar($idUsuario, $fila->id);
            }
   
        }
        
        return redirect()->back()->with('mensajeVerde', $mensaje);

    }

    public function solicitudAprobar($idCliente, $idSolicitud)
    {
        
        try
        {
            $perfil = Perfil::findOrFail($idCliente);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) 
        {
            $mensajeError = 'Atención, la información de perfil del Cliente [ ' . $idCliente . ' ] asociado a la Solicitud [ ' . $idSolicitud . ' ] no está disponible. Es imposible continuar con el proceso de eliminación de la solicitud. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);
        }

        try
        {
            $solicitud = Solicitud::findOrFail($idSolicitud);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) 
        {
            $mensaje = 'Atención, la Solicitud [ ' . $idSolicitud . ' ] no está disponible para su eliminación. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            return redirect()->back()->with('mensajeVerde', $mensaje);
        }

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

    public function solicitudRechazar($idCliente, $idSolicitud)
    {
        
        try
        {
            $perfil = Perfil::findOrFail($idCliente);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) 
        {
            $mensajeError = 'Atención, la información de perfil del Cliente [ ' . $idCliente . ' ] asociado a la Solicitud [ ' . $idSolicitud . ' ] no está disponible. Es imposible continuar con el proceso de eliminación de la solicitud. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);
        }

        try
        {
            $solicitud = Solicitud::findOrFail($idSolicitud);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) 
        {
            $mensaje = 'Atención, la Solicitud [ ' . $idSolicitud . ' ] no está disponible para su eliminación. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            return redirect()->back()->with('mensajeVerde', $mensaje);
        }

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
