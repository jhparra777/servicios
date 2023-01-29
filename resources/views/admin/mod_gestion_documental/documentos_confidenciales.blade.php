@extends("admin.mod_gestion_documental.layout.documents.list_document_master")
@section('btn-header')

@stop

@section('body-table')
    <tbody style="text-transform: uppercase;">
                                    @foreach($tipo_documento as $tipo)
                                        <tr>
                                            <td>{{ $tipo->descripcion }}</td>
                                            <td> {{$tipo->usuario_gestiono}} </td>
                                            <td> {{($tipo->gestiono)?date("d-m-Y",strtotime($tipo->fecha_carga)):''}} </td>
                                            <td>
                                                @if($tipo->nombre!="")
                                                    <i class="fa fa-check" aria-hidden="true" style="color:green;"></i>
                                                @else
                                                    <i class="fa fa-times" aria-hidden="true" style="color:red;">
                                                @endif
                                                
                                            </td>
                                            <td>
                                                <div class="btn-group-vertical">
                                                    @if($tipo->nombre!="")
                                                        
                                                        <a class="btn btn-primary btn-sm btn-block | tri-br-2 tri-fs-12 tri-txt-purple tri-bg-white tri-bd-purple tri-transition-300 tri-hover-out-purple" href='{{ route("view_document_url", encrypt("recursos_documentos_verificados/"."|".$tipo->nombre."|".$tipo->id)) }}' target="_blank">
                                                            <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                                            <span data-toggle="tooltip" data-container="body"  title="{{ $tipo->nombre_real }}">Ver</span>
                                                        </a>

                                                        <a class="btn btn-primary btn-sm btn-block | tri-br-2 tri-fs-12 tri-txt-purple tri-bg-white tri-bd-purple tri-transition-300 tri-hover-out-purple" href="{{ route('admin.descargar_recurso', ['recursos_documentos_verificados', $tipo->nombre]) }}" target="_blank" title="Descargar archivo">
                                                            <i class="fa fa-download" aria-hidden="true"></i>
                                                            Descargar
                                                        </a>
                                                    @else

                                                    @endif
                                                </div>
                                                    
                                            </td>
                                        </tr>
                                    @endforeach

                                    {{-- Consulta de seguridad --}}
                                    @if(!empty($consultaSeguridad))
                                        <tr>
                                            <td>CONSULTA DE SEGURIDAD</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                 <i class="fa fa-check" aria-hidden="true" style="color:green;"></i>
                                            </td>
                                            <td>
                                               <div class="btn-group-vertical">
                                                    <a class="btn btn-primary btn-sm btn-block | tri-br-2 tri-fs-12 tri-txt-purple tri-bg-white tri-bd-purple tri-transition-300 tri-hover-out-purple" href='{{ url('recursos_pdf_consulta/'.$consultaSeguridad->pdf_consulta_file) }}' target="_blank">
                                                        <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                                    </a>

                                                    <a class="btn btn-primary btn-sm btn-block | tri-br-2 tri-fs-12 tri-txt-purple tri-bg-white tri-bd-purple tri-transition-300 tri-hover-out-purple" href='{{ route('admin.descargar_recurso', ['recursos_pdf_consulta', $consultaSeguridad->pdf_consulta_file]) }}' target="_blank" title="Descargar archivo">
                                                        <i class="fa fa-download" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif

                                    {{-- Consulta de seguridad --}}
                                    @if(!empty($tusdatosData))
                                        <tr>
                                            <td>CONSULTA TUSDATOS</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <i class="fa fa-check" aria-hidden="true" style="color:green;"></i>
                                            </td>
                                            <td>
                                                @if($tusdatosData->status == 'finalizado')
                                                    
                                                    <a href='{{ route('tusdatos_reporte', ['check' => $tusdatosData->id]) }}' target="_blank">
                                                        <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
@stop

@section('botones')
    @if($current_user->hasAccess("admin.gestion_documental.eliminar_documento"))
    <div class="col-md-12 text-center">
        
        
            <button class="btn btn-info | tri-br-2 tri-fs-12 tri-txt-gray tri-bg-white tri-bd-gray tri-transition-300 tri-hover-out-gray" id="cargarDocumentoConfi" type="button"><i class="fa fa-cloud-upload"></i>&nbsp;Cargar documento</button>
    
    </div>
@endif
@stop



@section('scripts-documents')
    <script>
        $(function(){
            $("#cargarDocumentoConfi").on("click", function(){
                $.ajax({
                    url: "{{ route('admin.cargarDocumentoAdminConfidencial') }}",
                    data: {
                        user_id:{{ $candidato_id }},
                        req:{{$req}}
                    },
                    type: "POST",
                    beforeSend: function(){
                    },
                    success: function(response) {
                        $("#modal_gr").find(".modal-content").html(response);
                        $("#modal_gr").modal("show");
                    }
                });
            });

    });
</script>
    </script>
@stop