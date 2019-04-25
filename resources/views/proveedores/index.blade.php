@extends('layouts.app')

@section('title', 'Proveedores')
@section('color-style', 'bg-success')
@section('content')

    <h4 class=" mB-20 text-center text-success">LISTA DE PROVEEDORES</h4>

    <div class="text-left container mb-3 p-0">
        <a class="btn btn-outline-primary" href="{{ URL::previous() }}"><i class="ti-arrow-left"></i> Volver</a>
        <a  data-toggle="modal" data-target="#ModalNuevoProveedor" class="btn btn-outline-success"><i class="ti-plus"></i> NUEVO PROVEEDOR</a>
    </div>

    <table id="tablaProveedores" class="table table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th style="max-width: 200px;">Dirección</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach($proveedores as $proveedor)
            <tr>
                <td>{{$proveedor->id}}</td>
                <td>{{$proveedor->nombre}}</td>
                <td>{{$proveedor->direccion}}</td>
                <td>{{$proveedor->telefono}}</td>
                <td>{{$proveedor->correo}}</td>
                <td>
                    <a href="{{ route('proveedores.destroy', $proveedor->id) }}"  data-toggle="tooltip" title="Eliminar Proveedor"  onclick="return confirm('¿Seguro quieres eliminar a este Proveedor?')" class="btn btn-danger"><i class="ti-trash"></i></a>
                    <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-warning"  data-toggle="tooltip" title="Editar Proveedor" ><i class="ti-pencil text-white"></i></a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <!-- MODAL agregar PROVEEDOR -->
    <div id="ModalNuevoProveedor" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white rounded-0 text-center">
                    <h4 class="modal-title" >NUEVO PROVEEDOR</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <input type="hidden" value="{{ csrf_token() }}" name="_token">
                <div class="modal-body p-5" align="center">
                    <form class="form mb-4" role="form" id="formNuevoProveedor"><br><br>
                        <input type="hidden" value="{{ csrf_token() }}" name="_token">
                        <div class="form-group">
                            <label class="col-sm-12">Id:</label>
                            <div class="col-sm-8">
                                <input placeholder="Identificación de Proveedor" autocomplete="off" type="text" class="form-control" name="id" id="id_add" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12">Nombre:</label>
                            <div class="col-sm-8">
                                <input placeholder="Nombre de Proveedor" type="text" autocomplete="off" class="form-control" name="nombre" id="nombre_add" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12">Dirección (Opcional):</label>
                            <div class="col-sm-8">
                                <input placeholder="Dirección del Proveedor" type="text" autocomplete="off" class="form-control" name="direccion" id="direccion_add" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12">Teléfono:</label>
                            <div class="col-sm-8">
                                <input placeholder="Telefono - Celular " type="tel" autocomplete="off" class="form-control" name="telefono" id="telefono_add" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12">Correo (Opcional):</label>
                            <div class="col-sm-8">
                                <input placeholder="Correo Electronico " type="email" autocomplete="off" class="form-control" name="correo" id="correo_add" autofocus>
                            </div>
                        </div>

                        <div class="modal-footer text-center" align="center">
                            <button type="button" class="btn btn-success btnProveedorAdd">
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
    <!--// MODAL agregar PROVEEDOR -->


    <script src="{{asset('js/scripts/proveedor.js')}}"></script>

    @if(isset($_GET['search']))
        <script type="text/javascript">
            $('#tablaProveedores').DataTable({
                "order": [[1, "asc"]],
                "search": {
                    "search": "{{$_GET['search']}}"
                }
            });
        </script>
    @else
        <script type="text/javascript">
            $('#tablaProveedores').DataTable({
                "order": [[1, "asc"]],
            });
        </script>
    @endif
    </script>
@endsection
