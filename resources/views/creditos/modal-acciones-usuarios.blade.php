    <a class="btn btn-link link-tabla" data-toggle="modal" data-target="#datos-ampliados-usuarios-{{ $fila->id }}">
    <img src="{{ asset('icons/three-dots.svg') }}" alt="ver información extendida del usuario" width="24" height="24" title="Ver información extendida del usuario">
    </a>

    <div id="datos-ampliados-usuarios-{{ $fila->id }}" class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-eliminar" role="document">
            <div class="modal-content modal-content-eliminar">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLiveLabel">Información extendida del usuario [ {{ $fila->id }} ]</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>


              <div class="modal-body">

                <div class="col-md-12">
                    
                    <div class="row col-md-12">
                        <div class="col-md-4 text-right font-weight-bold">

                            Creación

                        </div>

                        <div class="col-md-8 text-left">
                            {{ $fila->created_at }}
                        </div>

                        <div class="col-md-4 text-right font-weight-bold">
                            
                            Modificación

                        </div>

                        <div class="col-md-8 text-left">
                             {{ $fila->updated_at }}
                        </div>

                        <div class="col-md-4 text-right font-weight-bold">

                            Verificación
                        
                        </div>

                        <div class="col-md-8 text-left">
                             
                            @if($fila->email_verified_at != null)
                                {{ $fila->email_verified_at }} 
                            @else
                                pendiente
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