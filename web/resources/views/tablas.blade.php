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
                                <form method="GET" action="{{url('/productos')}}">
                                    <label>Marca Perfume: </label>
                                    <select name="marca">
                                        <option>Seleccione</option>
                                        @foreach($marcas as $marca)
                                        <option value="{{$marca->id}}" @if($marcaPerfume == $marca->id) selected @endif>{{$marca->nombre}}</option>
                                        @endforeach
                                    </select>
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productos as $producto)
                                <tr>
                                    <td>{{ucwords(strtolower($producto->marca->nombre))}}</td>
                                    <td><?php echo ucwords(strtolower(htmlentities( $producto->nombre ))); ?></td>
                                    <td>{{ucwords(strtolower($producto->sexo->nombre))}}</td>
                                    <td>{{number_format($producto->precio_compra, 0, ',', '.') }}</td>
                                    <td>{{number_format($producto->precio_venta, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
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
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
          }
        } );
    });
</script>
@endsection

@endsection
