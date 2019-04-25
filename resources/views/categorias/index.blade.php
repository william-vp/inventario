@extends('layouts.app')

@section('title', 'Categorias')
@section('content')

    <h4 class="c-grey-900 mB-20 text-center">Lista de Categorias</h4>

    <div class="text-left container mb-3 p-0">
        <a class="btn btn-outline-primary" href="{{ URL::previous() }}"><i class="ti-arrow-left"></i> Volver</a>
        <button data-toggle="modal" data-target="#addModal" class="btn cur-p btn-outline-success"><i class="ti-plus"></i> NUEVA CATEGORIA</button>
    </div>

    <table id="tablaCategorias" class="table table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Id</th>
            <th>Nombre Categoria</th>
            <th>Impuesto</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Impuesto</th>
            <th>Acciones</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach($categorias as $categoria)
            <tr>
                <td>{{$categoria->id}}</td>
                <td id="td_{{ $categoria->id }}" style="text-transform: uppercase;">{{$categoria->nombre}}</td>
                <td id="td2_{{ $categoria->id }}" style="text-transform: uppercase;">{{$categoria->impuesto}}</td>
                <form data-method="PUT" data-route="{{ $url = route('update', ['id' => $categoria->id ]) }}" id="form_{{$categoria->id}}" name="update_{{$categoria->id}}">
                    <input type="hidden" name="_token" id="token_{{ $categoria->id }}" value="{{ csrf_token() }}">
                    <td id="input_{{$categoria->id}}" style="display: none;">
                        <input style="text-transform: uppercase;" type="text" value="{{$categoria->nombre}}" placeholder="Nombre" id="nombre_{{ $categoria->id }}" name="nombre" class="form-control">
                    </td>

                    <td id="input2_{{$categoria->id}}" style="display: none;">
                        <input style="text-transform: uppercase;" type="text" value="{{$categoria->impuesto}}" placeholder="Impuesto" id="imp_{{ $categoria->id }}" name="impuesto" class="form-control">
                    </td>

                    <td id="btn_{{ $categoria->id }}" style="display: none;">
                        <button type="button" class="btn btn-success btnSave" data-id="{{$categoria->id}}" data-form="update"><i class="ti-save"></i></button>
                    </td>
                </form>
                <td id="tdAcciones_{{ $categoria->id }}">
                    <a data-id="{{$categoria->id}}"  data-toggle="tooltip" title="Editar" class="btn btn-warning btnEdit"><i class="ti-pencil text-white"></i></a>
                    <a href="{{ route('categorias.destroy', $categoria->id) }}"  data-toggle="tooltip" title="Eliminar Categoria" onclick="return confirm('¿Seguro quieres eliminar a esta categoria?')" class="btn btn-danger"><i class="ti-trash"></i></a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <!-- MODAL agregar nueva CATEGORIA -->
    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" >INGRESAR NUEVA CATEGORIA</h4>
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

                        <div class="form-group">
                            <label class="control-label col-sm-3" for="title">Impuesto (%):</label>
                            <div class="col-sm-9">
                                <input style="text-transform: uppercase;" placeholder="Impuesto de la Categoria" type="text" class="form-control" id="impuesto_add" autofocus>
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


    <script type="text/javascript">
        $('#tablaCategorias').DataTable({
            "order": [[1, "asc"]]
        });
    </script>
    <script src="{{ asset('js/scripts/categoria.js') }}"></script>
@endsection
