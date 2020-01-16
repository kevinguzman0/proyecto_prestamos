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

    public function documentStore(Request $request, $idSolicitud)
    {

        $mensaje = 'Documento subido correctamente...';
        $documento = new Documento;

        $validatedData = Validator::make($request->all(),
                [
                    'documento'=> 'required|mimes:jpeg,bmp,png,gif,pdf,doc,docx,xls,xlsx|max:5120',
                    'descripcionDocumento' => 'required',
                ]);

        $file = $request->file('documento');
        $ext = $request->file('documento')->getClientOriginalExtension();
        $timeStamp = date_create()->format('Ymd-His');
        $archivo = 'documento_solicitud_' . $idSolicitud . '_' . $timeStamp . '.' . $ext;

        $documento->idSolicitud = $idSolicitud;
        $documento->descripcionDocumento = $request->descripcionDocumento;
        $documento->revisado = 0;
        $documento->aprobado = -1;
        $documento->documento = $archivo;
        Storage::disk('public')->put($archivo, File::get($file));
        $documento->save();
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
