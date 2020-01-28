<a href="#" class="btn btn-link link-tabla" data-toggle="modal" data-target="#acciones-perfil-{{ $fila->id }}">
    <img src="{{ asset('icons/tools.svg') }}" alt="Ver menú de acciones" width="24" height="24" title="Ver menú de acciones" />
</a>

<div id="acciones-perfil-{{ $fila->id }}" class="modal fade show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-eliminar" role="document">
        <div class="modal-content modal-content-acciones">
            <div class="modal-header">
                <h5 class="modal-title">Perfil [ {{ $fila->id }} ]</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="row col-md-12">
                        <div class="col-md-2">
                            <a href="{{ action('PerfilController@miPerfil', [$fila->id]) }}">
                                <img src="{{ asset('icons/search.svg') }}" alt="Ver perfil" width="24" height="24" title="Ver perfil" />
                            </a>
                        </div>
                        <div class="col-md-10 text-left">
                            <a href="{{ action('PerfilController@miPerfil', [$fila->id]) }}">Ver perfil</a>       
                        </div>

                        @hasanyrole('directivo')

                            <div class="col-md-2">
                                <a href="{{ action('CreditoController@misSolicitudes', [$fila->id]) }}">
                                    <img src="{{ asset('icons/folder-symlink.svg') }}" alt="Ver solicitudes" width="24" height="24" title="Ver solicitudes" />
                                </a>
                            </div>
                            <div class="col-md-10 text-left">
                                <a href="{{ action('CreditoController@misSolicitudes', [$fila->id]) }}">Ver solicitudes</a>
                            </div>
                            @if(($fila->id) != (Auth::user()->id))

                                <div class="col-md-2">
                                    <a href="{{ action('PerfilController@datosCorreo', [$fila->id]) }}">
                                        <img src="{{ asset('icons/envelope.svg') }}" alt="Enviar correo" width="24" height="24" title="Enviar correo" />
                                    </a>
                                </div>
                                <div class="col-md-10 text-left">
                                    <a href="{{ action('PerfilController@datosCorreo', [$fila->id]) }}">Enviar correo a cliente</a>
                                </div>
                            @endif

                            @if($fila->user->hasAnyRole('registrado'))

                                <div class="col-md-2">
                                    @include('modals.desactivar-usuario')
                                </div>
                                <div class="col-md-10 text-left">
                                    Inactivar usuario
                                </div>

                            @endif

                            @if($fila->user->hasAnyRole('inactivo'))

                                 <div class="col-md-2">
                                    @include('modals.activar-usuario')
                                </div>
                                <div class="col-md-10 text-left">
                                    Activar usuario
                                </div>
                            @endif
                            

                        @endhasanyrole

                        @hasanyrole('administrador')

                            @if($fila->user->hasAnyRole('directivo'))

                                <div class="col-md-2">
                                    @include('modals.desactivar-usuario')
                                </div>
                                <div class="col-md-10 text-left">
                                    Inactivar usuario
                                </div>
                                
                            @endif

                            @if($fila->idEstadoPerfil == 5)
                                 <div class="col-md-2">
                                   @include('modals.activar-usuario')
                                </div>
                                <div class="col-md-10 text-left">
                                    Activar usuario
                                </div>
                            @endif

                            @if ($fila->idEstadoPerfil < 4)
                                <div class="col-md-2">
                                     @include('modals.activar-directivo')
                                </div>
                                <div class="col-md-10 text-left">
                                    Convertir en Directivo
                                </div>
                            @endif

                            @if ($fila->idEstadoPerfil == 4)
                                <div class="col-md-2">
                                    @include('modals.desactivar-directivo')
                                </div>
                                <div class="col-md-10 text-left">
                                    Retirar permiso de Directivo
                                </div>
                            @endif
                        @endhasanyrole

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>