<div class="container">
    <div class="row">
        @if(method_exists($data, 'total'))
        <h3>Hoja de Vida</h3>
        <h4>
            Total de Registros :
            <span>
                {{$data->total()}}
            </span>
        </h4>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    @foreach($headers as $key => $value)
                        <th class="active">
                            {{ $value }}
                        </th>
                    @endforeach
                </tr>


                @foreach( $data as $field )
                    <tr>
                        <td>
                            @if(strlen($field->cedula)>10)
                                 {{(string)"\t"."P".$field->cedula."\t"}}
                            @else
                                {{$field->cedula}}
                            @endif
                        </td>
                        <td>
                            {{ App\Jobs\FuncionesGlobales::eliminar_tildes($field->primer_nombre) }}
                        </td>
                        <td> 
                            {{ App\Jobs\FuncionesGlobales::eliminar_tildes($field->segundo_nombre) }}
                        </td>
                        <td>
                            {{ App\Jobs\FuncionesGlobales::eliminar_tildes($field->primer_apellido) }}
                        </td>
                        <td>
                            {{ App\Jobs\FuncionesGlobales::eliminar_tildes($field->segundo_apellido) }}
                        </td>
                        <td>
                            {{ App\Jobs\FuncionesGlobales::eliminar_tildes($field->direccion) }}
                        </td>
                        <td>
                            {{$field->telefono_movil}}
                        </td>
                        <td>
                            {{$field->telefono_fijo}}
                        </td>
                        <td>
                            {{$field->codigo_tipo_id}}
                        </td>
                        <td>
                            {{ App\Jobs\FuncionesGlobales::eliminar_tildes($field->correo) }}
                        </td>
                        <td>
                            {{-- DV Vacio --}}
                        </td>
                        <td>
                            {{$field->telefono_movil}}
                        </td>
                        <td>
                            {{$field->codigo_pais_vive}}
                        </td>
                        <td>
                            {{$field->codigo_departamento_vive}}
                        </td>
                        <td>
                            {{$field->codigo_ciudad_vive}}
                        </td>
                        <td>
                            {{$field->codigo_cabeza_familia}}
                        </td>
                        <td>
                            CCP000
                        </td>
                        <td>
                            @if( $field->codigo_grupo_poblacional != null )
                                {{$field->codigo_grupo_poblacional}}
                            @else
                                CCB000
                            @endif
                        </td>
                        <td>
                            {{$field->codigo_estrato}}
                        </td>
                        <td>
                            {{$field->codigo_sexo}}
                        </td>
                        <td>
                            {{$field->codigo_estado_civil}}
                        </td>
                        <td>
                            {{$field->codigo_grupo_sanguineo}}
                        </td>
                        <td>
                            {{$field->codigo_peso}}
                        </td>
                        <td>
                            {{$field->codigo_estatura}}
                        </td>
                        <td>
                            {{ $field->codigo_profesion_sorttime }}
                        </td>
                        <td>
                            {{$field->codigo_zapatos}}
                        </td>
                        <td>
                            {{$field->codigo_pantalon}}
                        </td>
                        <td>
                            {{$field->codigo_camisa}}
                        </td>
                        <td>
                            @if ($field->tiene_estudio == 0)
                                {{$field->codigo_nivel_educativo_sin_definir}}
                            @else
                                {{$field->codigo_nivel_educativo}}
                            @endif
                        </td>
                        <td>
                            {{$field->codigo_pais_nacimiento}}
                        </td>
                        <td>
                            {{$field->codigo_departamento_nacimiento}}
                        </td>
                        <td>
                            {{$field->codigo_ciudad_nacimiento}}
                        </td>
                        <td>
                            {{$field->fecha_expedicion}}
                        </td>
                        <td>
                            {{$field->fecha_nacimiento}}
                        </td>
                        <td>
                            {{dar_formato_fecha($field->fecha_registro,'corta_a_m_d')}}
                        </td>
                        <td>
                            {{ App\Jobs\FuncionesGlobales::eliminar_tildes($field->libreta) }}
                        </td>
                        <td>
                            {{ App\Jobs\FuncionesGlobales::eliminar_tildes($field->numero_licencia) }}
                        </td>
                        <td>
                            {{-- Avecindad (vacio) --}}
                        </td>
                        <td>
                            {{ App\Jobs\FuncionesGlobales::eliminar_tildes($field->barrio) }}
                        </td>
                        <td>
                            {{-- FFechaCertificadoJudicial (vacio) --}}
                        </td>
                        <td>
                            {{-- Judicial (vacio) --}}
                        </td>
                        <td>
                            {{ App\Jobs\FuncionesGlobales::eliminar_tildes($field->distrito_militar) }}
                        </td>
                        <td>
                            {{ App\Jobs\FuncionesGlobales::eliminar_tildes($field->ciudad_expedicion) }}
                        </td>
                        <td>
                            {{ App\Jobs\FuncionesGlobales::eliminar_tildes($field->clase_libreta) }}
                        </td>
                        <td>
                            {{$field->codigo_tipo_vivienda}}
                        </td>
                        <td>
                            {{$field->codigo_tipo_ingreso}}
                        </td>
                    </tr>
                @endforeach
                {{--
                    Identificación  1Nombre 2Nombre 1Apellido   2Apellido   Direccion   Telefono1   Telefono2   TipoId  Correo  DV  Celular Pais Vive   Dpto Vive   Ciudad Vive MujerCF Etnico  Social  Estrato Sexo    Estado  GrupoS  Peso    Estatura    Vestidos    Zapatos Pantalon    Camisa  NivelEducativo  Pais Nació  Dpto Nació  Ciudad Nació    FExpedicion FNacido FRegistro   LMilitar    LConducir   Avecindad   Barrio  FFechaCertificadoJudicial   Judicial    Distrito    CiudadExpide (Escrita)  Categoria   ClasificacionCasa   TipoIngreso
                --}}
            </table>
        </div>
        <div>
            @if(method_exists($data, 'appends'))
                {!! $data->appends(Request::all())->render() !!}
            @endif
        </div>
    </div>
</div>
