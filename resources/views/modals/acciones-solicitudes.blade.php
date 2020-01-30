
<a href="#" class="btn btn-link link-tabla boton-acciones" data-toggle="modal" data-target="#acciones-solicitud-{{ $fila->id }}">
    <img src="{{ asset('icons/tools.svg') }}" alt="Ver menú de acciones" width="36" height="36" title="Ver menú de acciones" />
</a>

<div id="acciones-solicitud-{{ $fila->id }}" class="modal fade show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-eliminar" role="document">
        <div class="modal-content modal-content-acciones">
            <div class="modal-header">
                <h5 class="modal-title">Solicitud [ {{ $fila->id }} ]</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="row col-md-12">
 
                        @if($fila->idEstadoSolicitud <= 3)
                            <div class="col-md-2">
                                <a href="{{ route('mis.documentos', [$fila->idCliente, $fila->id]) }}">
                                    <img src="{{ asset('icons/documents.svg') }}" alt="Ver documentos entregados" width="36" height="36" title="Ver documentos entregados" />
                                </a>
                            </div>
                            <div class="d-flex align-items-center col-md-10 text-left">
                                <a href="{{ route('mis.documentos', [$fila->idCliente, $fila->id]) }}">Ver documentos entregados</a>
                            </div>
                        @endif

                        @if(($fila->idCliente) != (Auth::user()->id))

    		      			@if($fila->idEstadoSolicitud == 2)
                                <div class="col-md-2">
                                    <a href="{{ route('solicitud.aprobar', [$fila->idCliente, $fila->id]) }}">
                                        <img src="{{ asset('icons/award.svg') }}" alt="Marcar como aprobada" width="36" height="36" title="Marcar como aprobada" />
                                    </a>
                                </div>
                                <div class="d-flex align-items-center col-md-10 text-left">
                                    <a href="{{ route('solicitud.aprobar', [$fila->idCliente, $fila->id]) }}">Marcar como aprobada</a>
                                </div>
                            @endif

    		      			@if($fila->idEstadoSolicitud == 2)
                            <div class="col-md-2">
                                    <a href="{{ route('solicitud.rechazar', [$fila->idCliente, $fila->id]) }}">
                                        <img src="{{ asset('icons/x-octagon-fill.svg') }}" alt="Marcar como rechazada" width="36" height="36" title="Marcar como rechazada" />
                                    </a>
                                </div>
                                <div class="d-flex align-items-center col-md-10 text-left">
                                    <a href="{{ route('solicitud.rechazar', [$fila->idCliente, $fila->id]) }}">Marcar como rechazada</a>
                                </div>
                            @endif
                            <div class="col-md-2">
                                <a href="{{ action('CreditoController@solicitudPendiente', [$fila->idCliente, $fila->id]) }}">
                                    <img src="{{ asset('icons/alarm.svg') }}" alt="Marcar con documentos pendientes" width="36" height="36" title="Marcar con documentos pendientes" />
                                </a>
                            </div>
                            <div class="d-flex align-items-center col-md-10 text-left">
                                 <a href="{{ action('CreditoController@solicitudPendiente', [$fila->idCliente, $fila->id]) }}">Marcar con documentos pendientes</a>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ action('CreditoController@solicitudDesembolsada', [$fila->idCliente, $fila->id]) }}">
                                    <img src="{{ asset('icons/check-circle.svg') }}" alt="Marcar como solicitud desembolsada" width="36" height="36" title="Marcar como solicitud desembolsada" />
                                </a>
                            </div>
                            <div class="d-flex align-items-center col-md-10 text-left">
                                <a href="{{ action('CreditoController@solicitudDesembolsada', [$fila->idCliente, $fila->id]) }}">Marcar como solicitud desembolsada</a>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ action('CreditoController@solicitudEnEspera', [$fila->idCliente, $fila->id]) }}">
                                    <img src="{{ asset('icons/clock.svg') }}" alt="Marcar como solicitud en espera" width="36" height="36" title="Marcar como solicitud en espera" />
                                </a>
                            </div>
                            <div class="d-flex align-items-center col-md-10 text-left">
                                <a href="{{ action('CreditoController@solicitudEnEspera', [$fila->idCliente, $fila->id]) }}">Marcar como solicitud en espera</a>
                            </div>
                            @if($fila->idEstadoSolicitud == 1)
                                @include('modals.eliminar-solicitudes', ['tipo' => 'modal'])
                            @endif
                        @endif

                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>