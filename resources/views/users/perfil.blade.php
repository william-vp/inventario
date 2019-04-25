@extends('layouts.app')

@section('title', 'Mi Perfil')
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
                    <form enctype="multipart/form-data" id="formEditProfile">
                        <div class="box box-info">
                            <div class="box-header box-header-background-light with-border">
                                <h3 class="box-title text-center text-success">MIS DATOS</h3><br>
                            </div>
                            <div class="box-background">
                                <div class="box-body">
                                    <div class="row">
                                         <input type="hidden" value="{{ csrf_token() }}" name="_token">
                                        <div class="col-md-2">
                                            <label ><span class="ti-image"></span> Foto:</label>
                                                @if ($datos->avatar == 'default')<br>
                                                  <img width="100" src="{{ asset('images/user.png') }}" alt="">
                                                @else<br>
                                                  <img width="100" src="{{ Storage::url($datos->avatar) }}" alt="">
                                                @endif
                                            <input type="file" name="imagen" data-toggle="tooltip" title="Cambiar Foto." class="btn btn-xs btn-outline-info mt-3" id="imagen_edit" >
                                        </div>


                                        <div class="col-md-2">
                                            <label><span class="ti-user"></span> Id</label>
                                            <div class="input-group">
                                                <input type="text" data-toggle="tooltip" title="Es recomendable no cambiar el Id de usuario por posibles conflictos." class="form-control" name="id" id="id_edit" value="{{ $datos->id }}">
                                            </div>
                                        </div>

                                            <div class="col-md-3">
                                                <label><span class="ti-user"></span> Nombre </label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="name" id="nombre_edit" value="{{ $datos->name }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label><span class="ti-envelope"></span> Correo Electronico </label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control text-left" name="email" id="email_edit" value="{{ $datos->email }}">
                                                </div>
                                            </div>

                                            @if (Auth::user()->type == 'ADMIN')
                                            <div class="col-md-2">
                                                <label><span class="ti-tag"></span> Tipo de Usuario </label>
                                                    <select class="form-control" name="type" id="type">
                                                        <option selected value="{{$datos->type}}">{{$datos->type}}</option>
                                                        <option value="ADMIN">ADMIN</option>
                                                        <option value="USER">USER</option>
                                                        <option value="VENDEDOR">VENDEDOR</option>
                                                    </select>
                                            </div>
                                            @endif
                                            
                        
                                    </div>
                                </div><!-- /.box-body -->
                            </div>
                        </div>

                        <h3 class="box-title text-center text-success">Cambiar Contraseña</h3>
                        <p>Si deseas cambiar tu contraseña completa los siguentes campos de lo contrario dejalos vacios.</p>

                        <div class="row box-info">
                            <div class="col-md-4">
                                <label> Actual Contraseña </label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="actual_pass" name="actual_pass" placeholder="Actual contraseña">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label> Nueva Contraseña </label>
                                    <div class="input-group">
                                        <input type="password" class="form-control text-left" name="nueva_pass" id="nueva_pass" placeholder="Nueva Contraseña">
                                    </div>
                            </div>
                            
                        </div>

                        <div class="row box-info mt-5">

                            <div class="col-md-12 text-center">
                                <button type="button" id="btnSave" class="btn btn-success"><i class="ti-save"></i> Guardar Mis datos</button> 
                            
                                <button type="reset" class="btn btn-info"><i class="ti-reload"></i> Restablecer Datos</button>
                            </div>
                            
                        </div>

            </form>


                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/scripts/user.js')}}"></script>
    <script type="text/javascript">  
        $('#tablaProductos').dataTable({
            "order": [[1, "asc"]]
        });
    </script>
@endsection
