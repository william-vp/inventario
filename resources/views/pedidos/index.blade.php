@extends('layouts.app')

@section('title', 'Lista de Pedidos')
@section('color-style', 'bg-success')
@section('content')
    <div class="text-left container mb-3 p-0">
        <a class="btn btn-outline-primary" href="{{ URL::previous() }}"><i class="ti-arrow-left"></i> Volver</a>
        <a href="{{ url('/pedidos/create') }}" class="btn cur-p btn-outline-success"><i class="ti-plus"></i> NUEVO PEDIDO</a>
    </div>

    <h3 class="text-center text-success">Pedidos al Contado 
    <a class="btn btn-primary text-white" id="btnCollapseContado" data-toggle="collapse" href="#contado" role="button" aria-expanded="false" aria-controls="contado">
    Ocultar</a>
    </h3>    

    <div id="contado" class="show">
    <table id="tablaPedidos" class="table table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Proveedor</th>
            <th>Usuario</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Proveedor</th>
            <th>Usuario</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach($pedidos as $pedido)
            <tr>
                <td>{{$pedido->id}}</td>
                <td>{{$pedido->fecha}}</td>
                <td><strong>Id: </strong> {{$pedido->proveedor_id}}<br>
                    <strong>Nombre: </strong> {{$pedido->nombre}}
                </td>

                <td>
                    <strong>Id: </strong> {{$pedido->user_id}}<br>
                    <strong>Nombre: </strong> {{$pedido->name}}
                </td>

                @if ($pedido->estado_pedido == 1)
                    <td><span class="badge bg-success text-white">REALIZADO</span></td>
                @else
                    <td><span class="badge bg-primary text-white">SIN REALIZAR</span></td>
                @endif

                <td>
                    <a href="{{ route('pedidos.detalles', $pedido->id) }}"  data-toggle="tooltip" title="Información del pedido"  class="btn btn-info"><i class="ti-info text-white"></i></a>

                     @if ($pedido->estado_pedido == 0)
                    <a href="{{ route('pedidos.generar', ['id' => $pedido->id, 'tipo' => 'contado']) }}"  data-toggle="tooltip" title="Generar Pedido"  class="btn btn-warning" target="_blank"><i class="ti-check-box"></i></a>
                    @endif

                    <a href="{{ route('pedidos.view', $pedido->id) }}"  data-toggle="tooltip" title="Visualizar Pedido"  class="btn btn-success" target="_blank"><i class="ti-eye"></i></a>
                    <!--<a href="{ route('pedidos.destroy', $pedido->id) }}"  data-toggle="tooltip" title="Eliminar pedido"  onclick="return confirm('¿Seguro quieres eliminar este Pedido?')" class="btn btn-danger"><i class="ti-trash"></i></a>-->
              
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    </div>


    <h3 class="text-center text-warning">Pedidos Pagados a Credito 
        <a class="btn btn-warning text-white" id="btnCollapseCredito" data-toggle="collapse" href="#credito" role="button" aria-expanded="false" aria-controls="collapseExample">
    Ocultar</a></h3>    


    <div id="credito" class="show">
     <table id="tablaCreditos" class="table table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Proveedor</th>
            <th>Usuario</th>
            <th>Inf. Credito</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Proveedor</th>
            <th>Usuario</th>
            <th>Inf. Credito</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach($creditos as $credito)
            <tr>
                <td>{{$credito->id}}</td>
                <td>{{$credito->fecha}}</td>
                <td><strong>Id: </strong> {{$credito->proveedor_id}}<br>
                    <strong>Nombre: </strong> {{$credito->nombre}}
                </td>

                <td><strong>Id: </strong> {{$credito->user_id}}<br>
                    <strong>Nombre: </strong> {{$credito->name}}
                </td>

                <td>
                    <a href="{{ route('pedidos_credito.detalles', $credito->CreditoId ) }}">Ver Credito</a>
                </td>

                @if ($credito->estado_pedido == 1)
                    <td><span class="badge bg-success text-white">REALIZADO</span>
                    </td>
                @else
                    <td><span class="badge bg-primary text-white">SIN REALIZAR</span></td>
                @endif

                <td>
                    <a href="{{ route('pedidos.detalles', $credito->id ) }}"  data-toggle="tooltip" title="Información del pedido"  class="btn btn-info"><i class="ti-info text-white"></i></a>

                @if ($credito->estado_pedido == 0)
                    <a href="{{ route('pedidos.generar', ['id' => $credito->CreditoId, 'tipo' => 'credito']) }}"  data-toggle="tooltip" title="Generar Pedido"  class="btn btn-warning" target="_blank"><i class="ti-check-box"></i></a>
                @endif

                    <a href="{{ route('pedidos.view', $credito->id) }}"  data-toggle="tooltip" title="Visualizar Pedido"  class="btn btn-success" target="_blank"><i class="ti-eye"></i></a>
                    <!--<a href="{ route('pedidos.destroy', $credito->id) }}"  data-toggle="tooltip" title="Eliminar pedido"  onclick="return confirm('¿Seguro quieres eliminar este Pedido?')" class="btn btn-danger"><i class="ti-trash"></i></a>-->
                <!--<a href="crear_reporte_producto/2" target="_blank" ><button class="btn btn-block btn-success btn-xs">Descargar</button>-->

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>

    <script src="{{ asset('js/scripts/pedido.js') }}"></script>
    <script type="text/javascript">
        $('#tablaPedidos').DataTable({
            "order": [1, "asc"]
        });
        $('#tablaCreditos').DataTable({
            "order": [1, "asc"]
        });
    </script>
@endsection
