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
        $idEstadosSolicitudes = Solicitud::select('idEstadoSolicitud')->distinct()->get();
        $cboIdClientes = Solicitud::select('idCliente')->distinct()->get();
        $cboPlazo = Solicitud::select('plazo')->distinct()->get();
        $cboInteres = Solicitud::select('interes')->distinct()->get();
        $cboIdAnalizadoPor = Solicitud::select('idAnalizadoPor')->whereNotNull('idAnalizadoPor')->distinct()->get();
        $idSolicitudes = Solicitud::select('id')->distinct()->get();
        $paginacion = 'si';

        return view('general.tablaSolicitudes', compact('solicitudes', 'idEstadosSolicitudes', 'cboIdClientes', 'idSolicitudes', 'cboPlazo', 'cboInteres', 'cboIdAnalizadoPor', 'paginacion'));

    }

    public function tablaDocumentos()
    {

        $documentos = Documento::paginate(10);
        $cboIdSolicitud = Documento::select('idSolicitud')->distinct()->get();
        $idDocumentos = Documento::select('id')->get();
        $idAnalizadoPor = Documento::select('idAnalizadoPor')->whereNotNull('idAnalizadoPor')->distinct()->get();
        $idClientes = Documento::distinct('idCliente')->get();
        $paginacion = 'si';

        return view('general.tablaDocumentos', compact('documentos', 'cboIdSolicitud', 'idDocumentos', 'idAnalizadoPor', 'idClientes', 'paginacion'));

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
        $filtroConFechas = false;

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
            $filtroConFechas = true;
        } 

        if ($fechaFinal != null) 
        {
            $contieneFiltros = true;
            $filtroConFechas = true;
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

            $perfiles = Perfil::where($filtros)
                           ->where(function ($query) 
                                 use ($fechaDe, $fechaInicial, $fechaFinal, $filtroConFechas) {   
                                 if ($filtroConFechas)
                                    {
                                        $query->whereDate($fechaDe, '>=', $fechaInicial)
                                              ->whereDate($fechaDe, '<=', $fechaFinal);
                                    }
                             })
                           ->get();

            $mensaje = 'Se aplicaron filtros...'; 
            $paginacion = 'no';

            return view('general.tablaPerfiles', compact('perfiles', 'cboEstadosPerfil', 'idPerfiles', 'paginacion'))->with('mensajeVerde', $mensaje);

        }

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
        $filtroConFechas = false;
        $filtroConEmail = false;

        if ($id != -1)
        {
            $filtros['id'] = $id; 
            $contieneFiltros = true;
        }

        if ($verificacionEmail != -1) 
        {
            $contieneFiltros = true;
            $filtroConEmail = true;
        } 

        if ($fechaInicial != null) 
        {
            $contieneFiltros = true;
            $filtroConFechas = true;
        } 

        if ($fechaFinal != null) 
        {
            $contieneFiltros = true;
            $filtroConFechas = true;
        }

        //dd($request, $filtros, $contieneFiltros);

        if ($contieneFiltros == false)
        {

            $mensaje = 'No se han aplicado filtros...'; 
            $usuarios = User::paginate(10);
            $paginacion = 'si';

            return view('general.tablaUsuarios', compact('usuarios', 'idUsuarios', 'paginacion'))->with('mensajeRojo', $mensaje);

        }
        else
        {

            $usuarios = User::where($filtros)
                           ->where(function ($query) 
                                 use ($fechaDe, $fechaInicial, $fechaFinal, $filtroConFechas) {   
                                 if ($filtroConFechas)
                                    {
                                        $query->whereDate($fechaDe, '>=', $fechaInicial)
                                              ->whereDate($fechaDe, '<=', $fechaFinal);
                                    }
                             })
                           ->where(function ($query) 
                                 use ($filtroConEmail, $verificacionEmail) {
                                 if ($filtroConEmail)
                                    {
                                        if ($verificacionEmail == 0)
                                        {
                                            $query->whereNull('email_verified_at');
                                        }
                                    
                                        if ($verificacionEmail == 1)
                                        {
                                            $query->whereNotNull('email_verified_at');
                                        }
                                    }
                             })
                           ->get();

            $mensaje = 'Se aplicaron filtros...'; 
            $paginacion = 'no';

            return view('general.tablaUsuarios', compact('usuarios', 'idUsuarios', 'paginacion'))->with('mensajeVerde', $mensaje);

        }

    }

    public function buscadorDocumentos(Request $request)
    {

        $filtro = $request->filtro;
        $cboIdSolicitud = Documento::select('idSolicitud')->distinct()->get();
        $idDocumentos = Documento::select('id')->get();
        $idAnalizadoPor = Documento::select('idAnalizadoPor')->whereNotNull('idAnalizadoPor')->distinct()->get();
        $idClientes = Documento::distinct('idCliente')->get();
        $paginacion = 'no';

        if (!$filtro)
        {
            $mensaje = 'No se han recibido criterios de búsqueda con el filtro. Pruebe con otra búsqueda...'; 

            $documentos = Documento::paginate(10);

            return view('general.tablaDocumentos', compact('documentos', 'cboIdSolicitud', 'idDocumentos', 'idAnalizadoPor', 'idClientes', 'paginacion'))->with('mensajeRojo', $mensaje);
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

            return view('general.tablaDocumentos', compact('documentos', 'cboIdSolicitud', 'idDocumentos', 'idAnalizadoPor', 'idClientes', 'paginacion'))->with('mensajeVerde', $mensaje);

        }

    }

    public function filtrosDocumentos(Request $request)
    {

        $id = $request->cboIdDocumentos;
        $idSolicitud = $request->cboIdSolicitud;
        $procesoDocumento = $request->procesoDocumento;
        $estadoDocumento = $request->estadoDocumento;
        $analizadoPor = $request->cboAnalizadoPor;
        $idCliente = $request->cboCliente;
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
        $idDocumentos = Documento::select('id')->get();
        $idAnalizadoPor = Documento::select('idAnalizadoPor')->whereNotNull('idAnalizadoPor')->distinct()->get();
        $idClientes = Documento::distinct('idCliente')->get();

        $filtros = array();

        $contieneFiltros = false;
        $filtroConFechas = false;
        $filtroAnalizadoPor = false;

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
            $filtros['revisado'] = $procesoDocumento;
            $contieneFiltros = true;
        } 

        if ($estadoDocumento != -2) 
        {
            $filtros['aprobado'] = $estadoDocumento;
            $contieneFiltros = true;
        } 

        if ($analizadoPor > 0) 
        {
            $filtros['idAnalizadoPor'] = $analizadoPor;
            $contieneFiltros = true;
        }
        else{
            if ($analizadoPor == -2) {
                $contieneFiltros = true;
                $filtroAnalizadoPor = true;
            }
        }

        if ($idCliente != -1) 
        {
            $filtros['idCliente'] = $idCliente;
            $contieneFiltros = true;
        } 

        if ($fechaInicial != null) 
        {
            $contieneFiltros = true;
            $filtroConFechas = true;
        } 

        if ($fechaFinal != null) 
        {
            $contieneFiltros = true;
            $filtroConFechas = true;
        }

        if ($contieneFiltros == false)
        {

            $mensaje = 'No se han aplicado filtros...'; 
            $documentos = Documento::paginate(10);
            $paginacion = 'si';

            return view('general.tablaDocumentos', compact('documentos', 'cboIdSolicitud', 'idDocumentos', 'idAnalizadoPor', 'idClientes', 'paginacion'))->with('mensajeRojo', $mensaje);

        }
        else
        {

            $documentos = Documento::where($filtros)
                           ->where(function ($query) 
                                 use ($fechaDe, $fechaInicial, $fechaFinal, $filtroConFechas) {   
                                 if ($filtroConFechas)
                                    {
                                        $query->whereDate($fechaDe, '>=', $fechaInicial)
                                              ->whereDate($fechaDe, '<=', $fechaFinal);
                                    }
                             })
                           ->where(function ($query) 
                                 use ($filtroAnalizadoPor) {
                                 if ($filtroAnalizadoPor)
                                    {
                                        $query->whereNull('idAnalizadoPor');
                                    }
                             })
                           ->get();

            $mensaje = 'Se aplicaron filtros...'; 
            $paginacion = 'no';

            return view('general.tablaDocumentos', compact('documentos', 'cboIdSolicitud', 'idDocumentos', 'idAnalizadoPor', 'idClientes', 'paginacion'))->with('mensajeVerde', $mensaje);

        }

    }

    public function buscadorSolicitudes(Request $request)
    {

        $filtro = $request->filtro;
        $cboClienteSolicitudes = Solicitud::select('idCliente')->distinct()->get();
        $idSolicitudes = Solicitud::select('id')->distinct()->get();
        $cboIdAnalizadoPor = Solicitud::select('idAnalizadoPor')->whereNotNull('idAnalizadoPor')->distinct()->get();
        $cboPlazo = Solicitud::select('plazo')->distinct()->get();
        $cboInteres = Solicitud::select('interes')->distinct()->get();
        $paginacion = 'no';

        if (!$filtro)
        {
            $mensaje = 'No se han recibido criterios de búsqueda con el filtro. Pruebe con otra búsqueda...'; 
            $solicitudes = Solicitud::paginate(10);
            return view('general.tablaSolicitudes', compact('solcitudes', 'cboClienteSolicitudes', 'idSolicitudes', 'cboIdAnalizadoPor', 'cboPlazo', 'cboInteres', 'paginacion'))->with('mensajeRojo', $mensaje);
        }
        else
        {

            Builder::macro('whereLike', function($attributes, string $searchTerm) {
                foreach(Arr::wrap($attributes) as $attribute) {
                    $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                }
                return $this;
            });

            $solicitudes = Solicitud::whereLike(['monto', 
                                           'plazo',
                                           'cuota'], $filtro)
                        ->get();

            $mensaje = 'La información de Solicitudes visualizada está filtrada por algunos campos que contienen el texto [ ' . $filtro . ' ]... ';

            return view('general.tablaSolicitudes', compact('solicitudes', 'cboClienteSolicitudes', 'idSolicitudes', 'cboIdAnalizadoPor', 'cboPlazo', 'cboInteres', 'paginacion'))->with('mensajeVerde', $mensaje);

        }

    }

    public function filtrosSolicitudes(Request $request)
    {
        
        $id = $request->cboIdSolicitudes;
        $idCliente = $request->cboIdCliente;
        $idEstadoSolicitud = $request->cboIdEstadosSolicitudes;
        $idAnalizadoPor = $request->cboIdAnalizadoPor;
        $plazo = $request->cboPlazo;      
        $interes = $request->cboInteres;  

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

        $valorDe = $request->cboValorDe;
        $vInicial = $request->valorInicial;
        $vFinal = $request->valorFinal;

        $valorInicial = $vInicial;
        $valorFinal = $vFinal;

        if (($vInicial != null) && ($vFinal != null)) 
        {
            if ($vInicial < $vFinal)
            {
                $valorInicial = $vInicial;
                $valorFinal = $vFinal;
            }
            else
            {
                $valorInicial = $vFinal;
                $valorFinal = $vInicial;
            }
        }

        if (($vInicial == null) && ($vFinal != null)) 
        {
            $valorInicial = $vFinal;
        }

        if (($vInicial != null) && ($vFinal == null)) 
        {
            $valorFinal = $vInicial;
        }        

        $cboIdClientes = Solicitud::select('idCliente')->distinct()->get();
        $idSolicitudes = Solicitud::select('id')->distinct()->get();
        $idEstadosSolicitudes = Solicitud::select('idEstadoSolicitud')->distinct()->get();
        $cboIdAnalizadoPor = Solicitud::select('idAnalizadoPor')->whereNotNull('idAnalizadoPor')->distinct()->get();
        $cboPlazo = Solicitud::select('plazo')->distinct()->get();
        $cboInteres = Solicitud::select('interes')->distinct()->get();

        $filtros = array();

        $contieneFiltros = false;
        $filtroConFechas = false;
        $filtroConNumeros = false;

        if ($id != -1)
        {
            $filtros['id'] = $id; 
            $contieneFiltros = true;
        }

        if ($idEstadoSolicitud != -1) 
        {
            $filtros['idEstadoSolicitud'] = $idEstadoSolicitud;
            $contieneFiltros = true;
        }

        if ($idCliente != -1) 
        {
            $filtros['idCliente'] = $idCliente;
            $contieneFiltros = true;
        }

        if ($plazo != -1) 
        {
            $filtros['plazo'] = $plazo;
            $contieneFiltros = true;
        }

        if ($interes != -1) 
        {
            $filtros['interes'] = $interes;
            $contieneFiltros = true;
        }

        if ($idAnalizadoPor != -1)
        {
            $filtros['idAnalizadoPor'] = $idAnalizadoPor;
            $contieneFiltros = true;
        }

        if ($fechaInicial != null) 
        {
            $contieneFiltros = true;
            $filtroConFechas = true;
        } 

        if ($fechaFinal != null) 
        {
            $contieneFiltros = true;
            $filtroConFechas = true;
        }

        if ($valorInicial != null) 
        {
            $contieneFiltros = true;
            $filtroConNumeros = true;
        } 

        if ($valorFinal != null) 
        {
            $contieneFiltros = true;
            $filtroConNumeros = true;
        }

        if ($contieneFiltros == false)
        {

            $mensaje = 'No se han aplicado filtros...'; 
            $solicitudes = Solicitud::paginate(10);
            $paginacion = 'si';

            return view('general.tablaSolicitudes', compact('solicitudes', 'idSolicitudes', 'cboIdClientes','idEstadosSolicitudes', 'cboIdAnalizadoPor', 'cboPlazo', 'cboInteres', 'paginacion'))->with('mensajeRojo', $mensaje);

        }
        else
        {

            $solicitudes = Solicitud::where($filtros)
                           ->where(function ($query) 
                                 use ($fechaDe, $fechaInicial, $fechaFinal, $filtroConFechas) {   
                                 if ($filtroConFechas)
                                    {
                                        $query->whereDate($fechaDe, '>=', $fechaInicial)
                                              ->whereDate($fechaDe, '<=', $fechaFinal);
                                    }
                             })
                           ->where(function ($query) 
                                 use ($valorDe, $valorInicial, $valorFinal, $filtroConNumeros) {
                                 if ($filtroConNumeros)
                                    {
                                        $query->where($valorDe, '>=', $valorInicial)
                                              ->where($valorDe, '<=', $valorFinal);
                                    }
                             })
                           ->get();

            $mensaje = 'Se aplicaron filtros...'; 
            $paginacion = 'no';

            return view('general.tablaSolicitudes', compact('solicitudes', 'idSolicitudes', 'cboIdClientes','idEstadosSolicitudes', 'cboIdAnalizadoPor', 'cboPlazo', 'cboInteres', 'paginacion'))->with('mensajeVerde', $mensaje);

        }

    }

}
