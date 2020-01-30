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
        $idPerfiles = Perfil::select('id')->get();
        $paginacion = 'si';

        return view('general.tablaPerfiles', compact('perfiles', 'cboEstadosPerfil', 'idPerfiles', 'paginacion'));

    }

    public function tablaUsuarios()
    {

        $usuarios = User::paginate(10);
        $idUsuarios = User::select('id')->get();
        $paginacion = 'si';

        return view('general.tablaUsuarios', compact('usuarios', 'idUsuarios', 'paginacion'));

    }

    public function tablaSolicitudes()
    {

        $solicitudes = Solicitud::paginate(10);
        return view('general.tablaSolicitudes', compact('solicitudes'));

    }

    public function tablaDocumentos()
    {

        $documentos = Documento::paginate(10);
        $cboIdSolicitud = Documento::select('idSolicitud')->distinct()->get();
        $idDocumentos = Documento::distinct()->get();
        $paginacion = 'si';

        return view('general.tablaDocumentos', compact('documentos', 'cboIdSolicitud', 'idDocumentos', 'paginacion'));

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
        $idPerfiles = Perfil::select('id')->get();
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

        $fechaInicial = $fInicial;
        $fechaFinal = $fFinal;

        if (($fInicial != null) && ($fFinal != null)) 
        {
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
        }

        if (($fInicial == null) && ($fFinal != null)) 
        {
            $fechaInicial = $fFinal;
        }

        if (($fInicial != null) && ($fFinal == null)) 
        {
            $fechaFinal = $fInicial;
        }

        $cboEstadosPerfil = Perfil::select('idEstadoPerfil')->distinct()->get();
        $idPerfiles = Perfil::select('id')->get();

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

            if (($fechaInicial == null) && ($fechaFinal == null)) 
            {
                $perfiles = Perfil::where($filtros)->get();
            }
            else
            {
                if (($fechaInicial != null) && ($fechaInicial != null)) 
                {
                    $perfiles = Perfil::where($filtros)
                                ->whereDate($fechaDe, '>=', $fechaInicial)
                                ->whereDate($fechaDe, '<=', $fechaFinal)
                                ->get();
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
        $idPerfiles = Perfil::select('id')->get();
        $paginacion = 'si';

        return view('general.tablaPerfiles', compact('perfiles', 'cboEstadosPerfil', 'idPerfiles', 'paginacion'));
    }

    public function buscadorUsuarios(Request $request)
    {

        $filtro = $request->filtro;
        $idUsuarios = User::select('id')->get();
        $paginacion = 'no';

        if (!$filtro)
        {
            $mensaje = 'No se han recibido criterios de búsqueda con el filtro. Pruebe con otra búsqueda...'; 
            $usuarios = User::paginate(10);
            return view('general.tablaUsuarios', compact('usuarios', 'idUsuarios', 'paginacion'))->with('mensajeRojo', $mensaje);
        }
        else
        {

            Builder::macro('whereLike', function($attributes, string $searchTerm) {
                foreach(Arr::wrap($attributes) as $attribute) {
                    $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                }
                return $this;
            });

            $usuarios = User::whereLike(['name', 
                                         'email'], $filtro)
                        ->get();

            $mensaje = 'La información de Usuarios visualizada está filtrada por algunos campos que contienen el texto [ ' . $filtro . ' ]... ';

            return view('general.tablaUsuarios', compact('usuarios', 'idUsuarios', 'paginacion'))->with('mensajeVerde', $mensaje);

        }

    }

    public function filtrosUsuarios(Request $request)
    {
        
        $id = $request->cboIdUsuarios;
        $verificacionEmail = $request->verificacionEmail;

        $fechaDe = $request->cboFechaDe;
        $fInicial = $request->fechaInicial;
        $fFinal = $request->fechaFinal;

        $fechaInicial = $fInicial;
        $fechaFinal = $fFinal;

        if (($fInicial != null) && ($fFinal != null)) 
        {
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
        }

        if (($fInicial == null) && ($fFinal != null)) 
        {
            $fechaInicial = $fFinal;
        }

        if (($fInicial != null) && ($fFinal == null)) 
        {
            $fechaFinal = $fInicial;
        }

        $idUsuarios = User::select('id')->get();

        $filtros = array();

        $contieneFiltros = false;

        if ($id != -1)
        {
            $filtros['id'] = $id; 
            $contieneFiltros = true;
        }

        if ($verificacionEmail != -1) 
        {
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
            $usuarios = User::paginate(10);
            $paginacion = 'si';

            return view('general.tablaUsuarios', compact('usuarios', 'idUsuarios', 'paginacion'))->with('mensajeRojo', $mensaje);

        }
        else
        {

            if (($fechaInicial == null) && ($fechaFinal == null)) 
            {
                if ($verificacionEmail == -1)
                {
                    $usuarios = User::where($filtros)->get();
                }
                else
                {
                    if ($verificacionEmail == 0)
                    {
                        $usuarios = User::where($filtros)
                                    ->whereNull('email_verified_at')
                                    ->get();
                    }
                    else
                    {
                        $usuarios = User::where($filtros)
                                    ->whereNotNull('email_verified_at')
                                    ->get();
                    }
                }
            }
            else
            {
                if (($fechaInicial != null) && ($fechaInicial != null)) 
                {
                    $usuarios = User::where($filtros)
                                ->whereDate($fechaDe, '>=', $fechaInicial)
                                ->whereDate($fechaDe, '<=', $fechaFinal)
                                ->get();
                }
             }

            $mensaje = 'Se aplicaron filtros...'; 
            $paginacion = 'no';

            return view('general.tablaUsuarios', compact('usuarios', 'idUsuarios', 'paginacion'))->with('mensajeVerde', $mensaje);

        }

    }

    public function todosUsuarios()
    {

        $usuarios = User::paginate(10);
        $idUsuarios = User::select('id')->get();
        $paginacion = 'si';

        return view('general.tablaUsuarios', compact('usuarios', 'idUsuarios', 'paginacion'));
    }

    public function buscadorDocumentos(Request $request)
    {

        $filtro = $request->filtro;
        $cboIdSolicitud = Documento::select('idSolicitud')->distinct()->get();
        $idDocumentos = Documento::distinct()->get();
        $paginacion = 'no';

        if (!$filtro)
        {
            $mensaje = 'No se han recibido criterios de búsqueda con el filtro. Pruebe con otra búsqueda...'; 

            $documentos = Documento::paginate(10);

            return view('general.tablaDocumentos', compact('documentos', 'cboIdSolicitud', 'idDocumentos', 'paginacion'))->with('mensajeRojo', $mensaje);
        }
        else
        {

            Builder::macro('whereLike', function($attributes, string $searchTerm) {
                foreach(Arr::wrap($attributes) as $attribute) {
                    $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                }
                return $this;
            });

            $documentos = Documento::whereLike(['archivoOriginal', 
                                           'descripcionDocumento'], $filtro)
                        ->get();

            $mensaje = 'La información de Documentos visualizada está filtrada por algunos campos que contienen el texto [ ' . $filtro . ' ]... ';

            return view('general.tablaDocumentos', compact('documentos', 'cboIdSolicitud', 'idDocumentos', 'paginacion'))->with('mensajeVerde', $mensaje);

        }

    }

    public function filtrosDocumentos(Request $request)
    {

        $id = $request->cboIdDocumentos;
        $idSolicitud = $request->cboIdSolicitud;
        $procesoDocumento = $request->procesoDocumento;
        $estadoDocumento = $request->estadoDocumento;

        $analizadoPor = $request->cboAnalizadoPor;

        $fechaDe = $request->cboFechaDe;
        $fInicial = $request->fechaInicial;
        $fFinal = $request->fechaFinal;

        $fechaInicial = $fInicial;
        $fechaFinal = $fFinal;

        if (($fInicial != null) && ($fFinal != null)) 
        {
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
        }

        if (($fInicial == null) && ($fFinal != null)) 
        {
            $fechaInicial = $fFinal;
        }

        if (($fInicial != null) && ($fFinal == null)) 
        {
            $fechaFinal = $fInicial;
        }

        $cboIdSolicitud = Documento::select('idSolicitud')->distinct()->get();
        $idDocumentos = Documento::distinct()->get();

        $filtros = array();

        $contieneFiltros = false;

        if ($id != -1)
        {
            $filtros['id'] = $id; 
            $contieneFiltros = true;
        }

        if ($idSolicitud != -1) 
        {
            $filtros['idSolicitud'] = $idSolicitud;
            $contieneFiltros = true;
        } 

        if ($procesoDocumento != -1) 
        {
            $filtros['procesoDocumento'] = $procesoDocumento;
            $contieneFiltros = true;
        } 

        if ($estadoDocumento != -1) 
        {
            $filtros['estadoDocumento'] = $estadoDocumento;
            $contieneFiltros = true;
        } 

        if ($analizadoPor != -1) 
        {
            $filtros['analizadoPor'] = $analizadoPor;
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
            $documentos = Documento::paginate(10);
            $paginacion = 'si';

            return view('general.tablaDocumentos', compact('documentos', 'cboIdSolicitud', 'idDocumentos', 'paginacion'))->with('mensajeRojo', $mensaje);

        }
        else
        {

            if (($fechaInicial == null) && ($fechaFinal == null)) 
            {
                $documentos = Documento::where($filtros)->get();
            }
            else
            {
                if (($fechaInicial != null) && ($fechaInicial != null)) 
                {
                    $documentos = Perfil::where($filtros)
                                ->whereDate($fechaDe,'>=', $fechaInicial)
                                ->whereDate($fechaDe,'<=', $fechaFinal)
                                ->get();
                }
             }

            $mensaje = 'Se aplicaron filtros...'; 
            $paginacion = 'no';

            //$cboEstadosPerfil = Perfil::select('idEstadoPerfil')->where($filtros)->distinct()->get();

            return view('general.tablaDocumentos', compact('documentos', 'cboIdSolicitud', 'idDocumentos', 'paginacion'))->with('mensajeVerde', $mensaje);

        }

    }


    public function todosDocumentos()
    {

        $documentos = Documento::paginate(10);
        $cboIdSolicitud = Documento::select('idSolicitud')->distinct()->get();
        $idDocumentos = Documento::distinct()->get();
        $paginacion = 'si';

        return view('general.tablaDocumentos', compact('documentos', 'cboIdSolicitud', 'idDocumentos', 'paginacion'));

    }

}
