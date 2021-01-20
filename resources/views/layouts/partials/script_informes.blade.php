@section('css')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}">

<!-- kartik-v-bootstrap-fileinput -->
<link rel="stylesheet" href="{{asset('plugins/kartik-v-bootstrap-fileinput/css/fileinput.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/kartik-v-bootstrap-fileinput/css/fileinput-rtl.min.css')}}">

{{-- <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.css') }}"> --}}
@endsection
@section('scripts')
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script>
$('.select').select2();
</script>

<!-- CK Editor -->
<script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
<!-- kartik-v-bootstrap-fileinput -->
<script src="{{asset('plugins/kartik-v-bootstrap-fileinput/js/plugins/piexif.min.js')}}"></script>
<script src="{{asset('plugins/kartik-v-bootstrap-fileinput/js/plugins/sortable.min.js')}}"></script>
<script src="{{asset('plugins/kartik-v-bootstrap-fileinput/js/plugins/purify.min.js')}}"></script>
<script src="{{asset('plugins/kartik-v-bootstrap-fileinput/js/fileinput.min.js')}}"></script>
<script src="{{asset('plugins/kartik-v-bootstrap-fileinput/themes/fa/theme.min.js')}}"></script>
<script src="{{asset('plugins/kartik-v-bootstrap-fileinput/js/locales/es.js')}}"></script>
{{-- <script src="{{ asset('plugins/sweetalert2/sweetalert2.js') }}"></script> --}}
<!-- script personalizados -->
{{-- <script src="{{asset('js/script.js')}}"></script> --}}
@endsection