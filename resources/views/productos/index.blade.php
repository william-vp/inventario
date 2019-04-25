@extends('layouts.app')

@section('title', 'Productos')
@section('color-style', 'bg-primary')
@section('content')
    <h4 class="c-grey-900 mB-20 text-primary">Lista de Productos</h4>

    <div class="text-left container mb-3 p-0">
        <a class="btn btn-outline-primary" href="{{ URL::previous() }}"><i class="ti-arrow-left"></i> Volver</a>
        <a href="{{ url('/productos/create') }}" class="btn cur-p btn-outline-success"><i class="ti-plus"></i> NUEVO PRODUCTO</a>
    </div>

    <table id="tablaProductos" class="table table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Id</th>
            <th><i class="ti-image"></i></th>
            <th>Nombre</th>
            <th>Precio Compra</th>
            <th>Precio Venta</th>
            <th>Cant. Mostrador</th>
            <th>Cant. Bodega</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Id</th>
            <th><i class="ti-image"></i></th>
            <th>Nombre</th>
            <th>Precio Compra</th>
            <th>Precio Venta</th>
            <th>Cant. Mostrador</th>
            <th>Cant. Bodega</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach($productos as $producto)
            <tr>
                <td>{{$producto ->id}}</td>
                <td><img width="90" src="{{ Storage::url($producto->imagen) }}" alt=""></td>
                <td>{{$producto->nombre}}</td>
                <td>{{$producto->precio_compra}}</td>
                <td>{{$producto->precio_venta}}</td>
                <td>{{$producto->mostrador}}</td>
                <td>{{$producto->existencias}}</td>
                @if ($producto->estado)
                    <td><span class="badge badge-pill bg-success text-white">ACTIVO</span></td>
                @else
                    <td><span class="badge badge-pill bg-danger text-white">INACTIVO</span></td>
                @endif
                <td id="tdAcciones_{{ $producto ->id }}">
                    <a href="{{ route('productos.edit', $producto->id) }}" data-toggle="tooltip" title="Editar Producto" class="btn btn-warning"><i class="ti-pencil text-white"></i></a>

                    <a href="{{ route('productos.traslado', $producto->id) }}" data-toggle="tooltip" title="Realizar Translado" class="btn btn-success"><i class=" ti-exchange-vertical text-white"></i></a>
                   

                    <a href="{{ route('productos.changeStatus', $producto->id) }}" data-toggle="tooltip" title="Cambiar Estado"   class="btn btn-info"><i class="ti-reload text-white"></i></a>

                    <!--<a href="{{ route('productos.destroy', $producto->id) }}"  data-toggle="tooltip" title="Eliminar Producto"  onclick="return confirm('¿Seguro quieres eliminar a esta producto ?')" class="btn btn-danger"><i class="ti-trash"></i></a>-->
                </td>
            </tr>
        @endforeach

        

        </tbody>
    </table>


    @if(isset($_GET['search']))
        <script type="text/javascript">
            $('#tablaProductos').DataTable({
                "order": [[1, "asc"]],
                "search": {
                    "search": "{{$_GET['search']}}"
                }
            });
        </script>
    @else
        <script type="text/javascript">
            $('#tablaProductos').DataTable({
                "order": [[1, "asc"]],
            });
        </script>
    @endif
    <script src="{{ asset('js/scripts/producto.js') }}"></script>
@endsection
