	<a href="#" class="btn btn-link link-tabla" data-toggle="modal" data-target="#acciones-solicitud-{{ $fila->id }}">
		<img src="{{ asset('icons/tools.svg') }}" alt="Ver menú de acciones" width="24" height="24" title="Ver menú de acciones">
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
									<img src="{{ asset('icons/book.svg') }}" alt="Presentar / Ver documentos" width="24" height="24" title="Presentar / Ver documentos">
								</a>
			      			</div>

			      			<div class="col-md-10 text-left">
			      				<p>Presentar / Ver documentos</p>
			      			</div>
		      			@endif

		      			@if($fila->idEstadoSolicitud == 2)
			      			<div class="col-md-2">
			      				<a href="{{ route('solicitud.aprobar', [$fila->idCliente, $fila->id]) }}">
									<img src="{{ asset('icons/award.svg') }}" alt="Aprobar / Validar" width="24" height="24" title="Aprobar / Validar">
								</a>
			      			</div>

			      			<div class="col-md-10 text-left">
			      				<p>Aprobar / Validar</p>
			      			</div>
		      			@endif

		      			@if($fila->idEstadoSolicitud == 2)
		      				<div class="col-md-2">
		      					<a href="{{ route('solicitud.rechazar', [$fila->idCliente, $fila->id]) }}">
									<img src="{{ asset('icons/x-octagon-fill.svg') }}" alt="Rechazar" width="24" height="24" title="Rechazar">
								</a>
		      				</div>

		      				<div class="col-md-10 text-left">
		      					<p>Rechazar</p>
		      				</div>
		      			@endif

		      			<div class="col-md-2">
		      				<a href="{{ action('CreditoController@solicitudPendiente', [$fila->idCliente, $fila->id]) }}">
								<img src="{{ asset('icons/alarm.svg') }}" alt="Con Pendientes" width="24" height="24" title="Documentos pendientes">
							</a>
		      			</div>

		      			<div class="col-md-10 text-left">
		      				<p>Con documentos pendientes</p>
		      			</div>

		      			<div class="col-md-2">
		      				<a href="{{ action('CreditoController@solicitudDesembolsada', [$fila->idCliente, $fila->id]) }}">
								<img src="{{ asset('icons/check-circle.svg') }}" alt="Desembolsada" width="24" height="24" title="Solicitud desembolsada">
							</a>
		      			</div>

		      			<div class="col-md-10 text-left">
		      				<p>Solicitud desembolsada</p>
		      			</div>

		      			<div class="col-md-2">
		      				<a href="{{ action('CreditoController@solicitudEnEspera', [$fila->idCliente, $fila->id]) }}">
								<img src="{{ asset('icons/clock.svg') }}" alt="En Espera" width="24" height="24" title="Solicitud en espera">
							</a>
		      			</div>

		      			<div class="col-md-10 text-left">
		      				<p>Solicitud en espera</p>
		      			</div>

		      			@if($fila->idEstadoSolicitud == 1)

			      			<div class="col-md-2">
	
			      				@include('modals.eliminar-solicitudes')

			      			</div>

		      				<div class="col-md-10 text-left">
		      					<p>Eliminar solicitud</p>
		      				</div>

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
