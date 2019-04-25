@extends('layouts.app')

@section('title', 'Clientes')
@section('color-style', 'bg-info')
@section('content')

    <h4 class=" mB-20 text-center text-info">LISTA DE CLIENTES</h4>

    <div class="text-left container mb-3 p-0">
        <a class="btn btn-outline-primary" href="{{ URL::previous() }}"><i class="ti-arrow-left"></i> Volver</a>
        <a  data-toggle="modal" data-target="#ModalNuevoCliente" class="btn btn-outline-info"><i class="ti-plus"></i> NUEVO CLIENTE</a>
    </div>

    <table id="tablaClientes" class="table table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th style="max-width: 200px;">Dirección</th>
            <th>Telefono</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th>Acciones</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach($clientes as $cliente)
            <tr>
                <td>{{$cliente->id}}</td>
                <td>{{$cliente->nombre}}</td>
                <td>{{$cliente->direccion}}</td>
                <td>{{$cliente->telefono}}</td>
                <td>
                    <a href="{{ route('clientes.destroy', $cliente->id) }}"  data-toggle="tooltip" title="Eliminar Cliente"  onclick="return confirm('¿Seguro quieres eliminar a este Usuario?')" class="btn btn-danger"><i class="ti-trash"></i></a>
                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning"  data-toggle="tooltip" title="Editar Cliente" ><i class="ti-pencil text-white"></i></a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <!-- MODAL agregar CLIENTE -->
    <div id="ModalNuevoCliente" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white rounded-0 text-center">
                    <h4 class="modal-title" >NUEVO CLIENTE</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <input type="hidden" value="{{ csrf_token() }}" name="_token">
                <div class="modal-body p-5" align="center">
                    <form class="form mb-4" role="form" id="formNuevoCliente"><br><br>
                        <input type="hidden" value="{{ csrf_token() }}" name="_token">
                        <div class="form-group">
                            <label class="col-sm-12">Id:</label>
                            <div class="col-sm-8">
                                <input placeholder="Identificación de Cliente" autocomplete="off" type="text" class="form-control" name="id" id="id_add" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12">Nombre:</label>
                            <div class="col-sm-8">
                                <input placeholder="Nombre de Cliente" type="text" autocomplete="off" class="form-control" name="nombre" id="nombre_add" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12">Dirección (Opcional):</label>
                            <div class="col-sm-8">
                                <input placeholder="Dirección del Cliente" type="text" autocomplete="off" class="form-control" name="direccion" id="direccion_add" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12">Teléfono:</label>
                            <div class="col-sm-8">
                                <input placeholder="Telefono - Celular " type="tel" autocomplete="off" class="form-control" name="telefono" id="telefono_add" autofocus>
                            </div>
                        </div>

                        <div class="modal-footer text-center" align="center">
                            <button type="button" class="btn btn-success btnClientAdd">
                                <span class='glyphicon glyphicon-plus'></span> AGREGAR
                            </button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">
                                <span class='glyphicon glyphicon-remove'></span> CERRAR
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--// MODAL agregar CLIENTE -->


    <script src="{{asset('js/scripts/cliente.js')}}"></script>

    @if(isset($_GET['search']))
        <script type="text/javascript">
            $('#tablaClientes').DataTable({
                "order": [[1, "asc"]],
                "search": {
                    "search": "{{$_GET['search']}}"
                }
            });
        </script>
    @else
        <script type="text/javascript">
            $('#tablaClientes').DataTable({
                "order": [[1, "asc"]],
            });
        </script>
    @endif
    </script>
@endsection
