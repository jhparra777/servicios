<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Firma de contrato</title>

    <style>
        html{
            font-family: 'Arial';
        }

        body{
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            font-size: 9pt !important;
            line-height: 1.2;
            color: black;
            background-color: #fff;
        }

        .text-center{ text-align: center;  }
        .text-left{ text-align: left;  }
        .text-right{ text-align: right;  }
        .text-light{ font-weight: lighter; }

        .m-1{ margin: 1rem; }
        .mt-1{ margin-top: 1rem; }
        .mt-2{ margin-top: 2rem; }
        .mt-3{ margin-top: 3rem; }
        .mt-4{ margin-top: 4rem; }

        .pd-1{ padding: 1rem; }

        .center{ margin: auto; }

        .table{
            border-collapse:separate; 
            /*border-spacing: 6px;*/
        }

        .justify{ text-align: justify; }

        .list{ list-style: none; }

        .space{ line-height: 18px; }

        hr{
            page-break-after: always;
            border: none;
            margin: 0;
            padding: 0;
        }

        footer{
            position: fixed; 
            bottom: -20px; 
            font-size: 7pt;
        }
    </style>
</head>
<body>
    @include('contratos.includes._section_footer_marca_agua')
    <table width="100%" class="mt-1">
        <tr>
            <th width="10%"></th>

            <th class="text-left">
                @if (isset($sitio->logo))
                      <img src="{{ public_path().'/configuracion_sitio/'.$sitio->logo }}" width="80" >
                @endif
            </th>

            <th class="text-right text-light">
                Fecha: <strong>{{ $fecha }}</strong>
            </th>

            <th width="10%"></th>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <th class="text-center">
                <p>Firma de contrato</p>
                @if (isset($anulado))
                    <h4 style="color:red; margin:0; padding:0; font-size: 24px;">CONTRATO ANULADO</h4>
                @endif
            </th>
        </tr>

        @if($foto != null)
            <tr>
                <td class="text-center">
                    <img src="{{ public_path().'/recursos_datosbasicos/'.$foto }}" width="80" height="80" style="border-radius: 10px;">
                </td>
            </tr>
        @endif

        <tr>
            <td class="text-center mt-1">
                {{ $candidato->nombres }} {{ $candidato->primer_apellido }} {{ $candidato->segundo_apellido }}
            </td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <th class="text-center">
                <p>{{$empresa_contrata->nombre_empresa}}</p>
                <p>CONTRATO DE APRENDIZAJE</p>
            </th>
        </tr>
    </table>

    <table class="center table justify" width="97%">
        <tr>
            <th class="text-left">
                Nombre del Aprendiz:
            </th>
            
            <td colspan="3">
                {{ $candidato->primer_apellido }} {{ $candidato->segundo_apellido }} {{ $candidato->nombres }}
            </td>
        </tr>

        <tr>
            <th class="text-left">
                Tipo Documento:
            </th>

            <td>
                {{ ucwords(mb_strtolower($candidato->dec_tipo_doc))}}
            </td>

            <th class="text-left">
                No:
            </th>

            <td>
                {{ $candidato->numero_id }}
            </td>

        </tr>

        <tr>
            <th class="text-left">
                Expedido en:
            </th>

            <td>
                @if($lugarexpedicion != null)
                    {{ $lugarexpedicion->value }}
                @endif
            </td>

            <th class="text-left">
                Lib. Militar No:
            </th>

            <td>
                {{ $candidato->numero_libreta }}
            </td>

        </tr>

        <tr>
            <th class="text-left">
                Clase:    
            </th>

            <td>
                {{ $candidato->clases_libretas_des }}
            </td>

            <th class="text-left">
                Residenciado en:
            </th>

            <td>
                @if($lugarresidencia != null)
                    {{ $lugarresidencia->value }}
                @endif
            </td>
        </tr>

        <tr>
            <th class="text-left">
                Barrio:
            </th>

            <td colspan="3">
                {{ $candidato->barrio }}
            </td>
        </tr>

        <tr>
            <th class="text-left">
                Dirección:
            </th>
            
            <td>
                {{ $candidato->direccion }}
            </td>

            <th class="text-left">
                Teléfono:
            </th>
            
            <td>
                {{ $candidato->telefono_movil }}
            </td>
        </tr>

        <tr>
            <th class="text-left">
                Salario Mensual:
            </th>

            <td>
                @if(isset($fechasContrato->salario))
                    $ {{ number_format($fechasContrato->salario) }}
                @else
                    {{-- Para previsualización del contrato --}}
                    @if(isset($requerimiento_informacion->salario))
                        $ {{ number_format($requerimiento_informacion->salario) }}
                    @endif
                @endif

                Pesos Mcte
            </td>

            <th class="text-left">
                Etapa:
            </th>

            <td>
                
            </td>

        </tr>

        <tr>

            <th class="text-left">
                Especialidad:
            </th>
            
            <td>
                {{$reqcandidato->nombre_cargo_especifico}}
            </td>

            <th class="text-left">
                ARP:
            </th>

            <td>
                ARL SURA
            </td>
        </tr>

        

        <tr>
            <th class="text-left">
                Centro de costos:
            </th>

            <td>
                @if(isset($fechasContrato->centro_costo_produccion))
                    {{$fechasContrato->centro_costo_produccion}}
                @endif
            </td>

            <th class="text-left">
                Fecha de inicición:
            </th>

            <td>
                @if(isset($fechasContrato->fecha_ingreso))
                    {{ $fechasContrato->fecha_ingreso }}
                @endif
            </td>

        </tr>

        <tr>
            <th class="text-left">EPS:</th>

            <td>
                @if( isset($fechasContrato) )
                 {{$fechasContrato->entidad_eps}}
                @endif
            </td>

            <th class="text-left">AFP:</th>

            <td>
                @if( isset($fechasContrato) )
                    {{$fechasContrato->entidad_afp}}
                @endif
            </td>

        </tr>

        <tr>

            <th class="text-left">
                Fecha de Nacimiento:
            </th>
            
            <td>
                {{ $candidato->fecha_nacimiento }}
            </td>

            <th class="text-left">
                Caja de Compensación:
            </th>

            <td>
                @if( isset($fechasContrato) )
                    {{$fechasContrato->caja_compensacion_des}}
                @endif
            </td>
        </tr>

        <tr>
            <th class="text-left">
                Forma de pago:
            </th>

            <td>
                @if(isset($fechasContrato->forma_pago))
                    {{$fechasContrato->forma_pago}}
                @endif
            </td>

            <th class="text-left">
                Cuenta No:
            </th>

            <td>
                @if(isset($fechasContrato->numero_cuenta))
                    {{$fechasContrato->numero_cuenta}}
                @endif
            </td>
        </tr>

        <tr>
            <th class="text-left">
                Entidad:
            </th>

            <td>
                @if(isset($fechasContrato->nombre_banco))
                    {{$fechasContrato->nombre_banco}}
                @endif
            </td>
        </tr>
    </table>

    <div class="center table justify mt-4" style="width:97%;">
        
        Entre los suscritos, a saber, por una parte, <b>{{$empresa_contrata->representante}}</b>, mayor de edad y vecino de {{$empresa_contrata->ciudad}}, identificado con la cédula de ciudadanía No. {{$empresa_contrata->cedula}} expedida en Cali, en su calidad de Gerente de <b>{{$empresa_contrata->nombre_empresa}}</b>, quien en  adelante  se  llamará  <b>EL EMPLEADOR</b>, y por la otra, <b>EL APRENDIZ</b>, se ha celebrado el presente contrato de <b>APRENDIZAJE</b> conforme a lo preceptuado por la LEY 789 de 2002 y de acuerdo a las siguientes clausulas: 

        {!! isset($cuerpo_contrato) ? $cuerpo_contrato->cuerpo_contrato : "" !!}

        <b>OCTAVA</b>.- El presente contrato se firma en dos ejemplares del mismo tenor y ante testigos, a los {{ date('d') }} del mes de {{ $meses[date('n')] }} del {{date('Y')}}. NOTA 2.- Las empresas no podrán contratar bajo la modalidad de aprendices a personas que hayan estado o se encuentren vinculadas laboralmente a las mismas (Ley 789 del 27 27 de diciembre de 2002, Articulo 35 Parágrafo).
    
    </div>

    {{-- Contrato firmado --}}
    @if($firmaContrato != null || (isset($mostrar_firma) && $mostrar_firma === 'SI'))
        <table class="center table" width="80%">
            <tr>
                <td width="40%">
                    <div style="width: 100%; margin: 4em; margin-top: 1.5em;">
                        <img src="{{ asset('contratos/'.$empresa_contrata->firma) }}" width="180">
                        <p>________________________________</p>
                       {{$empresa_contrata->representante}}  
                        <br>
                        C.C. No. {{$empresa_contrata->cedula}}
                        <br>
                    </div>
                </td>
                <td width="30%"></td>
                <td width="40%">
                    <div style="width: 100%; margin: 4em;">
                        @if ($firmaContrato != null)
                            <img src="{{ $firmaContrato->firma }}" width="180">
                        @endif
                        <p>________________________________</p>
                        El Aprendiz:<br>
                        {{ ucwords(mb_strtolower($candidato->dec_tipo_doc))}} : {{ $candidato->numero_id }}
                    </div>
                </td>
            </tr>
        </table>
    @endif

    @if(!isset($anulado) || (isset($mostrar_adicionales) && $mostrar_adicionales === 'SI'))
        @if(isset($adicionales))
            @if($adicionales->count() > 0)
                @foreach($adicionales as $ad)
                    <hr>
                    
                    <?php
                        $firma = null;
                        $documento_mostrar = "home.include.adicionales.documento_".$ad->adicional_id;
                        if($ad->firma != null && $ad->firma != ""){
                            $firma=$ad->firma;
                        }
                    ?>
                    
                    @include($documento_mostrar)

                    <?php
                        if(isset($firma)){
                            unset($firma);
                        }
                    ?>
                @endforeach
            @endif
        @endif

        @if(isset($adicional_externo))
            @if($adicional_externo->count() > 0)
                <div style="page-break-after:always;"></div>
                @include("home.include.adicionales.documento_medico_recomendaciones", [
                    "recomendaciones" => $requerimiento_candidato_orden_pdf->especificacion,
                    "firma" => isset($adicional_externo->firma) ? $adicional_externo->firma : null,
                    "lugarexpedicion" => $lugarexpedicion_medica
                ])
            @endif
        @endif

        {{-- cláusulas creadas --}}
        @if(isset($adicionales_creadas))
            @if($adicionales_creadas->count() > 0)
                @foreach($adicionales_creadas as $clausula)
                    <hr>
                    
                    <?php
                        $firma = null;
                        if($clausula->firma != null && $clausula->firma != ""){
                            $firma = $clausula->firma;
                        }

                        $nuevo_cuerpo = App\Jobs\FuncionesGlobales::search_and_replace(
                            $replace, 
                            $clausula->contenido_clausula, 
                            ['adicional_id' => $clausula->adicional_id, 'req_id' => $req_id, 'cargo_id' => $clausula->cargo_id, 'user_id' => $userId]
                        );
                    ?>

                    @include('admin.clausulas.template.layout', ["nuevo_cuerpo" => $nuevo_cuerpo, "empresa_contrata" => $empresa_contrata, "firma" => $firma, 'opcion_firma' => $clausula->opcion_firma]) 
                        

                    <?php
                        if(isset($firma)){
                            unset($firma);
                        }
                    ?>
                @endforeach
            @endif
        @endif

        @if (isset($mostrar_adicionales) && $mostrar_adicionales === 'SI')
            <div style="page-break-after:always;"></div>
            @include("home.confirmacion_manual", array('firma' => '-1'))
        @endif
    @endif

    @if($firmaContrato != null)
        <div style="page-break-after:always;"></div>

        <table class="center table justify" width="80%">
            <tr>
                <td>
                    <p>Información especial del contrato</p>
                    <ul class="list">
                        <li>IP: {{ $firmaContrato->ip }}</li>
                        <li>Fecha y hora de firma: {{ date("Y-m-d H:i:s") }}</li>
                        <li>Token de acceso: {{ $reqcandidato->token_acceso }}</li>
                        {{--<li>{!!QrCode::size(200)->generate("www.t3rsc.com") !!}</li>--}}
                    </ul>
                </td>
            </tr>
        </table>
    @endif

    @if(isset($contrato_fotos) && count($contrato_fotos) > 0)
        <div style="page-break-after:always;"></div>

        <section>
            <p class="text-center">
                <b>
                    Fotos tomadas durante la firma de los documentos
                </b>
            </p>
        </section>

        <section>
			<div class="text-center">
				@foreach($contrato_fotos as $key => $foto)
                    @if (empty($foto->estado))
                        <img 
                            class="m-1" 
                            src="{{ url("recursos_firma_contrato_fotos/contrato_foto_"."$userId"."_"."$req_id"."_"."$firmaContrato->id/$foto->descripcion") }}" 
                            alt="Foto candidato"
                            width="220"
                            style="padding: .25rem; width: 220px; background-color: #fff; border: 1px solid #dee2e6; border-radius: .25rem; max-width: 100%;">
                        <div style="margin-top: -1rem; font-size: 8pt; color: gray;">{{ $foto->created_at }}</div>
                    @else
                        <div class="m-1" style="padding: .25rem; font-size: 8pt; color: rgb(95, 95, 95);">{{ $foto->estado }}</div>
                    @endif

                    <?php
						if ($key === 6) {
							break;
						}
					?>
	            @endforeach
			</div>
		</section>
    @endif
</body>
</html>