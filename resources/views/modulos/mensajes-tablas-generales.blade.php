@isset($mensajeVerde)
	<div class="form-row col-md-12 alert alert-success estilo-success alert-dismissible fade show estilo-mensaje-verde" role="alert">
        {{ $mensajeVerde }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
@endisset

@if ($mensaje = Session::get('mensajeVerde'))
    <div class="form-row col-md-12 alert alert-success estilo-success alert-dismissible fade show estilo-mensaje-verde" role="alert">
        {{ $mensaje }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
@endif

@isset($mensajeRojo)
	<div class="form-row col-md-12 alert alert-danger estilo-success alert-dismissible fade show estilo-mensaje-verde" role="alert">
        {{ $mensajeRojo }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
@endisset

@if ($mensaje = Session::get('mensajeRojo'))
    <div class="form-row col-md-12 alert alert-danger estilo-success alert-dismissible fade show estilo-mensaje-verde" role="alert">
        {{ $mensaje }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
@endif
