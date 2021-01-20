<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-informe-{{ $id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title"><i class="fa fa-file"></i> Tipo de Informe</h4>
      </div>
      {!! Form::open(['route' => ['tickets.informe',$id],'method'=>'GET']) !!}
      <div class="modal-body text-center">
        <div class="btn-group" data-toggle="buttons">
          <label class="btn btn-app btn-primary">
            {{ Form::radio('tipoinforme','recepcion') }}
            <i class="fa fa-file"></i> Inf. Recepcion
          </label>
          <label class="btn btn-app btn-primary">
            {{ Form::radio('tipoinforme','reparacion') }}
            <i class="fa fa-wrench"></i> Inf. Reparacion
          </label>
          <label class="btn btn-app btn-primary">
            {{ Form::radio('tipoinforme','reposicion') }}
            <i class="fa fa-cogs"></i> Inf. Reposicion
          </label>
          <label class="btn btn-app btn-primary">
            {{ Form::radio('tipoinforme','baja') }}
            <i class="fa fa-chevron-circle-down"></i> Inf. Baja
          </label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Confirmar</button>
      </div>
      {!! Form::close() !!}
    </div>    
  </div>
</div>
