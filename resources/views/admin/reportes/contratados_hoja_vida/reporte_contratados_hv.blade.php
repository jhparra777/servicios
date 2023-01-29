@extends("admin.layout.master")
@section('contenedor')
    @include('admin.layout.includes._section_header_breadcrumb', ['page_header' => "Reporte Contratos y Hoja de Vida"])

    @if(Session::has("mensaje_warning"))
        <div class="row">
            <div class="col-md-12 col-lg-12" id="mensaje-resultado">
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{Session::get("mensaje_warning")}}
                </div>
            </div>
        </div>
    @endif

    {!! Form::model(Request::all(), ["route"=>"admin.reporte_contratado_hoja_vida", "method"=>"GET", "accept-charset"=>"UTF-8"]) !!}
        <input type="hidden" id="generar_datos" name="generar_datos" value="generar">
        <input id="formato" name="formato" type="hidden" value="html">

        <div class="col-md-6 col-lg-6 form-group">
            <label for="rango_fecha">Rango de fechas de envío a contratación:</label>

            {!! Form::text("rango_fecha", null, [
                "id" => "rango_fecha",
                "class" => "form-control range | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                "autocomplete" => "off"
            ]); !!}
        </div>

        <div class="col-md-6 col-lg-6 form-group">
            <label for="rango_fecha_firma">Rango de fechas de firma de contrato:</label>

            {!! Form::text("rango_fecha_firma", null, [
                "id" => "rango_fecha_firma",
                "class" => "form-control range | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                "autocomplete" => "off"
            ]); !!}
        </div>

        <div class="col-sm-6 col-lg-6 form-group">
            <label for="cliente_id">Cliente:</label>

            {!! Form::select("cliente_id", $clientes, null, [
                "class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                "id" => "cliente_id"
            ]); !!}
        </div>

        <div class="col-sm-6 col-lg-6 form-group">
            <label for="usuario_envio">Usuario contrata:</label>

            {!! Form::select("usuario_envio", $usuarios_envio, null, [
                "class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                "id" => "usuario_envio"
            ]); !!}
        </div>

        <div class="col-sm-6 col-lg-6 form-group">
            <label for="usuario_aprueba">Usuario que aprueba:</label>

            {!! Form::select("usuario_aprueba", $usuarios_aprueba, null, [
                "class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                "id" => "usuario_aprueba"
            ]); !!}
        </div>

        <div class="col-md-6 col-lg-6 form-group">
            <label for="req_id">Número de Requerimiento:</label>

            {!! Form::text("req_id", null, [
                "id" => "req_id",
                "class" => "form-control input-number | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                "autocomplete" => "off"
            ]); !!}
        </div>

        <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-default | tri-px-2 text-white tri-br-2 tri-border--none tri-transition-200 tri-green">
                Generar <i aria-hidden="true" class="fa fa-search"></i>
            </button>

            <a class="btn btn-success | tri-px-2 text-white tri-br-2 tri-border--none tri-transition-200 tri-green" href="#" id="export_excel_btn" role="button">
                Excel <i aria-hidden="true" class="fa fa-file-excel-o"></i>
            </a>

            <a class="btn btn-default | tri-px-2 text-white tri-br-2 tri-border--none tri-transition-200 tri-red" href="{{ route('admin.reporte_contratado_hoja_vida') }}">
                Limpiar
            </a>
        </div>
    {!! Form::close() !!}

    @if(isset($data))
        @if($data!="vacio")
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="col-md-12 col-lg-12">
                        @include('admin.reportes.contratados_hoja_vida.include.grilla_detalle_section_hv', ["headers" => $headers['titulo_hoja_vida']])
                    </div>
                    <div class="col-md-12 col-lg-12">
                        @include('admin.reportes.contratados_hoja_vida.include.grilla_detalle_section_contratados', ["headers" => $headers['titulo_contratados']])
                    </div>
                </div>
            </div>
           <br>
        @endif
    @endif

    <script>
        $(function () {
            $('#export_excel_btn').click(function(e){
                $rango_fecha = $("#rango_fecha").val();
                $rango_fecha_firma = $("#rango_fecha_firma").val();
                $cliente_id = $("#cliente_id").val();
                $usuario_envio = $("#usuario_envio").val();
                $usuario_aprueba = $("#usuario_aprueba").val();
                $req_id = $("#req_id").val();

                $(this).prop("href","{{ route('admin.reporte_contratado_hoja_vida_excel') }}?&formato=xlsx&rango_fecha="+$rango_fecha+"&rango_fecha_firma="+$rango_fecha_firma+"&cliente_id="+$cliente_id+"&usuario_envio="+$usuario_envio+"&usuario_aprueba="+$usuario_aprueba+"&req_id="+$req_id);
            });
        });
    </script>
@stop
