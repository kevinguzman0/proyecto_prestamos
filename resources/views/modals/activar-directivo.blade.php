<div class="col-md-2">
    <a href="#" class="btn btn-link link-tabla boton-acciones" data-toggle="modal" data-target="#activar-directivo-{{ $fila->id }}">
        <img src="{{ asset('icons/bookmark.svg') }}" alt="Convertir en Directivo" width="36" height="36" title="Convertir en Directivo" />
    </a>
</div>

<div class="d-flex align-items-center col-md-10 text-left">
    <a href="#" data-toggle="modal" data-target="#activar-directivo-{{ $fila->id }}">
        Convertir en Directivo
    </a>
</div>

<div id="activar-directivo-{{ $fila->id }}" class="modal fade show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-eliminar" role="document">
        <div class="modal-content modal-content-eliminar">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar cambio a directivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>El cambio de estado será permanente y otorgará permisos especiales a este usuario.</p>
                <p>Desea proceder?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" onclick="location.href = '{{ action('PerfilController@usuarioDirectivo', [$fila->id]) }}'">Si</button>
            </div>
        </div>
    </div>
</div>