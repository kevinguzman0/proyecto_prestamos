<?php

namespace App\Http\Controllers;

use App\Solicitud;
use App\Usuario;
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

        try
        {
           $cliente = User::findOrFail($idCliente)->usuario;
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) 
        {
            $mensajeError = 'Atención, la información de perfil del Cliente [ ' . $idCliente . ' ] no está registrada. Es imposible mostrar la información de solicitudes existente. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);
        }

        $solicitudes = Usuario::findOrFail($idCliente)->solicitudes;
        return view('creditos.solicitudes', compact('solicitudes', 'cliente'));

    }

    public function tablaDocumentos($idCliente, $idSolicitud)
    {

        $cliente = Solicitud::findOrFail($idSolicitud)->cliente;

        if ($cliente == null)
        {
            $mensajeError = 'Atención, la información de perfil del Cliente [ ' . $idCliente . ' ] asociado a la Solicitud [ ' . $idSolicitud . ' ] no está disponible. Es imposible mostrar la información de documentos registrados. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);
        }

        $documentos = Solicitud::findOrFail($idSolicitud)->documentos;

        if (count($documentos) == 0)
        {
            $mensajeVerde = 'La Solicitud [ ' . $idSolicitud . ' ] del Cliente [ ' . $idCliente . ' ] no tiene documentos registrados.';
            $data = compact('cliente', 'idSolicitud', 'documentos', 'mensajeVerde');
        }
        else
        {
            $mensajeVerde = '';
            $data = compact('cliente', 'idSolicitud', 'documentos');
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

        $id = auth()->user()->id;
        $solicitud = new Solicitud;
        $solicitud->monto = $request->monto;
        $solicitud->plazo = $request->plazo;
        $solicitud->cuota = $request->cuota;
        $solicitud->interes = $request->interes;
        $solicitud->idEstadoSolicitud = $request->idEstadoSolicitud;
        $solicitud->idCliente = $request->idCliente;
        
        $cliente = Solicitud::find($request->idCliente)->cliente;
        $cliente->idPerfilUsuario = 2;
        $cliente->save();
 
        $solicitud->save();

        return redirect()->route('solicitudes.tabla');
    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function documentoNuevo(Request $request, $idSolicitud)
    {

        $documento = new Documento;

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

        $documento->idSolicitud = $idSolicitud;
        $documento->nombreOriginal = $originalFile;
        $documento->descripcionDocumento = $request->descripcionDocumento;
        $documento->revisado = 0;
        $documento->aprobado = -1;
        $documento->documento = strtolower($archivo);

        Storage::disk('public')->put($archivo, File::get($file));
        $documento->save();
        
        $mensajeVerde = 'Documento subido correctamente...';

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
            $mensajeError = 'Atención, la información del documento [ ' . $idDocumento . ' ] asociado a la Solicitud [ ' . $idSolicitud. ' ] no está disponible. Es imposible gestionar la información del documento registrado. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);
        }

        $documento->aprobado = 1;
        $documento->revisado = 1;
        $documento->save();

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
            $mensajeError = 'Atención, la información del documento [ ' . $idDocumento . ' ] asociado a la Solicitud [ ' . $idSolicitud. ' ] no está disponible. Es imposible gestionar la información del documento registrado. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);
        }

        $documento->aprobado = 0;
        $documento->revisado = 1;
        $documento->save();

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
            $mensajeError = 'Atención, la información del documento [ ' . $idDocumento . ' ] asociado a la Solicitud [ ' . $idSolicitud. ' ] no está disponible. Es imposible gestionar la información del documento registrado. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);
        }

        $archivo = $documento->documento;
        Storage::disk('public')->delete($archivo);
        $documento->delete();

        $mensajeVerde = 'Documento eliminado...';
        
        return redirect()->back()->with('mensajeVerde', $mensajeVerde);

    }

    public function solicitudEliminar($idCliente, $idSolicitud)
    {
        
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

}
