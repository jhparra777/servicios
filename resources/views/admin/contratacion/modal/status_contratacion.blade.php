<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title"><strong>Estatus del Candidato</strong></h4>
</div>

<div  class="modal-body">
    @if ($token_firma != null || $token_firma != '')
        @if ($firma_contrato != null || $firma_contrato != '')
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Código de acceso a la firma: <b>{{ $token_firma->codigo_validacion }}</b>
                </div>
            </div>
        @endif
    @endif

    <h4 class="titulo1">Estados Candidato</h4>
    
    <table class="table table-bordered ultima_seleccionada">
        <thead>
            <tr>
                <th style="text-align: center;">Fecha de Asociación</th>
                <th style="text-align: center;">Usuario que lo Asocio</th>
                <th style="text-align: center;">Estado del Candidato</th>
                <th style="text-align: center;">Proceso</th>
            </tr>
        </thead>

        @foreach($estadoCandidato as $estado)
            <tr>
                <td style="text-align: center;">{{$estado->created_at}}</td>
                <td style="text-align: center;">{{$estado->usuarioRegistro()->name  }}</td>
                <td style="text-align: center;">
                    @if(route("home")=="http://komatsu.t3rsc.co" || route("home")=="https://komatsu.t3rsc.co")
                        {{($estado->estado_desc == 'EVALUACION DEL CLIENTE' )?'ENVIADO COORDINADORA SELECCION':$estado->estado_desc}}
                    @else
                        {{$estado->estado_desc}}
                    @endif
                </td>
                <td style="text-align: center;"> 
                    @if(route("home")=="http://komatsu.t3rsc.co" || route("home")=="https://komatsu.t3rsc.co")
                        @if($estado->nombre_proceso == 'ENVIO_DOCUMENTOS')
                            ENV_EST_SEG
                        @else
                            {{($estado->nombre_proceso == 'ENVIO_APROBAR_CLIENTE' || $estado->nombre_proceso == 'ENVIO_CONTRATACION_CLIENTE' )?'ENVIO_COORDINADORA_SELECCION':$estado->nombre_proceso}}
                        @endif
                    @else
                        {{$estado->nombre_proceso}}
                    @endif
                </td>
                {{--
                    @if(isset($estado->asis))
                        <td>{{(($estado->asis==1)?"Si":"No ha asistido")}}</td>
                    @else
                        <td>No se ha enviado a la entrevista</td>
                    @endif
                --}}
            </tr>
        @endforeach
    </table>

    <h4 class="titulo1">Trazabilidad del Candidato</h4>
    
    <table class="table table-responsive">
        <tr>
            <th>Usuario que Solicitó</th>
            <th>Fecha de Solicitud</th>
            <th>Proceso</th>

            @if($user_sesion->hasAccess("entrevista_virtual"))
                <th>Estado/Puntos</th>
            @else
                <th>Estado</th>
            @endif

            @if($sitioModulo->consulta_seguridad === 'enabled')

                @if(isset($factor->factor_seguridad))
                    <th>Factor de Seguridad</th>
                @endif

            @endif

            @if(route("home") == "http://vym.t3rsc.co" || route("home") == "https://vym.t3rsc.co" ||
                route("home") == "http://listos.t3rsc.co" || route("home") == "https://listos.t3rsc.co")

                @if (isset($generated_score))
                    <th>Truora Score (Factor)</th>
                @endif

            @endif

            {{-- <th>¿Asistió a la entrevista?</th> --}}
            <th>Motivo Rechazo</th>
            <th>Observaciones</th>
            <th>Usuario que Finalizo Procedimiento</th>
            <th>Fecha de Finalización Procedimiento</th>

            {{-- <th>Porcentaje asignado</th> --}}
            <!--<td>Nota en el Procedimiento</td>-->
        </tr>

        <!-- T-BODY -->
        @foreach($reqCandidato as $ref)
            <tr style="height: 10px !important; overflow: scroll; " >
                <td>{{$ref->usuarioRegistro()->name}}</td>

                <td>{{$ref->fecha_inicio}}</td>

                <td>
                    @if($ref->proceso == "ENVIO_VALIDACION")
                        <p>ENVIO VINCULACIÓN</p>
                    @else
                        @if(route("home")=="http://komatsu.t3rsc.co" || route("home")=="https://komatsu.t3rsc.co")
                            @if($ref->proceso == 'ENVIO_DOCUMENTOS')
                                ENV_EST_SEG
                            @else
                                {{($ref->proceso == 'ENVIO_APROBAR_CLIENTE' || $ref->proceso == 'ENVIO_CONTRATACION_CLIENTE' )?'ENVIO_COORDINADORA_SELECCION':$ref->proceso}}
                            @endif
                        @else
                            {{$ref->proceso}}
                        @endif
                    @endif
                </td>

                @if($ref->proceso === 'ENVIO_ENTREVISTA_VIRTUAL')
                    <td>
                        <?php
                            switch ($ref->apto) {
                                case 1:
                                    echo "<p style='padding:10px' class=' bg-success'>Apto | ({$ref->puntuacion}/5)</p>";
                                break;
                                
                                case 0:
                                    echo "<p style='padding:10px' class=' bg-danger'>No Apto | ({$ref->puntuacion}/5)</p>";
                                break;
                                
                                case 3:
                                    echo "<p style='padding:10px' class=' bg-warning'>Pendiente | ({$ref->puntuacion}/5)</p>";
                                break;
                                
                                default :
                                    echo "<p style='padding:10px' class=''>Enviado</p>";
                                break;
                            }
                        ?>
                    </td>
                @elseif($ref->proceso === 'ENVIO_PRUEBA_DIGITACION' || $ref->proceso === 'ENVIO_PRUEBA_COMPETENCIA')
                    <td>
                        <?php
                            switch ($ref->apto) {
                                case '1':
                                    echo "<p style='padding:10px' class=' bg-success'>Apto</p>";
                                break;
                                
                                case '2':
                                    echo "<p style='padding:10px' class=' bg-warning'>Pendiente</p>";
                                break;

                                default :
                                    echo "<p style='padding:10px' class=''>Enviado</p>";
                                break;
                            }
                        ?>
                    </td>
                @else

                    <td>
                        <?php
                            switch ($ref->apto) {
                                case '1':
                                    echo "<p style='padding:10px' class=' bg-success'>Apto</p>";
                                break;
                                
                                case '0':
                                    echo "<p style='padding:10px' class=' bg-danger'>No Apto</p>";
                                break;
                                
                                case '3':
                                    echo "<p style='padding:10px' class=' bg-warning'>Pendiente</p>";
                                break;
                    
                                default :
                                    echo "<p style='padding:10px' class=''>Enviado</p>";
                                break;
                            }
                        ?>
                    </td>

                @endif

                @if($sitioModulo->consulta_seguridad === 'enabled')

                    @if(isset($factor->factor_seguridad))
                        <td></td>
                    @endif

                @endif

                @if (route("home") == "http://vym.t3rsc.co" || route("home") == "https://vym.t3rsc.co" ||
                    route("home") == "http://listos.t3rsc.co" || route("home") == "https://listos.t3rsc.co")
                    <td></td>
                @endif

                @if ($ref->des_motivo_rechazo != '')
                    <td>{{$ref->des_motivo_rechazo}}</td>
                @else
                    <td></td>
                @endif

                @if ($ref->proceso == 'ENVIO_APROBAR_CLIENTE')
                    @if ($ref->observaciones)
                        <td>
                            {{$ref->observaciones}}
                            @if($documento_aprobacion != null)
                                <br>
                                <a href="{{url('recursos_documentos_verificados/'.$documento_aprobacion->nombre_archivo)}}" target="_blank" title="Ver documento aprobación cargado"><span class="fa fa-file" aria-hidden="true"></span> Ver archivo</a>
                            @endif
                        </td>
                    @else
                        <td>
                            @if($documento_aprobacion != null)
                                <a href="{{url('recursos_documentos_verificados/'.$documento_aprobacion->nombre_archivo)}}" target="_blank" title="Ver documento aprobación cargado"><span class="fa fa-file" aria-hidden="true"></span> Ver archivo</a>
                            @endif
                        </td>
                    @endif
                @elseif($ref->proceso == "ENVIO_EXCEL_BASICO")
                    <?php
                        $resp_user_excel = $ref->respuestaPruebaExcelUser('basico');
                    ?>
                    @if ($resp_user_excel != null && $resp_user_excel->respuestas_correctas != null)
                        <?php
                            $config_prueba_excel = $resp_user_excel->configuracionReq;
                        ?>
                        <td style="width: 25%;word-break: break-all;">
                            <b>Calificación obtenida</b>: {{ $resp_user_excel->calcularCalificacion() }}% <br>
                            <b>Calificación minima</b>: {{ $config_prueba_excel->aprobacion_excel_basico }}% <br>
                            <a href="{{ route('admin.pdf_prueba_excel', ['id_respuesta_user' => $resp_user_excel->id]) }}" target="_blank"><i class="fa fa-file"></i> Ver Respuestas</a>
                            @if ($resp_user_excel->concepto_final != null && $resp_user_excel->concepto_final != '')
                                <br> <b>Concepto final</b>: {!! $resp_user_excel->concepto_final !!}
                            @endif
                        </td>
                    @else
                        <td></td>
                    @endif
                @elseif($ref->proceso == "ENVIO_EXCEL_INTERMEDIO")
                    <?php
                        $resp_user_excel = $ref->respuestaPruebaExcelUser('intermedio');
                    ?>
                    @if ($resp_user_excel != null && $resp_user_excel->respuestas_correctas != null)
                        <?php
                            $config_prueba_excel = $resp_user_excel->configuracionReq;
                        ?>
                        <td style="width: 25%;word-break: break-all;">
                            <b>Calificación obtenida</b>: {{ $resp_user_excel->calcularCalificacion() }}% <br>
                            <b>Calificación minima</b>: {{ $config_prueba_excel->aprobacion_excel_intermedio }}% <br>
                            <a href="{{ route('admin.pdf_prueba_excel', ['id_respuesta_user' => $resp_user_excel->id]) }}" target="_blank"><i class="fa fa-file"></i> Ver Respuestas</a>
                            @if ($resp_user_excel->concepto_final != null && $resp_user_excel->concepto_final != '')
                                <br> <b>Concepto final</b>: {!! $resp_user_excel->concepto_final !!}
                            @endif
                        </td>
                    @else
                        <td></td>
                    @endif
                @elseif($ref->proceso == "ENVIO_PRUEBA_ETHICAL_VALUES")
                    <?php
                        $resp_user_ev = $ref->respuestaPruebaEthicalValue();
                    ?>
                    @if ($resp_user_ev != null)
                        <td style="width: 25%;word-break: break-all;">
                            <a href="{{ route('admin.pdf_prueba_valores', ['id_respuesta_user' => $resp_user_ev->id]) }}" target="_blank"><i class="fa fa-file"></i> Ver Respuestas</a>
                            @if ($resp_user_ev->concepto_final != null && $resp_user_ev->concepto_final != '')
                                <br> <b>Concepto final</b>: {!! $resp_user_ev->concepto_final !!}
                            @endif
                        </td>
                    @else
                        <td></td>
                    @endif
                @elseif($ref->proceso == "ENVIO_SST")
                    @if($sitioModulo->evaluacion_sst === 'enabled')
                        <?php
                            $extension = null;
                            $configuracion_sst = $sitioModulo->configuracionEvaluacionSst();
                            $extensiones = ['.pdf','.docx','.doc','.png','.jpg','.jpeg'];
                            foreach ($extensiones as $ext) {
                                if(file_exists('recursos_evaluacion_sst/evaluacion_sst_'.$candidato_id.'_'.$req_id.$ext)) {
                                    $extension = $ext;
                                    break;
                                }
                            }
                            if ($extension == null) {
                                foreach ($extensiones as $ext) {
                                    if (file_exists('contratos/evaluacion_sst_'.$candidato_id.$ext)) {
                                        $extension = $ext;
                                        break;
                                    }
                                }
                            }
                        ?>
                        @if(file_exists('recursos_evaluacion_sst/evaluacion_sst_'.$candidato_id.'_'.$req_id.$extension))
                            <td>
                                <a href="{{ asset('recursos_evaluacion_sst/evaluacion_sst_'.$candidato_id.'_'.$req_id.$extension)}}" target="_blank" title="Ver Evaluacion SST"><span class="fa fa-file" aria-hidden="true"></span> Ver archivo</a>
                            </td>
                        @elseif(file_exists('contratos/evaluacion_sst_'.$candidato_id.$extension))
                            <td>
                                <a href="{{ asset('contratos/evaluacion_sst_'.$candidato_id.$extension)}}" target="_blank" title="Ver Evaluacion SST"><span class="fa fa-file" aria-hidden="true"></span> Ver archivo</a>
                            </td>
                        @endif
                    @endif
                @else
                    @if ($ref->observaciones)
                        <td>
                            {!! $ref->observaciones !!}
                        </td>
                    @else
                        <td></td>
                    @endif
                @endif

                <td>{{$ref->usuarioTerminacion()->name}}</td>

                <td>
                    @if($ref->usuario_terminacion !== null)
                        {{$ref->updated_at}}
                    @endif
                </td>

                {{-- <td style="text-align: center;">86%</td> --}}
                <!--<td></td>-->
            </tr>
        @endforeach

        {{-- Prueba BRYG --}}
        @if(!empty(App\Http\Controllers\PruebaPerfilBrygController::brygCandidato($candidato_id, $req_id)))
            <tr>
                <td></td>
                <td></td>
                <td>
                    <b>RESULTADO BRYG-A</b>
                </td>
                <td>
                    <a 
                        href="{{ route('admin.prueba_bryg_informe', [App\Http\Controllers\PruebaPerfilBrygController::brygCandidato($candidato_id, $req_id)->id]) }}" 
                        target="_blank"
                    ><i class="fa fa-file"></i> Verf informe BRYG-A</a>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @endif

        @if ($sitioModulo->consulta_seguridad === 'enabled')

                @if (isset($factor->factor_seguridad))
                    <tr>
                        <td> {{ $factor->usuarioRegistro()->name }} </td>
                        <td> {{ date("Y-m-d",strtotime($factor->created_at)) }} </td>
                        <td> CONSULTA_SEGURIDAD </td>
                        <td> <p style='padding:10px'>Enviado</p> </td>

                        @if($factor->factor_seguridad <= 30)
                            <td class="text-center bg-danger">{{ $factor->factor_seguridad }} %</td>
                        @elseif($factor->factor_seguridad > 30 || $factor->factor_seguridad <= 100)
                            <td class="text-center bg-success">{{ $factor->factor_seguridad }} %</td>
                        @endif
                        <td></td>
                        <td class="text-center">
                            Consulta de seguridad y factor de seguridad

                            @if($factor->pdf_consulta_file != null)
                                <br><a target="_blank" href="{{ url('recursos_pdf_consulta/'.$factor->pdf_consulta_file) }}" title="Ver PDF generado">
                                    <span class="fa fa-file" aria-hidden="true"></span> Ver PDF generado
                                </a>
                            @endif
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                @else
        
                @endif
        @endif

        {{-- Detalles de consulta en truora --}}
        @if(route("home") == "https://vym.t3rsc.co" || route("home") == "https://listos.t3rsc.co")
            @if (isset($generated_score))
                @if (isset($generated_status))
                    <tr>
                        {{-- Validar cada estado de la consulta en truora --}}
                        @if ($generated_status === 'in_progress')
                            <td></td>
                            <td></td>
                            <td>TRUORA PUNTAJE EN PROCESO DE CONSULTA</td>
                            <td></td>
                            <td class="text-center bg-info">Generando</td>
                            <td></td>
                            <td class="text-center">
                                Truora Factor <br>
                                <a href="#" title="Esperando PDF Truora">
                                    <span class="fa fa-file" aria-hidden="true"></span> PDF En Progreso
                                </a>
                            </td>

                            <td></td>
                        @elseif($generated_status === 'not_started')
                            <td></td>
                            <td></td>
                            <td>TRUORA PUNTAJE EN PROCESO DE CONSULTA</td>
                            <td></td>
                            <td class="text-center bg-info">Generando</td>
                            <td></td>
                            <td class="text-center">
                                Truora Factor <br>
                                <a href="#" title="Esperando PDF Truora">
                                    <span class="fa fa-file" aria-hidden="true"></span> PDF En Progreso
                                </a>
                            </td>

                            <td></td>
                        @elseif($generated_status === 'completed')
                            <td></td>
                            <td></td>
                            <td>TRUORA PUNTAJE CONSULTADO</td>
                            <td></td>
                            <td class="text-center bg-info">{{ $generated_score }} %</td>
                            <td></td>
                            <td class="text-center">
                                Truora Factor Generado <br>
                                <a 
                                    target="_blank" 
                                    href="{{ route('ver_pdf_truora', ['truora_generated' => $generated_check]) }}" 
                                    title="Ver PDF Truora">
                                    <span class="fa fa-file" aria-hidden="true"></span> Ver PDF Truora
                                </a>
                            </td>
                            <td></td>
                        @elseif($generated_status === 'error')
                            <td></td>
                            <td></td>
                            <td>TRUORA PUNTAJE CONSULTADO</td>
                            <td></td>
                            <td class="text-center bg-info">{{ $generated_score }} %</td>
                            <td></td>
                            <td class="text-center">
                                Truora Factor Generado (Truora no encontro el documento en algunas listas.)<br>
                                <a 
                                    target="_blank" href="{{ route('ver_pdf_truora', ['truora_generated' => $generated_check]) }}" 
                                    title="Ver PDF Truora"
                                >
                                    <span class="fa fa-file" aria-hidden="true"></span> Ver PDF Truora
                                </a>
                            </td>
                            <td></td>
                        @endif
                    </tr>
                @endif        
            @endif
        @endif

        {{-- Estatus de contrato
        @if (isset($firma_contrato) || $firma_contrato != null || $firma_contrato != '')
            @if ($firma_contrato->terminado == 1)
                <td></td>
                <td></td>
                <td>ENVIO_CONTRATACION</td>
                <td class="text-center">Apto</td>
                <td></td>
                <td>El candidato firmo virtualmente el contrato.</td>
                <td>{{ $datos_status_candidato->nombres }} {{ $datos_status_candidato->primer_apellido }} {{ $datos_status_candidato->segundo_apellido }}</td>
                <td>{{ $firma_contrato->updated_at }}</td>
            @elseif($firma_contrato->terminado == 2)
                <td></td>
                <td></td>
                <td>ENVIO_CONTRATACION</td>
                <td class="text-center">Apto</td>
                <td></td>
                <td>Contrato cargado manualmente.</td>
                <td>{{ $datos_status_candidato->nombres }} {{ $datos_status_candidato->primer_apellido }} {{ $datos_status_candidato->segundo_apellido }}</td>
                <td>{{ $firma_contrato->updated_at }}</td>
            @elseif($firma_contrato->terminado == 0)
                <td></td>
                <td></td>
                <td>ENVIO_CONTRATACION</td>
                <td class="text-center">No apto</td>
                <td></td>
                <td>El candidato cancelo la contratación.</td>
                <td>{{ $datos_status_candidato->nombres }} {{ $datos_status_candidato->primer_apellido }} {{ $datos_status_candidato->segundo_apellido }}</td>
                <td>{{ $firma_contrato->updated_at }}</td>
            @endif
        @endif
        --}}
    </table>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default | tri-px-2 tri-br-2 tri-border--none tri-transition-300" data-dismiss="modal">Cerrar</button>
</div>

<style>
    #mdialTamanio{ width: 80% !important; }
</style>

<script> </script>