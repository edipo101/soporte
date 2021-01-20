<div class="row">
    <div class="col-md-3 hidden-xs">
        <div class="box">
            <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-info-circle"></i> Informacion</h3>
            </div>
            <div class="box-body">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>DATOS DEL INFORME</b>
                        <p class='text-muted'><strong>Nro. de Informe:</strong>{{ $recepcion->nro_informe }}</p>
                        <p class='text-muted'><strong>Fecha del Informe:</strong>{{ $recepcion->fecha_informe }}</p>
                        <p class='text-muted'><strong>Solicitante:</strong>{{ $recepcion->ticket->solicitante }}</p>
                        <p class='text-muted'><strong>Asunto:</strong>{{ $recepcion->asunto }}</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-file-archive-o"></i> Datos de la Funcionario Solicitante</h3>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('carnet') ? ' has-error' : '' }}">
                            {{ Form::label('carnet', 'Carnet') }}
                            {{ Form::text('carnet',null,['class'=> 'form-control text-uppercase', 'placeholder'=>'00000000','autocomplete'=>'off']) }}
                            
                            @if ($errors->has('carnet'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('carnet') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('exp') ? ' has-error' : '' }}">
                            {{ Form::label('exp', 'EXP') }}
                            {{ Form::select('exp',$expeditos,null,['class'=> 'form-control select text-uppercase', 'placeholder'=>'EXPEDITO']) }}
                            @if ($errors->has('exp'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('exp') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('cargo') ? ' has-error' : '' }}">
                            {{ Form::label('cargo', 'CARGO') }}
                            {{ Form::text('cargo',null,['class'=> 'form-control text-uppercase', 'placeholder'=>'NOMBRE DEL CARGO']) }}

                            @if ($errors->has('cargo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cargo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            {{ Form::label('nombre', 'Nombre') }}
                            {{ Form::text('nombre',null,['class'=> 'form-control text-uppercase', 'placeholder'=>'-- NOMBRES DEL FUNCIONARIO --']) }}
                            
                            @if ($errors->has('nombre'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nombre') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('apellidos') ? ' has-error' : '' }}">
                            {{ Form::label('apellidos', 'Apellidos') }}
                            {{ Form::text('apellidos',null,['class'=> 'form-control text-uppercase', 'placeholder'=>'-- APELLIDOS DEL FUNCIONARIO --']) }}
                            
                            @if ($errors->has('apellidos'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('apellidos') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <h5><strong>Cambiar Fecha</strong></h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('fecha_informe') ? ' has-error' : '' }}">
                            {{-- {{ Form::label('fecha_informe', 'Fecha') }} --}}
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {{ Form::text('fecha_informe',null,['class'=> 'form-control date','id' => 'fecha_informe']) }}
                            </div>

                            @if ($errors->has('fecha_informe'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fecha_informe') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col md-12"> --}}
                        <div class="form-group{{ $errors->has('observacion_fecha') ? ' has-error' : '' }}">
                            {{ Form::label('observacion_fecha', 'Observacion del cambio de fecha') }}
                            {{ Form::textarea('observacion_fecha', null,['class'=> 'form-control text-uppercase', 'rows'=> '3','id'=>'observacion_fecha']) }}
                    
                            @if ($errors->has('observacion_fecha'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('observacion_fecha') }}</strong>
                                </span>
                            @endif
                        </div>
                    {{-- </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>


<hr>


<div class="form-group text-center">
	{{ Form::submit('GUARDAR', ['class'=>'btn btn-flat btn-success']) }}
	<a href="{{ route('recepcions.index') }}" class="btn btn-flat btn-danger">CANCELAR</a>
</div>

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
@endsection

@section('scripts2')

<script src="{{ asset('plugins/moment/moment.js') }}"></script>
<script src="{{ asset('plugins/moment/locale/es.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

<!-- Autocompletado -->
<script src="{{ asset('plugins/bootstrap3-typeahead/bootstrap3-typeahead.js') }}"></script>

<script type="text/javascript">
$(function () {
    $('.date').datetimepicker({
    	format: 'YYYY-MM-DD HH:mm:ss',
    	locale: 'es'
    });
});


let route_funcionarios = "{{ route('funcionarios.getFuncionarios') }}";
$.get(route_funcionarios, data => {
	$("#carnet").typeahead({
		source:data,
		displayText: function(data){ return data.carnet;},
	});
},'json');

let carnet = document.getElementById('carnet');

carnet.addEventListener('blur', e => {
	e.preventDefault();
	// let route_contratos = `${direccion}/api/api-contratos/${carnet.value}`;
    vercarnet = document.getElementById('carnet').value;
    if(vercarnet === '')
    {
        alert('introduzca el carnet')
    }else{
        let route_funcionario = `${direccion}/api/api-funcionarios/${carnet.value}`;

        $.get(route_funcionario, data =>{
            limpiarN();
            if(data.mensaje!='E'){
                document.getElementById('exp').value = data.exp;
                document.getElementById('nombre').value = data.nombre;
                document.getElementById('apellidos').value = data.apellidos;
                document.getElementById('cargo').value = data.cargo;
            }
        });
    }
})

const limpiarN = () => {
	document.getElementById('exp').value = "";
	document.getElementById('nombre').value = "";
	document.getElementById('apellidos').value = "";
    document.getElementById('cargo').value = "";
}


</script>
@endsection

