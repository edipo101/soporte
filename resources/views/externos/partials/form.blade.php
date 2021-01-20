<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('fecha', 'Fecha del Informe') }}
            {{ Form::text('fecha',$fecha,['class'=> 'form-control', 'disabled' =>'disabled']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('usuario', 'Usuario') }}
            {{ Form::text('usuario',$usuario,['class'=> 'form-control', 'disabled' =>'disabled']) }}
        </div>
    </div>
</div>

<div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
    {{ Form::label('nombre', 'Nombre Funcionario') }}
    {{ Form::text('nombre',null,['class'=> 'form-control text-uppercase', 'placeholder'=>'NOMBRE COMPLETO DEL FUNCIONARIO']) }}
    @if ($errors->has('nombre'))
        <span class="help-block">
            <strong>{{ $errors->first('nombre') }}</strong>
        </span>
    @endif
</div>

<div class="form-group{{ $errors->has('unidad') ? ' has-error' : '' }}">
    {{ Form::label('unidad', 'Unidad') }}
    @if(isset($externo))
    {{ Form::text('unidad',$externo->unidad->nombre,['class'=>'form-control text-uppercase', 'id'=>'unidad','autocomplete'=>'off','placeholder'=>'UNIDAD FUNCIONARIO']) }}
    @else
    {{ Form::text('unidad',null,['class'=> 'form-control text-uppercase','id' => 'unidad','autocomplete'=>'off','placeholder'=>'UNIDAD FUNCIONARIO']) }}
    @endif
    @if ($errors->has('unidad'))
        <span class="help-block">
            <strong>{{ $errors->first('unidad') }}</strong>
        </span>
    @endif
</div>

<hr>
<h4 class="text-center">SERVICIOS Y/O PROBLEMAS EN EL EQUIPO</h4>
<div class="form-group container">
	@foreach($servicios as $servicio)
		<div class="checkbox icheck enlinea">
            <label>
                {{ Form::checkbox('servicios[]', $servicio->id) }}
                <strong>{{ $servicio->nombre }}</strong>
            </label>
        </div>
	@endforeach
</div>
<hr>

<div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
    {{ Form::label('descripcion', 'Descripcion del Problema') }}
    {{ Form::textarea('descripcion',null,['class'=> 'form-control text-uppercase', 'placeholder'=>'BREVE DESCRIPCION DEL PROBLEMA', 'rows'=>'4']) }}
    @if ($errors->has('descripcion'))
        <span class="help-block">
            <strong>{{ $errors->first('descripcion') }}</strong>
        </span>
    @endif
</div>
<div class="form-group text-center">
    {{ Form::submit('GUARDAR', ['class'=>'btn btn-flat btn-success']) }}
    @if(isset($externo))
    <a href="javascript:void(0);" onclick="imprimirExterno({{ $externo->id }});return false;" class="btn btn-flat btn-warning">VISTA PREVIA</a>
    @endif
    <a href="{{ route('externos.index') }}" class="btn btn-flat btn-danger">CANCELAR</a>
</div>

@include('reportes.imprimir.modal-imprimir')

@section('scripts')
<!-- iCheck -->
<script src="{{ asset('plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
<!-- Autocompletado -->
<script src="{{ asset('plugins/bootstrap3-typeahead/bootstrap3-typeahead.js') }}" type="text/javascript"></script>

<script>
    let imprimirExterno = id => {
        let ruta = `${direccion}/informes/externos/${id}/imprimir`
        imprimir(ruta)
    }
    // Script para personalizar los checkbutton del formulario
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
    // Script para colocar al campo unidad como autocompletado
    var route_unidades = "{{ route('unidads.getUnidads') }}";
    $.get(route_unidades, function(data){
    $("#unidad").typeahead({
        source:data,
        displayText: function(data){ return data.nombre;},
    });
    },'json');
</script>
@endsection