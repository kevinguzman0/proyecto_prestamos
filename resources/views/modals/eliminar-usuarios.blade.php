<a href="#" class="btn btn-link link-tabla boton-acciones" data-toggle="modal" data-target="#eliminar-usuario-{{ $fila->id }}">
    <img src="{{ asset('icons/trash.svg') }}" alt="Eliminar usuario" width="32" height="32" title="Eliminar usuario" />
</a>

<div id="eliminar-usuario-{{ $fila->id }}" class="modal fade show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-eliminar" role="document">
        <div class="modal-content modal-content-eliminar">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar eliminación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>La eliminación de este usuario será irreversible.</p>
                <p>Desea proceder?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" onclick="location.href = '{{ route('usuario.eliminar', [$fila->id]) }}'">Si</button>
            </div>
        </div>
    </div>
</div>