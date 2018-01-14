@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Finalizar Venta</div>

                    <div class="panel-body">
                        <div id="result">
                            @foreach($productoModel as $product)
                                {{$product->nombre}}<br>
                            @endforeach
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
