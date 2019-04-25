@extends('layouts.app')

@section('title', 'Cajas')
@section('content')
<div class="row col-sm-12 col-xs-12">

    <div class="col-xs-12 col-lg-6 col-sm-12" style="overflow: auto;">
        <table id="tablaCajas" class="table table-hover" cellspacing="0" width="100%">
            <thead class="bg-dark text-white">
            <tr>
                <th>Caja No</th>
                <th>Apertura</th>
                <th>Cierre</th>
                <th>Valor Inicial</th>
                <th>Valor Total</th>
                <th>Usuario</th>
            </tr>
            </thead>
            <tbody>
                @foreach($cajas as $caja)
                    @if ($caja->id == $actual->id and $caja->cierre == null)
                        <tr class="bg-success text-white">
                            <td>{{ $caja->id }}</td>
                            <td>{{ $caja->apertura }}</td>
                            <td>{{ $caja->cierre }}</td>
                            <td>${{ number_format($caja->base,2,',','.') }}</td>
                            <td>$ {{ $caja->total }}</td>
                            <td><strong>Id:</strong> {{ $caja->user_id }} <br><strong>Nombre:</strong>{{ $caja->name }}</td>
                        </tr>
                    @else
                        <tr>
                            <td>{{ $caja->id }}</td>
                            <td>{{ $caja->apertura }}</td>
                            <td>{{ $caja->cierre }}</td>
                            <td>${{ number_format($caja->base,2,',','.') }}</td>
                            <td>$ {{ $caja->total }}</td>
                            <td><strong>Id:</strong> {{ $caja->user_id }} <br><strong>Nombre:</strong>{{ $caja->name }}</td>
                        </tr>
                    @endif

                @endforeach
            </tbody>
        </table>
    </div>

    <div class="col-xs-12 col-lg-6 col-sm-12">

        @if ($actual->cierre == null)
            <form id="formClose" name="formClose" method="post">
                <input type="hidden" value="{{ csrf_token() }}" name="_token">
                <input type="hidden" value="{{ $actual->id }}" name="id_caja">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action bg-success rounded-0 text-white">
                           </strong><span class="badge badge-success" style="font-size: 13px;">CAJA ABIERTA</span>
                                {{ $actual->apertura }}
                        </a>
                        <a href="#" class="list-group-item list-group-item-action"><strong>No. Caja:</strong> {{ $actual->id }}</a>
                        <a href="#" class="list-group-item list-group-item-action"><strong>Id Usuario:</strong> {{ $actual->user_id }}</a>
                        <a href="#" class="list-group-item list-group-item-action"><strong>Nombre Usuario:</strong> {{ $actual->name }}</a>
                        <a href="#" class="list-group-item list-group-item-action"><strong>Valor Inicial:</strong> {{ $actual->base }}</a>

                        <a href="#total_close" class="list-group-item list-group-item-action p-0">
                            <input style="width: 100%;" placeholder="Valor Total" type="number" id="total_close" class="form-control">
                        </a>
                        <a href="#" class="list-group-item list-group-item-action p-0">
                            <input style="width: 100%;" placeholder="Descripción" value="{{ $actual->descripcion }}" type="text" id="total_add" class="form-control">
                        </a>
                        <button type="button" class="list-group-item list-group-item-action bg-primary text-center text-white rounded-0 font-weight-bold btnClose"><i class="fa fa-toggle-off"></i> CERRAR</button>
                    </div>
            </form>
        @else
            <div class="container">

            <strong>Estado de caja actual: </strong><span class="badge badge-primary" style="font-size: 13px;"> CERRADA</span>

            <form id="formOpen" name="formOpen" method="post"><br>
                <input type="hidden" value="{{ csrf_token() }}" name="_token">

                <div class="form-group">
                    <input type="text"  min="1000.00" class="form-control"placeholder="$ Valor Inicial" name="base" id="base_add">
                </div>

                <div class="form-group">
                        <textarea name="descripcion" placeholder="Descripción" id="descripcion_add" cols="30" rows="10" style="max-width: 100%; height: 50px; max-height: 150px;" class="form-control"></textarea>
                </div>

                <div class="form-group text-center">
                    <button type="button" class="btn btn-success btnOpen"><i class="fa fa-toggle-on"></i> ABRIR CAJA</button>
                </div>
            </form>


            </div>
        @endif


    </div>
</div>

<script src="{{ asset('js/scripts/caja.js') }}"></script>
<script type="text/javascript">
    $('[data-toggle="tooltip"]').tooltip();
</script>
@endsection
