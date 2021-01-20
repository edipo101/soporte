<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-observaciones-{{ $id }}" style="color:black">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Ver observaciones de la direccion IP</h4>
            </div>
            {!! Form::open(['route' => ['direccions.quitarobservaciones',$id], 'method' => 'GET']) !!}
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            {{ Form::label('observacion', 'Observaciones') }}
                        </div>
                        <div class="col-xs-12">
                            {{ Form::textarea('observacion',$observacion,['class'=> 'form-control','rows'=>'3','readonly'=>'readonly']) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Quitar Observaciones</button>
            </div>
            {!! Form::close() !!}
            </div>
        </div>  
    </div>
</div>