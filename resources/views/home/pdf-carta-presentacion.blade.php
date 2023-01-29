<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Carta de presentación</title>

    <style>
        html{
            font-family: 'Arial';
        }

        body{
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            font-size: 9pt;
            line-height: 1.2;
            color: black;
            background-color: #fff;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            /*background-color: #2a0927;*/
            color: #d6d6d6;
            text-align: center;
            line-height: 20px;
        }

        .text-center{ text-align: center;  }
        .text-left{ text-align: left;  }
        .text-right{ text-align: right;  }
        .text-light{ font-weight: lighter; }

        .mt-1{ margin-top: 1rem; }
        .mt-2{ margin-top: 2rem; }
        .mt-3{ margin-top: 3rem; }
        .mt-4{ margin-top: 4rem; }
        .mt-6{ margin-top: 6rem; }

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
    </style>
</head>

<body>
    <table class="mt-6 center" width="90%">
        <tr>
            <td class="text-left" style="width: 30%">
                @if(isset($sitio->logo))
                    <img style="max-width: 200px" src="{{ public_path().'/configuracion_sitio/'.$sitio->logo }}">
                @endif
            </td> 
        </tr>
    </table>
    <br><br>
    <table class="center table justify mt-6" width="75%">
        <tr class="pd-1">
            <td class="text-left" width="100%">
                {{ ($reqcandidato != null ? $reqcandidato->ciudadreq : '') }}, <?php setlocale(LC_TIME, 'es_ES.UTF-8'); echo strftime("%d de %B del %Y") ?>  </p>
            </td>
        </tr>
        <tr>
            <td class="text-left" width="100%">
                Señores : {{ ($reqcandidato != null ? $reqcandidato->cliente_nombre : '') }}
            </td>
        </tr>
        <tr>
            <td class="text-left" width="100%">
                {{ ($reqcandidato != null ? $reqcandidato->ciudadreq : '') }}
            </td>
        </tr>
    </table>
    <table class="mt-2" width="75%"></table>
    <table class="center table justify mt-4" width="75%">
        <tr>
            <td style="padding-top: 5px; padding-bottom: 5px;">
                Asunto:  Envió de Personal
            </td>
        </tr>

        <tr>
            <td>
                <br/>
                Presentamos al siguiente personal quien ingresa a laborar a sus instalaciones a partir del {{strftime("%d de %B del %Y", strtotime($req_contrato_candidato->fecha_inicio_contrato))}}, en el cargo:   {{ $reqcandidato->nombre_cargo_especifico }}
                <br/><br/><br><br><br>
                <table style="width: 90%;">
                    <tr>
                        <td>
                            <b>CEDULA: {{ $candidato->numero_id }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>NOMBRE: {{ mb_strtoupper($candidato->nombres . ' ' . $candidato->primer_apellido . ' ' . $candidato->segundo_apellido, 'UTF-8') }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>EPS: {{$req_contrato_candidato->entidades_eps_des}}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>ARL: SURA</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>CAJA COMPENSACION: {{$req_contrato_candidato->caja_compensacion_des}}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>SALARIO: $ {{number_format($req_contrato_candidato->salario)}}</b>
                        </td>
                    </tr>
                </table>
                <br><br><br>
                <br><br><br><br><br>
                Atentamente,
                <br><br><br><br>
                <img src="{{public_path().'/firma_autorizada_v2.jpg'}}" width="180">
                <p>________________________</p>
                <p>
                    <b>{{$empresa_logo->nombre_empresa}}</b>
                    <br/>
                    <b>NIT: {{$empresa_logo->nit}}</b>
                </p>
            </td>
        </tr>
    </table>
    <footer>
        <img src="{{public_path().'/img/footer_proservis.png'}}" height="70">
    </footer>
</body>
</html>