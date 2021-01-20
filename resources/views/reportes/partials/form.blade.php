<div class="form-group">
    {{ Form::label('fecha1','Fecha Inicio') }}
    <div class="input-group date">
        <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
        </div>
        {{ Form::text('fecha1',null,['class'=> 'form-control pull-rigth date','id'=>'fecha1']) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('fecha2','Fecha Final') }}
    <div class="input-group date">
        <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
        </div>
        {{ Form::text('fecha2',null,['class'=> 'form-control pull-rigth date','id'=>'fecha2']) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('tipo','Tipo de Informe') }}
    {{ Form::select('tipo',$tipos,null,['class'=>'form-control','id'=>'tipo','placeholder'=>'Seleccione un tipo de Informe']) }}
</div>
<div class="form-group">
    {{ Form::label('usuario','Tecnico') }}
    @if(auth()->user()->isRole('admin') || auth()->user()->isRole('encargado'))
    {{ Form::select('usuario',$usuarios,null,['class'=>'form-control','id'=>'usuario', 'placeholder'=>'Seleccione un Tecnico']) }}
    @else
    {{ Form::text('usuarionombre',Auth::user()->tecnico->fullnombre,['class'=>'form-control','readonly'=>'readonly']) }}
    {{ Form::hidden('usuario',auth()->id(),['class'=>'form-control','id'=>'usuario']) }}
    @endif
</div>
    
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <button class="btn-block btn btn-flat btn-info btn-sm" id="btn-imprimir"><i class="fa fa-print fa-btn"></i> IMPRIMIR REPORTE</button>
    </div>
</div>
<br>
@include('reportes.imprimir.modal-imprimir')