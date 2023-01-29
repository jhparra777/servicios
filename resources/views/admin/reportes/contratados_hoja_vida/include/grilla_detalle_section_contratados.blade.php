<div class="container">
    <div class="row">
        @if(method_exists($data, 'total'))
        <h3>Contratos</h3>
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
                <tr data-id="{{$field->req_id}}">
                    <td>
                        {{$field->nit_cliente}}
                    </td>
                    <td>
                        {{$field->codigo_nomina_cliente}}
                    </td>
                    <td>
                        @if(strlen($field->cedula)>10)
                            {{(string)"\t"."P".$field->cedula."\t"}}
                        @else
                            {{$field->cedula}}
                        @endif
                    </td>
                    <td>
                        {{$field->salario}}
                    </td>
                    <td>
                        {{$field->fecha_ingreso}}
                    </td>
                    <td>
                        <?php
                            $data = new \Carbon\Carbon($field->fecha_ingreso);
                            $data->addYear();
                            $data->subDay();
                        ?>
                        {{$data->format('Y-m-d')}}
                    </td>
                    <td>
                        {{$field->entidad_eps}}
                    </td>
                    <td>
                        {{$field->entidad_afp}}
                    </td>
                    <td>
                        ARP001
                    </td>
                    <td>
                        {{$field->caja_compensacion}}
                    </td>
                    <td>
                        {{$field->fondo_cesantia}}
                    </td>
                    <td>
                        {{$field->codigo_agencia}}
                    </td>
                    <td>
                        {{$field->codigo_centro_trabajo}}
                    </td>
                    <td>
                        {{$field->codigo_centro_costo}}
                    </td>
                    <td>
                        {{$field->codigo_nivel_5}}
                    </td>
                    <td>
                        {{$field->codigo_nivel_6}}
                    </td>
                    <td>
                        {{$field->codigo_nivel_7}}
                    </td>
                    <td>
                        {{$field->codigo_nivel_8}}
                    </td>
                    <td>
                        {{$field->codigo_cargo}}
                    </td>
                    <td>
                        {{$field->codigo_contrato}}
                    </td>
                    <td>
                        {{$field->codigo_jornada}}
                    </td>
                    <td>
                        {{$field->codigo_tipo_empleado}}
                    </td>
                    <td>
                        {{$field->codigo_banco}}
                    </td>
                    <td>
                        {{"P".$field->numero_cuenta}}
                    </td>
                    <td>
                        {{$field->codigo_forma_pago}}
                    </td>
                    <td>
                        {{$field->codigo_salario}}
                    </td>
                    <td>
                        F
                    </td>
                    <td>
                        {{$field->codigo_motivo_req}}
                    </td>
                    <td>
                        {{$field->codigo_objeto_contrato}}
                    </td>
                    <td>
                        {{-- Descripcion (vacio) --}}
                    </td>
                    <td>
                        {{-- Restriccion (vacio) --}}
                    </td>
                    <td>
                        {{$field->codigo_subtipo_cotizante}}
                    </td>
                    <td>
                        {{-- Manejo (vacio) --}}
                    </td>
                    <td>
                        @if($field->auxilio_transporte == 'No se Paga')
                            1
                        @else
                            {{-- Zona (vacio) --}}
                        @endif
                    </td>
                    <td>
                        TCU001
                    </td>
                    <td>
                        {{$field->codigo_pais_requerimiento}}
                    </td>
                    <td>
                        {{$field->codigo_departamento_requerimiento}}
                    </td>
                    <td>
                        {{$field->codigo_ciudad_requerimiento}}
                    </td>
                    <td>
                        N
                    </td>
                    <td>
                        {{-- Certificado (vacio) --}}
                    </td>
                    <td>
                        {{$field->fecha_ingreso}}
                    </td>
                    <td>
                        {{$field->salario}}
                    </td>
                </tr>
                @endforeach

                {{--
                    Num Contrato    Nit Cliente Nomina  Identificación  Sueldo  FIngreso    FRetiro EPS AFP ARP CAJA    sCESANTIAS  CentroTrabajo   TarifaARP   CentroCosto Departamento    Division    Cargo   TipoContrato    Tiempo  TipoEmpleado    Banco   CuentaBanco FormaPago   FormaSalario    TipoSalario Funciones   Objeto  Descripcion Usuario Restriccion SubtipoCotizante    Manejo  Zona    TipoCuentaBanco PaisTributo DptoTributo CiudadTributo   TrabajoAltura   Certificado FechaCertificado    SueldoAfiliacion    FechaCreacion
                --}}
            </table>
        </div>
        {{--
            <div>
                @if(method_exists($data, 'appends'))
                    {!! $data->appends(Request::all())->render() !!}
                @endif
            </div>
        --}}
    </div>
</div>
