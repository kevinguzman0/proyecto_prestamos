<div class="col-md-2">
    <a href="#" data-toggle="modal" data-target="#activar-usuario-{{ $fila->id }}">
        <img src="{{ asset('icons/toggle-on.svg') }}" alt="Activar usuario" width="24" height="24" title="Activar usuario" />
    </a>
</div>
<div class="col-md-10 text-left">
    Activar usuario
</div>

<div id="activar-usuario-{{ $fila->id }}" class="modal fade show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-eliminar" role="document">
        <div class="modal-content modal-content-eliminar">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar activación de usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>El cambio de estado será permanente y el usuario estará nuevamente disponible en el sistema.</p>
                <p>Desea proceder?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" onclick="location.href = '{{ action('PerfilController@usuarioActivar', [$fila->id]) }}'">Si</button>
            </div>
        </div>
    </div>
</div>