@extends('layouts.app')

@section('title', 'Ventas al por mayor')
@section('color-style', 'bg-info')
@section('content')
    <div class="text-left container mb-3 p-0">
        <a class="btn btn-outline-primary" href="{{ URL::previous() }}"><i class="ti-arrow-left"></i> Volver</a>
        <a href="{{ url('/ventas/create') }}" class="btn cur-p btn-outline-success"><i class="ti-plus"></i> NUEVA VENTA</a>
    </div>

    <h4 class="c-cyan-500 mB-20 text-center">VENTAS AL POR MAYOR
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
                <?php
                $fecha_factura= gmmktime(
                    date_format(date_create($factura->fecha), 'g'),
                    date_format(date_create($factura->fecha), 'i'),
                    date_format(date_create($factura->fecha), 's'),
                    date_format(date_create($factura->fecha), 'm'),
                    date_format(date_create($factura->fecha), 'd'),
                    date_format(date_create($factura->fecha), 'Y'));
                $date= explode(' ',$factura->fecha);
                ?>
                <td><?php
                    setlocale(LC_TIME, 'es_ES');
                    $fecha= strftime("%A, %d de %B de %Y", $fecha_factura);
                    echo ucfirst($fecha);
                    echo "<br><strong>Hora: </strong>".$date[1];
                    ?></td>
                <td><strong>Id: </strong> {{$factura->cliente_id}}<br>
                    <strong>Nombre: </strong> {{$factura->nombre}}
                </td>
                <td>{{$factura->caja_id}}</td>

                <td>
                    @if ($factura->estado === "ANULADA")
                        <span class="badge badge-danger" data-toggle="tooltip" title="Esta Venta ha sido anulada">ANULADA</span><br>
                        <span class="text-muted">{{ $factura->updated_at }}</span>
                    @else
                    <!--<a href="route('ventas.destroy', $factura->id) }}"  data-toggle="tooltip" title="Eliminar venta"  onclick="return confirm('¿Seguro quieres eliminar esta Factura?')" class="btn btn-danger"><i class="ti-trash"></i></a>-->
                    <a href="{{ route('factura.detalles', $factura->id) }}"  data-toggle="tooltip" title="Información de la venta"  class="btn btn-info"><i class="ti-info text-white"></i></a>
                    <a href="{{ route('factura.view', $factura->id) }}"  data-toggle="tooltip" title="Visualizar Factura"  class="btn btn-success" target="_blank"><i class="ti-eye"></i></a>
                <!--<a href="crear_reporte_producto/2" target="_blank" ><button class="btn btn-block btn-success btn-xs">Descargar</button>-->
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>


    <script src="{{ asset('js/scripts/venta.js') }}"></script>
    <script type="text/javascript">
        $('#tablaVentas').DataTable({
            "order": [0, "desc"]
        });
    </script>
@endsection
