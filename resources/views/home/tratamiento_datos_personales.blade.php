<!DOCTYPE html>
<html>
<head>
	<title>Política de Tratamiento y Protección de Datos Personales</title>
    <style type="text/css">
        @page{
            margin: 20px 40px;
        }

    </style>
</head>
<body>
	
    <div class="modal-body" style="height:400px;overflow:auto;">
        <div style="text-align:center;">
            <h3>CONSENTIMIENTO O POLÍTICA DE PROTECCIÓN DE DATOS</h3>
        </div>
        <div id="texto" style="text-align:justify;margin:10px;font-family:arial; font-size: 12pt;">
            
            Apreciado usuario. En cumplimiento de lo dispuesto en el artículo 10 del decreto 1377 de 2013, reglamentario de la 
            <b>Ley 1581 de 2012, LA ORGANIZACIÓN PROSERVIS</b>, contará en su base de datos con información previamente suministrada 
            por Usted la cual ha sido recolectada por relaciones de interés laboral realizadas en desarrollo de nuestro objeto social, 
            razón por la cual usted es considerado como aspirante a ocupar una vacante.
            <br/><br/>

            Con ocasión de la entrada en vigencia de la <b>ley 1581 de 2012</b>, requerimos su <b>AUTORIZACIÓN</b> para el tratamiento de sus 
            datos personales, según lo dispone el artículo 9 de la ley en mención, los cuales serán incorporados <b>EXCLUSIVAMENTE</b> a una 
            base de datos de la que es responsable <b>PROSERVIS GENERALES Y/O PROSERVIS TEMPORALES</b> con domicilio en la Calle 38 Norte 
            No. 3CN92, teléfono: 4861717 y correo electrónico info@proservis.com.co
            <br/><br/>
            
            De acuerdo con lo anterior si usted está interesado en registrar su información, le confirmamos que usted está en derecho de 
            ejercer sus derechos a conocer, actualizar, rectificar y solicitar la supresión de sus datos personales en cualquier momento 
            notificando de forma escrita a la compañía o al correo electrónico info@proservis.com.co De aceptar la presente opción, sus 
            datos personales serán incluidos en nuestra base de datos que usted <b>voluntariamente ha entregado</b>, entendiendo que estos 
            datos serán custodiados y tratados en términos de la <b>ley 1581 de 2012</b> y demás disposiciones concordantes, los cuales 
            serán utilizados para participar en los diferentes procesos de selección que tenga la <b>ORGANIZACIÓN PROSERVIS.</b>
            <br/>
        </div>

        <div style="text-align:justify;margin:10px;font-family:arial; font-size: 12pt;">
            @if( isset($candidato) ) 
                <p>
                    FECHA ACEPTACIÓN: 
                    @if( isset($candidato->fecha_acepto_politica) )
                                
                        {{  $candidato->fecha_acepto_politica }}

                        {{ $candidato->hora_acepto_politica }}

                    @else

                        {{ $candidato->fecha_registro }}

                    @endif
                </p>

                <p>
                    IP ACEPTACIÓN:  {{ isset($candidato->ip_acepto_politica) ? $candidato->ip_acepto_politica : $candidato->ip_registro }}
                </p>
            @endif
        </div>

    </div>

</body>
</html>