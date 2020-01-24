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
                            Ver perfil
                        </div>
                        <div class="col-md-2">
                            <a href="{{ action('CreditoController@misSolicitudes', [$fila->id]) }}">
                                <img src="{{ asset('icons/folder-symlink.svg') }}" alt="Ver solicitudes" width="24" height="24" title="Ver solicitudes" />
                            </a>
                        </div>
                        <div class="col-md-10 text-left">
                            Ver solicitudes
                        </div>
                        <div class="col-md-2">
                            <a href="{{ action('CreditoController@usuarioInactivo', [$fila->id]) }}">
                                <img src="{{ asset('icons/toggle-off.svg') }}" alt="Inactivar usuario" width="24" height="24" title="Inactivar usuario" />
                            </a>
                        </div>
                        <div class="col-md-10 text-left">
                            Inactivar usuario
                        </div>
                        <div class="col-md-2">
                            <a href="{{ action('CreditoController@usuarioDirectivo', [$fila->id]) }}">
                                <img src="{{ asset('icons/bookmark.svg') }}" alt="Convertir en Directivo" width="24" height="24" title="Convertir en Directivo" />
                            </a>
                        </div>
                        <div class="col-md-10 text-left">
                            Convertir en Directivo
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>