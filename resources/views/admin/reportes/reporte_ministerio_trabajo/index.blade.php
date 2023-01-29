@extends("admin.layout.master")
@section('contenedor')
    <h3>
        <i aria-hidden="true" class="fa fa-file-text-o"></i>
        Reporte Ministerio
    </h3>
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
    {!! Form::model(Request::all(),["route" => "admin.reporte_ministerio_trabajo","method" => "GET","accept-charset" => "UTF-8"]) !!}
        <input type="hidden" id="generar_datos" name="generar_datos" value="generar">
        <div class="row">
            <div class="col-md-6 form-group">
                <label class="col-sm-4 control-label" for="rango_fecha">
                    Rango fechas firma contrato:
                </label>
                <div class="col-sm-8">
                    {!! Form::text("rango_fecha", null, ["class" => "form-control range", "id" => "rango_fecha", "autocomplete" => "off"]); !!}
                </div>
            </div>

            
            <div class="col-md-6 form-group">
                <label class="col-sm-4 control-label" for="inputEmail3">
                  Cliente:
                </label>
                <div class="col-sm-8">
                  {!! Form::select("cliente_id",$clientes,null,["class"=>"form-control","id"=>"cliente_id", "data-live-search" => "true"]); !!}
                </div>
            </div>
        </div>
    
        <div class="clearfix"></div>
        
        <input id="formato" name="formato" type="hidden" value="html"/>
        <button class="btn btn-success" type="submit">
            Generar
        </button>
        
        <a class="btn btn-success" href="#" id="export_excel_btn" role="button">
            <i aria-hidden="true" class="fa fa-file-excel-o"></i>
            Excel
        </a>

        <a class="btn btn-warning" href="{{ route('admin.reporte_ministerio_trabajo') }}">
            Limpiar
        </a>
        
    {!! Form::close() !!}

    @if(isset($data))
        @if($data!="vacio")
            @include('admin.reportes.reporte_ministerio_trabajo.includes.grilla_detalle_ministerio')
        @endif
    @endif

    <script>
        $(function () {
            $('#export_excel_btn').click(function(e){
                var cliente_id = $("#cliente_id").val();
                var rango_fecha = $("#rango_fecha").val();

                $(this).prop(
                    "href", "{{ route('admin.reporte_ministerio_trabajo_excel') }}?generar_datos=generar"+
                    "&formato=xlsx&cliente_id="+cliente_id+
                    "&rango_fecha="+rango_fecha
                );
            });
        })
    </script>
@stop
