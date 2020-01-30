<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\User;
use App\Solicitud;
use App\Documento;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use DB;

class GeneralController extends Controller
{

    public function tablaPerfiles()
    {

        $perfiles = Perfil::paginate(10);
        $cboEstadosPerfil = Perfil::select('idEstadoPerfil')->distinct()->get();
        $idPerfiles = Perfil::distinct()->get();
        $paginacion = 'si';

        return view('general.tablaPerfiles', compact('perfiles', 'cboEstadosPerfil', 'idPerfiles', 'paginacion'));

    }

    public function tablaUsuarios()
    {

        $usuarios = User::paginate(10);
        return view('general.tablaUsuarios', compact('usuarios'));

    }

    public function tablaSolicitudes()
    {

        $solicitudes = Solicitud::paginate(10);
        return view('general.tablaSolicitudes', compact('solicitudes'));

    }

    public function tablaDocumentos()
    {

        $documentos = Documento::paginate(10);
        return view('general.tablaDocumentos', compact('documentos'));

    }

    public function usuarioValidar($idUsuario)
    {

    	$usuario = User::find($idUsuario);

        if (!$usuario)
        {
            $mensajeError = 'Atención, la información de registro del Usuario [ ' . $idUsuario . ' ] no está disponible. Es imposible proceder con la validación de la cuenta. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);        
        }
        else
        {

            $usuario->email_verified_at = now();
            $usuario->save();
            
            $mensaje = 'La cuenta del Usuario [ ' . $idUsuario . ' ] fue validada y ya puede ingresar en el sistema...';
            
            return redirect()->back()->with('mensajeVerde', $mensaje);

        }
    
    }

    public function buscadorPerfiles(Request $request)
    {

        $filtro = $request->filtro;
        $cboEstadosPerfil = Perfil::select('idEstadoPerfil')->distinct()->get();
        $idPerfiles = Perfil::distinct()->get();
        $paginacion = 'no';

        if (!$filtro)
        {
            $mensaje = 'No se han recibido criterios de búsqueda con el filtro. Pruebe con otra búsqueda...'; 
            $perfiles = Perfil::paginate(10);
            return view('general.tablaPerfiles', compact('perfiles', 'cboEstadosPerfil', 'idPerfiles', 'paginacion'))->with('mensajeRojo', $mensaje);
        }
        else
        {

            Builder::macro('whereLike', function($attributes, string $searchTerm) {
                foreach(Arr::wrap($attributes) as $attribute) {
                    $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                }
                return $this;
            });

            $perfiles = Perfil::whereLike(['nombres', 
                                           'apellidos', 
                                           'cedula', 
                                           'email', 
                                           'telefono1', 
                                           'telefono2',
                                           'direccion',
                                           'barrio',
                                           'ciudad',
                                           'areaTrabajo',
                                           'cargoTrabajo'], $filtro)
                        ->get();

            $mensaje = 'La información de Perfiles visualizada está filtrada por algunos campos que contienen el texto [ ' . $filtro . ' ]... ';

            return view('general.tablaPerfiles', compact('perfiles', 'cboEstadosPerfil', 'idPerfiles', 'paginacion'))->with('mensajeVerde', $mensaje);

        }

    }

    public function filtrosPerfiles(Request $request)
    {
        
        $id = $request->cboIdPerfiles;
        $idEstadoPerfil = $request->cboEstadosPerfil;
        $afiliadoFondo = $request->afiliadoFondo;

        $fechaDe = $request->cboFechaDe;
        $fInicial = $request->fechaInicial;
        $fFinal = $request->fechaFinal;

        if ($fInicial < $fFinal)
        {
            $fechaInicial = $fInicial;
            $fechaFinal = $fFinal;
        }
        else
        {
            $fechaInicial = $fFinal;
            $fechaFinal = $fInicial;
        }

        $cboEstadosPerfil = Perfil::select('idEstadoPerfil')->distinct()->get();
        $idPerfiles = Perfil::distinct()->get();

        $filtros = array();

        $contieneFiltros = false;

        if ($id != -1)
        {
            $filtros['id'] = $id; 
            $contieneFiltros = true;
        }

        if ($idEstadoPerfil != -1) 
        {
            $filtros['idEstadoPerfil'] = $idEstadoPerfil;
            $contieneFiltros = true;
        } 

        if ($afiliadoFondo != -1) 
        {
            $filtros['afiliadoFondo'] = $afiliadoFondo;
            $contieneFiltros = true;
        } 

        if ($fechaInicial != null) 
        {
            $contieneFiltros = true;
        } 

        if ($fechaFinal != null) 
        {
            $contieneFiltros = true;
        }

        if ($contieneFiltros == false)
        {

            $mensaje = 'No se han aplicado filtros...'; 
            $perfiles = Perfil::paginate(10);
            $paginacion = 'si';

            return view('general.tablaPerfiles', compact('perfiles', 'cboEstadosPerfil', 'idPerfiles', 'paginacion'))->with('mensajeRojo', $mensaje);

        }
        else
        {

            //dd($fechaInicial, $fechaFinal);

            if (($fechaInicial == null) && ($fechaInicial == null)) 
            {
                $perfiles = Perfil::where($filtros)->get();
            }
            else
            {
                if (($fechaInicial != null) && ($fechaInicial != null)) 
                {
                    $perfiles = Perfil::where($filtros)
                                ->whereDate($fechaDe,'>=', $fechaInicial)
                                ->whereDate($fechaDe,'<=', $fechaFinal)
                                ->get();
                }
                else
                {

                }
            }

            $mensaje = 'Se aplicaron filtros...'; 
            $paginacion = 'no';

            //$cboEstadosPerfil = Perfil::select('idEstadoPerfil')->where($filtros)->distinct()->get();

            return view('general.tablaPerfiles', compact('perfiles', 'cboEstadosPerfil', 'idPerfiles', 'paginacion'))->with('mensajeVerde', $mensaje);

        }

    }

    public function todosPerfiles()
    {

        $perfiles = Perfil::paginate(10);
        $cboEstadosPerfil = Perfil::select('idEstadoPerfil')->distinct()->get();
        $idPerfiles = Perfil::distinct()->get();
        $paginacion = 'si';

        return view('general.tablaPerfiles', compact('perfiles', 'cboEstadosPerfil', 'idPerfiles', 'paginacion'));
    }

}
