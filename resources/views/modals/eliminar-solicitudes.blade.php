@if($tipo == 'modal')
    <div class="col-md-2">
        <a href="#" class="btn btn-link link-tabla boton-acciones" data-toggle="modal" data-target="#eliminar-solicitud-{{ $fila->id }}">
            <img src="{{ asset('icons/trash.svg') }}" alt="Eliminar solicitud" width="32" height="32" title="Eliminar solicitud" />
        </a>
    </div>

    <div class="d-flex align-items-center col-md-10 text-left">
        <a href="#" data-toggle="modal" data-target="#eliminar-solicitud-{{ $fila->id }}">Eliminar solicitud</a>
    </div>
@endif

@if($tipo == 'acciones')
    <a href="#" class="btn btn-link link-tabla boton-acciones" data-toggle="modal" data-target="#eliminar-solicitud-{{ $fila->id }}">
        <img src="{{ asset('icons/trash.svg') }}" alt="Eliminar solicitud" width="32" height="32" title="Eliminar solicitud" />
    </a>
@endif

<div id="eliminar-solicitud-{{ $fila->id }}" class="modal fade show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-eliminar" role="document">
        <div class="modal-content modal-content-eliminar">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar eliminación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>La eliminación de esta solicitud será irreversible. Adicionalmente, serán eliminados todos los documentos asociados que hayan sido presentados.</p>
                <p>Desea proceder?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" onclick="location.href = '{{ route('solicitud.eliminar', [$fila->idCliente, $fila->id]) }}'">Si</button>
            </div>
        </div>
    </div>
</div>