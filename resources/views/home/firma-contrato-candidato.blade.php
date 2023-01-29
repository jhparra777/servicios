<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="{{csrf_token()}}" name="token">

    {{-- drawingboard CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('js/drawingboard/drawingboard.min.css') }}">

    <script src="https://code.jquery.com/jquery-3.4.1.js" type="text/javascript"></script>

    {{-- drawingboard JS --}}
    <script src="{{ asset('js/drawingboard/drawingboard.min.js') }}" type="text/javascript"></script>

    <style>
        html{
            font-family: 'Arial';
        }

        .text-center{ text-align: center;  }
        .text-left{ text-align: left;  }
        .text-right{ text-align: right;  }
        .text-light{ font-weight: lighter; }

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
                @if (isset($empresa_contrata))
                    @if ($empresa_contrata != null || $empresa_contrata != '')
                        <img src="{{ asset('configuracion_sitio/'.$empresa_contrata->logo) }}" width="100" >
                    @endif
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
                <p>CONTRATO DE TRABAJO</p>
                <p>POR EL TIEMPO QUE DURE LA REALIZACIÓN DE LA OBRA O LABOR CONTRATADA</p>
            </th>
        </tr>
    </table>

    <table class="center table-contract justify" width="95%">
        <tr class="pd-1">
            <th class="text-left">
                Nombre del Empleador:
            </th>
            
            <td>
                @if (isset($empresa_contrata))
                    @if ($empresa_contrata != null || $empresa_contrata != '')
                        {{ $empresa_contrata->nombre_empresa }}
                    @endif
                @endif
            </td>

            <th class="text-left">
                NIT del Empleador:
            </th>
            
            <td>
                @if (isset($empresa_contrata))
                    @if ($empresa_contrata != null || $empresa_contrata != '')
                        {{ $empresa_contrata->nit }}
                    @endif
                @endif
            </td>
        </tr>

        <tr>
            <th class="text-left">
                Domicilio del Empleador:
            </th>
            
            <td>
                {{ $reqcandidato->agencia_direccion }}
            </td>

            <th class="text-left">
                Ciudad:
            </th>
            
            <td>
                {{ $reqcandidato->agencia }}
            </td>
        </tr>

        <tr>
            <th class="text-left">
                Teléfono:
            </th>
            
            <td>
                @if (isset($empresa_contrata))
                    @if ($empresa_contrata != null || $empresa_contrata != '')
                        {{ $empresa_contrata->telefono }}
                    @endif
                @endif
            </td>
        </tr>

        <tr>
            <th class="text-left">
                Nombre del trabajador:
            </th>
            
            <td>
                {{ $candidato->nombres }} {{ $candidato->primer_apellido }} {{ $candidato->segundo_apellido }}
            </td>

            <th class="text-left">
              {{ ucwords(mb_strtolower($candidato->dec_tipo_doc))}}
            </th>
            
            <td>
                {{ $candidato->numero_id }}
            </td>
        </tr>

        <tr>
            <th class="text-left">
                Dirección del Trabajador:
            </th>
            
            <td>
                {{ $candidato->direccion }}
            </td>

            <th class="text-left">
                Ciudad:
            </th>
            
            <td>
                @if($lugarresidencia != null)
                    {{ $lugarresidencia->value }}
                @endif
            </td>
        </tr>

        <tr>
            <th class="text-left">
                Teléfono:
            </th>
            
            <td>
                {{ $candidato->telefono_movil }}
            </td>

            <th class="text-left">
                Lugar y fecha de nacimiento:
            </th>
            
            <td>
                {{ $candidato->fecha_nacimiento }}

                @if($lugarnacimiento != null)
                  {{$lugarnacimiento->value }}
                @endif
            </td>
        </tr>

        <tr>
            <th class="text-left">
                Afiliaciones:
            </th>
            
            <td>
                <b>ARL:</b> COLPATRIA  <b>AFP:</b> {{ ($fechasContrato->entidad_afp != '' ? $fechasContrato->entidad_afp : $candidato->entidades_afp_des) }} <b>EPS:</b> {{ ($fechasContrato->entidad_eps != '' ? $fechasContrato->entidad_eps : $candidato->entidades_eps_des) }}
            </td>
        </tr>

        <tr>
            <th class="text-left">
                Empresa usuaria:
            </th>

            <td>
                {{ (!empty($reqcandidato->cliente_nombre)) ? $reqcandidato->cliente_nombre : '' }}
            </td>

            <th class="text-left">
                Cargo:
            </th>

            <td>
                {{ $reqcandidato->nombre_cargo_especifico }}
            </td>
        </tr>

        <tr>
            <th class="text-left">
                Actividad particular a desarrollar: 
            </th>

            <td colspan="4">
                {{ $reqcandidato->motivo_requerimiento }}
            </td>
        </tr>

        <tr>
            <th class="text-left">
                Fecha de inicio:
            </th>

            <td>
                {{ $fechasContrato->fecha_ingreso }}
            </td>

            <th class="text-left">
                Salario básico:
            </th>

            <td>
                $ {{ number_format($reqcandidato->salario) }}
            </td>
        </tr>

        <tr>
            <th class="text-left">
                Periodos de pagos:
            </th>

            <td>
                {{ $reqcandidato->nomina_contrato }}
            </td>
        </tr>
    </table>

    <table class="center table-contract justify mt-2" width="95%">
        <tr>
            <td>
                <P>Adicionales:</P>
                <P>
                    Entre El Empleador y El Trabajador, de las condiciones ya dichas, identificados como aparece al pie de sus firmas, se ha celebrado
                    el presente contrato individual de trabajo, regido además por las siguientes cláusulas: PRIMERA.-OBLIGACIONES: El Empleador
                    contrata los servicios personales del Trabajador y éste se obliga:
                </P>
            </td>
        </tr>

        <tr>
            <td>
                <ul class="list space">
                    <li>
                        a) A poner al servicio del Empleador toda su capacidad normal de trabajo, en forma exclusiva en el desempeño de las funciones propias del oficio mencionado y en las labores anexas y complementarias del mismo, de conformidad con las órdenes e instrucciones que le imparta la empresa usuaria, el Empleador o sus representantes.
                    </li>
                    <li>
                        b) Cumplir con sus obligaciones de manera cuidadosa y diligente en el lugar tiempo y necesidades del servicio.
                    </li>
                    <li>
                        c) Observar rigurosamente la disciplina interna establecida por el empleador, la usuaria y las persona autorizadas por estos.
                    </li>
                    <li>
                        d) A no prestar directa ni indirectamente servicios laborales a otros Empleadores, ni a trabajar por cuenta propia en el mismo oficio, durante la vigencia de este contrato, so pena de recibir sanciones disciplinarias y legales que la norma laboral faculta al empleador.
                    </li>
                    <li>
                        e)Informar al empleador oportunamente y por escrito, el cambio de su domicilio que será el lugar donde recibirá las notificaciones deque habla la Ley 789 de 2.002. Por tal razón cualquier información o notificación será remitida a la dirección señalada en el encabezado de este contrato y se entenderá recibido por el trabajador mientras que tal dirección no haya sido modificada e informada al empleador.
                    </li>
                    <li>
                        f) Laborar la jornada ordinaria, en los turnos y dentro de las horas señaladas por el empleador, la empresa usuaria o
                        sus representantes, pudiendo hacer éstos los ajustes o cambios de horarios cuando lo estimen conveniente. Por acuerdo expreso o tácito de las partes, podrán repartirse las horas de la jornada ordinaria, en la forma prevista en el articulo 164 del C.S.T., teniendo en cuenta que los tiempos de descanso entre las secciones de la jornada, no se computan dentro de la misma, según el articulo 167 ibidem. Cualquier hora extra o trabajo adicional deberá ser autorizado por el empleador, la empresa usuaria o sus representantes.
                    </li>
                    <li>
                        g) Cuidar permanentemente los intereses del empleador y la empresa usuaria.
                    </li>
                    <li>
                        h) Programar diariamente su trabajo y asistir puntualmente a las reuniones que efectúe el empleador o la empresa usuaria a las cuales hubiere sido citado.
                    </li>
                    <li>
                        i) Observar completa armonía y comprensión con sus superiores y compañeros de trabajo, en sus relaciones personales y en la ejecución de su labor.
                    </li>
                    <li>
                        j) Actuar permanentemente con espíritu de lealtad, colaboración y disciplina con el empleador y la empresa usuaria.
                    </li>
                    <li>
                        k) A presentar dentro de las 48 horas siguiente ante el empleador, la justificación de su ausencia al puesto de trabajo causado por la incapacidad médica, certificada por el medico adscrito a la EPS o ARL donde se encuentre afiliado.
                    </li>
                    <li>
                        l) Velar por el cuidado de las instalaciones de la Empresa Usuaria, así como también los equipos, muebles, enseres y demás elementos entregados para el cumplimiento de sus funciones, con el fin de evitar daños y extravíos.
                    </li>
                    <li>
                        m) Cumplir con los planes de trabajo que se indique por parte del empleador o de la Empresa Usuaria, bien sea por escrito o por recomendaciones verbales.
                    </li>
                    <li>
                        n) Utilizar los elementos de protección personal que le sean entregados para el desarrollo de sus funciones y en cumplimiento de las normas de Seguridad y Salud en el Trabajo.
                    </li>
                    <li>
                        ñ) Cumplir con el Reglamento Interno de Trabajo del empleador y de la empresa usuaria.
                    </li>
                    <li>
                        o) Reportar de manera inmediata al empleador o a la empresa usuaria la ocurrencia de accidente laboral.
                    </li>
                    <li>
                        p) Las demás funciones que se le indiquen oportunamente. Parágrafo: <br>
                        
                        Se considera hecho grave para el Trabajador el haber tenido conocimiento o participación, por acción, omisión, negligencia o
                        complicidad, en comportamiento o hechos delictivos o en contra de la moral, que perjudiquen los intereses del empleador o del
                        usuario, sus funcionarios, clientes o allegados, o el hecho de tener conocimiento de ellos y no informar oportunamente al empleador, a sus representantes o al usuario, o dar informaciones falsas o extemporáneas sobre los mismos.<br>

                        El trabajador manifiesta expresamente como condición esencial para la firma de este contrato, que no ha tenido vínculos directos ni indirectos con actividades tales como el terrorismo, la subversión, el tráfico de estupefacientes o la delincuencia común y es justa causa suficiente para dar por terminado éste contrato en forma unilateral por parte del empleador, el hecho de que el trabajador no haya suministrado información verídica al respecto, como también información exacta en la hoja de datos personales o en la solicitud de empleo, diligenciadas previamente a la firma del contrato, documentos que hacen parte integral del mismo. <br>
                        
                        - SEGUNDA. -DURACIÓN El presente contrato tendrá como duración el tiempo que dure la realización de la obra o labor particular contratada arriba señalada, la cual durará por el tiempo estrictamente necesario reportado al Empleador por la Empresa Usuaria. En consecuencia, este contrato termina en el momento en que la Empresa Usuaria comunique por cualquier medio al Empleador que la obra o labor particular que venía desempeñando el trabajador en misión ha finalizado, sin que el Empleador tenga que reconocerle indemnización alguna.<br>

                        TERCERA.-PERÍODO DE PRUEBA Los primeros sesenta (60) días de vigencia del presente contrato se consideran como período
                        de prueba y por consiguiente, cualquiera de las partes podrá terminar el contrato unilateralmente, en cualquier momento durante
                        dicho período. Vencido éste, la duración del contrato será por el tiempo que dure la realización de la obra o labor contratada arriba
                        Pagina 1/4
                        señalada, es decir mientras subsistan las causas que le dieron origen y la materia del trabajo <br>

                        - CUARTA. - INCORPORACIÓN DE
                        DISPOSICIONES.- Las partes declaran que en el presente contrato se entienden incorporadas, en lo pertinente, las disposiciones
                        legales que regulan las relaciones entre la empresa y sus trabajadores, en especial, las del contrato de trabajo para el oficio que se
                        suscribe y las obligaciones consignadas en los reglamentos de trabajo y de higiene y seguridad industrial del empleador y de la
                        Empresa Usuaria, disposiciones que manifiesta conocer y se compromete a acatar.<br>

                        QUINTA. - REMUNERACIÓN El Empleador
                        pagará al Trabajador por la prestación de sus servicios bajo la modalidad arriba citada, la cual será pagadera en las oportunidades
                        que se indican en el encabezamiento de este contrato. Dentro de este pago se encuentra incluida la remuneración de los descansos
                        dominicales y festivos de que tratan los capítulos I y II del título VII del Código Sustantivo del Trabajo. Se aclara y se conviene que
                        en los casos en los que El Trabajador llegare a devengar comisiones o cualquiera otra modalidad de salario variable, el 82.5% de
                        dichos ingresos, constituye remuneración ordinaria, y el 17.5% restante está destinado a remunerar el descanso en los días
                        dominicales y festivos de que tratan los capítulos I y II del título VII del Código Sustantivo del Trabajo.<br>
                        
                        -SEXTA.- NO
                        CONSTITUYE SALARIO.- En atención a lo ordenado por el artículo 128 del Código Sustantivo del Trabajo, modificado por el
                        artículo 15 de la Ley 50 de 1990, las partes en el presente contrato convienen de manera expresa que no constituyen salario las
                        sumas en dinero o en especie que ocasionalmente y por mera liberalidad recibe o llegue a recibir en el futuro adicional a su salario ordinario, el trabajador del empleador o de la empresa usuaria, como propinas, primas, bonificaciones o gratificaciones ocasionales, participación de utilidades, y lo que recibe en dinero o en especie no para su beneficio como ayudas o auxilios habituales u ocasionales, tales como alimentación, o vestuario, bonificaciones ocasionales o cualquier otra que reciba, durante la vigencia del contrato de trabajo, ni aquellos que se hacen, no para enriquecer su patrimonio, sino para desempeñar a cabalidad sus funciones, como gastos de representación, medios de transporte, elementos de trabajo y otros semejantes. Tampoco constituyen salario las prestaciones sociales de que tratan los títulos VIII y IX del Código Sustantivo del Trabajo, ni los beneficios o auxilios habituales u ocasionales acordados convencional o contractualmente u otorgados en forma extralegal por el empleador o de la empresa usuaria, tales como la alimentación, habitación o vestuario, las primas extralegales, de vacaciones, de servicios o de navidad. Igualmente, y conforme lo ordena el articulo 17 de la Ley 344 de 1.996 los pagos aquí señalados, que no constituyen salario no hacen parte de la
                        base para liquidar los aportes con destino al Servicio Nacional de Aprendizaje, SENA, Instituto Colombiano de Bienestar Familiar,
                        ICBF, Escuela Superior de Administración Pública, ESAP, régimen del subsidio familiar y contribuciones a la seguridad social
                        establecidas por la Ley 100 de 1993. Parágrafo: Soportado en el artículo 30 de la Ley 1393 de 2010 y para los efectos relacionados
                        con los artículos 18 y 204 de la ley 100 de 1993, Sentencia C- 521 de 1995, de la Corte Constitucional en y los artículos 15 y 16 de
                        la Ley 50 de 1990, El Empleador y el trabajador podrán convenir el pago de una suma de dinero que no supere el (40%) del total de
                        la remuneración, el cual no constituirá salario pues no se encamina a enriquecer el patrimonio del trabajador.<br>
                        
                        SÉPTIMA. TRABAJO
                        SUPLEMENTARIO: -Todo trabajo suplementario o en horas extras y todo trabajo en día domingo o festivo en los que legalmente
                        debe concederse descanso, se remunerará conforme a la ley, así como los correspondientes recargos nocturnos. Para el
                        reconocimiento y pago del trabajo suplementario, dominical o festivo El Empleador o sus representantes deben autorizarlo
                        previamente por escrito. Cuando la necesidad de este trabajo se presente de manera imprevista o inaplazable, deberá ejecutarse y
                        darse cuenta de él por escrito, a la mayor brevedad, al Empleador o a sus representantes. El Empleador, en consecuencia, no
                        reconocerá ningún trabajo suplementario o en días de descanso legalmente obligatorio que no haya sido autorizado previamente o
                        
                        avisado inmediatamente, como queda dicho.<br>
                        OCTAVA. - JORNADA: El Trabajador se obliga a laborar la jornada ordinaria en los
                        turnos y dentro de las horas señaladas por El Empleador o por la empresa usuaria, pudiendo hacer estos ajustes o cambios de horario
                        cuando lo estime conveniente. Conforme a lo indicado en el artículo 60 del C.S.T modificado por el art. 1 de la Ley 1846 de 2017, el
                        trabajo ordinario será el que se realiza entre las 6 Horas (6 A.M.) y las 21 horas (9 P.M.) y el trabajo nocturno es el comprendido
                        entre las 21 Horas (9 P.M.) y las 6 Horas (6 A.M.).<br>
                        
                        PARÁGRAFO PRIMERO: Conforme lo indicado por la ley laboral, el
                        empleador y el trabajador podrán acordar temporal o indefinidamente la organización de turnos de trabajo sucesivos que permitan
                        operar a la empresa o secciones de la misma sin solución de continuidad durante todos los días de la semana, siempre y cuando el
                        respectivo turno no exceda de 6 horas al día y 36 a la semana.<br>
                        
                        PARÁGRAFO SEGUNDO: El empleador y el trabajador, podrán
                        acordar que la jornada semanal de cuarenta y ocho (48) horas se realice mediante jornadas diarias flexibles de trabajo, distribuidas en
                        máximo 6 días a la semana con un día de descanso obligatorio, que podrá coincidir con el domingo. En este, el numero de horas de
                        trabajo diario podrá repartirse de manera variable durante la respectiva semana y podrá ser de mínimo cuatro (4) horas continuas y
                        hasta diez (10) horas diarias sin lugar a ningún recargo por trabajo suplementario, cuando el numero de horas de trabajo no exceda el promedio de cuarenta y ocho (48) horas semanales dentro de la jornada ordinaria de 6 A.M. a 9 P.M.<br>
                        
                        NOVENA- JUSTA CAUSA.-
                        Son justas causas para dar por terminado unilateralmente este contrato por cualquiera de las partes, las enumeradas en el artículo 7º
                        del Decreto 2351 de 1965; y, además, por parte del Empleador, el incumplimiento de las obligaciones señaladas en la cláusula
                        primera de este contrato, al igual que las faltas que para el efecto se califiquen como graves en el Reglamento Interno de Trabajo y
                        el espacio reservado para cláusulas adicionales en el presente contrato.<br>
                        
                        DÉCIMA. TRASLADO DE LUGAR. - -.El empleador podrá determinar que el trabajo se preste en lugar distinto del inicialmente contratado, siempre que tal traslado no desmejore las
                        condiciones laborales o de remuneración del Trabajador, o impliquen perjuicios para él. Los gastos que se originen con el traslado
                        serán cubiertos por El Empleador de conformidad con el numeral 8º del artículo 57 del Código Sustantivo del Trabajo. El Trabajador
                        se obliga a aceptar los cambios de oficio que decida El Empleador dentro de su poder subordinante, siempre que se respeten las
                        condiciones laborales del Trabajador y no se le causen perjuicios. Todo ello sin que se afecte el honor, la dignidad y los derechos
                        mínimos del Trabajador, de conformidad con el artículo 23 del Código Sustantivo del Trabajo, modificado por el artículo 1º de la
                        Ley 50 de 1990.<br>
                        
                        DÉCIMA PRIMERO. BUENA FE CONTRACTUAL-Este contrato ha sido redactado estrictamente de acuerdo con
                        la ley y la jurisprudencia y será interpretado de buena fe y en consonancia con el Código Sustantivo del Trabajo, cuyo objeto,
                        definido en su artículo 1º, es lograr la justicia en las relaciones entre Empleadores y Trabajadores dentro de un espíritu de
                        coordinación económica y equilibrio social.<br>
                        
                        DUODÉCIMA. CONFIDENCIALIDAD.-. En desarrollo de la labor contratada el
                        TRABAJADOR tendrá acceso de manera directa e indirecta a información de propiedad exclusiva de El Empleador y/o de sus
                        clientes o usuarios, información que goza de protección especial, atendiendo el grado de confidencialidad de la misma, es por ello
                        que se consagran como obligaciones especiales del trabajador las siguientes:<br><br>
                        
                        1. Toda información otorgada es de propiedad
                        exclusiva de El Empleador. En consecuencia, El Trabajador no utilizará esta información para su propio uso o el de terceros sin
                        autorización.<br>
                        2. El Trabajador se obliga a no copiar, editar, transformar, extraer, revelar, divulgar, exhibir, mostrar, comunicar,
                        utilizar y/o emplear para sí, o para otra persona natural o jurídica, la información que le ha sido entregada con ocasión de las labores
                        contratadas o aquella a la que haya tenido acceso por cualquier causa, que sea de propiedad de El Empleador y/o cualquiera de sus
                        Pagina 2/4
                        clientes.<br>
                        3. El Trabajador se obliga en consecuencia a mantenerla reservada y privada y a proteger dicha información para evitar su
                        divulgación no autorizada, ejerciendo sobre ésta, el máximo grado de diligencia y cuidado, faltando a esta obligación por acción o
                        por omisión.<br>
                        4. El Trabajador se obliga a responder por todos los documentos, claves de acceso, mercancías, herramientas, software
                        y hardware que le ha sido entregado para el ejercicio de su labor, y en general con la información confidencial que maneje en el
                        desempeño del cargo.<br>
                        5. El Trabajador se hace responsable por los perjuicios que pudieren causarse a la empresa o a sus clientes, en
                        virtud del no cumplimiento de estas obligaciones. <br>
                        6. Todo ello en virtud y armonía de las obligaciones del trabajador previstas en el
                        Código Sustantivo y en el Reglamento Interno de Trabajo.<br>
                        7. Cualquier violación a lo pactado dentro de la presente clausula, de
                        confidencialidad, ya por acción o por omisión, será considerada como falta grave, según lo estipulado en el Numeral 6 del artículo
                        62 CST, y será justa causa de terminación del contrato laboral.<br>
                        8. El trabajador manifiesta conocer las políticas internas que se
                        establecen dentro de la empresa alusivas a lo consagrado en la ley 1266 de 2008, ley estatutaria 1581 de 2012 y decreto
                        reglamentario 1377 de 2007 que contienen la normas sobre protección y manejo de datos personales.<br>
                        9. Las obligaciones de
                        confidencialidad previstas en la presente cláusula estarán vigentes en el entretanto lo esté, el contrato laboral y se extenderá, por
                        cinco (5) años más, que se cuentan a partir de la fecha de su terminación.<br>
                        - DÉCIMA TERCERA-. PROTECCIÓN DE DATOS:<br>
                        El Trabajador Titular de la Información manifiesta que conoce, acepta y autoriza de manera libre y espontánea el tratamiento de la
                        información que haga El Empleador relativa a, organizaciones sociales, a la salud, a la vida sexual y datos biométricos, que sea
                        necesaria para el cumplimiento de la finalidades anteriormente descritas basado en lo establecido en la presente autorización. El
                        Trabajador autoriza al empleador para que acopie sus datos personales, cuya finalidad será la elaboración de nóminas y la seguridad
                        Social, así como los usos típicos de un departamento de Personal. La negativa a suministrar determinados datos, que impidan a la
                        empresa realizar las funciones obligatorias (la seguridad Social, Nóminas etc.) implicarán una sanción, y una posible terminación del
                        contrato con justa causa. El trabajador tiene derecho de acceso, rectificación anulación y oposición que deberá ejercer mediante
                        escrito al Empleador.<br>
                        DÉCIMA CUARTA DEDUCCIONES Y COMPENSACIONES. Cuando por causa emanada directa o
                        indirectamente de la relación contractual existan obligaciones de tipo económico a cargo del(la) trabajador(a) y a favor del
                        Empleador, éste procederá a efectuar las deducciones y/o compensaciones a que hubiere lugar, de los salarios , prestaciones sociales
                        y cualquier otro devengo causado en favor del trabajador, en cualquier tiempo y más concretamente, a la terminación del presente
                        contrato, así lo autoriza desde ahora el(la) trabajador(a), entendiendo expresamente las partes que la presente cláusula cumple las
                        condiciones de orden escrita previa, aplicable para cada caso ( Sentencia 39980 del 13 de Febrero de 2013 CSJ sala Laboral).<br>
                        DÉCIMA QUINTA: DERECHOS DE AUTOR Y USO DE DERECHOS DE IMAGEN: Las invenciones o descubrimientos
                        realizados por el trabajador contratado para investigar pertenecen al empleador, de conformidad con el artículo 539 del Código de
                        Comercio, así como el artículo 20 y concordantes de la Ley 23 de 1982 sobre derechos de autor. En cualquier otro caso el invento
                        pertenece al trabajador, salvo cuando éste no haya sido contratado para investigar y realice la invención mediante datos o medios
                        conocidos o utilizados en razón de la labor desempeñada, evento en el cual el trabajador, tendrá derecho a una compensación que se
                        fijará de acuerdo con el monto del salario, la importancia del invento o descubrimiento, el beneficio que reporte al empleador u otros factores similares.<br>
                        Parágrafo primero: Mediante el presente contrato El Trabajador Autoriza al empleador para que haga el uso y
                        tratamiento de sus derechos de imagen y lo autoriza expresamente para incluirlos sobre fotografías, procedimientos análogos a la
                        fotografía; producciones audiovisuales (Videos), así como de los derechos de autor; los derechos conexos y en general todos
                        aquellos derechos de propiedad intelectual que tengan que ver con el derecho de imagen. Parágrafo segundo- Alcance de la
                        autorización. La presente autorización de uso se otorga para ser utilizada en formato o soporte material en ediciones impresas, y se extiende a la utilización en medio electrónico, óptico, magnético, en redes (Intranet e Internet), mensajes de datos o similares y en general para cualquier medio o soporte conocido o por conocer en el futuro. La publicación podrá efectuarse de manera directa o a través de un tercero que se designe para tal fin.
                        Parágrafo Tercero - Territorio y exclusividad. - Los derechos aquí autorizados se dan
                        sin limitación geográfica o territorial alguna.<br>
                        DÉCIMA SEXTA: NOTIFICACIONES el trabajador autoriza al empleador para el
                        envío de notificaciones al correo electrónico registrado en su hoja de vida, incluidas las relacionadas con el trámite de procesos
                        disciplinarios, convocatoria a reuniones y todas las comunicaciones referidas a la ejecucion y terminacion del contrato de
                        trabajo.<br>
                        DECIMA SÉPTIMA: FORMALIDAD: El presente contrato reemplaza en su integridad y deja sin efecto alguno cualquiera
                        otro contrato verbal o escrito celebrado entre las partes con anterioridad. Las modificaciones que se acuerden al presente contrato se
                        anotarán a continuación de su texto.<br>
                        DÉCIMA OCTAVA: LECTURA Y COMPRENSIÓN DEL CONTRATO: El trabajador al
                        firmar el presente contrato certifica que ha leído y comprendido en su totalidad las cláusulas aquí consignadas.
                    </li>
                </ul>
            </td>
        </tr>
    </table>

    {{-- Contrato firmado --}}
    @if($firmaContrato != null || $firmaContrato != '')
        @if($firmaContrato->firma != null || $firmaContrato->firma != '')
            <table class="center table-contract" width="80%">
                <tr>
                    <td width="40%">
                        <div style="width: 100%; margin: 4em;">
                            <img src="{{ asset('contratos/default.jpg') }}" width="200" {{--style="width: 60%;"--}}>
                            <p>________________________________</p>
                            El empleador: <br>
                            James Ceron Palza <br>
                            Jefe nacional de Archivo.
                            <br>
                        </div>
                    </td>
                    <td width="30%"></td>
                    <td width="40%">
                        <div style="width: 100%; margin: 4em;">
                            <img src="{{ $firmaContrato->firma }}" width="200" {{--style="width: 60%;"--}}>
                            <p>________________________________</p>
                            El trabajador:<br>
                            {{ mb_strtoupper($candidato->nombres) }} {{ mb_strtoupper($candidato->primer_apellido)}} {{ mb_strtoupper($candidato->segundo_apellido)}}
                            <br>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>
        $(function () {
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
                                    }, 8000);
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