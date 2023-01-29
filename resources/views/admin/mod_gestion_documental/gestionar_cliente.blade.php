@extends("admin.layout.master")
@section('contenedor')

{{-- Header --}}
	
    @include('admin.layout.includes._section_header_breadcrumb', ['page_header' => "Gestión documental cliente $cliente->nombre"])

<div>
	<div class="row pt-2">
		@if(Session::has("mensaje_success"))
			<div class="col-md-12" id="mensaje-resultado">
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					{{ Session::get("mensaje_success") }}
				</div>
			</div>
		@endif
	</div>

	<br>

	<div class="row pt-2">
		@foreach($categorias as $categoria)
		   <div class="col-xs-6 ">
	           <div class="small-box bg-aqua | tri-hover-bd-purple tri-small-box tri-shadow-light  tri-transition-300 tri-bg-white ">
	           		<a class="tri-py-2" href="{{route('admin.gestion_documental.listado_documentos_clientes', ['categoria' => $categoria->id, 'cliente' => $cliente->id])}}">
		                 <div class="inner">
		                 		<div class="row">
		                 			<div class="col-sm-1" style="height: 110px;" >
		                 				{{--<span><i class="fas fa-folder" style="color: gray;"></i></span>--}}
		                 			</div>
		                 			<div class="col-sm-11">
		                 				<p class="tri-fs-30 .tri-py-4 text-center" style="color: gray;">{{$categoria->descripcion}}</p>
		                        		<p class="tri-txt-gray-600"></p>
		                 			</div>
		                 		</div>   
		                 </div>
		                 
	             	</a>
					<div class="icon">
						<i class="fas fa-folder"></i>
					</div>
	             	
	                <div class="btn-group btn-group-justified .tri-py-4" role="group" aria-label="...">
	                 	{{-- @if($current_user->hasAccess("admin.gestion_documental.descargar_carpeta")) --}}
						  <div class="btn-group" role="group">
						  	
						    <a type="button" class="btn btn-default" href="{{ route('admin.gestion_documental.download_categoria_carpeta_GDC', ['cliente_id'=>$cliente->id, 'categoria_id'=>$categoria->id]) }}">
							   	 <i class="fas fa-download"></i>
							    Descargar
							</a>
						  </div>
						 {{-- @endif --}}
						 
					</div>
	           </div>
	        </div>
           @endforeach

      
      
	</div>

	
	<div class="row">
		<div class="col-sm-12 text-right">
			<a class="btn btn-default | tri-px-2 tri-br-2 tri-border--none tri-transition-200" href="{{ session('url_previa') }}" title="Volver">Volver</a>
        </div>
	</div>
</div>


@stop