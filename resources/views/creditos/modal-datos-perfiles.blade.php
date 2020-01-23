    <a class="btn btn-link link-tabla" data-toggle="modal" data-target="#datos-ampliados-perfiles-{{ $fila->id }}">
    <img src="{{ asset('icons/three-dots.svg') }}" alt="ver información extendida del perfil" width="24" height="24" title="Ver información extendida del perfil">
    </a>

    <div id="datos-ampliados-perfiles-{{ $fila->id }}" class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-eliminar" role="document">
            <div class="modal-content modal-content-eliminar">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLiveLabel">Información extendida del perfil [ {{ $fila->id }} ]</h5>
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

                            Estado
                        
                        </div>

                        <div class="col-md-8 text-left">
                             
                            {{ $fila->estado->nombreEstado }}
                            
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