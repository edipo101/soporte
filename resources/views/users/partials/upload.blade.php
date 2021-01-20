<div class="box-body">
    @if(isset($tecnico))
        <img id='imagen' src="{{ asset('img/users/'.$tecnico->foto) }}" alt="Foto" class="img-responsive img-thumbnail">
    @else
        <img id='imagen' src="{{ asset('img/users/default.jpg') }}" alt="Foto" class="img-responsive img-thumbnail">
    @endif
</div>
<!-- /.box-body -->
<div class="box-footer">
    <button type="button" id='upload' class="btn btn-flat bg-black btn-sm btn-block"><i class="fa fa-picture-o"></i> SUBIR FOTO</button>
</div>

@section('css')
	<link rel="stylesheet" href="{{ asset('plugins/dropzone/basic.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/dropzone/dropzone.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.css') }}">
@endsection

@section('scripts')
<script src="{{ asset('plugins/dropzone/dropzone.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.js')}}"></script>
<script>
	$('select').select2();
  	const imagen = document.getElementById('imagen');
  	const fotografia = document.getElementById('fotografia');
  	const botonUpload = document.getElementById('upload');
  	botonUpload.addEventListener('click',e=>{
    	$('#modal-logo').modal('show');
  	});
  	Dropzone.options.miDropzone = {
		paramName: "file",
		dictDefaultMessage: 'Arrastre el logo aqui para subir al sistema',
		dictRemoveFile: 'Eliminar archivo',
		addRemoveLinks: true,
		autoProcessQueue:false,
		maxFiles:1,
		acceptedFiles:'.png,.jpg,.gif,.bmp,.jpeg',
		init:function(){
			let submitButton = document.getElementById('button-upload');
			myDropzone = this;
			submitButton.addEventListener('click', function(){
				myDropzone.processQueue();
			});
			this.on('complete', function(res){
				if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
				{
					let _this = this;
					_this.removeAllFiles();
					$('#modal-logo').modal('hide');
					let response = JSON.parse(res.xhr.responseText);
					imagen.src = `${direccion}${response}`;
					fotografia.value = response;
				}
			});
		},
  	};
</script>
@endsection