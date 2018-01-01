@extends('layouts.app')

@section('content')
<div class="container">
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
                    <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">Agregar Cliente</button>
                    <br><br><br>
                    <div id="actualizar">
                        <table id='clientes' class="table table-condensed  table-hover">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>E-mail</th>
                                    <th>Dirección</th>
                                    <th>Télefono Fijo</th>
                                    <th>Celular</th>
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <form id="formClientes" class="form-horizontal">
                    <div class="form-group">
                        <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nombre" class="col-sm-2 control-label">E-mail</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" id="email" placeholder="E-mail">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nombre" class="col-sm-2 control-label">Dirección</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nombre" class="col-sm-2 control-label">Télefono Fijo</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="telefono" id="telefono" placeholder="Télefono Fijo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nombre" class="col-sm-2 control-label">Celular</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="celular" id="celular" placeholder="Celular">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" id="guardar" class="btn btn-primary">Guardar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@section('scripts')
<link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}">
<script>
    $(document).ready(function(){
        $('#clientes').dataTable( {
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
                        $('#myModal').modal('hide');
                        $("#actualizar").load(location.href + " #actualizar");
                        $('#clientes').dataTable( {
                          "language": {
                            "url": "{{url('/')}}/spanish.json"
                          }
                        } );
                    }else{
                        alert('Error');
                    }
                }
            })
        });
    });
</script>
@endsection

@endsection
