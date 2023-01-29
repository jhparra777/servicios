<style>
    .titulo1{
    background: #f0f0f0 none repeat scroll 0 0;
    font-weight: bold;
    padding: 10px;
    text-align: center;
}
</style>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Clonar Requerimiento</h4>
</div>

<div class="modal-body">
    {!! Form::model(Request::all(),["route" => "admin.guardar_requerimiento_copia" ,"method" => "post"]) !!}

        <div class="col-md-12" id="mensaje-resultado">
            
            <div class="alert alert-info alert-dismissible" role="alert">
                <p><b>Se creara un requerimiento con los datos del seleccionado.</b></p>
            </div>

        </div>

        <div class="col-md-12">

            <div class="box box-info">
                <div class="box-header with-border">
                    <h4 class="box-header with-border">REQUERIMIENTO A COPIAR</h4>
                </div>

                <div class="box-body">
                    <div class="chart">
                        @include("admin.requerimientos.includes._informacion_requerimiento")
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <input type="hidden" name="req_id" id="req_id" value="{{ $requerimiento->id }}">

            <div class="alert alert-info alert-dismissible" role="alert">
                <p>COMPLETA LOS SIGUIENTES CAMPOS PARA EL NUEVO REQUERIMIENTO.</p>

                <p><b>PUEDES CREAR MÁS DE UNO DANDO CLICK EN EL BOTÓN +</b></p>
            </div>
        </div>

        <div class="col-md-12">
            <div id="postulados">
                <div class="row" style="border-bottom: solid 1px #bfbfbf; padding-top: 1.4rem;">
                    <div class="col-md-3">
                        <div class="form-group campos_select">
                            <label>Ciudad <span class='text-danger sm-text-label'>*</span></label>
                            {!! Form::select('ciudad_trabajo[]', $ciudadesSelect, null, ['id'=>'ciudad_trabajo','class'=>'form-control js-select-2-basic-city | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Salario <span class='text-danger sm-text-label'>*</span></label>
                            <input type="number" class="form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300" placeholder="SALARIO" name="salario[]" required="required">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Vacantes <span class='text-danger sm-text-label'>*</span></label>
                            <input type="number" class="form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300" placeholder="VACANTES" name="num_vacantes[]" required="required">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Asignado a <span class='text-danger sm-text-label'>*</span></label>
                            {!! Form::select("asignado_a[]",$psicologos, null, ["class"=>"form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300", "id" => "asignado_a", "required" => "required"]); !!}
                        </div>
                    </div>

                    <div class="col-md-2 form-group last-child">
                        <br>
                        <button type="button" class="btn btn-success add-person | tri-px-2 tri-br-2 tri-border--none tri-transition-300 tri-green">+</button>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Fecha Tentativa de ingreso <span class='text-danger sm-text-label'>*</span></label>
                            {!! Form::text("fecha_ingreso[]","$fecha_tentativa",["class"=>"form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300", "placeholder"=>"AAAA-MM-DD", "id"=>"fecha_ingreso","readonly"=>true, "required" => "required"]); !!}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Fecha Retiro <span class='text-danger sm-text-label'>*</span></label>
                            {!! Form::text("fecha_retiro[]","$fecha_r_tentativa",["class"=>"form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300", "placeholder"=>"AAAA-MM-DD", "id"=>"fecha_retiro","readonly"=>true, "required" => "required"]); !!}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Fecha Rec. Solicitud <span class='text-danger sm-text-label'>*</span></label>
                            {!! Form::text("fecha_recepcion[]","$fecha_hoy",["class"=>"form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300","id"=>"fecha_recepcion","readonly"=>true, "required" => "required"]); !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-2">
            <div class="pull-right">
                <button type="submit" class="btn btn-success | tri-px-2 tri-br-2 tri-border--none tri-transition-300 tri-green">Clonar Requerimiento</button>
            </div>            
        </div>

        <div class="clearfix"></div>

    {!! Form::close() !!}
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default | tri-px-2 tri-br-2 tri-border--none tri-transition-300" data-dismiss="modal">Cerrar</button>    
</div>