<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="{{csrf_token()}}" name="token">
    {{-- <title>
        @if(isset($sitio->nombre))
                @if($sitio->nombre != "")
                    {{ $sitio->nombre }} - Firma contrato
                @else
                    Desarrollo | Firma contrato
                @endif
        @else
                Desarrollo | Firma-contrato
        @endif
    </title>

     @if($sitio->favicon)
            @if($sitio->favicon != "")
                <link href="{{ url('configuracion_sitio')}}/{{$sitio->favicon }}" rel="shortcut icon">
            @else
                <link href="{{ url('img/favicon.png') }}" rel="shortcut icon">
            @endif
    @else
            <link href="{{ url('img/favicon.png') }}" rel="shortcut icon">
    @endif --}}

    {{-- drawingboard CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('js/drawingboard/drawingboard.min.css') }}">

    <script src="https://code.jquery.com/jquery-3.4.1.js" type="text/javascript"></script>

    {{-- drawingboard JS --}}
    <script src="{{ asset('js/drawingboard/drawingboard.min.js') }}" type="text/javascript"></script>

    <style>
        html{
            font-family: 'Arial';
        }

        body{
            /*font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            font-size: 14px;
            line-height: 1.42857143;
            color: #333;
            background-color: #fff;*/
        }

        /*.btn{
            text-decoration: none;
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid transparent;
                border-top-color: transparent;
                border-right-color: transparent;
                border-bottom-color: transparent;
                border-left-color: transparent;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: .25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }

        .btn-success{
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-secondary{
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-warning{
            color: #fff;
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-danger{
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-secondary:hover{
            color: #fff;
            background-color: #5a6268;
            border-color: #545b62;
        }

        .btn-success:hover{
            color: #fff;
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn:not(:disabled):not(.disabled){
            cursor: pointer;
        }

        .btn:focus, .btn:hover{
            text-decoration: none;
        }*/

        .text-center{ text-align: center;  }
        .text-left{ text-align: left;  }
        .text-right{ text-align: right;  }
        .text-light{ font-weight: lighter; }
        .text-nowrap{ white-space: nowrap; }  

        .mt-1{ margin-top: 1rem; }
        .mt-2{ margin-top: 2rem; }
        .mt-3{ margin-top: 3rem; }
        .mt-4{ margin-top: 4rem; }

        .pd-1{ padding: 1rem; }

        .center{ margin: auto; }

        /*.table{
            border-collapse:separate; 
            border-spacing: 0 1em;
        }*/

        .mb-2{
            margin-bottom: 2rem;
        }

        .justify{ text-align: justify; }

        .list{ list-style: none; }
        /*.space{ line-height: 22px; }*/
    </style>
</head>
<body>

    <table width="100%" class="mt-4">
        <tr>
            <th width="10%"></th>

            <th class="text-left">
                @if (isset($sitio))
                        <img src="{{ asset('configuracion_sitio/'.$sitio->logo) }}" width="100" >
                @endif
            </th>

            <th class="text-right text-light">
                Fecha: <strong>{{$fecha}}</strong>
            </th>

            <th width="10%"></th>
        </tr>
    </table>

    <table width="100%" class="mt-4">
        <tr>
            <th class="text-center">
                <p>Firma de contrato</p>
            </th>
        </tr>

        <tr>
            <td class="text-center mt-1">
                {{$candidato->nombres}} {{$candidato->primer_apellido}} {{$candidato->segundo_apellido}}
            </td>
        </tr>
    </table>

    <table class="mt-4 mb-2" width="100%">
        <tr>
            <th class="text-center">
                <p>{{$empresa_contrata->nombre_empresa}}</p>
                <p>CONTRATO DE TRABAJO POR OBRA O LABOR CONTRATADA</p>
            </th>
        </tr>
    </table>

    <table class="center table justify" width="97%">
        <tr>
            <th class="text-left">
                Nombre del trabajador:
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
                Empresa cliente:
            </th>
            
            <td>
                {{$reqcandidato->cliente_nombre}}
            </td>

            <th class="text-left">
                Cargo:
            </th>
            
            <td>
                {{$reqcandidato->nombre_cargo_especifico}}
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
                Centro de costos:
            </th>

            <td>
                {{$fechasContrato->centro_costo_produccion}}
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
                Caja de Compensación:
            </th>

            <td>
                {{$fechasContrato->caja_compensacion_des}}
            </td>

            <th class="text-left">
                Fecha de Nacimiento:
            </th>
            
            <td>
                {{ $candidato->fecha_nacimiento }}
            </td>
        </tr>

        <tr>

            <th class="text-left">
                Fecha de iniciación:
            </th>

            <td>
                @if(isset($fechasContrato->fecha_ingreso))
                    {{ $fechasContrato->fecha_ingreso }}
                @endif
            </td>

            <th class="text-left">
                Forma de pago:
            </th>

            <td>
                {{$fechasContrato->forma_pago}}
            </td>
        </tr>

        <tr>
            <th class="text-left">
                Cuenta No:
            </th>

            <td>
                {{$fechasContrato->numero_cuenta}}
            </td>
            
            <th class="text-left">
                Entidad:
            </th>

            <td>
                {{$fechasContrato->nombre_banco}}
            </td>
        </tr>
    </table>

    <div class="center table justify mt-4" style="width:97%;">

        Entre los suscritos, a saber, por una parte, <b>{{$empresa_contrata->representante}}</b>, mayor de edad y vecino de {{$empresa_contrata->ciudad}}, identificado con la cédula de ciudadanía No. {{$empresa_contrata->cedula}} expedida en Cali y quien actúa en nombre y representación   de   la sociedad denominada   <b>{{$empresa_contrata->nombre_empresa}}</b>, quien en adelante se llamará EL <b>EMPLEADOR</b>, y por la otra, EL <b>TRABAJADOR EN MISION</b>, se ha celebrado el presente contrato de trabajo <b>POR OBRA O LABOR CONTRATADA</b>, el cual se regirá por las siguientes estipulaciones: 
                
        {!! isset($cuerpo_contrato) ? $cuerpo_contrato->cuerpo_contrato : "" !!}
                
        El presente contrato se firma en dos ejemplares del mismo tenor y ante testigos, a los {{ date('d') }} del mes de {{ $meses[date('n')] }} del {{date('Y')}}.
    
    </div>

    {{-- Contrato firmado --}}
    @if($firmaContrato != null || $firmaContrato != '')
        @if($firmaContrato->firma != null || $firmaContrato->firma != '')
            <table class="center table-contract" width="80%">
                <tr>
                    <td width="40%">
                        <div style="width: 100%; margin: 4em;">
                            <img src="{{ asset('contratos/'.$empresa_contrata->firma) }}" width="200" {{--style="width: 60%;"--}}>
                            <p>________________________________</p>
                            {{$empresa_contrata->representante}} 
                            <br>
                            C.C. No. {{$empresa_contrata->cedula}} 
                        </div>
                    </td>
                    <td width="30%"></td>
                    <td width="40%">
                        <div style="width: 100%; margin: 4em;">
                            <img src="{{ $firmaContrato->firma }}" width="200" {{--style="width: 60%;"--}}>
                            <p>________________________________</p>
                            El trabajador:<br>
                            {{ucwords(mb_strtolower($candidato->dec_tipo_doc))}}: {{ $candidato->numero_id }}
                        </div>
                    </td>
                </tr>
            </table>
        @endif
    @endif

    {{-- Tablero de firmar contrato --}}
    @if(count($firmaContrato) <= 0)
        <table class="center table-contract" width="80%" bgcolor="#f1f1f1">
            <tr>
                <td width="30%"></td>
                <td>
                    <div>
                        <div>
                            <div id="firmBoard" style="width: 400px; height: 160px; margin: 1rem;"></div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

        <table class="center table-contract" width="80%" bgcolor="#f1f1f1">
            <tr>
                <td class="text-center">
                    <button type="button" class="btn btn-success guardarFirma" disabled>Firmar</button>
                    <p>Por favor dibuja tu firma en el panel blanco, no podemos guardar el contrato sin tu firma.</p>
                </td>
            </tr>
        </table>
    @elseif($firmaContrato->firma == null || $firmaContrato->firma == '')
        <table class="center table-contract" width="80%" bgcolor="#f1f1f1">
            <tr>
                <td width="30%"></td>
                <td>
                    <div>
                        <div>
                            <div id="firmBoard" style="width: 400px; height: 160px; margin: 1rem;"></div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

        <table class="center table-contract" width="80%" bgcolor="#f1f1f1">
            <tr>
                <td class="text-center">
                    <button type="button" class="btn btn-success guardarFirma" disabled>Firmar</button>
                    <p>Por favor dibuja tu firma en el panel blanco, no podemos guardar el contrato sin tu firma.</p>
                </td>
            </tr>
        </table>
    @endif

    {{-- Siguiente paso despues de haber firmado 
    @if($firmaContrato != null || $firmaContrato != '')
        @if($firmaContrato->firma != null || $firmaContrato->firma != '')
            @if($firmaContrato->video == null)
                <table class="center table" width="80%" bgcolor="#f1f1f1">
                    <tr>
                        <td class="text-center">
                            <a
                                type="button"
                                class="btn btn-warning pull-right"
                                href="{{ route('home.confirmar-documentos-adicionales', [$userIdHash, $firmaContratoHash]) }}"
                                style="color: white;"
                            >
                                Siguiente paso 
                            </a>
                        </td>
                    </tr>
                </table>
            @endif
        @endif
    @endif --}}

    {{-- <div class="text-center mt-4 mb-2">
        <button type="button" class="btn btn-danger" id="btnCancelarContrato">Cancelar contratación</button>
    </div>  --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>
        $(function (){
            //Define the swal toast
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });

            var firmBoard = new DrawingBoard.Board('firmBoard', {
                controls: [
                    { DrawingMode: { filler: false, eraser: false,  } },
                    { Navigation: { forward: false, back: false } }
                    //'Download'
                ],
                size: 2,
                webStorage: 'session',
                enlargeYourContainer: true
            });

            //listen draw event
            firmBoard.ev.bind('board:stopDrawing', getStopDraw);
            firmBoard.ev.bind('board:reset', getResetDraw);

            function getStopDraw() {
                $(".guardarFirma").attr("disabled", false);
            }

            function getResetDraw() {
                $(".guardarFirma").attr("disabled", true);
            }

            $(".guardarFirma").on("click", function() {
                $('.drawing-board-canvas').attr('id', 'canvas');

                var firmBefore = document.getElementById('canvas');
                var firmShow = firmBefore.toDataURL();

                Swal.fire({
                    imageUrl: firmShow,
                    imageWidth: 200,
                    imageHeight: 100,
                    title: '¿Tu firma es correcta?',
                    text: "Asegurate de que tu firma sea correcta y legible.",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, firmar',
                    cancelButtonText: 'Revisar'
                }).then((result) => {
                    if (result.value) {
                        $('.drawing-board-canvas').attr('id', 'canvas');

                        var canvas1 = document.getElementById('canvas');
                        var canvas = canvas1.toDataURL();
                
                        user_id = '{{$user_id}}';
                        req_id = '{{$req_id}}';
                        estado = 1;

                        var token = ('_token','{{ csrf_token() }}');
                        
                        $.ajax({
                            type: 'POST',
                            data: {
                                user_id : user_id,
                                estado : estado,
                                req_id : req_id,
                                _token : token,
                                firma : canvas
                            },
                            url: "{{ route('home.guardar-firma') }}",
                            beforeSend: function(response) {
                                Toast.fire({
                                    icon: 'info',
                                    title: 'Validando y guardando ...'
                                });
                            },
                            success: function(response) {
                                if(response.success == true){
                                    /*Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Contrato firmado.',
                                        showConfirmButton: false
                                    });*/

                                    takePicture(webcam)

                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: `¡Contrato firmado! <br>
                                                <p style="font-size: 2rem;">Por favor haz clic en el botón <i>"siguiente paso"</i> para continuar con la firma de los documentos adicionales.</p>`,
                                        showConfirmButton: false
                                    });

                                    setTimeout(function() {
                                        localStorage.setItem('reloadTab', false)
                                        localStorage.setItem('nextStep', true)
                                        location.reload();
                                    }, 5000);
                                }

                                if(response.success == false){
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'info',
                                        title: 'Ya se encuentra creada la firma.',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            }
                        });
                    }
                });
            });

            //Cancelar contrato
            const $btnCancelarContrato = document.querySelector('#btnCancelarContrato');
            var tokenvalue = $('meta[name="token"]').attr('content');

            let dashboardRedir = '{{ route('dashboard') }}';
            let routeCancel = '{{ route('cancelar_contratacion_candidato') }}';
            let contratoId  = '{{ $firmaContrato->id }}';
            let userId  = '{{ $userId }}';
            let reqId  = '{{ $ReqId }}';

            const ToastNoTime = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timerProgressBar: true
            });

            const cancelContract = () => {
                Swal.fire({
                    title: '¿Estas seguro/a?',
                    text: "Esta acción es irreversible.",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Si, cancelar',
                    cancelButtonText: 'No, continuar'
                }).then((result) => {
                    if (result.value) {
                        //$('#observeModal').modal('show');
                        Swal.fire({
                            title: 'Cancelación de contrato',
                            input: 'textarea',
                            inputPlaceholder: 'Describe la razón por la que quieres cancelar el contrato',
                            inputAttributes: {
                                'aria-label': 'Describe la razón por la que quieres cancelar el contrato'
                            },
                            inputValidator: (field) => {
                                if (!field) {
                                    return 'Debes completar el campo'
                                }
                            },
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Enviar y cancelar',
                            cancelButtonText: 'Cancelar'
                        }).then((cancelation) => {
                            $.ajax({
                                type: 'POST',
                                data: {
                                    _token : tokenvalue,
                                    user_id : userId,
                                    req_id : reqId,
                                    contrato_id : contratoId,
                                    observacion : cancelation.value
                                },
                                url: routeCancel,
                                beforeSend: function() {
                                    ToastNoTime.fire({
                                        icon: 'info',
                                        title: 'Validando y guardando ...'
                                    });
                                },
                                success: function(response) {
                                    if(response.success == true){
                                        Swal.fire({
                                            position: 'top-end',
                                            icon: 'success',
                                            title: 'Contrato cancelado.',
                                            showConfirmButton: false
                                        });

                                        setTimeout(() => {
                                            localStorage.setItem('reloadTab', false)
                                            window.location.href = dashboardRedir
                                        }, 1000)
                                    }
                                }
                            });
                        })
                    }
                });
            }

            $btnCancelarContrato.addEventListener('click', () => {
                cancelContract()
            });
        });
    </script>
</body>
</html>