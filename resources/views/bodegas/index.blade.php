@extends('layouts.app')

@section('title', 'Bodegas')
@section('content')

    <h4 class="c-grey-900 mB-20 text-center">Lista de Bogegas</h4>

    <div class="text-left container mb-3 p-0">
        <a class="btn btn-outline-primary" href="{{ URL::previous() }}"><i class="ti-arrow-left"></i> Volver</a>
        <button data-toggle="modal" data-target="#addModal" class="btn cur-p btn-outline-success"><i class="ti-plus"></i> NUEVA BODEGA</button>
    </div>

    <table id="tablaBodegas" class="table table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Código</th>
            <th>Nombre Bodega</th>
            <th>Descripción</th>
            <th>Acciones</th>
            <th>Cantidad<br> Productos</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Acciones</th>
            <th>Cantidad<br> Productos</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach($bodegas as $bodega)
            <tr>
                <td id="td_{{ $bodega->id }}">{{$bodega->codigo}}</td>
                <td id="td1_{{ $bodega->id }}" style="text-transform: uppercase;">{{$bodega->nombre}}</td>
                <td id="td2_{{ $bodega->id }}" style="text-transform: uppercase;">{{$bodega->descripcion}}</td>
                <form data-method="PUT" data-route="{{ $url = route('bodegas.update', ['id' => $bodega->id ]) }}" id="form_{{$bodega->id}}" name="update_{{$bodega->id}}">
                    <input type="hidden" name="_token" id="token_{{ $bodega->id }}" value="{{ csrf_token() }}">
                    <td id="input_{{$bodega->id}}" style="display: none;">
                        <input style="text-transform: uppercase;" value="{{$bodega->codigo}}" type="text" placeholder="Código Bodega" id="codigo_{{ $bodega->id }}" name="codigo" class="form-control">
                    </td>

                    <td id="input1_{{$bodega->id}}" style="display: none;">
                        <textarea style="text-transform: uppercase;" type="text" placeholder="Nombre" id="nombre_{{ $bodega->id }}" name="nombre" class="form-control">{{$bodega->nombre}}</textarea>
                    </td>

                    <td id="input2_{{$bodega->id}}" style="display: none;">
                        <textarea style="text-transform: uppercase;" type="text" placeholder="Descripción" id="desc_{{ $bodega->id }}" name="descripcion" class="form-control">{{$bodega->descripcion}}</textarea>
                    </td>

                    <td id="btn_{{ $bodega->id }}" style="display: none;">
                        <button type="button" class="btn btn-success btnSave" data-id="{{$bodega->id}}" data-form="update"><i class="ti-save"></i></button>
                    </td>
                </form>
                <td id="tdAcciones_{{ $bodega->id }}">
                    <a data-id="{{$bodega->id}}"  data-toggle="tooltip" title="Editar" class="btn btn-warning btnEdit"><i class="ti-pencil text-white"></i></a>
                    <a href="{{ route('bodegas.destroy', $bodega->id) }}"  data-toggle="tooltip" title="Eliminar Bodega" onclick="return confirm('¿Seguro quieres eliminar a esta bodega?')" class="btn btn-danger"><i class="ti-trash"></i></a>
                </td>
                <td>{{ $bodega->cantidad }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <!-- MODAL agregar nueva BODEGA -->
    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" >INGRESAR NUEVA BODEGA</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <input type="hidden" value="{{ csrf_token() }}" name="_token">
                <div class="modal-body">
                    <form class="form mb-4" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="title">Código:</label>
                            <div class="col-sm-9">
                                <input style="text-transform: uppercase;" placeholder="Código de la Bodega" type="text" class="form-control" id="codigo_add" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3" for="title">Nombre:</label>
                            <div class="col-sm-9">
                                <input style="text-transform: uppercase;" placeholder="Nombre" type="text" class="form-control" id="nombre_add" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3" for="title">Descripcion(Opcional):</label>
                            <div class="col-sm-9">
                                <input style="text-transform: uppercase;" placeholder="Descripción" type="text" class="form-control" id="descripcion_add" autofocus>
                            </div>
                        </div>

                        <p class="alert alert-danger" id="erroresBodega" style="border-radius: 0px; display: none; padding: 4px;"></p>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success add">
                            <span id="" class='fa fa-check'></span> Ingresar
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <span class='fa fa-remove'></span> Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/scripts/bodegas.js') }}"></script>
@endsection
