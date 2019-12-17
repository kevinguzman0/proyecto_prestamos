@section('miusuario')
    <form class="formularioCliente" action="{{ url('/validarUsuario') }}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}

        <h3>Perfil</h3>
        <input type="text" name="idPerfilUsuario">
        <h3>Cedula</h3>
        <input type="text" name="cedula">
        <h3>Nombres</h3>
        <input type="text" name="nombres">
        <h3>Apellidos</h3>
        <input type="text" name="apellidos">
        <h3>Foto</h3>
        <input type="file" name="foto">
        <h3>Email</h3>
        <input type="text" name="email">
        <h3>Telefono1</h3>
        <input type="text" name="telefono1">
        <h3>Telefono2</h3>
        <input type="text" name="telefono2">
        <h3>Fecha de nacimiento</h3>
        <input type="date" name="fechaNacimiento">
        <h3>Direccion</h3>
        <input type="text" name="direccion">
        <h3>Barrio</h3>
        <input type="text" name="barrio">
        <h3>Ciudad</h3>
        <input type="text" name="ciudad">
        <h3>Area de trabajo</h3>
        <input type="text" name="areaTrabajo">
        <h3>Cargo de trabajo</h3>
        <input type="text" name="cargoTrabajo">
        <input type="submit" name="user" value="Enviar">
    </form>

@endsection