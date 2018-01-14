@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Finalizar Venta</div>

                    <div class="panel-body">
                        <div id="result">
                            <table class="table table-condensed  table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Cantidad</th>
                                        <th>Precio Venta</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach($productoModel as $product)
                                    <tr>
                                        <td>{{$product['nombre']}}</td>
                                        <td>{{$product['cantidad']}}</td>
                                        <td>{{$product['precio']}}</td>
                                        <td>{{$product['total']}}</td>
                                    </tr>
                                    @php
                                        $total += $product['total'];
                                    @endphp
                                @endforeach
                                <tr style="background-color: #e0e0e0;">
                                    <th>Total Venta</th>
                                    <th></th>
                                    <th></th>
                                    <th>{{$total}}</th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-xs-12">
                            <button class="btn btn-primary pull-right">Agregar cuotas</button>
                            <button class="btn btn-default pull-right" style="margin-right:10px;">Finalizar como pagado</button>
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

@endsection

@endsection
