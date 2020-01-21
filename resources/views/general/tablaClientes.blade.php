@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@include('plantillas.base.sideMenu')

@include('plantillas.base.topMenu')

@section('content')
	
	<div class="row col-md-12">
        <h5>LISTADO CLIENTES</h5>
    </div>

    <div class="row col-md-12 mb-3 mt-3">

    	{{ $perfiles->onEachSide(2)->links() }}

		<table class="table table-striped table-bordered table-fit">

			<tbody>
				<thead>

					<tr>
						<th>IdCliente</th>
						<th>IdPerfilUsuario</th>
						<th>Fecha</th>
						<th>Nombres</th>
						<th>Apellidos</th>
						<th>Cedula</th>
						<th>email</th>
					</tr>

				</thead>

				@foreach ($perfiles as $fila)

				    <tr>

						<td style="text-align:center; font-weight: bold;"> {{ $fila->id }} </td>
						<td style="text-align:center; font-weight: bold;"> {{ $fila->perfil->nombrePerfil	 }} </td>
						<td style="text-align:center;"> {{ Date_format($fila->created_at, "d/m/Y") }} </td>
						<td style="text-align:center; font-weight: bold;"> {{ $fila->nombres }} </td>
						<td style="text-align:center; font-weight: bold;"> {{ $fila->apellidos }} </td>						
						<td style="text-align:right;"> {{ $fila->cedula }} </td>
						<td style="text-align:center;"> {{ $fila->email }} </td>

					</tr>
				
				@endforeach


			</tbody>

		</table>

	</div>

@endsection