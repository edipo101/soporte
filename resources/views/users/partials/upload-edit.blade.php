<div class="dz-message">
    Seleccione la fotografia del Usuario
</div>
<div class="dropzone-previews" style="text-align: center"></div>

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.css') }}">
<!-- Dropzone -->
<link href="{{ asset('/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    .dropzone{
        margin:auto;
        width: 300px;
        height: 300px;
    }
    .dropzone .dz-preview{
        margin: 10px;
        min-height: 250px;
    }
    .dropzone .dz-preview .dz-image{
        width: 250px;
        height: 250px;
    }
    .dz-image img{
        width: 250px;
        height: 250px;
    }
</style>
@endsection

@section('scripts')
<script src="{{ asset('plugins/select2/js/select2.js')}}"></script>
<script>
    $('select').select2();
</script>
<!-- Dropzone -->
<script src="{{ asset('plugins/dropzone/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/dropzone/dropzone.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        Dropzone.options.myDropzone = {
            uploadMultiple: false,
            // previewTemplate: '',
            addRemoveLinks: false,
            maxFiles: 1,
            dictDefaultMessage: '',
            init: function() {
                this.on("addedfile", function(file) {
                    // console.log('addedfile...');
                });
                this.on("thumbnail", function(file, dataUrl) {
                    // console.log('thumbnail...');
                    $('.dz-image-preview').hide();
                    $('.dz-progress').hide();
                    $('.dz-file-preview').hide();
                });
                this.on("success", function(file, res) {
                    console.log('upload success...');
                    $('#fotografia').attr('value', res.path);
                    $('input[name="pic_url"]').val(res.path);
                    console.log(res.path);
                });
                var mockFile = {
                    name: "Foto",
                    size: 12345
                };
                var path_photo = $('#fotografia').attr('value');
                this.emit("addedfile", mockFile);
                this.emit("thumbnail", mockFile, path_photo);
            }
        };
        var myDropzone = new Dropzone("#my-dropzone");
        $('#upload-submit').on('click', function(e) {
            e.preventDefault();
            //trigger file upload select
            $("#my-dropzone").trigger('click');
        });
    });
</script>
@endsection