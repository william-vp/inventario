@extends('layouts.app')

@section('title', 'Ventas')
@section('color-style', 'bg-info')
@section('content')
    <div class="text-left container mb-3 p-0">
        <a class="btn btn-outline-primary" href="{{ URL::previous() }}"><i class="ti-arrow-left"></i> Volver</a>
        <a href="{{ url('/ventas/create') }}" class="btn cur-p btn-outline-success"><i class="ti-plus"></i> NUEVA VENTA</a>
    </div>

    <h4 class="c-grey-900 mB-20 text-center">Ventas al Contado
      <a class="btn btn-primary text-white" id="btnCollapseContado" data-toggle="collapse" href="#contado" role="button" aria-expanded="false" aria-controls="contado">
      Ocultar</a>
    </h4>

<div id="contado" class="show">
    <table id="tablaVentas" class="table table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Caja</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Caja</th>
            <th>Acciones</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach($facturas as $factura)
            <tr>
                <td>{{$factura->id}}</td>
                <td>{{$factura->fecha}}</td>
                <td><strong>Id: </strong> {{$factura->cliente_id}}<br>
                    <strong>Nombre: </strong> {{$factura->nombre}}
                </td>
                <td>{{$factura->caja_id}}</td>

                <td>
                    <!--<a href="route('ventas.destroy', $factura->id) }}"  data-toggle="tooltip" title="Eliminar venta"  onclick="return confirm('¿Seguro quieres eliminar esta Factura?')" class="btn btn-danger"><i class="ti-trash"></i></a>-->
                    <a href="{{ route('factura.detalles', $factura->id) }}"  data-toggle="tooltip" title="Información de la venta"  class="btn btn-info"><i class="ti-info text-white"></i></a>
                    <a href="{{ route('factura.view', $factura->id) }}"  data-toggle="tooltip" title="Visualizar Factura"  class="btn btn-success" target="_blank"><i class="ti-eye"></i></a>
                <!--<a href="crear_reporte_producto/2" target="_blank" ><button class="btn btn-block btn-success btn-xs">Descargar</button>-->

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>

    <h4 class="c-grey-900 mB-20 text-center">Ventas Pagadas al Credito
      <a class="btn btn-warning text-white" id="btnCollapseCredito" data-toggle="collapse" href="#credito" role="button" aria-expanded="false" aria-controls="collapseExample">
  Ocultar</a>
    </h4>

<div id="credito" class="show">
    <table id="tablaCreditos" class="table table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Caja</th>
            <th>Forma de Pago</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Id Credito</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Caja</th>
            <th>Id Credito</th>
            <th>Acciones</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach($creditos as $credito)
            <tr>
                <td>{{$credito->id}}</td>
                <td>{{$credito->fecha}}</td>
                <td><strong>Id: </strong> {{$credito->cliente_id}}<br>
                    <strong>Nombre: </strong> {{$credito->nombre}}
                </td>
                <td>{{$credito->caja_id}}</td>

                <td>
                  <a href="{{ route('creditos.detalles', $credito->CreditoId ) }}">Ver Credito</a>
                </td>

                <td>
                    <a href="{{ route('creditos.detalles', $credito->id) }}"  data-toggle="tooltip" title="Información de la venta"  class="btn btn-info"><i class="ti-info text-white"></i></a>
                    <a href="{{ route('factura.view', $credito->id) }}"  data-toggle="tooltip" title="Visualizar Factura"  class="btn btn-success" target="_blank"><i class="ti-eye"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

    <script src="{{ asset('js/scripts/venta.js') }}"></script>
    <script type="text/javascript">
        $('#tablaVentas').DataTable({
            "order": [1, "desc"]
        });
        $('#tablaCreditos').DataTable({
            "order": [1, "desc"]
        });
    </script>
@endsection
