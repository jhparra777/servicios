<div>
    @if(isset($isPDF))
        <div style="text-align: justify; padding-bottom: 1em; ">
            <table style="width: 100%;border: 1px solid black;border-collapse: collapse;text-align: center;">
                <tr>
                    <td rowspan="4" style="width: 30%;border: 1px solid black;">
                        @if(isset($requerimiento->logo))
                            <img class="center fixedwidth"
                                align="center"
                                border="0"
                                src="{{ asset('configuracion_sitio/'.$requerimiento->logo) }}"
                                alt="Image"
                                title="Image"
                                style="clear: both; border: 0; height: 50;" width="100%"
                            >
                        @else
                            <img class="center fixedwidth"
                                align="center"
                                border="0"
                                src="{{ url("img/logo.png")}}"
                                alt="Image"
                                title="Image"
                                style="clear: both; border: 0; height: auto; float: left;" width="150"
                            >
                        @endif
                    </td>
                    
                    <td rowspan="4" style="width: 40%; text-align: center; border: 1px solid black;">SEGURIDAD Y SALUD EN EL TRABAJO </td>
                    
                    <td style=";border: 1px solid black;">Versión: 01</td>
                    
                </tr>

                <tr>
                    <td style=";border: 1px solid black;">Código: SST. F001</td>
                </tr>

                <tr>
                    <td style=";border: 1px solid black;">Creado: 22/05/2019</td>
                </tr>
                <tr>
                    <td style=";border: 1px solid black;">Aprobado:</td>
                </tr>
            </table>
        </div>
    @endif

    <div>
        <h4 style="font-weight: bold;text-align: center;">ACTA DE COMPROMISO EN SALUD.</h4>
    </div>

    <div>
        <p>
            Fecha: {{date('Y-m-d')}}
        </p>
        <p style="text-align: justify; line-height: 1.5em;">
            <b>{{$requerimiento->nombre_empresa}}.</b> Comprometida a trabajar con todos los actores que la conforman, a través de su departamento de seguridad y salud en el trabajo busca fomentar un espacio laboral promotor de salud, con la participación activa y consciente de sus trabajadores. Su bienestar depende del autocuidado y para tales fines se realiza la siguiente acta de compromiso en los siguientes términos: 
        </p>

        <p style="text-align: justify; line-height: 1.5em;">
            <b>PRIMERO.</b> Se le comunica al colaborador {{$candidato->nombres}} {{$candidato->primer_apellido}} {{$candidato->segundo_apellido}} identificado con el documento de identidad: {{$candidato->numero_id}} que dado los últimos resultados obtenidos en los exámenes médicos ocupacionales efectuados en {{ isset($requerimiento_candidato_orden) ? $requerimiento_candidato_orden->centro_medico : "" }} el medico determino que requiere:
        </p>
        <p style="text-align: justify; line-height: 1.5em;">
            @if (isset($recomendaciones))
                {!! $recomendaciones !!}
            @endif
        </p>
        <p style="text-align: justify; line-height: 1.5em;">
            <b>SEGUNDO.</b>  El departamento de Seguridad y Salud en el trabajo, coordinadores y ejecutivos de cuenta se compromete a realizar un seguimiento bimensual de su estado de salud y de vigilar cumplimiento a su tratamiento médico.
        </p>
        <p style="text-align: justify; line-height: 1.5em;">
            <b>TERCERO.</b> Su deber como trabajador de {{$requerimiento->nombre_empresa}}, es cumplir de manera responsable las indicaciones de cuidado en el ambiente laboral y extralaboral en cumplimiento a la normatividad legal vigente (Articulo 58 literal 7 y 8 Código sustantivo del trabajo, Decreto 1295 de 1994, articulo 22, recopilado en el Decreto 1072/2015).
        </p>
        <p style="text-align: justify; line-height: 1.5em;">
            <b>CUARTO.</b>  El trabajador en mencionado manifiesta leer el contenido de este documento y estar de acuerdo en iniciar y/o continuar su control en la entidad correspondiente EPS / ARL. Además de tener una buena adherencia a las indicaciones de cuidado en el ambiente laborar y extralaboral (ICAL), tratamientos farmacológicos y de conducta establecidos por su médico tratante en pro de contribuir a su salud
        </p>

        <p>
            La empresa deja constancia de la notificación a las partes interesadas:
        </p>
    </div>

    <div >
        <table class="tabla" width="80%" style="border: none !important;">
            <tr>
                <td width="40%">
                    <div style="width: 100%; margin: 4em; margin-top: 0em;">
                        @if( isset($firma) )
                            <img src="{{$firma}}" width="180">
                        @endif
                        <p>________________________________</p>
                         <br>
                         Trabajador  
                    </div>
                </td>
                <td width="30%"></td>
                <td width="40%">
                    <div style="width: 100%; margin: 4em; margin-top: 0em;">
                            <img src="{{ asset('configuracion_sitio/coordinador_recomendacion_medica.png') }}" width="180">
                        <p>________________________________</p>
                        Coordinador SST
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>