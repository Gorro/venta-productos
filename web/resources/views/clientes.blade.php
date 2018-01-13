@extends('layouts.app')

@section('content')
<div id="actualizar" class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Clientes</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#ingresarCliente">Agregar Cliente</button>
                    <br><br><br>
                    <div >
                        <table id='clientes' class="table table-condensed  table-hover">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>E-mail</th>
                                    <th>Dirección</th>
                                    <th>Télefono Fijo</th>
                                    <th>Celular</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clientes as $cliente)
                                    <tr>
                                        <td>{{$cliente->nombre}}</td>
                                        <td>{{$cliente->email}}</td>
                                        <td>{{$cliente->direccion}}</td>
                                        <td>{{$cliente->telefono_fijo}}</td>
                                        <td>{{$cliente->celular}}</td>
                                        <td>
                                            <p class="btn btn-primary">Modificar</p>
                                            <p class="btn btn-primary">Agergar producto</p>
                                            <p class="btn btn-primary">Agregar cuota</p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@include('modals.ingresarClienteModal')
@section('scripts')
<link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}">
<script>
    var tablaClientes = $('#clientes').DataTable( {
      "language": {
        "url": "{{asset('js/spanish.json')}}"
      }
    } );

    $('#guardar').click(function(){
        var form = $('#formClientes');
        $.ajax({
            url     : "{{url('/clientes')}}",
            method  :'POST',
            data    : form.serialize(),
            dataType: 'JSON',
            success : function(result){
                if(result.insert){
                    $('#ingresarCliente').modal('hide');
                    // $("#actualizar").load(location.href + " #actualizar");
                    tablaClientes.row.add( [
                        $('#nombre').val(),
                        $('#email').val(),
                        $('#direccion').val(),
                        $('#telefono').val(),
                        $('#celular').val()
                    ] ).draw( false );
                }else{
                    alert('Error');
                }
            }
        })
    });
</script>
@endsection

@endsection
