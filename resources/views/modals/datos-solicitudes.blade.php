
<a href="#" class="btn btn-link link-tabla boton-acciones" data-toggle="modal" data-target="#datos-solicitud-{{ $fila->id }}">
    <img src="{{ asset('icons/three-dots.svg') }}" alt="Ver información extendida de la solicitud" width="36" height="36" title="Ver información extendida de la solicitud" />
</a>

<div id="datos-solicitud-{{ $fila->id }}" class="modal fade show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-eliminar" role="document">
        <div class="modal-content modal-content-eliminar">
            <div class="modal-header">
                <h5 class="modal-title">Información extendida de la Solicitud [ {{ $fila->id }} ]</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="row col-md-12">
                        <div class="col-md-4 text-right font-weight-bold">Fecha</div>
                        <div class="col-md-8 text-left">{{ $fila->created_at }}</div>
                        <div class="col-md-4 text-right font-weight-bold">Analizado por</div>
                        <div class="col-md-8 text-left">
                            @if($fila->idAnalizadoPor != null)
                                <a class="btn btn-link link-tabla" href="{{ action('PerfilController@miPerfil', [$fila->idAnalizadoPor]) }}">[ {{ $fila->idAnalizadoPor }} ] - 
                                    {{ $fila->revisor->nombres }}
                                    {{ $fila->revisor->apellidos }}
                                </a>
                            @endif
                        </div>
                        <div class="col-md-4 text-right font-weight-bold">Analizado en</div>
                        <div class="col-md-8 text-left">
                            @if($fila->analizadoEn != null)
								{{ $fila->analizadoEn }} 
							@endif
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