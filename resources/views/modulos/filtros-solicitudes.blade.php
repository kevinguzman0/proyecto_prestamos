<p>
	<button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#seccionFiltros" aria-expanded="false" aria-controls="collapseExample">
		Ver filtros disponibles
	</button>
	
</p>

<div class="form-row col-md-12 padding-form">		

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
					      	<select class="form-control" id="cboIdSolicitudes" name="cboIdSolicitudes">
					      	
						      	<option value="-1">Todos</option>
						      	@foreach ($idSolicitudes as $item)
							        <option value="{{ $item->id }}">{{ $item->id }}</option>
							    @endforeach

					      	</select>

					    </div>

				    @endisset	

				    @isset($cboIdClientes)

					    <div class="col-md-5">

					    	<label class="label-margin">Cliente</label>
					      	<select class="form-control" id="cboIdCliente" name="cboIdCliente">
					      	
						      	<option value="-1">Todos</option>
						      	@foreach ($cboIdClientes as $item)
							        <option value="{{ $item->idCliente }}">
							        	{{ $item->cliente->nombres }} 
							        	{{ $item->cliente->apellidos }}
						        	</option>
							    @endforeach

					      	</select>

					    </div>

				    @endisset					

  			        @isset($cboIdAnalizadoPor)

					    <div class="col-md-5">

					    	<label class="label-margin">Analizado por</label>
					      	<select class="form-control" id="cboIdAnalizadoPor" name="cboIdAnalizadoPor">

						      	<option value="-1">Todos</option>
						      	@foreach ($cboIdAnalizadoPor as $item)
							        <option value="{{ $item->idAnalizadoPor }}">
							        	{{ $item->revisor->nombres }} 
							        	{{ $item->revisor->apellidos }}
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
					      	<select class="form-control" id="cboIdEstadosSolicitudes" name="cboIdEstadosSolicitudes">

						      	<option value="-1">Todos</option>
						      	@foreach ($idEstadosSolicitudes as $item)
							        <option value="{{ $item->idEstadoSolicitud }}">{{ $item->estado->nombreEstado }}</option>
							    @endforeach

					      	</select>

					    </div>

				    @endisset

				    @isset($cboPlazo)

					    <div class="col-md-2">

					    	<label class="label-margin">Plazo</label>
					      	<select class="form-control" id="cboPlazo" name="cboPlazo">

						      	<option value="-1">Todos</option>
						      	@foreach ($cboPlazo as $item)
							        <option value="{{ $item->plazo }}">{{ $item->plazo }}</option>
							    @endforeach

					      	</select>

					    </div>

				    @endisset		

				    @isset($cboInteres)

					    <div class="col-md-2">

					    	<label class="label-margin">Interés</label>
					      	<select class="form-control" id="cboInteres" name="cboInteres">

						      	<option value="-1">Todos</option>
						      	@foreach ($cboInteres as $item)
							        <option value="{{ $item->interes }}">{{ $item->interes }}</option>
							    @endforeach

					      	</select>

					    </div>

				    @endisset	

				</div>

			    <div class="form-row col-md-12 padding-form">

				    <div class="col-md-3">

				    	<label class="label-margin">Valores de</label>
				      	<select class="form-control" id="cboValorDe" name="cboValorDe">
				      	
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
				      	<select class="form-control" id="cboFechaDeSolicitud" name="cboFechaDe">
				      	
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

</div>