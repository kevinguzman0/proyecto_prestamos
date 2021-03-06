<div class="col-md-2">
    <a href="#" class="btn btn-link link-tabla boton-acciones" data-toggle="modal" data-target="#desactivar-usuario-{{ $fila->id }}">
        <img src="{{ asset('icons/toggle-off.svg') }}" alt="Desactivar usuario" width="32" height="32" title="Desactivar usuario" />
    </a>
</div>

<div class="d-flex align-items-center col-md-10 text-left">
    <a href="#" data-toggle="modal" data-target="#desactivar-usuario-{{ $fila->id }}">
        Inactivar usuario
    </a>
</div>

<div id="desactivar-usuario-{{ $fila->id }}" class="modal fade show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-eliminar" role="document">
        <div class="modal-content modal-content-eliminar">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar desactivación de usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>El cambio de estado será permanente y el usuario estará oculto para el sistema. Toda su información no estará disponible.</p>
                <p>Desea proceder?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" onclick="location.href = '{{ action('PerfilController@usuarioInactivar', [$fila->id]) }}'">Si</button>
            </div>
        </div>
    </div>
</div>