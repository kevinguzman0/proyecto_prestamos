<p>
	<button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#seccionFiltros" aria-expanded="false" aria-controls="collapseExample">
		Ver filtros disponibles
	</button>
</p>

<div class="collapse col-md-12 mb-3" id="seccionFiltros">

	<div class="card card-body">

		<form class="col-md-12 padding-form" method="POST">

            @csrf

            <div class="form-row col-md-12 padding-form">
            	
			    <div class="input-group col-md-10">

			    	<input type="text" name="filtro" class="form-control" placeholder="escriba texto a buscar...">

			  		<div class="input-group-append">

				      	<button class="btn btn-dark" type="submit" name="btnBuscar"  formaction="{{ action('GeneralController@buscadorDocumentos') }}">

				        	Buscar

				      	</button>

				    </div>

			    </div>

			    <div class="col-md-2">

			      	<input type="submit" value="Mostrar todos" name="btnMostrarTodos" formaction="{{ action('GeneralController@tablaDocumentos') }}" class="form-control btn btn-success">

			    </div>

            </div>

		</form>

		<form class="col-md-12 padding-form" method="POST">

            @csrf

		    <div class="form-row col-md-12 padding-form">

		    	@isset($idDocumentos)

				    <div class="col-md-3">

				    	<label class="label-margin">Id Documento</label>
				      	<select class="form-control" id="idDocumento" name="idDocumento">
				      	
					      	<option value="-1">Todos</option>
					      	@foreach ($idDocumentos as $item)
						        <option value="{{ $item->id }}">{{ $item->id }}</option>
						    @endforeach

				      	</select>

				    </div>

			    @endisset

			  	@isset($idSolicitudes)

				    <div class="col-md-3">

				    	<label class="label-margin">Id Solicitud</label>
				      	<select class="form-control" id="idSolicitud" name="idSolicitud">

					      	<option value="-1">Todos</option>
					      	@foreach ($idSolicitudes as $item)
						        <option value="{{ $item->idSolicitud }}">{{ $item->idSolicitud }}</option>
						    @endforeach

				      	</select>

				    </div>

			    @endisset

			    <div class="col-md-3">

			    	<label class="label-margin">Revisión</label>
			      	<select class="form-control" id="procesoDocumento" name="procesoDocumento">
			      	
				      	<option value="-1">Todos</option>
				      	<option value="1">Revisado</option>
				      	<option value="0">Sin revisar</option>

			      	</select>

			    </div>

			    <div class="col-md-3">

			    	<label class="label-margin">Estado Documento</label>
			      	<select class="form-control" id="estadoDocumento" name="estadoDocumento">
			      	
				      	<option value="-2">Todos</option>
				      	<option value="-1">Sin revisar</option>
				      	<option value="1">Aprobado</option>
				      	<option value="0">Rechazado</option>

			      	</select>

			    </div>

			</div>

            <div class="form-row col-md-12 padding-form">

			  	@isset($idAnalizadosPor)

			    	<div class="col-md-6">

				    	<label class="label-margin">Analizado por</label>
				      	<select class="form-control" id="idAnalizadoPor" name="idAnalizadoPor">
				      	
					      	<option value="-1">Todos</option>
					      	<option value="-2">Sin analizar</option>

					      	@foreach ($idAnalizadosPor as $item)
					        	<option value="{{ $item->idAnalizadoPor }}">
					        		{{ optional($item->revisor)->nombres }} 
					        		{{ optional($item->revisor)->apellidos }}
					        	</option>
						    @endforeach

				      	</select>

				    </div>

			    @endisset

			  	@isset($idClientes)

			    	<div class="col-md-6">

				    	<label class="label-margin">Cliente</label>
				      	<select class="form-control" id="idCliente" name="idCliente">
				      	
					      	<option value="-1">Todos</option>

					      	@foreach ($idClientes as $item)
					        	<option value="{{ $item->idCliente }}">
					        		{{ optional($item->cliente)->nombres }} {{ optional($item->cliente)->apellidos }}
					        	</option>
						    @endforeach

				      	</select>

				    </div>

			    @endisset

			</div>

		    <div class="form-row col-md-12 padding-form">

			    <div class="col-md-3">

			    	<label class="label-margin">Fecha de</label>
			      	<select class="form-control" id="cboFechaDe" name="cboFechaDe">
			      	
				      	<option value="created_at">Creación</option>
				      	<option value="updated_at">Modificación</option>
				      	<option value="analizadoEn">Analisis</option>

			      	</select>

			    </div>

                <div class="col-md-3">
                    <label class="label-margin">Fecha inicial</label>
                    <input type="date" name="fechaInicial" class="form-control">
                </div>

                <div class="col-md-3">
                    <label class="label-margin">Fecha Final</label>
                    <input type="date" name="fechaFinal" class="form-control">
                </div>

				<div class="col-md-2 ml-auto">

		      		<label class="label-margin"></label>
		      		<input type="submit" value="Filtrar" name="btnFiltrar" formaction="{{ action('GeneralController@filtrosDocumentos') }}" class="form-control btn btn-dark boton-filtrar">

		      	</div>

			</div>
		
		</form>	

	</div>

</div>