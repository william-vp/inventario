@extends('layouts.app')

@section('title', 'Editar Proveedor')
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
    <div class="text-left container mb-3 p-0">
        <a class="btn btn-outline-primary" href="{{ URL::previous() }}"><i class="ti-arrow-left"></i> Volver</a>
    </div>

    <div class="container">
        <div class="box-body">
            <div class="row">
                <!-- *********************** Purchase ************************** -->
                <div class="col-md-12 col-sm-12">
                    <form name="formEditProveedor" id="formEditProveedor">
                        <div class="box box-info">
                            <div class="box-header box-header-background-light with-border">
                                <h3 class="box-title text-center text-primary">DATOS DE PROVEEDOR</h3><br>
                            </div>
                            <div class="box-background">
                                <div class="box-body">
                                    <div class="row mt-3">
                                        <div class="col-md-3">
                                            <input type="hidden" value="{{ csrf_token() }}" name="_token">
                                            <label><span class="fa fa-address-card-o"></span> Id: </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control"  data-toggle="tooltip" title="Recomendable No cambiar el id del proveedor." placeholder="Id Proveedor" name="id" id="id_edit" value="{{$proveedor->id}}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label><span class="ti-user"></span> Nombre: </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Nombre Proveedor" name="nombre" id="nombre_edit" value="{{$proveedor->nombre}}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label><span class="fa fa-envelope"></span> Direccion: </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Correo Electrónico" name="direccion" id="direccion_edit" value="{{$proveedor->direccion}}">
                                            </div>
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <label><span class="fa fa-phone"></span> Teléfono: </label>
                                            <div class="input-group">
                                                <input type="tel" class="form-control" placeholder="Telefono" name="telefono" id="telefono_edit" value="{{$proveedor->telefono}}">
                                            </div>
                                        </div>

                                        <div class="col-md-3 mt-2">
                                            <label><span class="fa fa-phone"></span> Correo Electrónico: </label>
                                            <div class="input-group">
                                                <input type="email" class="form-control" placeholder="Correo Electrónico" name="correo" id="correo_edit" value="{{$proveedor->correo}}">
                                            </div>
                                        </div>

                        
                                    </div>
                                </div><!-- /.box-body -->
                            </div>
                        </div>

                        <div class="row box-info mt-5">

                            <div class="col-md-12 text-center">
                                <button type="button" id="btnUpdateProveedor" class="btn btn-success"><i class="ti-save"></i> Guardar datos</button> 
                                <button type="reset" class="btn btn-info"><i class="ti-save"></i> Restablecer datos</button> 
                            </div>
                            
                        </div>
            </form>

                </div>
            </div>
        </div>
    </div>

<script src="{{asset('js/scripts/proveedor.js')}}"></script>
@endsection