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

				      	<button class="btn btn-dark" type="submit" name="btnBuscar"  formaction="{{ action('GeneralController@buscadorPerfiles') }}">

				        	Buscar

				      	</button>

				    </div>

			    </div>

			    <div class="col-md-2">

			      	<input type="submit" value="Mostrar todos" name="btnMostrarTodos" formaction="{{ action('GeneralController@tablaPerfiles') }}" class="form-control btn btn-success">

			    </div>

            </div>

		</form>

		<form class="col-md-12 padding-form" method="POST">

            @csrf

		    <div class="form-row col-md-12 padding-form">

		    	@isset($idPerfiles)

				    <div class="col-md-2">

				    	<label class="label-margin">Id Perfil</label>
				      	<select class="form-control" id="idPerfil" name="idPerfil">
				      	
					      	<option value="-1">Todos</option>
					      	@foreach ($idPerfiles as $item)
					      		@if($item->id != 1)
						        	<option value="{{ $item->id }}">{{ $item->id }}</option>
						        @endif
						    @endforeach

				      	</select>

				    </div>

			    @endisset

			    <div class="col-md-2">

			    	<label class="label-margin">Afiliado al Fondo</label>
			      	<select class="form-control" id="afiliadoFondo" name="afiliadoFondo">
			      	
				      	<option value="-1">Todos</option>
				      	<option value="1">Si</option>
				      	<option value="0">No</option>

			      	</select>

			    </div>

			    <div class="col-md-2">

			    	<label class="label-margin">Con solicitudes</label>
			      	<select class="form-control" id="conSolicitudes" name="conSolicitudes">
			      	
				      	<option value="-1">Todos</option>
				      	<option value="1">Si</option>
				      	<option value="0">No</option>

			      	</select>

			    </div>

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

			    	<label class="label-margin">Fecha de</label>
			      	<select class="form-control" id="fechaDe" name="fechaDe">
			      	
				      	<option value="created_at">Creación</option>
				      	<option value="updated_at">Modificación</option>
				      	<option value="fechaNacimiento">Nacimiento</option>

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
		      		<input type="submit" value="Filtrar" name="btnFiltrar" formaction="{{ action('GeneralController@filtrosPerfiles') }}" class="form-control btn btn-dark boton-filtrar">

		      	</div>

			</div>
		
		</form>	

	</div>

</div>
