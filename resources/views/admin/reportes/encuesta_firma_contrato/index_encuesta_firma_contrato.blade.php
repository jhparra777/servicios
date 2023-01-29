@extends("admin.layout.master")
@section('contenedor')
    
	{{-- Header --}}
	@include('admin.layout.includes._section_header_breadcrumb', ['page_header' => $config_encuesta->titulo_encuesta])

    @if(Session::has("mensaje_warning"))
    <div class="row">
        <div class="col-md-12" id="mensaje-resultado">
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{Session::get("mensaje_warning")}}
            </div>
        </div>
    </div>
    @endif

    <br>

    {!! Form::model(Request::all(),["route" => "admin.encuesta_firma_contrato", "id" => "filter_form", "method" => "GET", "accept-charset" => "UTF-8"]) !!}
        <input type="hidden" id="generar_datos" name="generar_datos" value="generar">
        <input id="formato" name="formato" type="hidden" value="html">

        <div class="row">
            <div class="col-md-6 form-group">
                <label class="control-label" for="rango_fecha">
                    Rango de Fecha de firma de contrato:
                </label>

                {!! Form::text("rango_fecha", null, ["class" => "form-control range | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300", "id" => "rango_fecha", "autocomplete" => "off"]); !!}
            </div>
            <div class="col-md-6 form-group">
                <label class="control-label" for="numero_id">
                    #Nro de Identificación:
                </label>

                {!! Form::text("numero_id", null, ["class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300", "placeholder" => "Nro de Identificación", "id" => "numero_id" ]); !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                <label class="control-label" for="cliente_id">
                    Cliente:
                </label>

                {!! Form::select("cliente_id",$clientes,null,["class"=>"form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300","id"=>"cliente_id"]); !!}
            </div>
        </div>

        <div class="clearfix"></div>

		<div class="col-md-12 text-right">
	        <button class="btn btn-success | tri-px-2 tri-br-2 tri-border--none tri-transition-300 tri-green" type="submit">
	            Generar
	        </button>
	        
	        <a class="btn btn-success | tri-px-2 tri-br-2 tri-border--none tri-transition-300 tri-green" href="#" id="export_excel_btn" role="button">
	            <i aria-hidden="true" class="fa fa-file-excel-o"></i>
	            Excel
	        </a>
	        <a class="btn btn-danger | tri-px-2 tri-br-2 tri-border--none tri-transition-300 tri-red" href="{{ route('admin.validacion_documental_vencimiento') }}">Limpiar</a>
	    </div>

    {!! Form::close() !!}

    @if(isset($data))
        @if($data!="vacio")
        	<div class="row">
        		<div class="col-md-12 mt-2">
            		<div class="panel panel-default">
                		<div class="panel-body">
            				@include('admin.reportes.encuesta_firma_contrato.include.grilla_encuesta_firma_contrato')
            			</div>
            		</div>
            	</div>
            </div>
        @endif
    @endif

    <script>
        $(function () {
            $('#export_excel_btn').click(function(e){
                var rango_fecha = $("#rango_fecha").val();
                var numero_id = $("#numero_id").val();
                var cliente_id = $("#cliente_id").val();

                $(this).prop(
                    "href", "{{ route('admin.encuesta_firma_contrato_excel') }}?generar_datos=generar"+
                    "&formato=xlsx&numero_id="+numero_id+
                    "&rango_fecha="+rango_fecha+
                    "&cliente_id="+cliente_id
                );
            });
        })
    </script>
@stop
