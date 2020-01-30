<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminar-documento_{{ $fila->id }}">Eliminar
</button>

<div id="eliminar-documento_{{ $fila->id }}" class="modal fade show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-eliminar" role="document">
        <div class="modal-content modal-content-eliminar">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar eliminación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align: left;">
                <p>La eliminación de este documento será irreversible.</p>
                <p>Desea proceder?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" onclick="location.href = '{{ action('CreditoController@documentoEliminar', [$fila->idSolicitud, $fila->id]) }}'">Si</button>
            </div>
        </div>
    </div>
</div>
