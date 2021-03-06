@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@include('plantillas.base.sideMenu')

@include('plantillas.base.topMenu')

@section('content')
	
	<div class="row col-md-12">

        <h5>LISTADO GENERAL DE SOLICITUDES DE CRÉDITO</h5>

	    <div class="ml-auto">

	 	    @if($paginacion == 'si')

	    		{{ $solicitudes->onEachSide(2)->links() }}

			@endif

		</div>

    </div>

    <div class="row col-md-12 mb-3 mt-3">

    	@include('modulos.mensajes-tablas-generales')

		@include('modulos.filtros-solicitudes')    	

  		@isset($solicitudes)

			<table class="table table-striped table-bordered">

				<tbody>

					<thead class="header-tabla">

						<tr>
							<th class="header-tabla-texto">Id</th>
							<th class="header-tabla-texto">Cliente</th>
							<th class="header-tabla-texto">Monto</th>
							<th class="header-tabla-texto">Plazo</th>
							<th class="header-tabla-texto">Cuota mensual</th>
							<th class="header-tabla-texto">Interés</th>
							<th class="header-tabla-texto">Acciones</th>
						</tr>

					</thead>

					@foreach ($solicitudes as $fila)

					    <tr>

							<td style="text-align:center; font-weight: bold;"> {{ $fila->id }} </td>

							<td style="text-align:center;"> 

								<a class="btn btn-link link-tabla" href="{{ action('PerfilController@miPerfil', [$fila->idCliente]) }}">
									{{ optional($fila->cliente)->nombres }} {{ optional($fila->cliente)->apellidos }} 
								</a>

							</td>

							<td style="text-align:right;"> {{ '$' . number_format($fila->monto) }} </td>
							<td style="text-align:center;"> {{ $fila->plazo }} </td>
							<td style="text-align:right;"> {{ '$' . number_format($fila->cuota,2) }} </td>
							<td style="text-align:center;"> {{ $fila->interes . '%' }} </td>
							<td style="text-align:center;">

								@include('modals.datos-solicitudes')
								
								@include('modals.acciones-solicitudes')

								@include('modulos.liquidador-solicitudes')

							</td>

						</tr>
					
					@endforeach

				</tbody>

			</table>

		@endisset

	</div>

@endsection