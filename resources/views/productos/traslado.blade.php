@extends('layouts.app')

@section('title', 'Realizar Traslado de Producto: '.$producto->nombre)
@section('color-style', 'bg-primary')
@section('content')

    <div class="text-left container mb-3 p-0">
        <a class="btn btn-outline-primary" href="{{ url('/productos') }}"><i class="ti-arrow-left"></i> Volver</a>
    </div>

    <div class="container p-0" align="center">

    <form enctype="multipart/form-data" type="put" id="formTransladoProducto" name="formTransladoProducto"> 
        <div class="row">
            <input type="hidden" value="{{ csrf_token() }}" name="_token">

            <div class="col-md-3">
                <label class="text-primary font-weight-bold">Imagen Producto (opcional)</label class="text-primary font-weight-bold">
                    <img width="100" src="{{ Storage::url($producto->imagen) }}" alt="imagen">
            </div>

            <div class="col-md-2">
                <label class="text-primary font-weight-bold">Código de Producto:</label class="text-primary font-weight-bold">
                <div class="input-group">
                    <input placeholder="Id del Producto" disabled value="{{ $producto->id }}" type="text" class="form-control" name="id"  id="id_edit" autofocus>
                </div>
            </div>

            <div class="col-md-3">
                <label class="text-primary font-weight-bold">Nombre:</label class="text-primary font-weight-bold">
                <div class="input-group">
                    <input placeholder="Nombre del Producto" disabled value="{{ $producto->nombre }}" type="text" class="form-control" name="nombre"  id="nombre_edit" autofocus>
                </div>
            </div>

            <div class="col-md-3">
                <label class="text-primary font-weight-bold">Estado del Producto:</label class="text-primary font-weight-bold">
                <div class="input-group">
                    <select id="estado_edit" disabled name="estado" class="form-control">
                        @if ($producto->estado == 1)
                            <option selected value="1">ACTIVO</option>
                            <option value="0">INACTIVO</option>
                        @else
                            <option value="1">ACTIVO</option>
                            <option selected value="0">INACTIVO</option>
                        @endif

                    </select>
                </div>
            </div>

        </div>

        <?php $total= $producto->mostrador + $producto->existencias; ?>
        <div class="row mt-4">
            <div class="col-md-2">
                <label class="text-primary font-weight-bold">Cantidad Total:</label class="text-primary font-weight-bold">
                <div class="input-group">
                    <input disabled value="{{ $total }}" type="number" class="form-control text-center" autofocus>
                </div>
            </div>

            @if ($total <= 0)
            <div class="alert alert-danger col-md-12">
                <h1>NO HAY EXISTENCIAS DE ESTE PRODUCTO</h1>
                REALICE UN PEDIDO DE ESTE PRODUCTO PARA REALIZAR UN TRASLADO.

                <a href="{{ url('/pedidos/create') }}" class="btn btn-outline-success"><i class="ti-pencil-alt"></i> REALIZAR PEDIDO</a>
            </div>
            @else
            <input type="hidden" id="cantExist" value="{{$total}}">
            <input type="hidden" id="nombre_producto" value="{{$producto->nombre}}">

            <div class="col-md-3">
                <label class="text-primary font-weight-bold">Cantidad Mostrador:</label class="text-primary font-weight-bold">
                <div class="input-group">
                    <span class="input-group-btn"><button class="btn btn-default btnplus1" type="button"><i class="fa fa-plus"></i></button></span>
                    <input placeholder="Cantidad en Mostrador" name="mostrador" type="number" value="{{ $producto->mostrador }}"  class="form-control text-center" id="cantidadm_edit" autofocus>

                    <span class="input-group-btn">
                        <button class="btn btn-default btnminus1" type="button"><i class="fa fa-minus"></i></button></span>
                </div>
            </div>

            <div class="col-md-3">
                <label class="text-primary font-weight-bold">Cantidad Bodega:</label class="text-primary font-weight-bold">
                <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-default btnplus2" type="button"><i class="fa fa-plus"></i></button></span>
                    <input placeholder="Cantidad en Bodega" name="existencias" type="number" value="{{ $producto->existencias }}"  class="form-control text-center" id="cantidadb_edit" autofocus>

                    <span class="input-group-btn">
                        <button class="btn btn-default btnminus2" type="button"><i class="fa fa-minus"></i></button></span>
                </div>
            </div>
            @endif
                                

        </div>

        </div>
        @if ($total >= 0)
        <div class="row text-center">
            <div class="form-group col-sm-12 mt-2"><br><br>
                <button type="button" class="btn btn-success btnTraslado"><i class="ti-save"></i> GUARDAR CAMBIOS</button>
                <button type="reset" class="btn btn-info"><i class="ti-reload"></i> DESHACER CAMBIOS</button>
            </div>
        </div>
        @endif
    </form>
        
    </div>

    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}">
    <script src="{{ asset('js/bootstrap-select.js') }}"></script>

    <script src="{{ asset('js/scripts/producto.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.selectpicker').selectpicker();
        });
        $('.datepicker').datepicker({
            format: "yyyy/mm/dd",
            language: "es",
            local: "es",
            autoclose: true
        });
    </script>
@endsection