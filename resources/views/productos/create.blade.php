@extends('layouts.app')

@section('color-style', 'bg-primary')
@section('title', 'Ingresar Nuevo Producto')
@section('content')

<style type="text/css">
input{
    border-radius: 0px!important;
}
</style>
<div class="container-fluid col-sm-12">
    <h4 class="mB-20 text-primary text-center">Datos Nuevo Producto</h4>
        <div class="container p-0" align="center">

        <div class="text-left container mb-3 p-0">
            <a class="btn btn-outline-primary" href="{{ url('/productos') }}"><i class="ti-arrow-left"></i> Volver</a>
        </div>

            <form enctype="multipart/form-data" id="formNewProduct" autocomplete="off">
                <input type="hidden" value="{{ csrf_token() }}" name="_token">
            <div class="row">
                <div class="col-md-3">
                    <label class="text-primary font-weight-bold"><i class="ti-image"></i> Imagen Producto (opcional)</label>
                        <img width="100" src="{{ Storage::url('public/product.png') }}" alt="">
                        <div class="input-group col-sm-12">
                            <span class="btn btn-default btn-file">
                            <input type="file" name="imagen" data-toggle="tooltip" title="Adjuntar Imagen." class="btn-xs mt-1" id="imagen_add" >
                            </span>
                        </div>
                </div>

                <div class="col-md-2">
                    <label class="text-primary font-weight-bold">Código Producto:</label>
                    <div class="input-group">
                        <input placeholder="Código del Producto" type="text" class="form-control" name="codigo" id="codigo_add" autofocus>
                    </div>
                </div>

                <div class="col-md-3">
                    <label class="text-primary font-weight-bold">Nombre:</label>
                    <div class="input-group">
                        <input placeholder="Nombre del Producto" type="text" class="form-control" name="nombre" id="nombre_add" autofocus>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-2">
                    <label class="text-primary font-weight-bold">Precio Compra:</label>
                    <div class="input-group">
                        <input placeholder="Precio de compra" type="number" class="form-control" name="precio_compra" id="precioc_add" autofocus>
                    </div>
                </div>

                <div class="col-md-2">
                    <label class="text-primary font-weight-bold">Precio Venta:</label>
                    <div class="input-group">
                        <input placeholder="Precio de Venta" type="number" class="form-control" name="precio_venta" id="preciov_add" autofocus>
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="bodega_add" class="text-primary font-weight-bold">Bodega:</label>
                    <div class="input-group">
                        <select class="form-control" data-live-search="true" name="bodega_id" id="bodega_add">
                            <option selected disabled>Seleccione...</option>
                            @foreach(\App\Bodega::all() as $bodega)
                                <option data-tokens="{{$bodega->nombre}}" value="{{ $bodega->id }}"><strong>{{ $bodega->id }}</strong>: {{ $bodega->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <label class="text-primary font-weight-bold">Cantidad en Mostrador:</label>
                    <div class="input-group">
                        <input placeholder="Cantidad en Mostrador" type="number" name="mostrador" class="form-control" id="cantidadm_add" autofocus>
                    </div>
                </div>

                <div class="col-md-2">
                    <label class="text-primary font-weight-bold">Cantidad Bodega:</label>
                    <div class="input-group">
                        <input placeholder="Cantidad en Bodega" type="number" name="existencias" class="form-control" id="cantidadb_add" autofocus>
                    </div>
                </div>

            </div>

            <div class="row mt-3">

                <div class="col-md-3">
                    <label class="text-primary font-weight-bold">Fecha Vencimiento (opcional)</label>
                    <div class="input-group">
                        <input  data-provide="datepicker" type="text" class="form-control datepicker" style="border: 1px solid #ccc; border-radius: 0px;" name="vencimiento" id="fecha_add" autofocus>
                    </div>
                </div>

                <div class="col-md-3">
                    <label class="text-primary font-weight-bold">Categoria/tipo Producto:</label>
                    <div class="input-group">
                        <select class="form-control" data-live-search="true" name="categoria_id" id="categoria_add">
                            <option selected disabled>Seleccione...</option>
                            @foreach($categorias as $categoria)
                                <option data-tokens="{{$categoria->nombre}}" value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <label class="text-primary font-weight-bold">Unidad de Medida Producto:</label>
                    <div class="input-group">
                        <select id="unidad_add" class="form-control" name="medida_id" data-live-search="true">
                            <option selected disabled>Seleccione...</option>
                            @foreach($unidades as $unidad)
                                <option data-tokens="{{$unidad->nombre}}" value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                 <div class="col-md-3">
                    <label class="text-primary font-weight-bold">Estado del Producto:</label>
                    <div class="input-group">
                        <select id="estado_add" name="estado" class="form-control">
                            <option selected disabled>Seleccione...</option>
                            <option value="1">ACTIVO</option>
                            <option value="0">INACTIVO</option>
                        </select>
                    </div>
                 </div>

                 

            </div>

            <div class="row mt-4">
                <div class="col-md-12 text-left">
                    <label class="text-primary font-weight-bold">Descripción Producto (opcional)</label>
                    <div class="input-group">
                        <textarea name="descripcion" placeholder="Descripción del producto" id="descripcion_add" cols="40" rows="20" style="width: 300px; max-width: 500px; height: 50px; max-height: 150px;" class="form-control"></textarea>
                    </div>
                 </div>
            </div>

            <div class="clearfix"></div>
            <div class="row mt-4">
                <div class="form-group col-sm-12">
                    <button type="button" class="btn btn-success btnProduct"><i class="ti-save"></i> INGRESAR PRODUCTO</button>
                </div>
            </div>
           

        </form>
    </div>

</div>

    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <script src="{{ asset('js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>

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