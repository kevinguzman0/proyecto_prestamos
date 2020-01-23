	<a class="btn btn-link link-tabla" data-toggle="modal" data-target="#confirm-option{{ $fila->id }}">
	<img src="{{ asset('icons/tools.svg') }}" alt="Acciones" width="24" height="24" title="Opciones de usuario">
	</a>

	<div id="confirm-option{{ $fila->id }}" class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered modal-dialog-eliminar" role="document">
		    <div class="modal-content modal-content-acciones">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLiveLabel">Perfil [ {{ $fila->id }} ]</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>


		      <div class="modal-body">

		      	<div class="col-md-12">
		      		
		      		<div class="row col-md-12">
		      			<div class="col-md-2">
		      				<a href="{{ action('PerfilController@miPerfil', [$fila->id]) }}">
								<img src="{{ asset('icons/search.svg') }}" alt="Ver perfil" width="24" height="24" title="Ver perfil">
							</a>

		      			</div>

		      			<div class="col-md-10 text-left">
		      				<p>Ver perfil</p>
		      			</div>

		      			<div class="col-md-2">
		      				<a href="{{ action('CreditoController@misSolicitudes', [$fila->id]) }}">
								<img src="{{ asset('icons/archive.svg') }}" alt="Ver solicitudes" width="24" height="24" title="Ver solicitudes">
							</a>
		      			</div>

		      			<div class="col-md-10 text-left">
		      				<p>Ver solicitudes</p>
		      			</div>

	      				<div class="col-md-2">
	      					<a href="{{ action('CreditoController@usuarioInactivo', [$fila->id]) }}">
								<img src="{{ asset('icons/toggle-off.svg') }}" alt="Inactivar" width="24" height="24" title="Inactivar usuario">
							</a>
	      				</div>

	      				<div class="col-md-10 text-left">
	      					<p>Inactivar usuario</p>
	      				</div>

	      				<div class="col-md-2">
	      					<a href="{{ action('CreditoController@usuarioDirectivo', [$fila->id]) }}">
								<img src="{{ asset('icons/bookmark.svg') }}" alt="Directivo" width="24" height="24" title="Cambiar a directivo">
							</a>
	      				</div>

	      				<div class="col-md-10 text-left">
	      					<p>Cambiar a directivo</p>
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
