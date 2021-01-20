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
<div class="row">
		<div class="col-md-6">
			<div class="form-group{{ $errors->has('equipo_faltante') ? ' has-error' : '' }}">
				{{ Form::label('equipo_faltante', 'Equipo Faltante') }}
				{{ Form::textarea('equipo_faltante',null,['class'=> 'form-control','rows' =>'4', 'id'=>'equipo_faltante']) }}
				@if ($errors->has('equipo_faltante'))
					<span class="help-block">
						<strong>{{ $errors->first('equipo_faltante') }}</strong>
					</span>
				@endif
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group{{ $errors->has('equipo_repuesto') ? ' has-error' : '' }}">
				{{ Form::label('equipo_repuesto', 'Equipo Repuesto') }}
				{{ Form::textarea('equipo_repuesto',null,['class'=> 'form-control','rows' =>'4', 'id'=>'equipo_repuesto']) }}
				@if ($errors->has('equipo_repuesto'))
					<span class="help-block">
						<strong>{{ $errors->first('equipo_repuesto') }}</strong>
					</span>
				@endif
			</div>
		</div>
	</div>
	
	<div class="form-group{{ $errors->has('observaciones') ? ' has-error' : '' }}">
		{{ Form::label('observaciones', 'Observaciones') }}
		{{ Form::textarea('observaciones',null,['class'=> 'form-control','rows' =>'2','id'=>'observaciones','placeholder'=>'OBSERVACIONES ADICIONALES']) }}
		@if ($errors->has('observaciones'))
			<span class="help-block">
				<strong>{{ $errors->first('observaciones') }}</strong>
			</span>
		@endif
	</div>

	@if(isset($reposicion))
	<div class="row">
		<div class="col-md-12">
		<ul class="mailbox-attachments" id="preview">
			@foreach($reposicion->fotos as $foto)
			<li> 
				<span class="mailbox-attachment-icon has-img">
					<img src="{{ asset('img/fotos/reposicion/'.$foto->carpeta.'/'.$foto->nombre) }}" alt="{{ $foto->nombre }}">
				</span>
	
				<div class="mailbox-attachment-info">
					<a href="javascript:void(0);" onclick="mostrar({{ $foto->id }},'reposicion');return false;" class="mailbox-attachment-name"><i class="fa fa-camera"></i> {{ $foto->nombre }}</a>
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
	@if(isset($reposicion))
	<a href="javascript:void(0);" onclick="imprimirReposicion({{ $reposicion->id }});return false;" class="btn btn-flat btn-warning">VISTA PREVIA</a>
	@endif
	<a href="{{ route('reposicions.index') }}" class="btn btn-flat btn-danger">CANCELAR</a>
</div>
@include('reportes.imprimir.modal-imprimir')
@include('layouts.partials.script_informes')

@section('scripts2')
<script>
	//Funcion para imprimir el informe
	let imprimirReposicion = id => {
		let ruta = `${direccion}/informes/reposicions/${id}/imprimir`
		imprimir(ruta)
	}
	
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
			{ name: 'paragraph', items: [ 'BulletedList'] },
			{ name: 'texttransform', items: [ 'TransformTextToUppercase' ] },
		];
	// Reemplazar el <textarea id="equipo_faltante"> con una instancia de CKEditor
  	CKEDITOR.inline('equipo_faltante',{
    	language: 'es',
		disableAutoInLine: true,
		forcePasteAsPlainText: true,
    	});
	// Reemplazar el <textarea id="equipo_repuesto"> con una instancia de CKEditor
	CKEDITOR.inline('equipo_repuesto',{
    	language: 'es',
		disableAutoInLine: true,
		forcePasteAsPlainText: true,
    	});
	// Reemplazar el <textarea id="observaciones"> con una instancia de CKEditor
	CKEDITOR.inline('observaciones',{
    	language: 'es',
		disableAutoInLine: true,
		forcePasteAsPlainText: true,
    	});
</script>
@endsection
