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
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;


class CreditoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $id = auth()->user()->id;

        $usuario = User::find($id)->usuario;

        if ($usuario != null)
        {
            $solicitudes = Usuario::find($id)->solicitudes;
            $data = compact('solicitudes');
            return view('creditos.tabla', $data);
        }
        else
        {
            $mensaje = 'Para realizar esta consulta, primero debe llenar su información de perfil...';
            return view('creditos.tabla', compact('mensaje'));
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

        return redirect()->route('usuario.solicitudes');
    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function table($idSolicitud)
    {

        $documentos = Solicitud::find($idSolicitud)->documentos;

        $data = compact('documentos', 'idSolicitud');

        return view('creditos.documentos', $data);

    }

    public function documentoStore(Request $request, $idSolicitud)
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
        $mensaje = 'Documento subido correctamente...';
        return redirect()->back()->with('success', $mensaje);

    }

    public function documentoAprobado($idDocumento)
    {
        $documento = Documento::find($idDocumento);
        $documento->aprobado=1;
        $documento->revisado=1;
        $documento->save();
        $mensaje = 'Documento aprobado...';
        return redirect()->back()->with('success', $mensaje);

    }

    public function documentoRechazado($idDocumento)
    {
        $documento = Documento::find($idDocumento);
        $documento->aprobado=0;
        $documento->revisado=1;
        $documento->save();
        $mensaje = 'Documento rechazado...';
        return redirect()->back()->with('success', $mensaje);

    }

    public function documentoBorrar($idDocumento)
    {
        $documento = Documento::find($idDocumento);
        $name=$documento->documento;
        Storage::disk('public')->delete($name);
        $documento->delete();
        $mensaje = 'Documento borrado...';
        return redirect()->back()->with('success', $mensaje);

    }

    public function solicitudBorrar($idCredito)
    {
        
        $documentos = Solicitud::find($idCredito)->documentos;

        foreach ($documentos as $fila) {

            documentoBorrar($fila->id);

        }
        $documentos->delete();
        
        $mensaje = 'Solicitud eliminada...';
        return redirect()->back()->with('success', $mensaje);
    }

    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function show(Solicitud $solicitud)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function edit(Solicitud $solicitud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solicitud $solicitud)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solicitud $solicitud)
    {
        //
    }

}
