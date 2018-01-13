@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Perfumes</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-xs-12">

                                <p class="btn btn-success pull-right" onClick="productApp.finalizarVenta()">Finalizar Venta</p>
                                <form method="GET" action="{{url('/productos')}}">
                                    <label>Marca Perfume: </label>
                                    <select name="marca">
                                        <option>Seleccione</option>
                                        @foreach($marcas as $marca)
                                        <option value="{{$marca->id}}" @if($marcaPerfume == $marca->id) selected @endif>{{$marca->nombre}}</option>
                                        @endforeach
                                    </select>
                                    @if(!empty($cliente))
                                        <input type="hidden" name="cliente" value="{{$cliente}}">
                                    @endif
                                    <input type="submit" value="Buscar" class="btn btn-primary">
                                </form>
                            </div>
                            <hr>
                        </div>
                    </div>

                    <table id='productos' class="table table-condensed  table-hover">
                        <thead>
                            <tr>
                                <th>Marca</th>
                                <th>Nombre</th>
                                <th>Sexo</th>
                                <th>Precio Compra</th>
                                <th>Precio Venta</th>
                                @if(!empty($cliente))
                                    <th>Agregar</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productos as $producto)
                                <tr>
                                    <td>{{ucwords(strtolower($producto->marca->nombre))}}</td>
                                    <td><?php echo ucwords(strtolower(htmlentities( $producto->nombre ))); ?></td>
                                    <td><?php echo ucwords(strtolower(htmlentities( $producto->sexo->nombre ))); ?></td>
                                    <td>{{number_format($producto->precio_compra, 0, ',', '.') }}</td>
                                    <td>{{number_format($producto->precio_venta, 0, ',', '.') }}</td>
                                    @if(!empty($cliente))
                                        <td><p class="btn btn-sm btn-primary" onClick="productApp.agregarProducto({{$producto->id}},{{$cliente}})">Agregar</p></td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div id="result">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
<link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}">
<script>
    $(document).ready(function(){
        $('#productos').dataTable( {
            "language": {
                "url": "{{asset('js/spanish.json')}}"
            }
        });
    });
</script>
<script>
    var productApp = {

        productos : {
            idProducto   : '',
            idCliente    : '',
            allProducts  : ''
        },
        agregarProducto : function(idProducto, idCliente){
            productApp.productos.idProducto   = idProducto;
            productApp.productos.idCliente    = idCliente;


            productApp.allProducts = JSON.parse(localStorage.getItem('productArray')) || [];            

            productApp.allProducts.push(productApp.productos);

            localStorage.setItem('productArray', JSON.stringify(productApp.allProducts));
        },
        finalizarVenta : function(){
            $.ajax({
                url: "{{url('/clientes/finalizar')}}",
                data : {data : JSON.stringify(productApp.allProducts) || []},
                success: function(result){
                    $("#result").html(result);
                    window.localStorage.clear();
                }
            });
        }
    }
</script>
@endsection

@endsection
