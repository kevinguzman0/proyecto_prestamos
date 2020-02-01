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

			    	<input type="text" name="filtro" class="form-control" placeholder="Escriba la solicitud a buscar...">

			  		<div class="input-group-append">

				      	<button class="btn btn-dark" type="submit" name="btnBuscar"  formaction="{{ action('GeneralController@buscadorSolicitudes') }}">

				        	Buscar

				      	</button>

				    </div>

			    </div>

			    <div class="col-md-2">

			      	<input type="submit" value="Mostrar todos" name="btnMostrarTodos" formaction="{{ action('GeneralController@tablaSolicitudes') }}" class="form-control btn btn-success">

		        </div>

            </div>

		</form>

		<form class="col-md-12 padding-form" method="POST">

            @csrf

		    <div class="form-row col-md-12 padding-form">

	    		@isset($idSolicitudes)

				    <div class="col-md-2">

				    	<label class="label-margin">Id Solicitud</label>
				      	<select class="form-control" id="idSolicitud" name="idSolicitud">
				      	
					      	<option value="-1">Todos</option>
					      	@foreach ($idSolicitudes as $item)
						        <option value="{{ $item->id }}">{{ $item->id }}</option>
						    @endforeach

				      	</select>

				    </div>

			    @endisset	

			    @isset($idClientes)

				    <div class="col-md-5">

				    	<label class="label-margin">Cliente</label>
				      	<select class="form-control" id="idCliente" name="idCliente">

					      	<option value="-1">Todos</option>
					      	@foreach ($idClientes as $item)
						        <option value="{{ $item->idCliente }}">
						        	{{ optional($item->cliente)->nombres }} 
						        	{{ optional($item->cliente)->apellidos }}
					        	</option>
						    @endforeach

				      	</select>

				    </div>

			    @endisset					

		        @isset($idAnalizadosPor)

				    <div class="col-md-5">

				    	<label class="label-margin">Analizado por</label>
				      	<select class="form-control" id="idAnalizadoPor" name="idAnalizadoPor">

					      	<option value="-1">Todos</option>
					      	@foreach ($idAnalizadosPor as $item)
						        <option value="{{ $item->idAnalizadoPor }}">
						        	{{ optional($item->revisor)->nombres }} 
						        	{{ optional($item->revisor)->apellidos }}
						        </option>
						    @endforeach

				      	</select>

				    </div>

			    @endisset									  	   					 

			</div>

		    <div class="form-row col-md-12 padding-form">

			  	@isset($idEstadosSolicitudes)

				    <div class="col-md-3">

				    	<label class="label-margin">Estado solicitud</label>
				      	<select class="form-control" id="idEstadoSolicitud" name="idEstadoSolicitud">

					      	<option value="-1">Todos</option>
					      	@foreach ($idEstadosSolicitudes as $item)
						        <option value="{{ $item->idEstadoSolicitud }}">{{ optional($item->estado)->nombreEstado }}</option>
						    @endforeach

				      	</select>

				    </div>

			    @endisset

			    @isset($listaPlazos)

				    <div class="col-md-2">

				    	<label class="label-margin">Plazo</label>
				      	<select class="form-control" id="plazo" name="plazo">

					      	<option value="-1">Todos</option>
					      	@foreach ($listaPlazos as $item)
						        <option value="{{ $item->plazo }}">{{ $item->plazo }}</option>
						    @endforeach

				      	</select>

				    </div>

			    @endisset		

			    @isset($listaIntereses)

				    <div class="col-md-2">

				    	<label class="label-margin">Interés</label>
				      	<select class="form-control" id="interes" name="interes">

					      	<option value="-1">Todos</option>
					      	@foreach ($listaIntereses as $item)
						        <option value="{{ $item->interes }}">{{ $item->interes }}</option>
						    @endforeach

				      	</select>

				    </div>

			    @endisset	

			    <div class="col-md-2">

			    	<label class="label-margin">Con documentos</label>
			      	<select class="form-control" id="conDocumentos" name="conDocumentos">
			      	
				      	<option value="-1">Todos</option>
				      	<option value="1">Si</option>
				      	<option value="0">No</option>

			      	</select>

			    </div>

			</div>

		    <div class="form-row col-md-12 padding-form">

			    <div class="col-md-3">

			    	<label class="label-margin">Valores de</label>
			      	<select class="form-control" id="valorDe" name="valorDe">
			      	
				      	<option value="monto">Monto</option>
				      	<option value="cuota">Cuota</option>
				      	<option value="plazo">Plazo</option>

			      	</select>

			    </div>

                <div class="col-md-3">
                    <label class="label-margin">Valor inicial</label>
                    <input type="number" name="valorInicial" class="form-control">
                </div>

                <div class="col-md-3">
                    <label class="label-margin">Valor Final</label>
                    <input type="number" name="valorFinal" class="form-control">
                </div>

			</div>

		    <div class="form-row col-md-12 padding-form">

			    <div class="col-md-3">

			    	<label class="label-margin">Fecha de</label>
			      	<select class="form-control" id="fechaDe" name="fechaDe">
			      	
				      	<option value="created_at">Creación</option>
				      	<option value="updated_at">Modificación</option>
				      	<option value="analizadoEn">Análisis</option>

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
		      		<input type="submit" value="Filtrar" name="btnFiltrar" formaction="{{ action('GeneralController@filtrosSolicitudes') }}" class="form-control btn btn-dark boton-filtrar">

		      	</div>

			</div>
		
		</form>	

	</div>

</div>
