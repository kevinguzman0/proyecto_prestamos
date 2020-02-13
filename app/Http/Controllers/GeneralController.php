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
        $idPerfiles = Perfil::select('id')->get();
        $paginacion = 'si';

        return view('general.tablaPerfiles', compact('perfiles', 'idPerfiles', 'paginacion'));

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
        $idClientes = Solicitud::select('idCliente')->distinct()->get();
        $listaPlazos = Solicitud::select('plazo')->distinct()->get();
        $listaIntereses = Solicitud::select('interes')->distinct()->get();
        $idAnalizadosPor = Solicitud::select('idAnalizadoPor')->whereNotNull('idAnalizadoPor')->distinct()->get();
        $idSolicitudes = Solicitud::select('id')->distinct()->get();
        $paginacion = 'si';

        return view('general.tablaSolicitudes', compact('solicitudes', 'idEstadosSolicitudes', 'idClientes', 'idSolicitudes', 'listaPlazos', 'listaIntereses', 'idAnalizadosPor', 'paginacion'));

    }

    public function tablaDocumentos()
    {

        $documentos = Documento::paginate(10);
        $idSolicitudes = Documento::select('idSolicitud')->distinct()->get();
        $idDocumentos = Documento::select('id')->get();
        $idAnalizadosPor = Documento::select('idAnalizadoPor')->whereNotNull('idAnalizadoPor')->distinct()->get();
        $idClientes = Documento::select('idCliente')->distinct()->get();
        $paginacion = 'si';

        return view('general.tablaDocumentos', compact('documentos', 'idSolicitudes', 'idDocumentos', 'idAnalizadosPor', 'idClientes', 'paginacion'));

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
        $idPerfiles = Perfil::select('id')->get();
        $paginacion = 'no';

        if (!$filtro)
        {
            $mensaje = 'No se han recibido criterios de búsqueda con el filtro. Pruebe con otra búsqueda...'; 
            $perfiles = Perfil::paginate(10);
            return view('general.tablaPerfiles', compact('perfiles', 'idPerfiles', 'paginacion'))->with('mensajeRojo', $mensaje);
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

            return view('general.tablaPerfiles', compact('perfiles', 'idPerfiles', 'paginacion'))->with('mensajeVerde', $mensaje);

        }

    }

    public function filtrosPerfiles(Request $request)
    {
        
        $idPerfil = $request->idPerfil;
        $afiliadoFondo = $request->afiliadoFondo;
        $conSolicitudes = $request->conSolicitudes;
        $conDocumentos = $request->conDocumentos;
        $fechaDe = $request->fechaDe;
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

        $idPerfiles = Perfil::select('id')->get();

        $filtros = array();

        $contieneFiltros = false;
        $filtroConFechas = false;
        $filtroConSolicitudes = false;
        $filtroConDocumentos = false;

        if ($idPerfil != -1)
        {
            $filtros['id'] = $idPerfil; 
            $contieneFiltros = true;
        }

        if ($afiliadoFondo != -1) 
        {
            $filtros['afiliadoFondo'] = $afiliadoFondo;
            $contieneFiltros = true;
        } 

        if ($conSolicitudes != -1) 
        {
            $contieneFiltros = true;
            $filtroConSolicitudes = true;
        } 

        if ($conDocumentos != -1) 
        {
            $contieneFiltros = true;
            $filtroConDocumentos = true;
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

            return view('general.tablaPerfiles', compact('perfiles', 'idPerfiles', 'paginacion'))->with('mensajeRojo', $mensaje);

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
                           ->where(function ($query) 
                                 use ($filtroConSolicitudes, $conSolicitudes) {   
                                 if ($filtroConSolicitudes)
                                    {
                                        $idSolicitudes = Solicitud::pluck('idCliente')->all();

                                        if ($conSolicitudes == 0)
                                        {
                                            $query->whereNotIn('id', $idSolicitudes)->select('id')->get();
                                        }
                                    
                                        if ($conSolicitudes == 1)
                                        {
                                            $query->whereIn('id', $idSolicitudes)->select('id')->get();
                                        }
                                    }
                             })
                           ->where(function ($query) 
                                 use ($filtroConDocumentos, $conDocumentos) {   
                                 if ($filtroConDocumentos)
                                    {
                                        $idDocumentos = Documento::pluck('idCliente')->all();

                                        if ($conDocumentos == 0)
                                        {
                                            $query->whereNotIn('id', $idDocumentos)->select('id')->get();
                                        }
                                    
                                        if ($conDocumentos == 1)
                                        {
                                            $query->whereIn('id', $idDocumentos)->select('id')->get();
                                        }
                                    }
                             })
                           ->get();

            $mensaje = 'Se aplicaron filtros...'; 
            $paginacion = 'no';

            return view('general.tablaPerfiles', compact('perfiles', 'idPerfiles', 'paginacion'))->with('mensajeVerde', $mensaje);

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
        
        $idUsuario = $request->idUsuario;
        $verificacionEmail = $request->verificacionEmail;
        $estadoUsuario = $request->estadoUsuario;
        $fechaDe = $request->fechaDe;
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
        $filtroConEstado = false;

        if ($idUsuario != -1)
        {
            $filtros['id'] = $idUsuario; 
            $contieneFiltros = true;
        }

        if ($verificacionEmail != -1) 
        {
            $contieneFiltros = true;
            $filtroConEmail = true;
        } 

        if ($estadoUsuario != -1) 
        {
            $contieneFiltros = true;
            $filtroConEstado = true;
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
                           ->where(function ($query) 
                                 use ($filtroConEstado, $estadoUsuario) {   
                                 if ($filtroConEstado)
                                    {
                                        $query->role($estadoUsuario);
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
        $idSolicitudes = Documento::select('idSolicitud')->distinct()->get();
        $idDocumentos = Documento::select('id')->get();
        $idAnalizadosPor = Documento::select('idAnalizadoPor')->whereNotNull('idAnalizadoPor')->distinct()->get();
        $idClientes = Documento::select('idCliente')->distinct()->get();
        $paginacion = 'no';

        if (!$filtro)
        {
            $mensaje = 'No se han recibido criterios de búsqueda con el filtro. Pruebe con otra búsqueda...'; 

            $documentos = Documento::paginate(10);

            return view('general.tablaDocumentos', compact('documentos', 'idSolicitudes', 'idDocumentos', 'idAnalizadosPor', 'idClientes', 'paginacion'))->with('mensajeRojo', $mensaje);
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

            return view('general.tablaDocumentos', compact('documentos', 'idSolicitudes', 'idDocumentos', 'idAnalizadosPor', 'idClientes', 'paginacion'))->with('mensajeVerde', $mensaje);

        }

    }

    public function filtrosDocumentos(Request $request)
    {

        $idDocumento = $request->idDocumento;
        $idSolicitud = $request->idSolicitud;
        $procesoDocumento = $request->procesoDocumento;
        $estadoDocumento = $request->estadoDocumento;
        $analizadoPor = $request->idAnalizadoPor;
        $idCliente = $request->idCliente;
        $fechaDe = $request->fechaDe;
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

        $idSolicitudes = Documento::select('idSolicitud')->distinct()->get();
        $idDocumentos = Documento::select('id')->get();
        $idAnalizadoPor = Documento::select('idAnalizadoPor')->whereNotNull('idAnalizadoPor')->distinct()->get();
        $idClientes = Documento::select('idCliente')->distinct()->get();

        $filtros = array();

        $contieneFiltros = false;
        $filtroConFechas = false;
        $filtroAnalizadoPor = false;

        if ($idDocumento != -1)
        {
            $filtros['id'] = $idDocumento; 
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

            return view('general.tablaDocumentos', compact('documentos', 'idSolicitudes', 'idDocumentos', 'idAnalizadosPor', 'idClientes', 'paginacion'))->with('mensajeRojo', $mensaje);

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

            return view('general.tablaDocumentos', compact('documentos', 'idSolicitudes', 'idDocumentos', 'idAnalizadosPor', 'idClientes', 'paginacion'))->with('mensajeVerde', $mensaje);

        }

    }

    public function buscadorSolicitudes(Request $request)
    {

        $filtro = $request->filtro;
        $idClientes = Solicitud::select('idCliente')->distinct()->get();
        $idSolicitudes = Solicitud::select('id')->distinct()->get();
        $idAnalizadosPor = Solicitud::select('idAnalizadoPor')->whereNotNull('idAnalizadoPor')->distinct()->get();
        $listaPlazos = Solicitud::select('plazo')->distinct()->get();
        $listaIntereses = Solicitud::select('interes')->distinct()->get();
        $paginacion = 'no';

        if (!$filtro)
        {
            $mensaje = 'No se han recibido criterios de búsqueda con el filtro. Pruebe con otra búsqueda...'; 
            $solicitudes = Solicitud::paginate(10);
            return view('general.tablaSolicitudes', compact('solcitudes', 'idClientes', 'idSolicitudes', 'idAnalizadosPor', 'listaPlazos', 'listaIntereses', 'paginacion'))->with('mensajeRojo', $mensaje);
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

            return view('general.tablaSolicitudes', compact('solicitudes', 'idClientes', 'idSolicitudes', 'idAnalizadosPor', 'listaPlazo', 'listaInteres', 'paginacion'))->with('mensajeVerde', $mensaje);

        }

    }

    public function filtrosSolicitudes(Request $request)
    {
        
        $idSolicitud = $request->idSolicitud;
        $idCliente = $request->idCliente;
        $idEstadoSolicitud = $request->idEstadoSolicitud;
        $idAnalizadoPor = $request->idAnalizadoPor;
        $conDocumentos = $request->conDocumentos;
        $plazo = $request->plazo;      
        $interes = $request->interes;  

        $fechaDe = $request->fechaDe;
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

        $valorDe = $request->valorDe;
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

        $idClientes = Solicitud::select('idCliente')->distinct()->get();
        $idSolicitudes = Solicitud::select('id')->distinct()->get();
        $idEstadosSolicitudes = Solicitud::select('idEstadoSolicitud')->distinct()->get();
        $idAnalizadosPor = Solicitud::select('idAnalizadoPor')->whereNotNull('idAnalizadoPor')->distinct()->get();
        $listaPlazos = Solicitud::select('plazo')->distinct()->get();
        $listaIntereses = Solicitud::select('interes')->distinct()->get();

        $filtros = array();

        $contieneFiltros = false;
        $filtroConFechas = false;
        $filtroConNumeros = false;
        $filtroConDocumentos = false;

        if ($idSolicitud != -1)
        {
            $filtros['id'] = $idSolicitud; 
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

        if ($conDocumentos != -1) 
        {
            $contieneFiltros = true;
            $filtroConDocumentos = true;
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

            return view('general.tablaSolicitudes', compact('solicitudes', 'idSolicitudes', 'idClientes','idEstadosSolicitudes', 'idAnalizadosPor', 'listaPlazos', 'listaIntereses', 'paginacion'))->with('mensajeRojo', $mensaje);

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
                           ->where(function ($query) 
                                 use ($filtroConDocumentos, $conDocumentos) {   
                                 if ($filtroConDocumentos)
                                    {
                                        $idDocumentos = Documento::pluck('idCliente')->all();

                                        if ($conDocumentos == 0)
                                        {
                                            $query->whereNotIn('id', $idDocumentos)->select('id')->get();
                                        }
                                    
                                        if ($conDocumentos == 1)
                                        {
                                            $query->whereIn('id', $idDocumentos)->select('id')->get();
                                        }
                                    }
                             })
                           ->get();

            $mensaje = 'Se aplicaron filtros...'; 
            $paginacion = 'no';

            return view('general.tablaSolicitudes', compact('solicitudes', 'idSolicitudes', 'idClientes','idEstadosSolicitudes', 'idAnalizadosPor', 'listaPlazos', 'listaIntereses', 'paginacion'))->with('mensajeVerde', $mensaje);

        }

    }

}
