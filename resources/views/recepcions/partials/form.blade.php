@include('tickets.partials.info-ticket')

@include('tickets.partials.ticket')
<div class="row">
	<div class="col-md-6">
		<div class="form-group{{ $errors->has('orden_compra') ? ' has-error' : '' }}">
			{{ Form::label('orden_compra', 'Orden de Compra') }}
			@if(isset($recepcion_apartir))
			{{ Form::text('orden_compra',"",['class'=> 'form-control', 'placeholder'=>'NUMERO DE ORDEN DE COMPRA']) }}	
			@else
			{{ Form::text('orden_compra',null,['class'=> 'form-control', 'placeholder'=>'NUMERO DE ORDEN DE COMPRA']) }}
			@endif
			@if ($errors->has('orden_compra'))
				<span class="help-block">
					<strong>{{ $errors->first('orden_compra') }}</strong>
				</span>
			@endif
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group{{ $errors->has('empresa') ? ' has-error' : '' }}">
			{{ Form::label('empresa', 'Empresa') }}
			{{ Form::text('empresa',null,['class'=> 'form-control text-uppercase','placeholder'=>'NOMBRE DE LA EMPRESA', 'id'=>'empresa']) }}
			@if ($errors->has('empresa'))
				<span class="help-block">
					<strong>{{ $errors->first('empresa') }}</strong>
				</span>
			@endif
		</div>
	</div>
</div>

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
	{{ Form::textarea('caracteristicas',null,['class'=> 'form-control','rows' =>'4', 'placeholder'=>'DESCRIPCION DE LA CARACTERISTICA', 'id'=>'caracteristicas']) }}
	{{-- {{ Form::textarea('caracteristicas',null,['class'=> 'form-control','rows' =>'4', 'placeholder'=>'DESCRIPCION DE LA CARACTERISTICA', 'id'=>'caracteristicas', 'contenteditable' => 'true']) }} --}}
	@if ($errors->has('caracteristicas'))
        <span class="help-block">
            <strong>{{ $errors->first('caracteristicas') }}</strong>
        </span>
    @endif
</div>

<div class="form-group{{ $errors->has('observaciones') ? ' has-error' : '' }}">
	{{ Form::label('observaciones', 'Recomendaciones') }}
	{{ Form::textarea('observaciones',null,['class'=> 'form-control','rows' =>'2', 'placeholder'=>'DESCRIPCION  DE LAS RECOMENDACIONES', 'id' => 'observaciones', 'contenteditable' => 'true']) }}
	@if ($errors->has('observaciones'))
        <span class="help-block">
            <strong>{{ $errors->first('observaciones') }}</strong>
        </span>
    @endif
</div>
@if(isset($recepcion))
<div class="row">
	<div class="col-md-12">
	<ul class="mailbox-attachments" id="preview">
		@foreach($recepcion->fotos as $foto)
		<li> 
			<span class="mailbox-attachment-icon has-img">
				<img src="{{ asset('img/fotos/recepcion/'.$foto->carpeta.'/'.$foto->nombre) }}" alt="{{ $foto->nombre }}">
			</span>

			<div class="mailbox-attachment-info">
				<a href="javascript:void(0);" onclick="mostrar({{ $foto->id }},'recepcion');return false;" class="mailbox-attachment-name"><i class="fa fa-camera"></i> {{ $foto->nombre }}</a>
				<span class="mailbox-attachment-size">
					{{ $foto->tamanio }}
					<a href="javascript:void(0);" onclick="eliminarfoto({{ $foto->id }});return false;" class="btn btn-danger btn-xs pull-right"><i class="fa fa-trash"></i></a>
				</span>
			</div>
		</li>
		@endforeach
	</ul>
	@include('fotos.show')
	</div>
</div>
@endif
<hr>
<h4 class="lead text-center">Reportes Fotograficos</h4>
<div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
    {{ Form::label('adjunto', 'Documento Adjunto:',['class'=>'form-label'])}}
    <div class="file-loading"> 
        <input id="photo" name="photo[]" type="file" multiple>
    </div>
    @if ($errors->has('photo'))
        <span class="help-block">
            <strong>{{ $errors->first('photo') }}</strong>
        </span>
    @endif
</div>


<div class="form-group text-center">
	{{ Form::submit('GUARDAR', ['class'=>'btn btn-flat btn-success']) }}
	@if(isset($recepcion))
	<a href="javascript:void(0);" onclick="imprimirRecepcion({{ $recepcion->id }});return false;" class="btn btn-flat btn-warning">VISTA PREVIA</a>
	@endif
	<a href="{{ route('recepcions.index') }}" class="btn btn-flat btn-danger">CANCELAR</a>
</div>
@include('reportes.imprimir.modal-imprimir')
@include('layouts.partials.script_informes')

@section('scripts2')
<script>
	//Funcion para imprimir el informe
	let imprimirRecepcion = id => {
		let ruta = `${direccion}/informes/recepcions/${id}/imprimir`
		imprimir(ruta)
	}
	
	//Configuracion para la subida de fotografias
	$("#photo").fileinput({
		language: 'es',
		showUpload: false,
		maxFileCount: 3,
        maxFileSize: 2048,
	});
	//Configuracion de CKEDITOR
   	CKEDITOR.config.extraPlugins='confighelper';
   	CKEDITOR.config.extraPlugins = 'texttransform';
    CKEDITOR.config.toolbar = [
		    { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'Undo', 'Redo' ] },
			{ name: 'editing', items: [ 'SelectAll' ] },
			{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat' ] },
			{ name: 'paragraph', items: [ 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
			{ name: 'insert', items: [ 'Table','PageBreak'] },
			{ name: 'texttransform', items: [ 'TransformTextToUppercase' ] },
			{ name: 'document', items: [ 'Source' ] },
		];
	// Reemplazar el <textarea id="caracteristicas"> con una instancia de CKEditor
	CKEDITOR.replace('caracteristicas',{
    	language: 'es',
		height: 400,
		toolbarCanCollapse: true,
		forcePasteAsPlainText: true,
    	});
	// Reemplazar el <textarea id="diagnostico"> con una instancia de CKEditor
	CKEDITOR.inline('observaciones',{
    	language: 'es',
		disableAutoInLine: true,
		forcePasteAsPlainText: true,
    	});
</script>
@endsection
