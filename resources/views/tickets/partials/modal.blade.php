<div class="modal modal-danger fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{ $id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Anular Ticket</h4>
      </div>
      {!! Form::open(['route' => ['tickets.destroy',$id], 'method' => 'DELETE']) !!}
      <div class="modal-body">
        <p>
          Desea anular el ticket {{ $nro_ticket }} / {{ $gestion }}
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-outline">Confirmar</button>
      </div>
      {!! Form::close() !!}
    </div>    
  </div>
</div>
