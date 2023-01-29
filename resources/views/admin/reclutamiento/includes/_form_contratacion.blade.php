@if( isset($sitio) && $sitio->asistente_contratacion == 1 )
    {{-- Fecha ingreso --}}
    <?php
    // {{ ((isset($new))? $candidato->fecha_ingreso : $dato_contrato->fecha_ingreso) }}
    //     if (isset($is_new)) {
    //         $_fecha_ingreso = $candidato->fecha_ingreso;
    //     }else{
    //         $_fecha_ingreso = $dato_contrato->fecha_ingreso;
    //     }
    // ?>
     {{-- {{ dd($dato_contrato->fecha_ingreso) }} --}}
    <div class="col-md-6 form-group">
        <label for="fecha_ingreso" class="col-sm-12 control-label">Fecha Ingreso <span class="text-danger">*</span></label>

        <div class="col-sm-12">
            {!! Form::text("fecha_ingreso_contra", ($dato_contrato ? $dato_contrato->fecha_ingreso : (!empty($requerimiento->fecha_ingreso) ? $requerimiento->fecha_ingreso : null)), [
                "class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                "id" => "fecha_ingreso_contra",
                "required" => "required",
                "readonly" => "readonly"
            ]);
            !!}
        </div>

        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("fecha_ingreso_contra", $errors) !!}</p>
                
    </div>

    <!-- Hora de ingreso -->
    <div class="col-md-6 form-group">
        <label for="hora_ingreso" class="col-sm-12 control-label">Hora de ingreso <span class="text-danger">*</span></label>

        <div class="col-sm-12">
            {!! Form::time("hora_ingreso",($dato_contrato) ? $dato_contrato->hora_entrada : '08:00', [
                "class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                "id" => "time-inicio",
                "required" => "required"
            ]); !!}
        </div>
        
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("hora_ingreso", $errors) !!}</p>
    </div>

    {{-- Observaciones --}}
    <div class="col-md-12 form-group">
        <label for="observaciones" class="col-sm-12 control-label">Observaciones</label>

        <div class="col-sm-12">
            {!! Form::textarea("observaciones", ($dato_contrato) ? $dato_contrato->observaciones : '', [
                "class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                "rows" => '2',
                "id" => "observacion"
                ])
            !!}
        </div>

        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("observaciones",$errors) !!}</p>
    </div>

    <!-- salario -->
    <div class="col-md-6 form-group">
        <label for="salario" class="col-sm-12 control-label">Salario <span class="text-danger">*</span></label>

        <div class="col-sm-12">
            <input
                type="number"
                name="salario"
                class="form-control solo-numero | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300"
                value="{{ (!empty($dato_contrato->salario) ? $dato_contrato->salario : $requerimiento->salario) }}"
                id="salario"
                required="required"
            >
        </div>
            
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("salario", $errors) !!}</p>
    </div>

    <div class="col-md-6 form-group">
        <label for="clase_riesgo" class="col-sm-12 control-label">Clase de Riesgo <span class='text-danger sm-text-label'> </span></label>

        <div class="col-sm-12">
           {!! Form::select("clase_riesgo",$clases_riesgo, (!empty($dato_contrato->centro_trabajo_id) ? $dato_contrato->centro_trabajo_id : $requerimiento->ctra_x_clt_codigo), ["class"=>"form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300","id"=>"clase_riesgo","required"]); !!}
           <!--   {!! Form::select("clase_riesgo",$clases_riesgo,$requerimiento->ctra_x_clt_codigo, ["class"=>"form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300","id"=>"clase_riesgo","disabled"]); !!}   -->
        </div>

        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("clase_riesgo", $errors) !!}</p>
    </div>

    <!-- Tipo ingreso -->
    <div class="col-md-6 form-group">
        <label for="tipo_ingreso" class="col-sm-12 control-label">Tipo Ingreso <span class="text-danger">*</span></label>

        <div class="col-sm-12">
            <select name="tipo_ingreso" id="tipo_ingreso" class="form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300">
                <option value="1" @if($dato_contrato) @if($dato_contrato->tipo_ingreso == 1) selected @endif @endif >Nuevo</option>
                <option value="2" @if($dato_contrato) @if($dato_contrato->tipo_ingreso == 2) selected @endif @endif >Reingreso</option>
            </select>
        </div>

        <p class="error text-danger direction-botones-center">  {!! FuncionesGlobales::getErrorData("tipo_ingreso", $errors) !!} </p>
    </div>

    <!-- Fecha último contrato -->
    <div style="display: none;" class="col-md-6 form-group" id="fecha_fin_ultimo">
        <label for="fecha_fin_ultimo" class="col-sm-12 control-label">Fecha fin ultimo contrato</label>
                
        <div class="col-sm-12">
            {!! Form::date("fecha_fin_ultimo", ($dato_contrato) ? date('Y-m-d', strtotime($dato_contrato->fecha_ultimo_contrato)) : null, [
                "class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                "id" => "fecha_fin_ultimo"
                ]);
            !!}
        </div>
    </div>

    <!-- Centro de costos -->
    <div class="col-md-6 form-group">
        <label for="centro_costos" class="col-sm-12 control-label">Centro de costos <span class="text-danger">*</span></label>

        <div class="col-sm-12">
            @if($dato_contrato)
                {!! Form::select("centro_costos", $centros_costos, (!empty($dato_contrato->centro_costo_id)) ? $dato_contrato->centro_costo_id : $centro_costo->centro_costo_id,
                    [
                        "class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                        "required" => "required",
                        "id" => "centro_costos"
                    ]);
                !!}
            @else
                {!! Form::select("centro_costos", $centros_costos, ($contra_clientes != null ? ($contra_clientes->centro_costos != null ? $contra_clientes->centro_costos : $requerimiento->centro_costo_id) : $requerimiento->centro_costo_id),
                    [
                        "class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                        "required" => "required",
                        "id" => "centro_costos"
                    ]);
                !!}
            @endif
        </div>
                
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("centro_costos", $errors) !!}</p>
    </div>

    <div class="col-md-6 form-group">
        <label for="nivel_5" class="col-sm-12 control-label">Nivel 5 <span class="text-danger">*</span></label>

        <div class="col-sm-12">
            {!! Form::select("nivel_5_id", $nivel_5, (!empty($dato_contrato->nivel_5_id) ? $dato_contrato->nivel_5_id : $requerimiento->nivel_5_id),
                [
                    "class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                    "required" => "required",
                    "id" => "nivel_5"
                ]);
            !!}
        </div>
                
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("nivel_5_id", $errors) !!}</p>
    </div>

    <div class="col-md-6 form-group">
        <label for="nivel_6" class="col-sm-12 control-label">Nivel 6 <span class="text-danger">*</span></label>

        <div class="col-sm-12">
            {!! Form::select("nivel_6_id", $nivel_6, (!empty($dato_contrato->nivel_6_id) ? $dato_contrato->nivel_6_id : $requerimiento->nivel_6_id),
                [
                    "class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                    "required" => "required",
                    "id" => "nivel_6"
                ]);
            !!}
        </div>
                
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("nivel_6_id", $errors) !!}</p>
    </div>

    <div class="col-md-6 form-group">
        <label for="nivel_5" class="col-sm-12 control-label">Nivel 7 <span class="text-danger">*</span></label>

        <div class="col-sm-12">
            {!! Form::select("nivel_7_id", $nivel_7, (!empty($dato_contrato->nivel_7_id) ? $dato_contrato->nivel_7_id : $requerimiento->nivel_7_id),
                [
                    "class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                    "required" => "required",
                    "id" => "nivel_7"
                ]);
            !!}
        </div>
                
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("nivel_7_id", $errors) !!}</p>
    </div>

    <div class="col-md-6 form-group">
        <label for="nivel_8" class="col-sm-12 control-label">Nivel 8 <span class="text-danger">*</span></label>

        <div class="col-sm-12">
            {!! Form::select("nivel_8_id", $nivel_8, (!empty($dato_contrato->nivel_8_id) ? $dato_contrato->nivel_8_id : $requerimiento->nivel_8_id),
                [
                    "class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                    "required" => "required",
                    "id" => "nivel_8"
                ]);
            !!}
        </div>
                
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("nivel_8_id", $errors) !!}</p>
    </div>

    <div class="col-md-6 form-group">
        <label for="tipo_empleado" class="col-sm-12 control-label">Tipo empleado <span class="text-danger">*</span></label>

        <div class="col-sm-12">
            {!! Form::select("tipo_empleado_id", $tipos_empleados, (!empty($dato_contrato->tipo_empleado_id) ? $dato_contrato->tipo_empleado_id : $requerimiento->tipo_empleado_id),
                [
                    "class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                    "id" => "tipo_empleado_id",
                    "required" => "required"
                ]);
            !!}
        </div>
                
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("tipo_empleado_id", $errors) !!}</p>
    </div>

    <!-- Auxilio transporte -->
    <div class="col-md-6 form-group">
        <label for="auxilio_transporte" class="col-sm-12 control-label">Auxilio de Transporte</label>

        <div class="col-sm-12">
            <select name="auxilio_transporte" class="form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300">
                @if($dato_contrato)
                    <option value="No se Paga" @if($dato_contrato->auxilio_transporte == 'No se Paga') selected @endif > No se paga </option>
                    <option value="Total" @if($dato_contrato->auxilio_transporte == 'Total') selected @endif > Total </option>
                    <option value="Mitad" @if($dato_contrato->auxilio_transporte == 'Mitad') selected @endif > Mitad </option>
                @else
                    <option value="No se Paga" @if($requerimiento->auxilio_transporte == 'No se Paga') selected @endif> No se paga </option>
                    <option value="Total" @if($requerimiento->auxilio_transporte == 'Total') selected @endif> Total </option>
                    <option value="Mitad" @if($requerimiento->auxilio_transporte == 'Mitad') selected @endif> Mitad </option>
                @endif
            </select>
        </div>

        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("auxilio_transporte", $errors) !!}</p>
    </div>

    <!-- EPS -->
    <div class="col-md-6 form-group">
        <label for="entidad_eps" class="col-sm-12 control-label">EPS<span class="text-danger">*</span></label>
                
        <div class="col-sm-12">

            {!! Form::select("entidad_eps", $eps, (!empty($dato_contrato->eps_id) ? $dato_contrato->eps_id : $candidato->entidad_eps), ["class" => "form-control selectcategory | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300", "id" => "entidad_eps", "required" => "required"]) !!}
        </div>
                
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("entidad_eps", $errors) !!}</p>
    </div>

    <!-- Fondo pensiones -->
    <div class="col-md-6 form-group">
        <label for="entidad_afp" class="col-sm-12 control-label">Fondo Pensiones<span class="text-danger">*</span></label>

        <div class="col-sm-12">

            {!! Form::select("entidad_afp", $afp, (!empty($dato_contrato->fondo_pensiones_id) ? $dato_contrato->fondo_pensiones_id : $candidato->entidad_afp), ["class" => "form-control selectcategory | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300", "id" => "entidad_afp","required" => "required"]) !!}

        </div>

        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("entidad_afp", $errors) !!}</p>
    </div>

    <!-- Caja compensación -->
    <div class="col-md-6 form-group">
        <label for="caja_compensacion" class="col-sm-12 control-label">Caja de Compensaciones<span class="text-danger">*</span></label>

        <div class="col-sm-12">
            {!! Form::select("caja_compensacion", $caja_compensaciones, (!empty($dato_contrato->caja_compensacion_id) ? $dato_contrato->caja_compensacion_id : $candidato->caja_compensaciones), [
                "class" => "form-control selectcategory | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                "id" => "caja_compensacion",
                "required" => "required"

                ])
            !!}
        </div>
                
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("caja_compensacion", $errors) !!}</p>
    </div>

    <!-- ARL -->
    <div class="col-md-6 form-group">
        <label for="arl" class="col-sm-6 control-label">ARL</label>
                
        <div class="col-sm-12">
            {!! Form::text("arl", 'SURA', ["class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300", "id" => "arl", "readonly" => "readonly"]); !!}
        </div>
                
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("arl", $errors) !!}</p>
    </div>
            
    <!-- Fondo cesantías -->
    <div class="col-md-6 form-group">
        <label for="fondo_cesantias" class="col-sm-12 control-label">Fondo De Cesantias<span class="text-danger">*</span></label>

        <div class="col-sm-12">
            {!! Form::select("fondo_cesantias", $fondo_cesantias, (!empty($dato_contrato->fondo_cesantias) ? $dato_contrato->fondo_cesantias : $candidato->fondo_cesantias), [
                    "class" => "form-control selectcategory | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                    "id" => "fondo_cesantias",
                    "required" => "required"
                ])
            !!}
        </div>
            
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("fondo_cesantias", $errors) !!}</p>
    </div>

    <!-- formas de pago -->
    <div class="col-md-6 form-group">
        <label for="forma_pago" class="col-sm-12 control-label">Forma de pago:<span class="text-danger">*</span></label>
                
        <div class="col-sm-12">

            {!! Form::select("forma_pago", $formas_pago, (!empty($dato_contrato->forma_pago_id) ? $dato_contrato->forma_pago_id : null), ["class" => "form-control selectcategory | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300", "id" => "forma_pago","required" => "required"]) !!}

        </div>
                
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("forma_pago", $errors) !!}</p>
    </div>
 
    <div class="col-md-6 form-group">
   
        <label for="arl" class="col-sm-12 control-label">Código nómina del cliente :<span class="text-danger">*</span></label>
         
        
        <div class="col-sm-12">
            {!! Form::select("nomina_cliente_id", $nominas_clientes, $requerimiento->negocio_id, [
                    "class" => "form-control selectcategory | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                    "id" => "nomina_cliente_id",
                    "required" => "required"
                ])
            !!}
             
        </div>

   
    <!--{!! Form::select("entidad_eps", $eps, (!empty($dato_contrato->eps_id) ? $dato_contrato->eps_id : $candidato->entidad_eps), 
        ["class" => "form-control selectcategory | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300", 
        "id" => "entidad_eps",
        "required" => "required"]) !!} -->
                
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("nomina_cliente_id", $errors) !!}</p>
    </div>

    <div class="col-md-6 form-group">
        <label for="arl" class="col-sm-12 control-label">Objeto contrato:<span class="text-danger">*</span></label>
                
        <div class="col-sm-12">
            {!! Form::select("objeto_contrato_id", $objetos_contrato, (!empty($dato_contrato->objeto_contrato_id) ? $dato_contrato->objeto_contrato_id : $candidato->objeto_contrato_id), [
                    "class" => "form-control selectcategory | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                    "id" => "objeto_contrato_id",
                    "required" => "required"
                ])
            !!}
        </div>
                
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("objeto_contrato_id", $errors) !!}</p>
    </div>

    <div class="col-md-6 form-group">
        <label for="arl" class="col-sm-12 control-label">Subtipo cotizante:<span class="text-danger">*</span></label>
                
        <div class="col-sm-12">
            {!! Form::select("subtipo_cotizante_id", $subtipo_cotizante, (!empty($dato_contrato->subtipo_cotizante_id) ? $dato_contrato->subtipo_cotizante_id : $candidato->subtipo_cotizante_id), [
                    "class" => "form-control selectcategory | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                    "id" => "subtipo_cotizante_id",
                    "required" => "required"
                ])
            !!}
        </div>
                
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("subtipo_cotizante_id", $errors) !!}</p>
    </div>

    <!-- Nombre del banco -->
    <div class="col-md-6 form-group">
        <label for="nombre_banco" class="col-sm-12 control-label">Nombre del Banco<span class="text-danger">*</span></label>
                
        <div class="col-sm-12">
            {!! Form::select("nombre_banco", $bancos, $candidato->nombre_banco, [
                    "class" => "form-control selectcategory | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                    "id"=>"nombre_banco",
                    "required" => "required"
                ])
            !!}
        </div>
                
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("nombre_banco", $errors) !!}</p>
    </div>

    <!-- Tipo cuenta -->
    <div class="col-md-6 form-group">
        <label for="tipo_cuenta" class="col-sm-12 control-label">Tipo Cuenta</label>
                
        <div class="col-sm-12">
            <select name="tipo_cuenta" class="form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300" required="required">
                <option value="Ahorro" @if($candidato->tipo_cuenta == 'Ahorro') selected @endif > Ahorro </option>
                <option value="Corriente" @if($candidato->tipo_cuenta == 'Corriente') selected @endif > Corriente </option>
            </select>
        </div>
            
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("tipo_cuenta", $errors) !!}</p>
    </div>

    <!-- Número cuenta -->
    <div class="col-md-6 form-group">
        <label for="numero_cuenta" class="col-sm-12 control-label">Número Cuenta<span class="text-danger">*</span></label>

        <div class="col-sm-12">
            <input
                type="number"
                name="numero_cuenta"
                class="form-control solo-numero | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300"
                value="{{ ($candidato->numero_cuenta != 0) ? $candidato->numero_cuenta : '' }}"
                id="numero_cuenta"
                required="required"
            >
        </div>
            
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("numero_cuenta", $errors) !!}</p>
    </div>

    <!-- Confirma cuenta -->
    <div class="col-md-6 form-group">
        <label for="confirm_numero_cuenta" class="col-sm-12 control-label">Confirmar Cuenta</label>

        <div class="col-sm-12">
            <input
                type="number"
                name="confirm_numero_cuenta"
                class="form-control solo-numero | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300"
                id="confirm_numero_cuenta"
                required="required"
            >
        </div>
            
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("numero_cuenta", $errors) !!}</p>
    </div>

    <!-- Fecha fin contrato -->
    <?php
        if (!empty($dato_contrato) && $dato_contrato->fecha_ingreso != null) {
            $newEndingDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($dato_contrato->fecha_ingreso)) . " + 364 day"));
        } elseif(!empty($requerimiento->fecha_ingreso)) {
            $newEndingDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($requerimiento->fecha_ingreso)) . " + 364 day"));
        }
    ?>
    <div class="col-md-6 form-group">
        <label for="fecha_fin_contrato" class="col-sm-12 control-label">Fecha Fin Contrato</label>
                
        <div class="col-sm-12">
            <input
                type="text"
                name="fecha_fin_contrato"
                value="{{ isset($newEndingDate)?$newEndingDate:$dato_contrato->fecha_fin_contrato }}"
                class="form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300"
                id="fecha_fin_contrato"
                required
                readonly
            >
        </div>
                
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("fecha_fin_contrato", $errors) !!}</p>
    </div>

    <div class="col-md-6 form-group">
        <label class="col-sm-12 control-label" for="inputEmail3">
            Centro de trabajo: <span class="text-danger">*</span>
        </label>
        <div class="col-sm-12">
            {!! Form::select('centro_trabajo', 
            $agencias, 
            null, 
            [ 'class'=>'form-control js-example-basic-single2 | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300',
            "required"=> true]) !!}
        </div>
    </div>
 <!--
    <div class="col-md-6 form-group">
        <label for="inputEmail3" class="col-sm-12 control-label">¿Quién autorizó contratación?<span class="text-danger">*</span></label>

        @if(count($dato_contrato) > 0)
            @if(!is_null($dato_contrato->user_autorizacion) && $dato_contrato->user_autorizacion != '')
                <div class="col-sm-12">
                    {!! Form::select("user_autorizacion", $usuarios_clientes,($dato_contrato) ? $dato_contrato->user_autorizacion : null, [
                        "class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                        "readonly" => true,
                        "id" => "user_autorizacion"
                        ]);
                    !!}
                </div>
                            
                <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("user_autorizacion", $errors) !!}</p>
            @else
                <div class="col-sm-12">
                    {!! Form::select("user_autorizacion", $usuarios_clientes, ($dato_contrato) ? $dato_contrato->user_autorizacion : null, [
                        "class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                        "id" => "user_autorizacion",
                        "required" => "required"
                    ]); !!}
                </div>

                <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("user_autorizacion", $errors) !!}</p>
            @endif
        @else 
            <div class="col-sm-12">
                {!! Form::select("user_autorizacion", $usuarios_clientes, ($dato_contrato) ? $dato_contrato->user_autorizacion : null, [
                        "class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                        "id" => "user_autorizacion",
                        "required" => "required"
                    ]);
                !!}
            </div>
                        
            <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("user_autorizacion", $errors) !!}</p>
               
        @endif
    </div>
                -->             

    @if(!empty($adicionales))
        <div class="col-md-12">
            <label class="mb-2 mt-2">Documentos adicionales variables</label>

            <table class="table">
                <tr>
                    <th>Descripción</th>
                    <th></th>
                </tr>

                @foreach($adicionales as $key => $adicional)
                    @if(preg_match('/{valor_variable}/', $adicional->adicional->contenido_clausula))
                        <tr class="item_adicional">
                            <td>
                                {{ $adicional->adicional->descripcion }}
                            </td>

                            <td>
                                <input type="hidden" name="clausulas[]" value="{{ $adicional->adicional->id }}">

                                <input 
                                    type="text" 
                                    name="valor_adicional[]" 
                                    class="form-control valor_adicional | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300" 
                                    placeholder="Valor variable"
                                    @if( $is_new )
                                    value="{{ ( empty($adicional->variableReq($requerimiento->id)->valor)) ? $adicional->variableCargo()->valor : $adicional->variableReq($requerimiento->id)->valor }}"
                                    @else
                                    value="{{ $adicional->valor }}"
                                    @endif
                                    maxlength="100"
                                    autocomplete="off" 

                                    data-toggle="tooltip"
                                    data-placement="top"
                                    data-container="body"
                                    title="Debes definir el valor variable para este documento adicional."
                                >

                                @if(!preg_match('/{valor_variable}/', $adicional->adicional->contenido_clausula))
                                    <input type="hidden" name="valor_adicional[]" value="0">
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
                    </table>
                </div>
            @endif
@else

    {{-- Fecha ingreso --}}
    <div class="col-md-6 form-group">
        <label for="fecha_ingreso" class="col-sm-12 control-label">Fecha Ingreso <span class="text-danger">*</span></label>
                
        <div class="col-sm-12">
            {!! Form::text("fecha_ingreso_contra", ($dato_contrato ? $dato_contrato->fecha_inicio_contrato : (!empty($requerimiento->fecha_ingreso) ? $requerimiento->fecha_ingreso : null)), [
                "class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                "id" => "fecha_ingreso_contra",
                "required" => "required"
                ]);
            !!}
        </div>

        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("fecha_ingreso_contra", $errors) !!}</p>
                
    </div>

    <div class="col-md-6 form-group">
        <label class="col-sm-12 control-label" for="inputEmail3">
            Centro de trabajo: <span class="text-danger">*</span>
        </label>
        <div class="col-sm-12">
            {!! Form::select('centro_trabajo', 
            $agencias, 
            null, 
            [ 'class'=>'form-control js-example-basic-single2 | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300',
            "required"=> true]) !!}
        </div>
    </div>

    {{-- Observaciones --}}
    <div class="col-md-12 form-group">
        <label for="observaciones" class="col-sm-12 control-label">Observaciones</label>
                
        <div class="col-sm-12">
            {!! Form::textarea("observaciones", ($dato_contrato) ? $dato_contrato->observaciones : '', [
                "class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                "rows" => '2',
                "id" => "observacion"
                ])
            !!}
        </div>
                
        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("observaciones",$errors) !!}</p>
    </div>

    <div class="col-md-6 form-group">
        <label for="inputEmail3" class="col-sm-12 control-label">¿Quién autorizó contratación? **<span class="text-danger">*</span></label>

        @if(count($dato_contrato) > 0)
            @if(!is_null($dato_contrato->user_autorizacion) && $dato_contrato->user_autorizacion != '')
                <div class="col-sm-12">
                    {!! Form::select("user_autorizacion", $usuarios_clientes,($dato_contrato) ? $dato_contrato->user_autorizacion : null, [
                        "class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                        "readonly" => true,
                        "id" => "user_autorizacion"
                        ]);
                    !!}
                </div>
                            
                <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("user_autorizacion", $errors) !!}</p>
            @else
                <div class="col-sm-12">
                    {!! Form::select("user_autorizacion", $usuarios_clientes, ($dato_contrato) ? $dato_contrato->user_autorizacion : null, [
                        "class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                        "id" => "user_autorizacion",
                        "required" => "required"
                    ]); !!}
                </div>

                <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("user_autorizacion", $errors) !!}</p>
            @endif
        @else
            <div class="col-sm-12">
                {!! Form::select("user_autorizacion", $usuarios_clientes, ($dato_contrato) ? $dato_contrato->user_autorizacion : null, [
                        "class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                        "id" => "user_autorizacion",
                         "required" => "required"
                    ]);
                !!}
            </div>
                        
            <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("user_autorizacion", $errors) !!}</p>
        @endif
    </div>
                         
@endif