<div class="form-group">
    {{ Form::label('mes','Mes') }}
    <div class="input-group date">
        <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
        </div>
        {{ Form::text('mes',null,['class'=> 'form-control pull-rigth mes','id'=>'mes']) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('anio','Año:') }}
    <div class="input-group date">
        <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
        </div>
        {{ Form::text('anio',null,['class'=> 'form-control pull-rigth anio','id'=>'anio']) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('tipo','Tipo de Informe') }}
    {{ Form::select('tipo',$tipos,null,['class'=>'form-control','id'=>'tipomes','placeholder'=>'Seleccione un tipo de Informe']) }}
</div>
<div class="form-group">    
    @if( auth()->user()->isRole('admin') || auth()->user()->isRole('encargado') )
        {{ Form::label('usuario','Usuarios') }}
        {{ Form::select('usuario',$usuarios,null,['class'=>'form-control','id'=>'usuariomes', 'placeholder'=>'Seleccione un Tecnico']) }}
    @else
        {{ Form::label('usuario','Usuario') }}
        {{ Form::text('usuarionombre',Auth::user()->tecnico->fullnombre,['class'=>'form-control','readonly'=>'readonly']) }}
        {{ Form::hidden('usuario',Auth::id(),['class'=>'form-control','id'=>'usuariomes']) }}
    @endif
</div>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <button class="btn-block btn btn-flat btn-info btn-sm" id="btn-imprimir-mes"><i class="fa fa-print fa-btn"></i> IMPRIMIR REPORTE</button>
    </div>
</div>
<br>
@include('reportes.imprimir.modal-imprimir')