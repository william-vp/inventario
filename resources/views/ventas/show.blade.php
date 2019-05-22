@extends('layouts.app')

@section('title', 'Ventas')
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

    <h4 class="text-primary mB-20 text-center">INFORMACIÓN VENTA {{ $factura->id }}</h4>
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
                                <h3 class="box-title text-center text-info">DATOS FACTURA</h3><br>
                                <!--<div class="pull-right">
                                    <button type="submit" class="btn btn-success pull-right "><i class="fa fa-print"></i> Guardar e imprimir</button>
                                </div>-->
                            </div>
                            <div class="box-background">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><span class="ti-user"></span> Cliente</label>
                                            <div class="input-group">
                                                <input type="text" disabled class="form-control" value="{{ $factura->cliente_id }}">
                                            </div>
                                        </div>

                                            <div class="col-md-4">
                                                <label> Nombre </label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{ $factura->nombreCliente }}" disabled="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label> Direccion </label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control text-center" value="{{ $factura->direccion }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label> Teléfono </label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control text-center" value="{{ $factura->telefono }}"  disabled>
                                                </div>
                                            </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-2">
                                        	<?php
							    				$date= explode(' ',$factura->fecha);
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
                                            <label>Factura Nº</label>
                                            <input type="text" class="form-control" name="credit_number" id="no_credito" required value="{{ $factura->id }}" disabled>
                                        </div>


                                         @if ($factura->forma_pago == 1)
	                                         <div class="col-md-2">
	                                         	<label>Forma de Pago</label>
		                                         <span class="btn btn-success" href="#"><i class="ti-check"></i> CONTADO</span>
		                                     </div>
	                                     @else
		                                     <div class="col-md-2">
	                                         	<label>Forma de Pago</label>
		                                         <span class="btn btn-success" href="#"><i class="ti-check"></i> CREDITO</span>
		                                     </div>
                                         @endif

                                        @if ( $factura->estado !== "ANULADA")
                                            <div class="col-md-2 divNoCredito">
                                                <label>Visualizar Factura</label>
                                                <a class="btn btn-outline-success" target="_blank" href="{{ route('factura.view', $factura->id) }}"><i class="ti-eye"></i> Ver Factura</a>
                                            </div>

                                            <div class="col-md-2 divNoCredito">
                                                <label> </label>
                                                <a class="btn btn-outline-danger btnAnular" data-id="{{ $factura->id }}" href="#"><i class="ti-close"></i> Anular Factura</a>
                                            </div>
                                         @else
                                            <div class="col-md-2">
                                                <label>Estado</label>
                                                <span class="btn btn-danger" href="#"><i class="ti-close"></i> FACTURA ANULADA</span>
                                                <span class="text-muted">{{ $factura->updated_at }}</span>
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
	                                		<td>$ {{ number_format($producto->valor_unitario,'2',',','.') }}</td>
	                                		<td>{{ $producto->impuesto }}%</td>
	                                		<?php $impProduct= $producto->valor_total * ($producto->impuesto / 100); ?>
	                                		<td>$ {{ number_format($impProduct,'2',',','.') }}</td>
	                                		<td>$ {{ number_format($producto->valor_total,'2',',','.') }}</td>
	                                	</tr>
                                	@endforeach
                                	<tr>
                                		<td colspan="5"></td>
                                		<td><strong>SUBTOTAL</strong></td>
                                		<td><strong>$ {{ number_format($factura->subtotal,'2',',','.') }}</strong></td>
                                	</tr>
                                	<tr>
                                		<td colspan="5"></td>
                                		<td><strong>IVA</strong></td>
                                		<td><strong>$ {{ number_format($factura->iva,'2',',','.') }}</strong></td>
                                	</tr>

                                    @if($factura->descuento > 0)
                                    <tr>
                                        <td colspan="5"></td>
                                        <td><strong>DESCUENTO:</strong> {{$factura->descuento}}%</td>
                                        <?php $valDescuento= $factura->subtotal * ($factura->descuento / 100); ?>
                                        <td><strong>{{ number_format($valDescuento,'2',',','.') }}</strong></td>
                                    </tr>
                                    @endif

                                	<tr>
                                		<td colspan="5"></td>    
                                		<td><strong>TOTAL</strong></td>
                                		<td><strong>$ {{ number_format($factura->total,'2',',','.') }}</strong></td>
                                	</tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer">
                            <div class="form-group">
                                <textarea style="height: 80px; resize: none;" disabled cols="30" rows="10" class="form-control">Observaciones: {{$factura->observacion}}</textarea>
                            </div>
                        </div>
                        <br>

            </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/scripts/venta.js')}}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">  
        $('#tablaProductos').dataTable({
            "order": [[1, "asc"]]
        });
    </script>
@endsection
