<div class="page-break"></div>
<section class="secciones-titulos-2 center">
    <h2 style="color: #6F3795;">INFORMACIÓN ADICIONAL</h2>
    <hr align="left" class="divider-hd" style="margin-top: -.5rem;">
</section>

<section class="center">
    {{-- Subtitulo info_demandas --}}
    @if(!empty($visita->info_demandas))
        <ul>
            <li>
                <div class="ml-1">
                    <p class="color fw-700" style="font-size: 12pt;">¿Posee actualmente demandas de alimentos y/o embargos? Sí</p>
                    <hr align="left" class="divider-25" style="margin-top: -.6rem;">
                </div>
                <ul>
                    <li>
                        <div class="m-auto" style="width: 95%;">
                            <p class="text-justify color-sec">
                    
                                {{ $visita->info_demandas }}
                            
                            </p>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    @endif

    {{-- Subtitulo info_antecedentes --}}
    @if(!empty($visita->info_antecedentes))
        <ul>
            <li>
                <div class="ml-1">
                    <p class="color fw-700" style="font-size: 12pt;">¿Algún miembro de su familia presenta antecedentes penales? Sí</p>
                    <hr align="left" class="divider-25" style="margin-top: -.6rem;">
                </div>
                <ul>
                    <li>
                        <div class="m-auto" style="width: 95%;">
                            <p class="text-justify color-sec">
                    
                                {{ $visita->info_antecedentes }}
                            
                            </p>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    @endif

    {{-- Subtitulo info_sustancias --}}
    @if(!empty($visita->info_sustancias))
        <ul>
            <li>
                <div class="ml-1">
                    <p class="color fw-700" style="font-size: 12pt;">¿Ha consumido sustancias psicoactivas? Sí</p>
                    <hr align="left" class="divider-25" style="margin-top: -.6rem;">
                </div>
                <ul>
                    <li>
                        <div class="m-auto" style="width: 95%;">
                            <p class="text-justify color-sec">
                    
                                {{ $visita->info_sustancias }}
                            
                            </p>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    @endif

    {{-- Subtitulo info_ilicitas --}}
    @if(!empty($visita->info_ilicitas))
        <ul>
            <li>
                <div class="ml-1">
                    <p class="color fw-700" style="font-size: 12pt;">¿Ha sabido de actividades ilícitas en su entorno social o laboral? Sí</p>
                    <hr align="left" class="divider-25" style="margin-top: -.6rem;">
                </div>
                <ul>
                    <li>
                        <div class="m-auto" style="width: 95%;">
                            <p class="text-justify color-sec">
                    
                                {{ $visita->info_ilicitas }}
                           
                            </p>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    @endif

    {{-- subtitulo Concepto(Admin) --}}
    <div class="ml-1">
        <p class="color fw-700" style="font-size: 12pt;">Concepto del evaluador:  </p>
        <hr align="left" class="divider-25" style="margin-top: -.6rem;">
    </div>

    <div class="m-auto" style="width: 95%;">
        <p class="text-justify color-sec">

            {{ $visita->info_concepto }}
        
        </p>
    </div>

</section>

{{-- En caso de campos diferentes --}}
@if (count($info_adic_diferentes) > 0)
    <section class="center">
        <section class="secciones-titulos-2">
            <p class="color fw-700" style="font-size: 12pt;">Novedades</p>
            {{-- <h2 style="color: #6F3795;">Observaciones</h2> --}}
            <hr align="left" class="divider-hd" style="margin-top: -.5rem;">
        </section>

        <section class="">
            <table class="table table-striped novedades" >
                <thead>
                    <tr>
                        <th>Dato</th>
                        <th>Información suministrada por el candidato</th>
                        <th>Información verificada</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($info_adic_diferentes as $dif)
                        <tr> 
                            <td>{{ $dif["campo"] }}</td>
                            <td>{{ $dif["valor_cand"] }}</td>
                            <td>{{ $dif["valor_adm"] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </section>

@endif
<br>