@extends('layouts.app')

@section('title', 'NUEVO PEDIDO')
@section('color-style', 'bg-success')
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
    <div class="text-left container mb-3 p-0">
        <a class="btn btn-outline-primary" href="{{ URL::previous() }}"><i class="ti-arrow-left"></i> Volver</a>
    </div>

    <div class="container">
        <div class="box-body">
            <div class="row">
                <!-- *********************** Purchase ************************** -->
                <div class="col-md-12 col-sm-12">
                    <form method="post" name="save_sale" id="save_sale">
                        <div class="box box-success">
                            <div class="box-header box-header-background-light with-border">
                                <h3 class="box-title text-center text-success">DATOS PEDIDO</h3>
                                <!--<div class="pull-right">
                                    <button type="submit" class="btn btn-success pull-right "><i class="fa fa-print"></i> Guardar e imprimir</button>
                                </div>-->
                            </div>
                            <div class="box-background">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label><span class="ti-user"></span> Proveedor</label>
                                            <div class="input-group">
                                                <input list="proveedor" class="form-control" id="inputProveedor">
                                                <datalist id="proveedor">
                                                    <option disabled selected>Selecciona Proveedor</option>
                                                    @foreach($proveedores as $proveedor)
                                                        <option data-tokens="{{ $proveedor->nombre }}" value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                                                    @endforeach
                                                </datalist>
                                              <span class="input-group-btn">
												<button class="btn btn-default" type="button" data-toggle="modal" data-target="#ModalNuevoProveedor"><i class="fa fa-user-plus"></i> Nuevo</button>
											</span>
                                            </div>
                                        </div>


                                            <div class="col-md-3" style="display: none;" id="divNom">
                                                <input type="hidden" id="idProveedor">
                                                <label> Nombre </label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="nombre_proveedor" value="" disabled="">
                                                </div>
                                            </div>
                                            <div class="col-md-3" style="display: none;" id="divDir">
                                                <label> Direccion </label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control text-center" id="direccion_proveedor" value="" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-2" style="display: none;" id="divTel">
                                                <label> Teléfono </label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control text-center" id="telefono_proveedor" value="" disabled>
                                                </div>
                                            </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><span class="ti-calendar"></span> Fecha </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker text-center" name="purchase_date" value="{{ date('d/m/Y') }} " disabled="">
                                            </div>
                                        </div>

                                        <div class="col-md-2 divNoPedido">
                                            <label>Pedido Nº</label>
                                            <input type="text" class="form-control" name="sale_number" id="no_pedido" required value="{{ $noP->id+1 }}" disabled>
                                        </div>

                                        <div class="col-md-2 divNoCredito" style="display: none;">
                                            <label>Credito Nº</label>
                                            <input type="text" class="form-control" name="credit_number" id="no_credito" required value="{{ $noC->id+1 }}" disabled>
                                        </div>

                                        <div class="col-md-3">
                                            <label>Forma Pago</label>
                                            <select class="form-control btnt btn-success" name="formaPago" id="formaPago">
                                                <option value="1" selected>CONTADO</option>
                                                <option value="0">CREDITO</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-3 col-md-4 col-xs-6 mt-1">
                                            <label>Agregar productos</label>
                                            <button type="button" class="btn btn-success" id="btnSearchProducts" data-toggle="modal" data-target="#ModalBuscarProducto"><i class="fa fa-search"></i> Buscar productos</button>
                                        </div>

                                        <div class="col-lg-2 col-md-4 col-xs-5" id="divBtnSave" style="display: none; padding-top: 5px;">
                                            <label style="color: transparent;"><i class="ti-check-box"> </i></label>
                                            <button type="button" class="btn btn-success" id="btnSave"><i class="ti-check-box"></i> <span id="valBtnSave">Generar Pedido</span></button>
                                        </div>

                                        <input type="hidden" value="" id="nPd">
                                        <input type="hidden" value="" id="cPd">
                                        <input type="hidden" value="" id="pPd">
                                        <input type="hidden" value="" id="iPd">
                                        <input type="hidden" value="" id="sF">
                                        <input type="hidden" value="" id="iF">
                                        <input type="hidden" value="" id="tF">
                                    </div>
                                    <hr>
                                </div><!-- /.box-body -->
                            </div>
                        </div>

                        <div id="divProductAdds" class="col-md-12 mt-5 p-0" style="margin-top:4px; overflow: auto; display: none;">
                            <table class="table text-center table-hover" id="tablaDetalles">
                                <h3 class="box-title text-center text-success">DETALLES</h3><br>
                                <tbody>
                                <tr>
                                    <th>CODIGO</th>
                                    <th>DESCRIPCION</th>
                                    <th class="text-center">CANT.</th>
                                    <th><span class="pull-right">PRECIO UNIT.</span></th>
                                    <th><span class="pull-right">IVA</span></th>
                                    <th><span class="pull-right">VALOR IVA</span></th>
                                    <th><span class="pull-right">PRECIO TOTAL</span></th>
                                    <th>QUITAR</th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer">
                            <div class="form-group">
                                <textarea style="max-width: 100%; height: 50px; max-height: 100px;" name="observaciones" id="observaciones" cols="30" rows="10" class="form-control" placeholder="Observaciones (opcional)"></textarea>
                            </div>
                        </div>
                        <br><br>
            </form>
                </div>
            </div>
        </div>
    </div>


   <!-- MODAL BUSCAR PRODUCTO -->
   <div id="ModalBuscarProducto" class="modal fade" role="dialog">
       <div class="modal-dialog modal-lg modal-dialog-search">
           <div class="modal-content">
               <div class="modal-header bg-success text-white rounded-0 text-center">
                   <h4 class="modal-title" ><i class="ti-search"></i> BUSCAR PRODUCTO</h4>
                   <button type="button" class="close" data-dismiss="modal">×</button>
               </div>
               <input type="hidden" value="{{ csrf_token() }}" name="_token">
               <div class="modal-body">
                   <form class="form-inline mb-4" role="form"><br><br>
                       <table class="table table-hover" id="tablaProductos"  style="overflow: scroll;" width="100%">
                           <thead>
                               <tr align="center">
                                   <th class="hideTd">ID</th>
                                   <th class="hideTd"><i class="ti-image"></i></th>
                                   <th>PRODUCTO</th>
                                   <th>CANT EXIST.</th>
                                   <th>CANT.</th>
                                   <th><i class="ti-movey"></i> PRECIO</th>
                                   <!--<th class="hideTd">Cant. Mostrador</th>
                                   <th class="hideTd">Existencias</th>-->
                                   <th>ACCIONES</th>
                               </tr>
                           </thead>
                            <tbody>
                            @foreach($productos as $producto)
                                <tr align="center" id="tr_{{ $producto->id }}" class="text-center">
                                    <td class="hideTd">{{$producto->id}}</td>
                                    <td class="hideTd"><img width="60" src="{{ Storage::url($producto->imagen) }}" alt=""></td>
                                    <td id="nom_{{ $producto->id }}">{{$producto->nombre}}</td>

                                    <?php $existencias= $producto->mostrador + $producto->existencias;?>
                                    <td>{{ $existencias }}</td>
                                    <td>
                                        <input type="number" id="cant_{{$producto->id}}" value="" placeholder="" class="form-control inputProd text-center">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control inputProd text-center" placeholder="" style="text-align:right" id="precio_{{ $producto->id }}" value="{{ $producto->precio_compra }}">
                                    </td>
                                    <td>
                                        <a data-toggle="tooltip" title="Agregar Producto" id="btnAddProducto" data-id="{{ $producto->id }}" onclick="" class="btn btn-success"><i class="ti-plus text-white addProduct"></i></a>
                                        <i style="display: none; font-size: 20px;" class="ti-check text-success checkProducto" data-toggle="tooltip" title="Producto Añadido" id="check_{{ $producto->id }}"> </i>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                       </table>

                   </form>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-primary" data-dismiss="modal">
                           <span class='glyphicon glyphicon-remove'></span> Cerrar
                       </button>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <!--// MODAL BUSCAR PRODUCTO -->


    <!-- MODAL agregar PROVEEDOR -->
    <div id="ModalNuevoProveedor" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success text-white rounded-0 text-center">
                    <h4 class="modal-title" >NUEVO PROVEEDOR</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <input type="hidden" value="{{ csrf_token() }}" name="_token">
                <div class="modal-body p-5" align="center">
                    <form class="form mb-4" role="form" id="formNuevoProveedor"><br><br>
                        <input type="hidden" value="{{ csrf_token() }}" name="_token">
                        <div class="form-group">
                            <label class="col-sm-12">Id:</label>
                            <div class="col-sm-8">
                                <input placeholder="Identificación de Proveedor" autocomplete="off" type="text" class="form-control" name="id" id="id_add" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12">Nombre:</label>
                            <div class="col-sm-8">
                                <input placeholder="Nombre de Proveedor" type="text" autocomplete="off" class="form-control" name="nombre" id="nombre_add" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12">Dirección (Opcional):</label>
                            <div class="col-sm-8">
                                <input placeholder="Dirección del Proveedor" type="text" autocomplete="off" class="form-control" name="direccion" id="direccion_add" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12">Teléfono:</label>
                            <div class="col-sm-8">
                                <input placeholder="Telefono - Celular " type="tel" autocomplete="off" class="form-control" name="telefono" id="telefono_add" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12">Correo (Opcional):</label>
                            <div class="col-sm-8">
                                <input placeholder="Correo Electronico " type="email" autocomplete="off" class="form-control" name="correo" id="correo_add" autofocus>
                            </div>
                        </div>

                        <div class="modal-footer text-center" align="center">
                            <button type="button" class="btn btn-success btnProveedorAdd">
                                <span class='glyphicon glyphicon-plus'></span> AGREGAR
                            </button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">
                                <span class='glyphicon glyphicon-remove'></span> CERRAR
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--// MODAL agregar PROVEEDOR -->

    <script src="{{asset('js/scripts/pedido.js')}}"></script>
    <script src="{{asset('js/scripts/proveedor.js')}}"></script>
    <script type="text/javascript">  
        $('#tablaProductos').dataTable({
            "order": [[1, "asc"]]
        });
    </script>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
