<div class="container">
    <div class="row">
        @if(method_exists($data, 'total'))
        <h4>
            Total de Registros :
            <span>
                {{$data->total()}}
            </span>
        </h4>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered">
              
              <thead>
                <tr>
                    @foreach( $headersr as $key => $value )
                    <th class="active">
                        {{$value}}
                    </th>
                    @endforeach
                </tr> 
              </thead>
              <tbody>
                <?php 
                  $rango = explode(" | ", request()->get('rango_fecha')); 
                  $fecha_inicio = $rango[0];
                  $fecha_final  = $rango[1];  
                ?>
              @foreach( $data as $field )
                <tr>
                    <td>
                      @if( $fecha_inicio != null )
                      {{ date('Y', strtotime($fecha_final))}}
                      @endif
                    </td>
                    <td>
                      {{$fecha_inicio}}
                    </td>
                    <td>
                      {{$fecha_final}}
                    </td>
                    <td>
                        @if( $field->cantidad_contratos == 1 &&  $field->fecha_fin_contrato >= date('Y-m-d') )
                          ING
                        @elseif(  $field->cantidad_contratos == 1 &&  $field->fecha_fin_contrato < date('Y-m-d') )
                          RET
                        @endif
                    </td>
                    <td>
                      {{$field->codigo_cno}}
                    </td>
                    <td>
                      {{$field->rango_salario}}
                    </td>
                    <td>
                      @if( $field->sexo == 'MASCULINO' )
                        M
                      @elseif( $field->sexo == 'FEMENINO' )
                        F
                      @elseif( $field->sexo == 'INDIFERENTE' )
                        I
                      @endif
                    </td>
                    <td>
                      {{$field->rango_edad}}
                    </td>
                    <td>
                      {{$field->rango_academico}}
                    </td>
                    <td>
                      {{$field->dias_trabajados}}
                    </td>
                    <td>
                      {{$field->codigo_ciiu}}
                    </td>
                    <td>
                      {{$field->tamanio_empresa}}
                    </td>
                    <td>
                      {{$field->numero_id}}
                    </td>
                    <td>
                      {{$field->contrato_id}}
                    </td>
                    <td>
                      {{$field->fecha_ingreso_req}}
                    </td>
                    <td>
                      {{$field->fecha_fin_contrato}}
                    </td>
                    <td>
                      {{$field->agencia_req}}
                    </td>
                </tr>
              @endforeach
              </tbody>
            </table>
        </div>
        {{--MOver a indicadores--}}      
        <div>
         @if(method_exists($data, 'appends'))
          {!! $data->appends(Request::all())->render() !!}
         @endif
        </div>
    </div>
</div>

