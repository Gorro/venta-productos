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
                                <form id="buscar" method="GET" action="{{url('/productos')}}">
                                    <label>Marca Perfume: </label>
                                    <select name="marca" onChange="productApp.validaSelect($(this))">
                                        <option value="">Seleccione</option>
                                        @foreach($marcas as $marca)
                                        <option value="{{$marca->id}}" @if($marcaPerfume == $marca->id) selected @endif>{{$marca->nombre}}</option>
                                        @endforeach
                                    </select>
                                    @if(!empty($cliente))
                                        <input type="hidden" name="cliente" value="{{$cliente}}">
                                        <input type="hidden" id="data" name="data" value="">
                                    @endif
                                    <input id="btnBuscar" type="submit" value="Buscar" class="btn btn-primary" disabled>
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
                                @php
                                    $cantidad = 0;
                                @endphp
                                @if(!empty($data))
                                    @php
                                        $key = array_search($producto->id, array_column($data, 'idProducto'));
                                        if($key !== false){
                                            $cantidad = $data[$key]['cantidad'];
                                        }
                                    @endphp
                                @endif
                                <tr>
                                    <td>{{ucwords(strtolower($producto->marca->nombre))}}</td>
                                    <td>{{ ucwords(strtolower(htmlentities( $producto->nombre ))) }}</td>
                                    <td>{{ ucwords(strtolower(htmlentities( $producto->sexo->nombre ))) }}</td>
                                    <td>{{number_format($producto->precio_compra, 0, ',', '.') }}</td>
                                    <td>{{number_format($producto->precio_venta, 0, ',', '.') }}</td>
                                    @if(!empty($cliente))
                                        <td><p @if(($cantidad) > 0) class="btn btn-sm btn-default" @else class="btn btn-sm btn-primary" @endif onClick="productApp.agregarProducto({{$producto->id}},{{$cliente}},$(this))">@if(($cantidad) > 0) Agregado ({{$cantidad}}) @else Agregar @endif</p></td>
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
            cantidad     : ''
            },
            allProducts  : '',
            agregarProducto : function(idProducto, idCliente, $this){
                productApp.allProducts = JSON.parse(localStorage.getItem('productArray')) || [];
                if($this.hasClass('btn-default')){
                    var cantidad = 0;
                    var index = 0;
                    $.each(productApp.allProducts,function(i,item){
                        if(item.idProducto == idProducto){
                            cantidad = parseInt(item.cantidad) + 1;
                            index = i;
                            return;
                        }
                    });
                    $this.text('Agregado ('+cantidad+')');
                    productApp.allProducts[index].cantidad = cantidad;
                }else{
                    $this.removeClass('btn-primary');
                    $this.addClass('btn-default');
                    $this.text('Agregado (1)');
                    productApp.productos.idProducto   = idProducto;
                    productApp.productos.idCliente    = idCliente;
                    productApp.productos.cantidad    = 1;
                    productApp.allProducts.push(productApp.productos);
                }

                localStorage.setItem('productArray', JSON.stringify(productApp.allProducts));
            },
            finalizarVenta : function(){
                window.localStorage.clear();
                var url = "{{url('/clientes/finalizar')}}?data="+JSON.stringify(productApp.allProducts) || [];
                window.location.href = url;
            },
            validaSelect : function($this){
                if($this.val() == ''){
                    $('#btnBuscar').attr('disabled', true);
                }else{
                    $('#btnBuscar').attr('disabled', false);
                }
            }
    }
    var Productos = backbone.Collections.extend();
    var productos = new Productos (JSON.parse( localStorage.getItem('productArray' ))) || [];
    ProductApp.allProducts = JSON.parse(localStorage.getItem('productArray')) || [];
    $('#buscar').submit(function(e){
        $('#data').val(JSON.stringify(productApp.allProducts) || []);
//        $(this).submit();
        return true;
    })
</script>
@endsection

@endsection
