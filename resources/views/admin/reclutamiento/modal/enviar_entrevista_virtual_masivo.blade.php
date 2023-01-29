<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Realizar entrevista virtual  : 
    
        @foreach($datos_basicos as $candi)
        <strong><br>{{mb_strtoupper($candi)}}</strong>
        @endforeach 
</h4>
</div>
<div class="modal-body">
    {!! Form::open(["id"=>"fr_entre_vir_masi"]) !!}
    {!! Form::hidden("req_can_id",$req_can_id_j,["id"=>"candidato_req_fr"]) !!}
    {!! Form::hidden("req_id",$req_id) !!}
    {!! Form::hidden("cliente_id",$cliente_id) !!}

    ¿Desea enviar a estos candidatos a entrevista virtual?
    {!! Form::close() !!}


    <div class="clearfix"></div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-success" id="confirmar_entrevista_virtual_masivo" >Confirmar</button>
</div>
