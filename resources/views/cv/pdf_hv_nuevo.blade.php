<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ public_path('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Anton">
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Gothic A1">
        <title> Hoja de Vida - T3RS </title>
        <style type="text/css">
            * {
                margin: 0;
                padding: 0;
            }

            .page-break {
                page-break-after: always !important;
            }

            @page {
                margin: 0.5cm 0.5cm 0.8cm 0.5cm;
            }

            body {
                font-family: 'Gothic A1', serif !important;
                font-size: 10pt !important;
            }

            .fa-1ix {
                font-size: 1.5em !important;
            }

            .btn-icon {
                padding: 5px;
                justify-content: center !important;
                overflow: hidden;
                border-radius: 100%;
                flex-shrink: 0;
                height: 30px;
                width: 30px;
                /*
                height: calc( (0.875rem * 1) + (0.875rem * 2) + (2px) ) !important;
                width: calc( (0.875rem * 1) + (0.875rem * 2) + (2px) ) !important;
                */
            }

            .btn-icon .feather {
                margin-top: 0 !important;
            }

            .btn-icon.btn-xl {
                height: calc( (1.125rem * 1) + (1.25rem * 2) + (2px) ) !important;
                width: calc( (1.125rem * 1) + (1.25rem * 2) + (2px) ) !important;
                border-radius: 100%;
            }

            .btn-icon.btn-lg, .btn-group-lg > .btn-icon.btn {
                height: calc( (1rem * 1) + (1.125rem * 2) + (2px) ) !important;
                width: calc( (1rem * 1) + (1.125rem * 2) + (2px) ) !important;
            }
            .btn-icon.btn-sm, .btn-group-sm > .btn-icon.btn {
                height: calc( (0.75rem * 1) + (0.5rem * 2) + (2px) ) !important;
                width: calc( (0.75rem * 1) + (0.5rem * 2) + (2px) ) !important;
            }

            .btn-icon.btn-xs {
                height: calc( (0.7rem * 1) + (0.25rem * 2) + (2px) ) !important;
                width: calc( (0.7rem * 1) + (0.25rem * 2) + (2px) ) !important;
                border-radius: 100%;
            }

            .btn-facebook {
                color: #fff !important;
                background-color: #3b5998 !important;
                border-color: #3b5998 !important;
            }

            .btn-linkedin {
                color: #fff !important;
                background-color: #0073b1 !important;
                border-color: #0073b1 !important;
            }

            .btn-youtube {
                color: #fff !important;
                background-color: #ff0000 !important;
                border-color: #ff0000 !important;
            }

            .btn-instagram {
                color: #fff !important;
                background-color: #702357 !important;
                border-color: #702357 !important;
            }

            .btn-web {
                color: #fff !important;
                background-color: #488e48 !important;
                border-color: #488e48 !important;
            }

            .btn-twitter {
                color: #fff !important;
                background-color: #1da1f2 !important;
                border-color: #1da1f2 !important;
            }

            .btn-verde-azul {
                color: #fff !important;
                background-color: #167225 !important;
                border-color: #167225 !important;
            }

            .mx-1 {
                margin-right: 0.25rem !important;
                margin-left: 0.25rem !important;
            }

            p{
                text-align: justify;
            }

            .subtitulo, .titulo {
                letter-spacing: 1px;
            }

            .subtitulo {
                font-family: Anton !important;
                font-size: 12pt !important;
                color: {{ ($sitio->usar_color_hv != null ? $sitio->usar_color_hv : '#29792b') }} !important;
            }

            .titulo {
                font-family: Anton !important;
                font-size: 14pt !important;
                color: {{ ($sitio->usar_color_hv != null ? $sitio->usar_color_hv : '#29792b') }} !important;
            }

            .divisor {
                color: #1D9738 !important;
                width: 70% !important;
                border: 0;
                height: 3px !important;
                background: #1D9738 !important;
                margin-top: 0 !important;
                margin-bottom: 5px !important;
            }

            /* Style the side navigation */
            .sidenav {
                background-color: #efefef !important;
            }

            .main-pic {
                width: 80%;
                height: 150px;
                margin: 30px auto;
            }

            .main-pic img {
                width: 80%;
                height: 150px;
                border-radius: 50%;
            }

            .mx-100 {
                margin-left: 100px;
                margin-right: 100px;
            }

            .acortar-texto {
                white-space: nowrap;
                text-overflow: ellipsis;
                overflow: hidden;
            }

            main {
                width: 100%;

                padding: 0rem;
                border-radius: 0rem;
                border: none;
                background-color: none;
                margin-left: 0 !important;
                margin-right: 0 !important;
                /*padding-bottom: 2rem !important;*/
            }
            body {
                margin-top: 0 !important;
                background-color: transparent !important;
            }
            .section-descarga {
                display: none;
            }
            .acortar-texto {
                display: inline-block !important;
                overflow: visible !important;
            }
            #salto-email {
                display: block;
            }

            .espacio-imagen {
                padding-top: 2rem !important;
            }
        </style>
    </head>
    <body>
        <main id="main" class="row">
            <div class="col-xs-12 col-md-12">
                <div class="col-xs-4 col-md-3 mb-2 sidenav">
                    <div class="main-pic text-center espacio-imagen">
                        @if($user->foto_perfil != "")
                            <img alt="user photo" src="{{ url('recursos_datosbasicos/'.$user->foto_perfil)}}">
                        @elseif($user->avatar != "")
                            <img alt="user photo" src="{{ $user->avatar }}">
                        @else
                            <img alt="user photo" src="{{ url('img/personaDefectoG.jpg')}}">
                        @endif
                    </div>
                    <div class="text-center">
                        <h3 class="titulo">
                            {{ucwords(mb_strtolower($datos_basicos->nombres))}} {{ucwords(mb_strtolower($datos_basicos->primer_apellido)) }} {{ ucwords(mb_strtolower($datos_basicos->segundo_apellido)) }}
                        </h3>
                        @if($estudios->count() > 0)
                            <?php
                                $filtered = collect([]);
                                foreach ($estudios as $item) {
                                    if ($item->estudio_actual == 0 || $item->estudio_actual == null) {
                                        $filtered->push($item);
                                    }
                                }
                                $estudio_finalizado_mayor = $filtered->sortByDesc('nivel_estudio_id')->first();
                            ?>
                            @if ($estudio_finalizado_mayor != null)
                                {{ $estudio_finalizado_mayor->titulo_obtenido }} <br>
                            @endif
                        @endif
                        @if($datos_basicos->ciudad_residencia != '')
                            {{ \App\Models\Ciudad::GetCiudad($datos_basicos->pais_residencia, $datos_basicos->departamento_residencia, $datos_basicos->ciudad_residencia) }}
                            <br>
                        @endif
                        {{ $datos_basicos->dec_tipo_doc . ' ' . $datos_basicos->numero_id }}
                        <br>
                        {{$edad}} Años
                        <br>
                    </div>
                    <div class="ml-1">
                        <h3 class="titulo">Contacto</h3>
                        <hr align="right" class="divisor">
                        @if($datos_basicos->direccion!= '')
                            <span class="btn btn-icon btn-verde-azul">
                                <i class="fa fa-home"></i>
                            </span>
                            {{ $datos_basicos->direccion }}
                            <br>
                        @endif
                        <span class="btn btn-icon btn-verde-azul">
                            <i class="fa fa-phone"></i>
                        </span>
                        {{ $datos_basicos->telefono_movil }}
                        @if($datos_basicos->telefono_fijo != '')
                            - {{$datos_basicos->telefono_fijo}}
                        @endif
                        <br>
                        <span class="btn btn-icon btn-verde-azul">
                            <i class="fa fa-envelope-o"></i>
                        </span>
                        <div class="acortar-texto">
                            {{ $datos_basicos->email }}
                        </div>
                        <span id="salto-email"><br></span>
                    </div>
                    @if ($datos_basicos->descrip_profesional != '')
                        <div class="mt-1">
                            <h3 class="titulo">Perfil</h3>
                            <hr align="right" class="divisor">
                            <p>{{ $datos_basicos->descrip_profesional }}</p>
                        </div>
                        <div class="page-break"></div>
                    @endif
                    <div class="mt-1">
                        <h3 class="titulo">Información Personal</h3>
                        <hr align="right" class="divisor">
                        <p>
                        {{ ucwords(mb_strtolower($datos_basicos->nombres)) }} se identifica con el documento {{ mb_strtolower($datos_basicos->dec_tipo_doc) }} número {{ number_format($datos_basicos->numero_id) }} de la ciudad de {{ \App\Models\Ciudad::GetCiudad($datos_basicos->pais_id, $datos_basicos->departamento_expedicion_id, $datos_basicos->ciudad_expedicion_id) }}, cuyo género es {{mb_strtolower($datos_basicos->genero_desc) }}, su estado civil es {{mb_strtolower($datos_basicos->estado_civil_des) }} y tiene una aspiración salarial {{ strtolower($datos_basicos->aspiracion_salarial_des) }}. Reside actualmente en la ciudad de {{ \App\Models\Ciudad::GetCiudad($datos_basicos->pais_residencia, $datos_basicos->departamento_residencia, $datos_basicos->ciudad_residencia) }}, en la dirección {{ mb_strtolower($datos_basicos->direccion) }}.
                        </p>
                    </div>
                    <div class="mt-1">
                        <h3 class="titulo">Idiomas</h3>
                        <hr align="right" class="divisor">

                        @forelse($idiomas as $idioma)
                            <p>
                                {{ $idioma->nombre_idioma->descripcion }}
                                @if($idioma->nivel_idioma) 
                                    {{ ': ' . $idioma->nivel_idioma->descripcion }}
                                @endif
                           </p>
                        @empty
                            <p>Sin información registrada</p>
                        @endforelse
                    </div>
                </div>
                <div class="col-xs-8 col-md-9 mt-2 mb-2" id="">
                    <!-- ESTUDIOS -->
                    <h3 class="titulo">Estudios</h3>
                    <hr align="right" class="divisor">
                    <br>

                    @forelse($estudios as $estudio)
                        <h5 class="subtitulo">
                            {{  ucwords(mb_strtolower($estudio->desc_nivel)) }}
                        </h5>

                        <p>
                            @if ($estudio->estudio_actual)
                                {{ ucwords(mb_strtolower($estudio->titulo_obtenido)) }} / {{ ucwords(mb_strtolower($estudio->institucion)) }} <br>
                                Cursando actualmente
                            @else
                                {{ ucwords(mb_strtolower($estudio->titulo_obtenido)) }} / {{ ucwords(mb_strtolower($estudio->institucion)) }} <br>
                                {{ $estudio->getFechaFinalizo() }}
                            @endif
                        </p>
                        <br>
                    @empty
                        <p>Sin información registrada</p>
                    @endforelse
                    <br>

                    <!-- EXPERIENCIAS -->
                    <h3 class="titulo mt-2">Experiencias</h3>
                    <hr align="right" class="divisor">
                    <br>

                    @forelse($experiencias as $key => $experiencia)
                        <p class="subtitulo">
                            {{ ucwords(mb_strtolower($experiencia->cargo_especifico)) }} / {{ ucwords(mb_strtolower($experiencia->nombre_empresa)) }}
                        </p>

                        <p>
                            @if ($experiencia->empleo_actual == 1)
                                {{ $experiencia->getFechaInicia() }} - Actualidad
                            @else
                                {{ $experiencia->getFechaInicia() }} - {{ $experiencia->getFechaFinal() }}
                            @endif
                            <br><br>
                            @if($experiencia->funciones_logros)
                                Sus principales funciones fueron {{$experiencia->funciones_logros}}.
                                <br><br>
                            @endif
                            El salario percibido es de {{ mb_strtolower($experiencia->salario) }}, su jefe inmediato {{ ucwords(mb_strtolower($experiencia->nombres_jefe)) }} se desempeña como {{ ucwords(mb_strtolower($experiencia->cargo_jefe)) }} y su número de contácto es {{ $experiencia->movil_jefe }}.
                        </p>
                        <br>
                    @empty
                        <p>Sin información registrada</p>
                    @endforelse
                    <br>

                    <!-- FAMILIARES -->
                    <h3 class="titulo mt-2">Grupo Familiar</h3>
                    <hr align="right" class="divisor">
                    <br>
                    
                    @forelse($familiares as $key => $familiar)
                        <p class="subtitulo">
                            {{ ucwords(mb_strtolower($familiar->parentesco)) }}
                        </p>

                        <p>
                            {{ ucwords(mb_strtolower($familiar->nombres_familiar)) }} <br>
                            Tiene {{ $familiar->getEdad() }} años, el nivel de escolaridad es {{ mb_strtolower($familiar->escolaridad) }}, su profesión es {{ ucwords(mb_strtolower($familiar->profesion_id)) }} y nació en {{ \App\Models\Ciudad::GetCiudad($familiar->codigo_pais_nacimiento, $familiar->codigo_departamento_nacimiento, $familiar->codigo_ciudad_nacimiento) }}.
                        </p>
                        <br>
                    @empty
                        <p>Sin información registrada</p>
                    @endforelse
                </div>
            </div>
        </main>
        
        <!--  PIE -->
        <footer>
            {{--
            <div class="row" style="display: none;">
                <div class="">
                    <div class="col-xs-6">
                        <span class="btn btn-icon btn-sm btn-facebook mx-1">
                            <i class="fa fa-facebook-f"></i>
                        </span>
                        {{ $sitio->social_facebook }}
                    </div>

                    <div class="col-xs-6">
                        <span class="btn btn-icon btn-sm btn-twitter mx-1">
                            <i class="fa fa-twitter"></i>
                        </span>
                        {{ $sitio->social_twitter }}
                    </div>

                    <div class="col-xs-6">
                        <span class="btn btn-icon btn-sm btn-instagram mx-1">
                            <i class="fa fa-instagram"></i>
                        </span>
                        {{ $sitio->social_instagram }}
                    </div>

                    <div class="col-xs-6">
                        <span class="btn btn-icon btn-sm btn-linkedin mx-1">
                            <i class="fa fa-linkedin"></i>
                        </span>
                        {{ $sitio->social_linkedin }}
                    </div>

                    <div class="col-xs-6">
                        <span class="btn btn-icon btn-sm btn-youtube mx-1">
                            <i class="fa fa-youtube-play"></i>
                        </span>
                        {{ $sitio->social_youtube }}
                    </div>

                    <div class="col-xs-6">
                        <span class="btn btn-icon btn-sm btn-web mx-1">
                            <i class="fa fa-dribbble"></i>
                        </span>
                        {{ $sitio->web_corporativa }}
                    </div>
                </div>
            </div>
            --}}
            {{-- @include("home.include._firma_footer_tri", ["estilo_personalizado" => true]) --}}
            {{--
            <div
                    style="
                    position:fixed !important;
                    z-index: -1000;
                    bottom: .5cm;
                    right: .5cm;
                    opacity: .7;
                    font-size: 8pt;
                    text-align: right;"
            >
                <i><a href="https://www.t3rsc.co" style="text-decoration: none; color:black;">Documento generado con la tecnología de t3rsc.co</a></i>
            </div>
            --}}
        </footer>
    </body>
</html>
