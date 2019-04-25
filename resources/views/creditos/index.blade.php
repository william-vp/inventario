@extends('layouts.app')

@section('title', 'Creditos')
@section('color-style', 'bg-primary')
@section('content')
    <h4 class="c-grey-900 mB-20 text-center text-primary">Lista de Creditos</h4>
    <div class="text-left container mb-3 p-0">
        <a class="btn btn-outline-primary" href="{{ URL::previous() }}"><i class="ti-arrow-left"></i> Volver</a>
    </div>
    <table id="tablaVentas" class="table table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Caja</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Caja</th>
            <th>Estado</th>
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

                @if ($credito->estado == 1)
                    <td><span class="badge bg-success text-white">PAGADO</span><br>
                        <a href="{{ route('factura.detalles', $credito->factura_id ) }}">Ver Factura</a>
                    </td>
                @else
                    <td><span class="badge bg-info text-white">ACTIVO</span></td>
                @endif
                <td>
                    <a href="{{ route('creditos.abono', $credito->id) }}" data-toggle="tooltip" title="Realizar Abono" class="btn btn-success"><i class="ti-money text-white"></i></a>

                    <a href="{{ route('creditos.detalles', $credito->id) }}" data-toggle="tooltip" title="Información del Credito" class="btn btn-info"><i class="ti-info text-white"></i></a>

                    <!--<a href="{ route('creditos.destroy', $credito->id) }}" data-toggle="tooltip" title="Eliminar credito" onclick="return confirm('¿Seguro quieres eliminar este Credito?')" class="btn btn-danger"><i class="ti-trash"></i></a>-->
                </td>
            </tr>
        @endforeach
        
        </tbody>
    </table>

    <script src="{{ asset('js/scripts/auth.js') }}"></script>
    <script type="text/javascript">
        $('#tablaVentas').DataTable({
            "order": [1, "asc"]
        });
    </script>
@endsection
