<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

    <h4 class="modal-title">
        @if(count($candidato) > 0)
            <h5>
                <strong>
                       {{ "¿Enviar a pre-contratar a ".$candidato->numero_id." ".$candidato->nombres." ".$candidato->primer_apellido."?" }}

                </strong>
            </h5>
        @endif
    
    </h4>
</div>


<div class="modal-body">
    
    
    @if(count($candidato) > 0)
    {!! Form::model(Request::all(), ["id" => "fr_pre_contratar"]) !!}
        {!! Form::hidden("candidato_req", $candidato->req_candidato, ["id" => "candidato_req"]) !!}

        
        <div class="row">

            <div class="col-md-6 form-group">
                <label class="control-label" for="inputEmail3">
                    Fecha tentativa de ingreso:
                </label> 
                {!! Form::text("fecha_inicio", $candidato->fecha_inicio, ["class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300", "placeholder" => "Fecha Inicial", "id" => "fecha_inicio","readonly" => "readonly" ]); !!}
            </div>

            <div class="col-md-6 form-group">
                <label for="inputEmail3" class="control-label">Usuario contratación asignado:</label>

                {!! Form::select("usuario_asignado_id",$usuario_asignado, null, ["class"=>"form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300", "required"=> true, "id" => "usuario_asignado_id"]); !!}
            </div>
        </div>
        <br>
  
        @if($candidato->porcentaje < 100)
            <p>Ups... este candidato aún no ha cargado el <b>100%</b> de los documentos a la plataforma. ¿Deseas enviarlo a pre-contratar de todos modos?</p>
        @else
            <p>¿Enviar a pre-contratar a este candidato/a?</p>
        @endif
        
    {!! Form::close() !!}
    @endif

    @if(count($candi_no_cumplen) > 0)   
            <?php $no_cumple = $candi_no_cumplen->first(); ?>
        @if($no_cumple->observacion_no_cumple['tipo'] == 1)
            <p>El candidato o la candidata <b>{{ $no_cumple->numero_id." ".$no_cumple->nombres." ".$no_cumple->primer_apellido }}</b> debe tener <b>completos</b> los datos para su envío a pre-contratar.</p>
            <br>
            <p>Ingresa a su hoja de vida y actualiza sus datos básicos como:</p>
            <p>
                Tipo de documento,
                Dirección,
                Eps,
                Afp,
                Fecha de expedición documento,
                Fecha de nacimiento,
                Lugar de residencia,
                Teléfono,
                Lugar expedición
                {{$$candi_no_cumplen->apto}}
            </p>
      
            @else
               
                @if($no_cumple->observacion_no_cumple['tipo'] == 3)
                <p>El candidato o la candidata <b>{{ $no_cumple->numero_id." ".$no_cumple->nombres." ".$no_cumple->primer_apellido }}</b> tiene un concepto "NO APTO" en la entrevista, no podrás enviarlo al Pre-Contratar.</p>
                @else
                    <p>El candidato o la candidata <b>{{ $no_cumple->numero_id." ".$no_cumple->nombres." ".$no_cumple->primer_apellido }}</b> ya se encuentra en proceso de pre-contratación o contratación y no se puede enviar a pre-contratar</p>
                @endif
                    
                
            @endif

     
    @endif
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default | tri-px-2 tri-br-2 tri-border--none tri-transition-200" data-dismiss="modal">Cerrar</button>
    @if(count($candidato) > 0)
        <button type="button" class="btn btn-success | tri-px-2 tri-br-2 tri-border--none tri-transition-300 tri-green" id="pre_contratar_enviar" >Enviar</button>
    @endif
</div>


<script>
    $(function () {
        var confDatepicker2 = {
            altFormat: "yy-mm-dd",
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            buttonImage: "img/gifs/018.gif",
            buttonImageOnly: true,
            autoSize: true,
            dayNames: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
            monthNamesShort: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
            yearRange: "1930:2050",
            minDate:new Date()
        };

        $("#fecha_inicio").datepicker(confDatepicker2);
    })
</script>