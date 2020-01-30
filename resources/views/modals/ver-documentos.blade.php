<a href="#" class="btn btn-link link-tabla boton-acciones" data-toggle="modal" data-target="#ver-documento-{{ $fila->id }}">
    <img src="{{ asset('icons/eye.svg') }}" alt="Ver documento" width="32" height="32" title="Ver documento" />
</a>

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

                @else

                    @if (in_array(strtolower(pathinfo($fila->documento, PATHINFO_EXTENSION)), array('doc', 'docx', 'xls', 'xlsx', 'zip', 'rar', '7z')))

                        <h4 class="modal-title" id="modal_body_descripcion">Apreciado usuario, este archivo debe ser descargado</h4>

                    @else

                        <img src="{{ asset('storage/docUsuarios') }}{{ '/' . $fila->documento }}" class="img-fluid form-control estilo-img-previa" />

                    @endif
                    
                @endif

            </div>

            <div class="modal-footer">

                @hasanyrole('directivo')

                    @if(($fila->solicitud->cliente->id) != (Auth::user()->id))

                        @if($fila->aprobado!=1)
                            <button type="button" class="btn btn-success" data-dismiss="modal" onclick="location.href = '{{ action('CreditoController@documentoAprobado', [$fila->idSolicitud, $fila->id]) }}'">Aprobar</button>
                        @endif
                        @if($fila->aprobado!=0)
                            <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="location.href = '{{ action('CreditoController@documentoRechazado', [$fila->idSolicitud, $fila->id]) }}'">Rechazar</button>
                        @endif

                    @endif

                @endhasanyrole

                @if((($fila->solicitud->idEstadoSolicitud <= 3) && ($fila->aprobado != 1)) || ($fila->solicitud->cliente->id != Auth::user()->id))

                    @include('modals.eliminar-documentos')
                    
                @endif

                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="location.href = '{{ action('CreditoController@documentoDescargar', [$fila->documento]) }}'">Descargar</button>

            </div>

        </div>

    </div>

</div>