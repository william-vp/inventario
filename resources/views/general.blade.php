@extends('layouts.app')

@section('title', 'General')
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
                    <form enctype="multipart/form-data" id="formEditGeneral">
                        <div class="box box-info">
                            <div class="box-header box-header-background-light with-border">
                                <h3 class="box-title text-center text-primary">DATOS DE APLICACIÓN</h3><br>
                            </div>
                            <div class="box-background">
                                <div class="box-body">
                                    <div class="row">
                                         <input type="hidden" value="{{ csrf_token() }}" name="_token">
                                        <div class="col-md-6">
                                            <label ><span class="ti-image"></span> Logo (60 x 70):</label>
                                                <br>
                                                  <img width="100" src="{{ Storage::url($datos->logo) }}" alt="">

                                            <input type="file" name="logo" data-toggle="tooltip" title="Cambiar Logo." class="btn btn-xs btn-outline-primary mt-3 col-xs-10" id="logo_edit" >
                                        </div>

                                        <div class="col-md-6">
                                            <label ><span class="ti-image"></span> Portada (1920 x 1080):</label>
                                                <br>
                                                  <img width="200" src="{{ Storage::url($datos->portada) }}" alt="">

                                            <input type="file" name="portada" data-toggle="tooltip" title="Cambiar Portada." class="btn btn-xs btn-outline-primary mt-3" id="portada_edit" >
                                        </div>

                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-3">
                                            <label><span class=""></span> Nombre Aplicación: </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Nombre Aplicación" name="nombre" id="nombre_edit" value="{{$datos->nombre}}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label><span class="fa fa-envelope"></span> Email Contacto: </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Correo Electrónico" name="email" id="email_edit" value="{{$datos->email}}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label><span class="fa fa-phone"></span> Teléfono Contacto: </label>
                                            <div class="input-group">
                                                <input type="tel" class="form-control" placeholder="Telefono" name="telefono" id="telefono_edit" value="{{$datos->telefono}}">
                                            </div>
                                        </div>

                        
                                    </div>
                                </div><!-- /.box-body -->
                            </div>
                        </div>

                        <div class="row box-info mt-5">

                            <div class="col-md-12 text-center">
                                <button type="button" id="btnSave" class="btn btn-success"><i class="ti-save"></i> Guardar datos</button> 
                                <button type="reset" class="btn btn-info"><i class="ti-save"></i> Restablecer datos</button> 
                            </div>
                            
                        </div>
            </form>

                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/scripts/general.js')}}"></script>
@endsection