@extends("admin.layout.master")
@section("contenedor")

<h3>Lista de clientes</h3>
@if(Session::has("mensaje_success"))
<div class="col-md-12" id="mensaje-resultado">
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{Session::get("mensaje_success")}}
    </div>
</div>
@endif
{!! Form::model(Request::all(),["id"=>"admin.lista_clientes","method"=>"GET"]) !!}

<div class="col-md-6  form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Nombre Cliente:</label>
    <div class="col-sm-9">
        {!! Form::text("nombre",null,["class"=>"form-control","placeholder"=>"Nombre"]); !!}
    </div>
    <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("nombre",$errors) !!}</p>    

</div>
<div class="col-md-6  form-group">
  @if(route("home")=="https://gpc.t3rsc.co")
     <label for="inputEmail3" class="col-sm-3 control-label">RUC:</label>
  @else
     <label for="inputEmail3" class="col-sm-3 control-label">Nit:</label>
  @endif
   
    <div class="col-sm-9">
        {!! Form::text("nit",null,["class"=>"form-control solo-numero","placeholder"=>"Nit"]); !!}
    </div>
    <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("nit",$errors) !!}</p>    

</div>
<button class="btn btn-warning" >Buscar</button>
<a class="btn btn-warning" href="{{route("admin.lista_clientes")}}" >Limpiar</a>


<a class="btn btn-info" href="Javascript:;" onclick="return conf_registro('cliente_id[]', this)">Editar Cliente</a>

@if($eliminar)

 <a class="btn btn-danger" data-url="{{url('admin/eliminar-cliente/')}}" id="eliminar-c" href="#">Eliminar Cliente</a>
 
@endif

{!! Form::close() !!}

<table class="table table-bordered">
    <thead>
      <tr>
        <th></th>
        @if(route("home")=="https://gpc.t3rsc.co")
          <th>RUC</th>
        @else
          <th>Nit</th>
        @endif
        
        <th>Clientes</th>
        <th>Dirección</th>
        <th>Teléfono</th>
        <th>Ubicación</th>
      </tr>
    </thead>
    <tbody>
      @foreach($clientes as $cliente)
        <tr>
            <td>
            {!! Form::checkbox("cliente_id[]",$cliente->id,null,["data-url"=>route('admin.editar_cliente',["cliente_id"=>$cliente->id])]) !!}
            </td>
            <td>{{$cliente->nit}}</td>
            <td>{{$cliente->nombre}}</td>
            <td>{{$cliente->direccion}}</td>
            <td>{{$cliente->telefono}}</td>
            <td>{{$cliente->getUbicacion()->value}}</td>
        </tr>
      @endforeach
    </tbody>
</table>
{!! $clientes->appends(Request::all())->render() !!}

<script>
    $(function () {

       $("#eliminar-c").on("click", function () {
        
         var checks = $("input[name='cliente_id[]']:checked").val();
         var url = $(this).data('url');
         //console.log(checks);
                
          if(checks.length == 0) {

            mensaje_success("Debe seleccionar un item de la tabla.");
            
          }else{

            // var valor = checks.value();
            $.ajax({
                type: "GET",
                url:url+'/'+checks,
                success: function (response) {
                  mensaje_success("Registro Eliminado");

                 $("input[name='cliente_id[]']:checked").parent('td').parent('tr').remove();    
                
          }
            });

           }
        });

    });

</script>

@stop