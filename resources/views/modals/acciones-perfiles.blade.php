<a href="#" class="btn btn-link link-tabla boton-acciones" data-toggle="modal" data-target="#acciones-perfil-{{ $fila->id }}">
    <img src="{{ asset('icons/tools.svg') }}" alt="Ver menú de acciones" width="32" height="32" title="Ver menú de acciones" />
</a>

<div id="acciones-perfil-{{ $fila->id }}" class="modal fade show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-eliminar" role="document">
        <div class="modal-content modal-content-acciones">
            <div class="modal-header">
                <h5 class="modal-title">Perfil [ {{ $fila->id }} - {{ $fila->nombres }} {{ $fila->apellidos }} ]</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="row col-md-12">

                        <div class="col-md-2">
                            <a href="{{ action('PerfilController@miPerfil', [$fila->id]) }}">
                                <img src="{{ asset('icons/person-fill.svg') }}" alt="Ver perfil" width="32" height="32" title="Ver perfil" />
                            </a>
                        </div>
                        <div class="d-flex align-items-center col-md-10 text-left">
                            <a href="{{ action('PerfilController@miPerfil', [$fila->id]) }}">Ver perfil</a>       
                        </div>

                        @hasanyrole('directivo')

                            @if(App\Perfil::find($fila->id)->solicitudes->count() > 0)

                                <div class="col-md-2">
                                    <a href="{{ action('CreditoController@misSolicitudes', [$fila->id]) }}">
                                        <img src="{{ asset('icons/list-ol.svg') }}" alt="Ver solicitudes" width="32" height="32" title="Ver solicitudes" />
                                    </a>
                                </div>
                                <div class="d-flex align-items-center col-md-10 text-left">
                                    <a href="{{ action('CreditoController@misSolicitudes', [$fila->id]) }}">Ver solicitudes</a>
                                </div>

                            @endif

                            @if(($fila->id) != (Auth::user()->id))

                                <div class="col-md-2">
                                    <a href="{{ action('PerfilController@datosCorreo', [$fila->id]) }}">
                                        <img src="{{ asset('icons/envelope.svg') }}" alt="Enviar correo" width="32" height="32" title="Enviar correo" />
                                    </a>
                                </div>
                                <div class="d-flex align-items-center col-md-10 text-left">
                                    <a href="{{ action('PerfilController@datosCorreo', [$fila->id]) }}">Enviar correo a cliente</a>
                                </div>
                            @endif

                            @if($fila->user->hasRole('registrado'))
                                @include('modals.desactivar-usuario')
                            @endif

                            @if($fila->user->hasRole('inactivo'))

                                @include('modals.activar-usuario')

                            @endif

                        @endhasanyrole

                        @hasanyrole('administrador')

                            @if($fila->user->hasRole('directivo'))
                                @include('modals.desactivar-usuario')
                            @endif

                            @if($fila->user->hasRole('inactivo'))
                                @include('modals.activar-usuario')
                            @endif

                            @if($fila->user->hasRole('registrado'))
                                 @include('modals.activar-directivo')
                            @endif

                            @if($fila->user->hasRole('directivo'))
                                @include('modals.desactivar-directivo')
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