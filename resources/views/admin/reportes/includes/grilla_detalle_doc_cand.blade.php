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
                <tr>
                    @foreach( $headersr as $key => $value )
                    <th class="active">
                        {{ $value }}
                    </th>
                    @endforeach
                </tr>

                @foreach( $data as $field )
                <tr>
                    <td>
                        {{$field->nombres}}
                    </td>
                    <td>
                        {{$field->primer_apellido}} {{$field->segundo_apellido}}
                    </td>
                    <td>
                         @if(strlen($field->numero_id)>10)
                            {{(string)"\t"."PEP".$field->numero_id."\t"}}
                        @else
                            {{$field->numero_id}}
                        @endif
                    </td>

                    @foreach ($field->documentos as $documentos)
                    <td style="text-align: center;">
                        @if (count($documentos['documentos']) > 0 && !isset($formato))
                            @foreach ($documentos['documentos'] as $doc)
                            <a style="padding-right: 5px;" href='{{ asset("recursos_documentos/$doc->nombre_archivo") }}' target="_blank"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                            @endforeach
                        @elseif (count($documentos['documentos']) > 0 && isset($formato))
                            SI
                        @else
                            <i class="fa fa-times" aria-hidden="true" style="color:red;">
                        @endif
                    </td>
                    @endforeach

                    <td>
                        @if($field->porcentaje == 0)
                            <span style="color: red"> {{$field->porcentaje}} </span>
                        @elseif($field->porcentaje == 100)
                            <span style="color: green"> {{$field->porcentaje}} </span>
                        @else
                            <span style="color: orange"> {{$field->porcentaje}} </span>
                        @endif
                        %
                    </td>
                    <td>
                        <a target="_blank" href="https://api.whatsapp.com/send?phone={!! env('INDICATIVO','57') !!}{{ $field->telefono_movil}}&text=¡Hola %20{{$field->nombres}}! %20te%20hablamos%20del%20equipo%20de%20selección%20de%20{{$sitio->nombre}},%20te%20invitamos%20a%20ingresar%20a%20la%20plataforma%20a%20cargar%20los%20documentos%20que%20tienes%20pendientes%20para%20continuar%20con%20tu%20proceso." class="btn  btn-block  btn-success aplicar_oferta">@if (isset($formato)) WhatsApp @else <span class="fa fa-whatsapp fa-lg" aria-hidden="true"></span> @endif</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <div>
            @if(method_exists($data, 'appends'))
             {!! $data->appends(Request::all())->render() !!}
             @endif
        </div>
    </div>
</div>
