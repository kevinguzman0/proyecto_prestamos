@section('miusuario')

        <div class="row col-md-12" style="">

            <div class="row col-md-12 mt-3 ml-3">
                <h4>FORMULARIO PARA REGISTRO DE INTERESADOS</h4>
            </div>

            <div class="row col-md-12 mt-2 ml-3">

                <form class="formularioCliente" 
                      action="{{ url('/validarUsuario') }}" 
                      method="POST" 
                      enctype="multipart/form-data">

                    @csrf

                    <div class="form-row">

                        <div class="col-md-3">
                            <label>Cédula</label>
                            <input type="text" maxlength="15" name="cedula" class="form-control">
                        </div>

                        <div class="col-md-9">
                            <label>Email</label>
                            <input type="text" maxlength="100" name="email" class="form-control">
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-6">
                            <label>Nombres</label>
                            <input type="text" maxlength="100" name="nombres" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Apellidos</label>
                            <input type="text" maxlength="100" name="apellidos" class="form-control">
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-4">
                            <label>Teléfono #1</label>
                            <input type="text" maxlength="15" name="telefono1" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label>Teléfono #2</label>
                            <input type="text" maxlength="15" name="telefono2" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label>Fecha de nacimiento</label>
                            <input type="date" name="fechaNacimiento" class="form-control">
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-6">
                            <label>Dirección</label>
                            <input type="text" maxlength="100" name="direccion" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label>Barrio</label>
                            <input type="text" maxlength="100" name="barrio" class="form-control">
                        </div>

                        <div class="col-md-2">
                            <label>Ciudad</label>
                            <input type="text" maxlength="45" name="ciudad" class="form-control">
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-3">
                            <label>Área de trabajo</label>
                            <input type="text" maxlength="100" name="areaTrabajo" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>Cargo de trabajo</label>
                            <input type="text" maxlength="100" name="cargoTrabajo" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Foto personal</label>
                            <div class="input-group">
                              
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="foto" name="foto" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="foto">Seleccionar archivo</label>
                              </div>
                            </div>
                        </div>

                    </div>

                    <input type="hidden" maxlength="20" name="idPerfilUsuario" value="1" class="form-control">

                    <div class="form-row mb-5">

                        <div class="col-md-12">
                            <label></label>
                            <input type="submit" value="Enviar" name="btnEnviarUser" class="form-control">
                        </div>

                    </div>
                    
                </form>

            </div>

        </div>

@endsection