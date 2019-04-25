@extends('layouts.app')

@section('title', 'PEDIDO A CREDITO')
@section('color-style', 'bg-primary')
@section('content')
    <style>
        .modal-dialog-search {
            max-width: 80%;
            margin: 1.75rem auto;
        }

        .inputProd{
            width: 100px !important;
        }

        @media (max-width:991px){
            .modal-dialog-search {
                max-width: 100%;
                margin: 10px;
                margin-right: -25px;
                font-size: 12px;
            }
            .inputProd{
                width: 65px !important;
                margin: 0px;
            }
            .hideTd{
                display: none;
            }

        }

    </style>
    <h4 class="text-primary mB-20 text-center">INFORMACIÓN PEDIDO A CREDITO CREDITO {{ $credito->id }}</h4>
    <div class="text-left container mb-3 p-0">
        <a class="btn btn-outline-primary" href="{{ URL::previous() }}"><i class="ti-arrow-left"></i> Volver</a>
    </div>

    <div class="container">
        <div class="box-body">
            <div class="row">
                <!-- *********************** Purchase ************************** -->
                <div class="col-md-12 col-sm-12">
                    <form method="post" name="save_sale" id="save_sale">
                        <div class="box box-info">
                            <div class="box-header box-header-background-light with-border">
                                <h3 class="box-title text-center text-info">DATOS CREDITO</h3><br>
                                <!--<div class="pull-right">
                                    <button type="submit" class="btn btn-success pull-right "><i class="fa fa-print"></i> Guardar e imprimir</button>
                                </div>-->
                            </div>
                            <div class="box-background">
                                <div class="box-body">
                                    <div class="row">

                                        <div class="col-md-2">
                                            <label><span class="ti-user"></span> Proveedor</label>
                                            <div class="input-group">
                                                <input type="text" disabled class="form-control" value="{{ $credito->proveedor_id }}">
                                            </div>
                                        </div>

                                            <div class="col-md-4">
                                                <label> Nombre </label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{ $credito->nombreCliente }}" disabled="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label> Direccion </label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control text-center" value="{{ $credito->direccion }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label> Teléfono </label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control text-center" value="{{ $credito->telefono }}"  disabled>
                                                </div>
                                            </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-2">
                                        	<?php
							    				$date= explode(' ',$credito->fecha);
							    				$fecha= $date[0];
							    				$hora= $date[1];
							    			?>
                                            <label><span class="ti-calendar"></span> Fecha </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="purchase_date" value="{{ $fecha }} " disabled="">
                                            </div>
                                        </div>

                                        <div class="col-md-2 divNoCredito">
                                            <label><i class="ti-time"></i> Hora</label>
                                            <input type="text" class="form-control" value="{{ $hora }}" disabled>
                                        </div>

                                        <div class="col-md-2 divNoCredito">
                                            <label>Credito Nº</label>
                                            <input type="text" class="form-control" name="credit_number" id="no_credito" required value="{{ $credito->id }}" disabled>
                                        </div>


                                        <div class="col-md-2 divNoCredito">
                                            <label>Estado Pedido</label>
                                            @if ($credito->estado_pedido == 1)
                                                <input type="text" disabled class="form-control border-0 bg-success text-white text-center" required value="REALIZADO" disabled>
                                            @else
                                                <input type="text" disabled class="form-control border-0 bg-warning text-white text-center" required value="SIN REALIZAR" disabled>
                                            @endif
                                        </div>

                                        <div class="col-md-2 divNoCredito">
                                            <label>Estado Credito</label>
                                            @if ($credito->estado_credito == 1)
							                	<input type="text" disabled class="form-control border-0 bg-success text-white text-center" required value="PAGADO" disabled>
							                @else
							                	<input type="text" disabled class="form-control border-0 bg-warning text-white text-center" required value="ACTIVO" disabled>
							                @endif
                                        </div>

                                         @if ($credito->estado_credito == 1)
                                         <div class="col-md-2">
                                         	<label>Ver Pedido</label>
	                                         <a target="_new" class="btn btn-outline-success" href="{{ route('pedidos.view', $credito->pedido_id) }}"><i class="ti-eye"></i> Ver Pedido</a>
	                                     </div>
                                         @endif


                                    </div>
                                    <hr>
                                </div><!-- /.box-body -->
                            </div>
                        </div>

                        <div id="divProductAdds" class="col-md-12 mt-2 p-0" style="margin-top:0px; overflow: auto;">
                            <table class="table text-center table-hover" id="tablaDetalles">
                                <h3 class="box-title text-center text-info">DETALLES</h3><br>
                                <thead>
	                                <tr>
	                                    <th>CODIGO</th>
	                                    <th>DESCRIPCION</th>
	                                    <th class="text-center">CANT.</th>
	                                    <th><span class="pull-right">PRECIO UNIT.</span></th>
	                                    <th><span class="pull-right">IVA</span></th>
	                                    <th><span class="pull-right">VALOR IVA</span></th>
	                                    <th><span class="pull-right">PRECIO TOTAL</span></th>
	                                </tr>
                                </thead>
                                <tbody>
                                	@foreach($productos as $producto)
	                                	<tr align="center">
	                                		<td>{{ $producto->id }}</td>
	                                		<td>{{ $producto->nombre }}</td>
	                                		<td>{{ $producto->cantidad }}</td>
	                                		<td>$ {{ number_format($producto->valor_unitario,'0',',','.') }}</td>
	                                		<td>{{ $producto->impuesto }}%</td>
	                                		<?php 
                                            $valor_total= $producto->cantidad * $producto->valor_unitario;
                                            $impProduct= $valor_total * ($producto->impuesto / 100); ?>
	                                		<td>$ {{ number_format($impProduct,'0',',','.') }}</td>
	                                		<td>$ {{ number_format($valor_total,'0',',','.') }}</td>
	                                	</tr>
                                	@endforeach
                                	<tr>
                                		<td colspan="5"></td>
                                		<td><strong>SUBTOTAL</strong></td>
                                		<td><strong>$ {{ number_format($credito->subtotal,'0',',','.') }}</strong></td>
                                	</tr>
                                	<tr>
                                		<td colspan="5"></td>
                                		<td><strong>IVA</strong></td>
                                		<td><strong>$ {{ number_format($credito->iva,'0',',','.') }}</strong></td>
                                	</tr>
                                	<tr>
                                		<td colspan="5"></td>
                                		<td><strong>TOTAL</strong></td>
                                		<td><strong>$ {{ number_format($credito->total,'0',',','.') }}</strong></td>
                                	</tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer">
                            <div class="form-group">
                                <textarea style="height: 80px; resize: none;" disabled cols="30" rows="10" class="form-control">Observaciones: {{$credito->observacion}}</textarea>
                            </div>
                        </div>
                        <br>


                        <h3 class="box-title text-center text-info">ABONOS
                        	@if ($credito->estado_credito == 0)
                         	<a class="btn btn-outline-info pull-right" 
                         	href="{{ route('pedidos_credito.abono', $credito->id) }}"><i class="ti-money"></i> Realizar Abono</a>
                         	@endif
                         </h3>

                        <br>
                        @if (count($abonos) > 0 )
						<table id="tablaAbonos" class="table table-hover" cellspacing="0" width="100%">
						<?php
							$valorCancelado= 0;
						?>
				            <thead class="bg-info text-white">
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
					        	<tr>
					        		<td colspan="2"></td>
					                <td align="right"><strong>Valor Cancelado (Pagado)</strong></td>
					                <td>$ {{ number_format( $valorCancelado ,2, ',' ,'.') }}</td>
					            </tr>
					            <tr>
					            	<td colspan="2"></td>
					            	<?php $valorRestante= $credito->total - $valorCancelado; ?>
					                <td align="right"><strong>Valor Restante (Saldo)</strong></td>
					                <td>$ {{ number_format($valorRestante ,2,',','.') }}</td>
					            </tr>
				        	</tbody>
						</table>
					@endif

            </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/scripts/venta.js')}}"></script>
    <script type="text/javascript">  
        $('#tablaProductos').dataTable({
            "order": [[1, "asc"]]
        });
    </script>
@endsection
