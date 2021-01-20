@include('tickets.partials.info-ticket')

@include('tickets.partials.ticket')

<div class="form-group{{ $errors->has('asunto') ? ' has-error' : '' }}">
	{{ Form::label('asunto', 'Asunto') }}
	{{ Form::text('asunto',null,['class'=> 'form-control text-uppercase', 'placeholder'=>'ASUSTO DEL INFORME']) }}
	@if ($errors->has('asunto'))
        <span class="help-block">
            <strong>{{ $errors->first('asunto') }}</strong>
        </span>
    @endif
</div>
<div class="form-group{{ $errors->has('caracteristicas') ? ' has-error' : '' }}">
	{{ Form::label('caracteristicas', 'Caracteristicas') }}
	{{ Form::textarea('caracteristicas',null,['class'=> 'form-control area','rows' =>'4', 'placeholder'=>'DESCRIPCION DE LA CARACTERISTICA', 'id'=>'caracteristicas', 'contenteditable' => 'true']) }}
	@if ($errors->has('caracteristicas'))
        <span class="help-block">
            <strong>{{ $errors->first('caracteristicas') }}</strong>
        </span>
    @endif
</div>
<div class="form-group{{ $errors->has('diagnostico') ? ' has-error' : '' }}">
	{{ Form::label('diagnostico', 'Diagnosticos') }}
	{{ Form::textarea('diagnostico',null,['class'=> 'form-control area','rows' =>'2', 'placeholder'=>'DESCRIPCION DEL DIAGNOSTICO', 'id' => 'diagnostico', 'contenteditable' => 'true']) }}
	@if ($errors->has('diagnostico'))
        <span class="help-block">
            <strong>{{ $errors->first('diagnostico') }}</strong>
        </span>
    @endif
</div>
<div class="form-group{{ $errors->has('trabajo_realizado') ? ' has-error' : '' }}">
	{{ Form::label('trabajo_realizado', 'Trabajo Realizado') }}
	{{ Form::textarea('trabajo_realizado',null,['class'=> 'form-control area','rows' =>'2', 'placeholder'=>'DESCRIPCION DEL TRABAJO REALIZADO', 'id' => 'trabajo_realizado', 'contenteditable' => 'true']) }}
	@if ($errors->has('trabajo_realizado'))
        <span class="help-block">
            <strong>{{ $errors->first('trabajo_realizado') }}</strong>
        </span>
    @endif
</div>
<div class="form-group{{ $errors->has('recomendaciones') ? ' has-error' : '' }}">
	{{ Form::label('recomendaciones', 'Recomendaciones') }}
	{{ Form::textarea('recomendaciones',null,['class'=> 'form-control area','rows' =>'2', 'placeholder'=>'DESCRIPCION  DE LAS RECOMENDACIONES', 'id' => 'recomendaciones', 'contenteditable' => 'true']) }}
	@if ($errors->has('recomendaciones'))
        <span class="help-block">
            <strong>{{ $errors->first('recomendaciones') }}</strong>
        </span>
    @endif
</div>

<div class="form-group text-center">
	{{ Form::submit('GUARDAR', ['class'=>'btn btn-flat btn-success']) }}
	@if(isset($reparacion))
	<a href="javascript:void(0);" onclick="imprimirReparacion({{ $reparacion->id }});return false;" class="btn btn-flat btn-warning">VISTA PREVIA</a>
	@endif
	<a href="{{ route('reparacions.index') }}" class="btn btn-flat btn-danger">CANCELAR</a>
</div>
@include('reportes.imprimir.modal-imprimir')
@include('layouts.partials.script_informes')

@section('scripts2')
<script>
	let imprimirReparacion = id => {
		let ruta = `${direccion}/informes/reparacions/${id}/imprimir`
		imprimir(ruta)
	}
	$(function(){
	//Configuracion de CKEDITOR
   	CKEDITOR.config.extraPlugins='confighelper';
   	CKEDITOR.config.extraPlugins = 'texttransform';
    CKEDITOR.config.toolbar = [
		    { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'Undo', 'Redo' ] },
			{ name: 'editing', items: [ 'SelectAll' ] },
			{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat' ] },
			{ name: 'paragraph', items: [ 'BulletedList'] },
			{ name: 'insert', items: [ 'Table','PageBreak'] },
			{ name: 'texttransform', items: [ 'TransformTextToUppercase' ] },
		];
	// Reemplazar el <textarea id="caracteristicas"> con una instancia de CKEditor
  	CKEDITOR.inline('caracteristicas',{
    	language: 'es',
		disableAutoInLine: true,
		forcePasteAsPlainText: true,
    	});
	// Reemplazar el <textarea id="diagnostico"> con una instancia de CKEditor
	CKEDITOR.inline('diagnostico',{
    	language: 'es',
		disableAutoInLine: true,
		forcePasteAsPlainText: true,
    	});
	// Reemplazar el <textarea id="trabajo_realizado"> con una instancia de CKEditor
	CKEDITOR.inline('trabajo_realizado',{
    	language: 'es',
		disableAutoInLine: true,
		forcePasteAsPlainText: true,
    	});
	// Reemplazar el <textarea id="recomendaciones"> con una instancia de CKEditor
    CKEDITOR.inline('recomendaciones',{
    	language: 'es',
		disableAutoInLine: true,
		forcePasteAsPlainText: true,
    	});
	});
</script>
@endsection
