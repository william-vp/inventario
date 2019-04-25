@extends('layouts.app')

@section('title', 'Realizar Pedido')
@section('color-style', 'bg-primary')
@section('content')
<div class="row col-sm-12">

    <div class="col-xs-12 col-lg-6 col-sm-12">
    	<h3 class="text-center text-primary">Datos Pedido</h3>
    		<div class="list-group">
    			<?php
    				$date= explode(' ',$pedido->fecha);
    				$fecha= $date[0];
    				$hora= $date[1];
    			?>

                <a href="#" class="list-group-item list-group-item-action"><strong>No.:</strong> {{$pedido->id}}</a>
                <a href="#" class="list-group-item list-group-item-action"><strong>Fecha:</strong> {{$fecha}}</a>
                <a href="#" class="list-group-item list-group-item-action"><strong>Hora:</strong> {{$hora}}</a>
                <a href="#" class="list-group-item list-group-item-action"><strong>Id Proveedor:</strong> {{$pedido->proveedor_id}}</a>
                <a href="#" class="list-group-item list-group-item-action"><strong>Nombre:</strong> {{$pedido->nombreProv}}</a>

                
                @if ($tipo == "credito")
                    @if ($pedido->estado_credito == 1)
                    <a href="#" class="list-group-item list-group-item-action"><strong>Estado Credito:</strong> <span class="badge badge-success" style="font-size: 13px;"> PAGADO</span></a>
                    @elseif ($pedido->estado_credito == 0)
                        <a href="#" class="list-group-item list-group-item-action"><strong>Estado Credito:</strong> <span class="badge badge-warning text-white" style="font-size: 13px;"> ACTIVO</span></a>
                    @endif

                @endif


                @if ($pedido->estado_pedido == 0)
                    <a href="#" class="list-group-item list-group-item-action"><strong>Estado Pedido:</strong> <span class="badge badge-info" 
                        style="font-size: 13px;"> SIN REALIZAR</span></a>
                @else
                        <a href="#" class="list-group-item list-group-item-action"><strong>Estado Pedido:</strong> <span class="badge badge-success text-white" style="font-size: 13px;"> REALIZADO</span></a>
                @endif
                

                <a href="#" class="list-group-item list-group-item-action"><strong>Obervaciones:</strong> <p>{{$pedido->observacion}}</p></a>


                @if ($tipo == "credito")
                    <a href="{{ route('pedidos_credito.detalles', $pedido->id) }}" class="list-group-item list-group-item-action bg-info text-center text-white rounded-0 font-weight-bold btnClose"><i class="fa fa-list"></i> VER MÁS DETALLES</a>
                @else
                    <a href="{{ route('pedidos.detalles', $pedido->id) }}" class="list-group-item list-group-item-action bg-info text-center text-white rounded-0 font-weight-bold btnClose"><i class="fa fa-list"></i> VER MÁS DETALLES</a>
                @endif

            </div>
    </div>

    <div class="col-xs-12 col-lg-6 col-sm-12">

    		@if ($pedido->estado_pedido == 0)

            <div class="container">

				<h3 class="text-center text-primary">Realizar Pedido</h3>

            <form id="formGenerarPedido" name="formGenerarPedido" method="post"><br>
                <input type="hidden" value="{{ csrf_token() }}" name="_token">
                <input type="hidden" value="{{ $pedido->id }}" name="_no">
                <input type="hidden" value="{{ $tipo }}" name="_type">


                <label>Elija donde desea ubicar los productos solicitados en el pedido.</label>
                <div class="checkbox checkbox-circle checkbox-info peers ai-c">
                    <input type="checkbox" id="mostrador" value="0" name="ubicar" class="peer">
                    <label for="mostrador" class=" peers peer-greed js-sb ai-c">
                                <span class="peer peer-greed">Ubicar en Mostrador</span>
                    </label>
                </div>
                <div class="checkbox checkbox-circle checkbox-info peers ai-c">
                    <input type="checkbox" id="existencias" value="1" name="ubicar" class="peer">
                    <label for="existencias" class=" peers peer-greed js-sb ai-c">
                                <span class="peer peer-greed">Ubicar en Bodega</span>
                    </label>
                </div>

                <div class="form-group text-center">
                    <button type="button" class="btn btn-success btnGenerar"><i class="ti-save"></i> REALIZAR PEDIDO</button>
                </div>
            </form>
            </div>

            @else

            <div class="alert alert-success">
                <h1>PEDIDO REALIZADO</h1>
                ESTE PEDIDO YA HA SIDO REALIZADO.
            </div>

            @endif
    </div>
</div>

<script src="{{ asset('js/scripts/abono.js') }}"></script>
<script src="{{ asset('js/scripts/pedido.js') }}"></script>
<script type="text/javascript">
    $('[data-toggle="tooltip"]').tooltip();
</script>
@endsection
