<button type="button" class="btn btn-link link-tabla" data-toggle="modal" data-target="#ver-documento-{{ $fila->id }}">
    <img src="{{ asset('icons/eye.svg') }}" alt="Ver documento" width="24" height="24" title="Ver documento" />
</button>

<div class="modal fade" id="ver-documento-{{ $fila->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Id Documento [ {{ $fila->id }} ] / {{ $fila->documento }}</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body-descripcion">
                    <h6 class="modal-title" id="modal_body_descripcion">{{ $fila->descripcionDocumento }}</h6>
                </div>
                @if ((strtolower(pathinfo($fila->documento, PATHINFO_EXTENSION) == 'pdf')))
                    <iframe id="pdfdoc" src="{{ asset('storage/docUsuarios') }}{{ '/' . $fila->documento }}" width="100%" height="500px"></iframe>
                @endif
                @if (in_array(strtolower(pathinfo($fila->documento, PATHINFO_EXTENSION)), array('doc', 'docx', 'xls', 'xlsx', 'zip', 'rar', '7z')))
                    <h4 class="modal-title" id="modal_body_descripcion">Apreciado usuario, este archivo debe ser descargado</h4>
                @else
                    <img src="{{ asset('storage/docUsuarios') }}{{ '/' . $fila->documento }}" class="img-fluid form-control estilo-img-previa" />
                @endif
            </div>
            <div class="modal-footer">
                @if($fila->aprobado!=1)
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="location.href = '{{ action('CreditoController@documentoAprobado', [$fila->idSolicitud, $fila->id]) }}'">Aprobar</button>
                @endif
                @if($fila->aprobado!=0)
                    <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="location.href = '{{ action('CreditoController@documentoRechazado', [$fila->idSolicitud, $fila->id]) }}'">Rechazar</button>
                @endif
                @if($fila->aprobado!=1)
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete_{{ $fila->id }}">Eliminar</button>
                    <div id="confirm-delete_{{ $fila->id }}" class="modal fade show" tabindex="-1" role="dialog" aria-hidden="true">
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
                                    <button type="button" class="btn btn-danger" onclick="location.href = '{{ action('CreditoController@documentoEliminar', [$fila->idSolicitud, $fila->id]) }}'">Aceptar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="location.href = '{{ action('CreditoController@documentoDescargar', [$fila->documento]) }}'">Descargar</button>
            </div>
        </div>
    </div>
</div>