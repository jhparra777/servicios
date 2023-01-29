<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Carnet Candidato</title>
    </head>

    <style>

      @font-face {
            font-family: 'Bureau';
            src: url('{{asset("assets/fonts/Font-Bureau-HeronSans-Regular.woff2")}}') format('woff2');
            font-style: normal;
            font-weight: 300;
      }

      @font-face {
            font-family: 'Bureau';
            src: url('{{asset("assets/fonts/Font-Bureau-HeronSans-SemiBold.woff2")}}') format('woff2');
            font-style: normal;
            font-weight: 400;
      }

      @font-face {
            font-family: 'Bureau';
            src: url('{{asset("assets/fonts/Font-Bureau-HeronSansCond-SemiBold.woff2")}}') format('woff2');
            font-style: normal;
            font-weight: 700;
      }

        body{
          font-family: "Bureau", Verdana, arial, sans-serif;
          font-size: 8px;
        }

        @page { margin: 30px 40px; }

        .page-break {
          page-break-after: always;
        }


        .titulo{
          background-color: #333131;
          padding: 10px 0px;
          color: #FFFFFF;
          text-align: center;
          font-size: 16px;
        }

        .tabla1 tr th{
            background-color: #fdf099;
            font-weight: bold;
            padding: 5px 10px;
            text-align: left;
            width: 180px;
            font-size: 14px;
        }

        .tabla2 tr th{
            background-color: #fdf099;
            font-weight: bold;
            padding: 5px 10px;
            text-align: left;
            font-size: 8px;
        }

        .tabla1 tr td{
          padding: 5px 10px;
          font-size: 8px;
          width: 100%;
        }

        .tabla2 tr td{
          padding: 5px 10px;
          font-size: 8px;
        }

        .col-center{
          float: none;
          margin-left: auto;
          margin-right: auto;
        }

        .logo_derecha{      
          position: absolute;
          right: 0;
        }

    </style>

    <body>
      @if( $empresa->codigo == "PSV" )
            <div style="position: relative; margin:0;">
              <img alt="Logo T3RS" class="" src="{{asset('carnet_PT.png')}}" style="position: absolute;width:50%;height:220px;">
                    
                  <div style="postion:absolute;width:56%;z-index:1;">

                    <div class="datos_candidato" style="text-align: center; word-wrap: break-word;left: 140px; height:auto; width:50%; position: relative;z-index:2;">

                      <span style="font-size:9pt; color: white; font-weight: bold;">
                        <p style="line-height: 1.5em;"> 
                          <span style="font-size:11pt;">{{ucwords($candidato->nombres)}}
                            <br/>
                            {{ucwords($candidato->primer_apellido).' '.ucwords($candidato->segundo_apellido)}}
                          </span>
                          <br/>
                          <span style="font-size:7pt;">Trabajador en Misión</span>
                        </p>

                      </span>

                      <table style="font-size:8pt; color: white; width:110%; padding-bottom: 25px;">
                        <tr>
                          <th style="text-align: left;">
                            {{$candidato->cod_tipo}}
                          </th>
                          <td>
                            {{$candidato->numero_id}}
                          </td>
                        </tr>
                        <tr>
                          <th style="text-align: left;">
                            Cargo
                          </th>
                          <td>
                            {{$req->cargo_req()}}
                          </td>
                        </tr>
                        <tr>
                          <th style="text-align: left;">
                            ARL
                          </th>
                          <td>
                            SURA
                          </td>
                        </tr>
                        <tr>
                          <th style="text-align: left;">
                            RH
                          </th>
                          <td>
                            {{$candidato->grupo_sanguineo}} 
                            @if( $candidato->rh == 'positivo' )
                              +
                            @elseif( $candidato->rh == 'negativo' )
                              -
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <th style="text-align: left;">
                            Cliente
                          </th>
                          <td>
                            {{ucwords(mb_strtoupper($req->nombre_cliente))}}
                          </td>
                        </tr>
                      </table>

                    </div>

                </div>
              </div>
    @elseif($empresa->codigo == "PSG" )
      <div style="position: relative; margin:0;">
             <img alt="Logo T3RS" class="" src="{{asset('configuracion_sitio/Carnet_PG.png')}}" style="position: absolute;width:40%;height:500px;">
                    
                  <div style="postion:absolute;width:56%;z-index:1;">

                    <div class="datos_candidato" style="text-align: center; word-wrap: break-word;top:120px;height:auto; width:50%; position: relative;z-index:2; margin-left:50px;">

                      <span style="font-size:9pt; color: white; font-weight: bold;">
                        <p> 
                          <span style="font-size:11pt;">{{ucwords(mb_strtoupper($candidato->nombres))}}
                            <br/>
                            {{ucwords(mb_strtoupper($candidato->primer_apellido)).' '.ucwords(mb_strtoupper($candidato->segundo_apellido))}}
                          </span>
                          <br/>
                          {{$req->cargo_req()}}
                        </p>

                      </span>
                      <br/><br/>
                      <table style="font-size:8pt; color: white; width:110%; padding-bottom: 20px;">
                        <tr>
                          <td>
                            C.C
                          </td>
                          <td>
                            {{$candidato->numero_id}}
                          </td>
                        </tr>
                        <tr>
                          <td>
                            ARL
                          </td>
                          <td>
                            SURA
                          </td>
                        </tr>
                        <tr>
                          <td>
                            RH
                          </td>
                          <td>
                            {{$candidato->grupo_sanguineo}} {{$candidato->rh}}
                          </td>
                        </tr>
                        <tr>
                          <td>
                            Nit
                          </td>
                          <td>
                            {{$empresa->nit}}
                          </td>
                        </tr>
                        <tr>
                          <td>
                            Sociedad
                          </td>
                          <td>
                            {{$empresa->nombre_empresa}}
                          </td>
                        </tr>
                      </table>
                      <br/><br/>
                      <span> 
                        @if( isset($qrcode) )
                         <img style="width:50%;height:100px;" alt="QR code" src="data:image/png;base64,{!!$qrcode!!}" />
                        @endif
                     </span>

                    </div>

                 </div>
              </div>
    @endif
              @if($empresa->codigo == "PSG" )
                <div style="position: relative; margin:0; top:0; right: 0;">
                  <img alt="Logo T3RS" src="{{asset('configuracion_sitio/Carnet_PG_Trasero.png')}}" style="position: absolute;top:0; right: 0; width:40%;height:500px;">
                  <div style="postion:absolute;width:56%;z-index:1;">

                    <div class="datos_candidato" style="text-align: center; word-wrap: break-word;top:120px;height:auto; width:50%; position: relative;z-index:2; margin-left: 485px;">

                      <span style="font-size:9pt; color: white; font-weight: bold; text-align: center;">
                        <p> 
                          <span style="font-size:11pt;">{{ucwords(mb_strtoupper($candidato->nombres))}}
                            <br/>
                            {{ucwords(mb_strtoupper($candidato->primer_apellido)).' '.ucwords(mb_strtoupper($candidato->segundo_apellido))}}
                          </span>
                          <hr/>
                          {{$req->cargo_req()}}
                        </p>
                        <br/><br/><br/>
                        <p>
                          Este carnet de identificación
                          <br/>
                          acredita al portador para su
                          <br/>
                          acceso a las instalaciones
                        </p>
                        <br/><br/><br/><br/><br/>
                        <p style="color: lightgray; font-size: 7pt;">
                          En el caso de pérdida del documento o
                          <br/>
                          alguna emergencia por favor entregarlo en
                          <br/>
                          las instalaciones de
                          <br/><br/>
                          <span style="font-weight: 700; color: gray;">
                            PROSERVIS GENERALES
                          </span>
                          <br/>
                          Calle 38 norte No. 3cn 92
                          <br/>
                          Cali - Colombia
                          <br/>
                          (572) 4861717
                        </p>

                      </span>
                      <br/><br/>
                    </div>
                  </div>
                </div>
              @endif
  </body>
</html>