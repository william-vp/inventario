@extends('layouts.app')
@section('title', 'Unidades de Medida')
@section('content')
    <h4 class="c-grey-900 mB-20">Lista de Unidades de Medida</h4>
    <div class="text-left container mb-3 p-0">
        <a class="btn btn-outline-primary" href="{{ URL::previous() }}"><i class="ti-arrow-left"></i> Volver</a>
        <button data-toggle="modal" data-target="#addModal" class="btn cur-p btn-outline-success"><i class="ti-plus"></i> NUEVA UNIDAD DE MEDIDA</button>
    </div>
    <table id="tablaUnidades" class="table table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>A</th>
        </tr>
        </thead>
        <tbody>
        @foreach($unidades as $unidad)
            <tr>
                <td>{{$unidad->id}}</td>
                <td id="td_{{ $unidad->id }}" style="text-transform: uppercase;">{{$unidad->nombre}}
                    <form action="#" data-method="PUT" data-route="{{ $url = route('unidades.update', ['id' => $unidad->id ]) }}" id="form_{{$unidad->id}}" name="update_{{$unidad->id}}">
                        <input type="hidden" name="_token" id="token_{{ $unidad->id }}" value="{{ csrf_token() }}">
                        <span id="input_{{$unidad->id}}" style="display: none;">
                            <input style="text-transform: uppercase;" type="text" value="{{$unidad->nombre}}" placeholder="Nombre" id="nombre_{{ $unidad->id }}" name="nombre" class="form-control">
                        </span>
                    </form>
                </td>
                <td>
                    <span id="btn_{{$unidad->id}}" style="display: none;">
                        <button type="button" class="btn btn-success btnSave" data-id="{{$unidad->id}}" data-form="update"><i class="ti-save"></i></button>
                    </span>
                    <span id="tdAcciones_{{ $unidad->id }}">
                        <a data-id="{{$unidad->id}}"  class="btn btn-warning btnEdit" title="Editar" data-toggle="tooltip"><i class="ti-pencil text-white"></i></a>
                        <a  title="Eliminar" data-toggle="tooltip" href="{{ route('unidades.destroy', $unidad->id) }}" onclick="return confirm('¿Seguro quieres eliminar a esta categoria?')" class="btn btn-danger"><i class="ti-trash"></i></a>
                    </span>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
        </tfoot>
    </table>

    <!-- MODAL agregar nueva UNIDAD DE MEDIDA -->
    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" >INGRESAR NUEVA UNIDAD DE MEDIDA</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <input type="hidden" value="{{ csrf_token() }}" name="_token">
                <div class="modal-body">
                    <form class="form-inline mb-4" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="title">Nombre:</label>
                            <div class="col-sm-9">
                                <input style="text-transform: uppercase;" placeholder="Nombre de la Categoria" type="text" class="form-control" id="nombre_add" autofocus>
                            </div>
                        </div>
                        <p class="alert alert-danger" id="erroresCategoria" style="border-radius: 0px; display: none; padding: 4px;"></p>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success add" data-dismiss="modal">
                            <span id="" class='glyphicon glyphicon-check'></span> Ingresar
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="{{ asset('js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/jszip.min.js') }}"></script>


    <script type="text/javascript">
        $('#tablaUnidades').DataTable({
            "order": [[1, "asc"]],
            dom: 'Bfrtip',
            buttons: [
                'copy',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
        });
    </script>
    <script src="{{ asset('js/scripts/unidad.js') }}"></script>
@endsection
