<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">Enviar a contratación  : <strong>{{$candidato->nombres." ".$candidato->primer_apellido." ".$candidato->segundo_apellido}}</strong> </h4>
</div>
<div class="modal-body">
{!! Form::model(Request::all(),["id"=>"fr_contratar_req"]) !!}
{!! Form::hidden("candidato_req",$candidato->req_candidato,["id"=>"candidato_req_fr"]) !!}
{!! Form::hidden("cliente_id",null) !!}
 
  {{$mensaje}}

    <br>
    <br>
    @if($proceso != null && $proceso->apto == "")
    {{--    {!! Form::hidden("aprobar_cliente","true") !!}
    <div class="col-md-12 form-group">
        <label for="inputEmail3" class="col-sm-4 control-label"> Seleccione el usuario quien aprobo este cliente </label>
        <div class="col-sm-8">

          {!!Form::select ("usuario_terminacion",$usuarios_clientes,null,["class"=>"form-control"]);!!}
        </div>
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("usuario_terminacion",$errors) !!}</p>
    </div>--}}
    @endif

    <h3>Datos de contratación</h3>
     {{-- {{ dd($contra_clientes) }} --}}
     
    @if($contra_clientes != null)
        <div class="col-md-12 form-group">
          <label for="inputEmail3" class="col-sm-4 control-label"> Fecha Ingreso* </label>
           <div class="col-sm-8">
            {!! Form::text ("fecha_inicio_contrato",$contra_clientes->fecha_ingreso_contra,["class"=>"form-control","id"=>"fecha_inicio_contrato"]); !!}
           </div>
           <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("fecha_ingreso_contra",$errors) !!}</p>
        </div>

        <div class="col-md-12 form-group">
          <label for="inputEmail3" class="col-sm-4 control-label"> Fecha Retiro* </label>
           <div class="col-sm-8">
            {!! Form::text ("fecha_fin_contrato",$contra_clientes->fecha_fin_contrato,["class"=>"form-control","id"=>"fecha_fin_contrato"]); !!}
           </div>
          <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("fecha_fin_contrato",$errors) !!}</p>
        </div>
        
         <div class="col-md-12 form-group">
            <label for="inputEmail3" class="col-sm-4 control-label"> Centro de costos* </label>
            <div class="col-sm-8">
             {!! Form::select("centro_costos", $centros_costos, (!empty($contra_clientes->centro_costos)) ? $contra_clientes->centro_costos : $requerimiento->centro_costo_id, ["class" => "form-control","id" => "centro_costos"]); !!}
            </div>
            <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("observaciones",$errors) !!}</p>
        </div>

        <div class="col-md-12 form-group">
         <label for="inputEmail3" class="col-sm-4 control-label"> Observaciones* </label>
          <div class="col-sm-8">
           {!! Form::textarea("observaciones",$contra_clientes->observaciones,["class"=>"form-control","rows"=>'2']); !!}
          </div>
          <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("observaciones",$errors) !!}</p>
        </div>
        
        <div class="col-md-12 form-group">
            @if(route("home") == "http://komatsu.t3rsc.co" || route("home") == "https://komatsu.t3rsc.co")
                <label for="inputEmail3" class="col-sm-4 control-label">Quién autorizó * </label>
            @else
              <label for="inputEmail3" class="col-sm-4 control-label">Quién autorizó por parte del cliente* </label>
            @endif
            <div class="col-sm-8">
             {!! Form::select ("user_autorizacion",$usuarios_clientes,$contra_clientes->user_autorizacion,["class"=>"form-control"]); !!}
            </div>
            <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("user_autorizacion",$errors) !!}</p>
        </div>
    @else

        <div class="col-md-12 form-group">
            <label for="inputEmail3" class="col-sm-4 control-label"> Fecha Ingreso* </label>
             <div class="col-sm-8">
              {!! Form::text("fecha_inicio_contrato",$requerimiento->fecha_ingreso,["class"=>"form-control","id"=>"fecha_inicio_contrato"]); !!}
              </div>
             <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("fecha_inicio_contrato",$errors) !!}</p>
        </div>
      
        <div class="col-md-12 form-group">
         <label for="inputEmail3" class="col-sm-4 control-label">Fecha Retiro * </label>
          <div class="col-sm-8">
           {!! Form::text ("fecha_fin_contrato",null,["class"=>"form-control","id"=>"fecha_fin_contrato"]); !!}
          </div>
         <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("fecha_fin_contrato",$errors) !!}</p>
        </div>

        <div class="col-md-12 form-group">
          <label for="inputEmail3" class="col-sm-4 control-label"> Centro de costos* </label>
            <div class="col-sm-8">
              {!! Form::select("centro_costos", $centros_costos, $requerimiento->centro_costo_id, ["class" => "form-control","id" => "centro_costos"]); !!}
            </div>
          <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("observaciones",$errors) !!}</p>
        </div>
       
        <div class="col-md-12 form-group">
         <label for="inputEmail3" class="col-sm-4 control-label"> Observaciones* </label>
          <div class="col-sm-8">
            {!! Form::textarea("observaciones",null,["class"=>"form-control","rows"=>'2']);!!}
          </div>
         <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("observaciones",$errors) !!}</p>
        </div>
        <div class="col-md-12 form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Quién autorizó por parte del cliente* </label>
            <div class="col-sm-8">

                {!! Form::select ("user_autorizacion",$usuarios_clientes,$user_id,["class"=>"form-control"]); !!}
            </div>
            <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("user_autorizacion",$errors) !!}</p>
        </div>
    @endif
  
{!! Form::close() !!}

<div class="clearfix"></div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
<button type="button" class="btn btn-success" id="confirmar_contratacion" >Confirmar</button>
</div>
<script>

$(function () {

  var confDatepicker = {
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
    
    $("#fecha_fin_contrato, #fecha_inicio_contrato").datepicker(confDatepicker);

         jQuery(document).on('change', '#fecha_inicio_contrato', (event) => {
        const element = event.target;
        
        jQuery('#fecha_fin_contrato').datepicker('option', 'minDate', element.value);
    });


  });
</script>