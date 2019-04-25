@extends('layouts.app')

@section('title', 'Lista de Pedidos a Credito')
@section('color-style', 'bg-primary')
@section('content')
    <div class="text-left container mb-3 p-0">
        <a class="btn btn-outline-primary" href="{{ URL::previous() }}"><i class="ti-arrow-left"></i> Volver</a>
        <a href="{{ url('/pedidos/create') }}" class="btn cur-p btn-outline-success"><i class="ti-plus"></i> NUEVO PEDIDO</a>
    </div>
    <table id="tablaPedidos" class="table table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Proveedor</th>
            <th>Usuario</th>
            <th>Estado Credito</th>
            <th>Estado Pedido</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Proveedor</th>
            <th>Usuario</th>
            <th>Estado Credito</th>
            <th>Estado Pedido</th>
            <th>Acciones</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach($pedidos_credito as $pedido)
            <tr>
                <td>{{$pedido->id}}</td>
                <td>{{$pedido->fecha}}</td>
                <td><strong>Id: </strong> {{$pedido->proveedor_id}}<br>
                    <strong>Nombre: </strong> {{$pedido->nombre}}
                </td>

                <td><strong>Id: </strong> {{$pedido->user_id}}<br>
                    <strong>Nombre: </strong> {{$pedido->name}}
                </td>

                 @if ($pedido->estado_credito == 1)
                    <td class="text-center"><span class="badge bg-success text-white">PAGADO</span>
                    </td>
                @else
                    <td class="text-center"><span class="badge bg-info text-white">ACTIVO</span></td>
                @endif

                @if ($pedido->estado_pedido == 1)
                    <td class="text-center"><span class="badge bg-success text-white">REALIZADO</span><br>
                    </td>
                @else
                    <td class="text-center"><span class="badge bg-primary text-white">SIN REALIZAR</span>
                    </td>
                @endif

                <td>
                     <a href="{{ route('pedidos_credito.abono', $pedido->id) }}" data-toggle="tooltip" title="Realizar Abono de pedido a credito" class="btn btn-success"><i class="ti-money text-white"></i></a>

                      @if ($pedido->estado_pedido == 0)
                    <a href="{{ route('pedidos.generar', ['id' => $pedido->id, 'tipo' => 'credito']) }}"  data-toggle="tooltip" title="Generar Pedido"  class="btn btn-warning" target="_blank"><i class="ti-check-box"></i></a>
                    @endif

                    <a href="{{ route('pedidos_credito.detalles', $pedido->id) }}"  data-toggle="tooltip" title="Información del pedido a credito"  class="btn btn-info"><i class="ti-info text-white"></i></a>

                    <!--<a href="{{ route('pedidos_credito.destroy', $pedido->id) }}"  data-toggle="tooltip" title="Eliminar pedido a credito"  onclick="return confirm('¿Seguro quieres eliminar este Pedido?')" class="btn btn-danger"><i class="ti-trash"></i></a>-->
            
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <script type="text/javascript">
        $('#tablaPedidos').DataTable({
            "order": [1, "asc"]
        });
    </script>
@endsection
