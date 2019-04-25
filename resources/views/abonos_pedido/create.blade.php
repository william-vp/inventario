@extends('layouts.app')

@section('title', 'Abonos de Pedido')
@section('color-style', 'bg-primary')
@section('content')
<div class="row col-sm-12">

    <div class="col-xs-12 col-lg-6 col-sm-12">
    	<h3 class="text-center">Datos Credito</h3>
    		<div class="list-group">
    			<?php
    				$date= explode(' ',$credito->fecha);
    				$fecha= $date[0];
    				$hora= $date[1];
    			?>

                <a href="#" class="list-group-item list-group-item-action"><strong>Credito No:</strong> {{$credito->id}}</a>
                <a href="#" class="list-group-item list-group-item-action"><strong>Fecha:</strong> {{$fecha}}</a>
                <a href="#" class="list-group-item list-group-item-action"><strong>Hora:</strong> {{$hora}}</a>
                <a href="#" class="list-group-item list-group-item-action"><strong>Id Proveedor:</strong> {{$credito->proveedor_id}}</a>
                <a href="#" class="list-group-item list-group-item-action"><strong>Nombre:</strong> {{$credito->nombre}}</a>

                @if ($credito->estado_credito == 1)
                	<a href="#" class="list-group-item list-group-item-action"><strong>Estado Credito:</strong> <span class="badge badge-success" style="font-size: 13px;"> PAGADO</span></a>
                @else
                	<a href="#" class="list-group-item list-group-item-action"><strong>Estado Credito:</strong> <span class="badge badge-warning text-white" style="font-size: 13px;"> ACTIVO</span></a>
                @endif

                <a href="#" class="list-group-item list-group-item-action"><strong>Obervaciones:</strong> <p>{{$credito->observacion}}</p></a>

                <a href="{{ route('pedidos_credito.detalles', $credito->id) }}" class="list-group-item list-group-item-action bg-info text-center text-white rounded-0 font-weight-bold btnClose"><i class="fa fa-list"></i> VER MÁS DETALLES</a>

            </div>


         <br>
    	<h3 class="text-center">Abonos Realizados: {{count($abonos)}}</h3>

		<table id="tablaAbonos" class="table table-hover" cellspacing="0" width="100%">
		<?php
			$valorCancelado= 0;
		?>
    	@if (count($abonos) > 0 )
            <thead class="bg-dark text-white">
            <tr>
                <th>Abono No</th>
                <th>Fecha</th>
                <th>Caja</th>
                <th>Valor Abono</th>
            </tr>
            </thead>
            <tbody>
                @foreach($abonos as $abono)
                <?php $valorCancelado= $valorCancelado + $abono->valor; ?>
                        <tr>
                            <td>{{ $abono->id }}</td>
                            <td>{{ $abono->fecha }}</td>
                            <td>{{ $abono->caja_id }}</td>
                            <td>${{ number_format($abono->valor,2,',','.') }}</td>
                        </tr>
                @endforeach
            
    	@endif
        	<tr>
                <td colspan="2">Valor Cancelado (Pagado)</td>
                <td colspan="2">$ {{ number_format( $valorCancelado ,2, ',' ,'.') }}</td>
            </tr>
            <tr>
            	<?php $valorRestante= $credito->total - $valorCancelado; ?>
                <td colspan="2"> Valor Restante (Saldo) </td>
                <td colspan="2">$ {{ number_format($valorRestante ,2,',','.') }}</td>
            </tr>
        </tbody>
	</table>

        
    </div>

    <div class="col-xs-12 col-lg-6 col-sm-12">

    		@if ($credito->estado_credito == 0)

            <div class="container">

				<h3 class="text-center">Realizar Abono</h3>

            <form id="formAbono" name="formAbono" method="post"><br>
                <input type="hidden" value="{{ csrf_token() }}" name="_token">
                <input type="hidden" value="{{ $valorRestante }}" class="_inputVR">

                <div class="form-group">
                	<label>Valor Abono: </label>
                    <input type="number" min="1000" max="{{$valorRestante}}" class="form-control"  placeholder="$ Valor Inicial" name="valor_abono" id="valor_abono">
                </div>

                <div class="checkbox checkbox-circle checkbox-info peers ai-c">
                            <input type="checkbox" id="checkPayAll" name="checkPayAll" class="peer">
                            <label for="checkPayAll" class=" peers peer-greed js-sb ai-c">
                                <span class="peer peer-greed">Pagar Todo</span>
                            </label>
                </div>

                <div class="form-group text-center">
                    <button type="button" class="btn btn-success btnAbonoPedido"><i class="ti-save"></i> INGRESAR ABONO</button>
                </div>
            </form>
            </div>

            @else

            <div class="alert alert-success">
                <h1>CREDITO PAGADO</h1>
                ESTE CREDITO YA HA SIDO PAGADO TOTALMENTE.
            </div>

            @endif
    </div>
</div>

<script src="{{ asset('js/scripts/abono_pedido.js') }}"></script>
<script type="text/javascript">
    $('[data-toggle="tooltip"]').tooltip();
</script>
@endsection
