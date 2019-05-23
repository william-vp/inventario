@extends('layouts.app')
<style>
    button,
    input {
        font-family: "Montserrat", "Helvetica Neue", Arial, sans-serif;
    }

    a {
        color: #f96332;
    }

    a:hover,
    a:focus {
        color: #f96332;
    }

    p {
        line-height: 1.61em;
        font-weight: 300;
        font-size: 1.2em;
    }

    .category {
        text-transform: capitalize;
        font-weight: 700;
        color: #9A9A9A;
    }

    body {
        color: #2c2c2c;
        font-size: 14px;
        font-family: "Montserrat", "Helvetica Neue", Arial, sans-serif;
        overflow-x: hidden;
        -moz-osx-font-smoothing: grayscale;
        -webkit-font-smoothing: antialiased;
    }

    .nav-item .nav-link,
    .nav-tabs .nav-link {
        -webkit-transition: all 300ms ease 0s;
        -moz-transition: all 300ms ease 0s;
        -o-transition: all 300ms ease 0s;
        -ms-transition: all 300ms ease 0s;
        transition: all 300ms ease 0s;
    }

    .card a {
        -webkit-transition: all 150ms ease 0s;
        -moz-transition: all 150ms ease 0s;
        -o-transition: all 150ms ease 0s;
        -ms-transition: all 150ms ease 0s;
        transition: all 150ms ease 0s;
    }

    [data-toggle="collapse"][data-parent="#accordion"] i {
        -webkit-transition: transform 150ms ease 0s;
        -moz-transition: transform 150ms ease 0s;
        -o-transition: transform 150ms ease 0s;
        -ms-transition: all 150ms ease 0s;
        transition: transform 150ms ease 0s;
    }

    [data-toggle="collapse"][data-parent="#accordion"][aria-expanded="true"] i {
        filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=2);
        -webkit-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        transform: rotate(180deg);
    }


    .now-ui-icons {
        display: inline-block;
        font: normal normal normal 14px/1 'Nucleo Outline';
        font-size: inherit;
        speak: none;
        text-transform: none;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    @-webkit-keyframes nc-icon-spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @-moz-keyframes nc-icon-spin {
        0% {
            -moz-transform: rotate(0deg);
        }

        100% {
            -moz-transform: rotate(360deg);
        }
    }

    @keyframes nc-icon-spin {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    .now-ui-icons.objects_umbrella-13:before {
        content: "\ea5f";
    }

    .now-ui-icons.shopping_cart-simple:before {
        content: "\ea1d";
    }

    .now-ui-icons.shopping_shop:before {
        content: "\ea50";
    }

    .now-ui-icons.ui-2_settings-90:before {
        content: "\ea4b";
    }

    .nav-tabs {
        border: 0;
        padding: 15px 0.7rem;
    }

    .nav-tabs:not(.nav-tabs-neutral)>.nav-item>.nav-link.active {
        box-shadow: 0px 5px 35px 0px rgba(0, 0, 0, 0.3);
    }

    .card .nav-tabs {
        border-top-right-radius: 0.1875rem;
        border-top-left-radius: 0.1875rem;
    }

    .nav-tabs>.nav-item>.nav-link {
        color: #888888;
        margin: 0;
        margin-right: 5px;
        background-color: transparent;
        border: 1px solid #eee;
        border-radius: 30px;
        font-size: 14px;
        padding: 11px 23px;
        line-height: 1.5;
    }

    .nav-tabs>.nav-item>.nav-link:hover {
        background-color: #c41d18;
        color: #fff;
    }

    .nav-tabs>.nav-item>.nav-link.active {
        background-color: #c41d18;
        border-radius: 30px;
        color: #FFFFFF;
    }

    .nav-tabs>.nav-item>.nav-link i.now-ui-icons {
        font-size: 14px;
        position: relative;
        top: 1px;
        margin-right: 3px;
    }

    .nav-tabs.nav-tabs-neutral>.nav-item>.nav-link {
        color: #FFFFFF;
    }

    .nav-tabs.nav-tabs-neutral>.nav-item>.nav-link.active {
        background-color: rgba(255, 255, 255, 0.2);
        color: #FFFFFF;
    }

    .card {
        border: 0;
        border-radius: 0.1875rem;
        display: inline-block;
        position: relative;
        width: 100%;
        margin-bottom: 30px;
        box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
    }

    .card .card-header {
        background-color: transparent;
        border-bottom: 0;
        background-color: transparent;
        border-radius: 0;
        padding: 0;
    }

    .card[data-background-color="orange"] {
        background-color: #f96332;
    }

    .card[data-background-color="red"] {
        background-color: #FF3636;
    }

    .card[data-background-color="yellow"] {
        background-color: #FFB236;
    }

    .card[data-background-color="blue"] {
        background-color: #2CA8FF;
    }

    .card[data-background-color="green"] {
        background-color: #15b60d;
    }

    [data-background-color="orange"] {
        background-color: #e95e38;
    }

    [data-background-color="black"] {
        background-color: #2c2c2c;
    }

    [data-background-color]:not([data-background-color="gray"]) {
        color: #FFFFFF;
    }

    [data-background-color]:not([data-background-color="gray"]) p {
        color: #FFFFFF;
    }

    [data-background-color]:not([data-background-color="gray"]) a:not(.btn):not(.dropdown-item) {
        color: #FFFFFF;
    }

    [data-background-color]:not([data-background-color="gray"]) .nav-tabs>.nav-item>.nav-link i.now-ui-icons {
        color: #FFFFFF;
    }


    @font-face {
        font-family: 'Nucleo Outline';
        src: url("https://github.com/creativetimofficial/now-ui-kit/blob/master/assets/fonts/nucleo-outline.eot");
        src: url("https://github.com/creativetimofficial/now-ui-kit/blob/master/assets/fonts/nucleo-outline.eot") format("embedded-opentype");
        src: url("https://raw.githack.com/creativetimofficial/now-ui-kit/master/assets/fonts/nucleo-outline.woff2");
        font-weight: normal;
        font-style: normal;

    }

    .now-ui-icons {
        display: inline-block;
        font: normal normal normal 14px/1 'Nucleo Outline';
        font-size: inherit;
        speak: none;
        text-transform: none;
        /* Better Font Rendering */
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }


    footer{
        margin-top:50px;
        color: #555;
        background: #fff;
        padding: 25px;
        font-weight: 300;
        background: #f7f7f7;

    }
    .footer p{
        margin-bottom: 0;
    }
    footer p a{
        color: #555;
        font-weight: 400;
    }

    footer p a:hover{
        color: #e86c42;
    }

    @media screen and (max-width: 768px) {

        .nav-tabs {
            display: inline-block;
            width: 100%;
            padding-left: 100px;
            padding-right: 100px;
            text-align: center;
        }

        .nav-tabs .nav-item>.nav-link {
            margin-bottom: 5px;
        }
    }
</style>
@section('title', 'Productos')
@section('color-style', 'bg-primary')
@section('content')
    <h4 class="c-grey-900 mB-20 text-primary">Lista de Productos</h4>
    <div class="text-left container mb-3 p-0">
        <a class="btn btn-outline-primary" href="{{ URL::previous() }}"><i class="ti-arrow-left"></i> Volver</a>
        <a href="{{ url('/productos/create') }}" class="btn cur-p btn-outline-success"><i class="ti-plus"></i> NUEVO PRODUCTO</a>
    </div>

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12 col-xs-12 ml-auto col-xl-12 mr-auto">
                <div class="card mt-5">
                    <div class="card-header">
                        <ul class="nav nav-tabs justify-content-center" role="tablist">
                            <!--<li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                                    <i class="now-ui-icons objects_umbrella-13"></i> Home
                                </a>
                            </li>-->
                            <?php $count= 0; ?>
                            @foreach($bodegas as $bodega)
                                <li class="nav-item">
                                    <a id="link_{{ $bodega->id }}" class="nav-link <?= $count === 0 ? 'active': '' ?>" data-toggle="tab" href="#productos_bodega_{{ $bodega->id }}" role="tab">
                                        <i class="now-ui-icons shopping_shop"></i> Bodega <strong>{{ $bodega->codigo }}</strong>
                                    </a>
                                </li>
                                <?php $count++; ?>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-body">
                        <!-- Tab panes -->
                        <div class="tab-content text-center">
                            <!--<div class="tab-pane active" id="home" role="tabpanel">
                                Home
                            </div>-->
                            <?php $count= 0; ?>
                            @foreach($bodegas as $bodega)
                                <div class="mt-3 tab-pane <?= $count === 0 ? 'active': '' ?>" id="productos_bodega_{{ $bodega->id }}" role="tabpanel">
                                   <h4 class="card-title text-danger">Productos Bodega {{ $bodega->codigo }}</h4>

                                    <div class="text-left mb-1 text-info w-auto"> <i class="fa fa-info-circle" data-toggle="tooltip" title="Exportar al formato correspondiente"></i> Exportar productos:</div>
                                    <table id="tablaProductosBodega_{{ $bodega->id }}" class="table table-hover mt-5" cellspacing="0" width="100%" style="overflow: auto;">
                                        <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th class="text-center"><i class="ti-image"></i> Imagen</th>
                                            <th>Nombre</th>
                                            <th>Precio Compra</th>
                                            <th>Precio Venta</th>
                                            <th>Cant. Mostrador</th>
                                            <th>Cant. Bodega</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Código</th>
                                            <th><i class="ti-image"></i> Imagen</th>
                                            <th>Nombre</th>
                                            <th>Precio Compra</th>
                                            <th>Precio Venta</th>
                                            <th>Cant. Mostrador</th>
                                            <th>Cant. Bodega</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        </tbody>
                                    </table>

                                </div>
                                <?php $count++; ?>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script src="{{ asset('js/buttons.html5.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
<script src="{{ asset('js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/jszip.min.js') }}"></script>
<script src="{{ asset('js/buttons.colVis.min.js') }}"></script>
    <style>
        .dropdown-item.active, .dropdown-item:active{
            color: #0c0d0d;
        }
    </style>
<script>
    @if(isset($_GET['search']) and isset($_GET['bodega']))
            var active_tab_selector = $('.nav-tabs > .nav-item > a.active');
            $(active_tab_selector).removeClass('active');
            $(active_tab_selector.attr('href')).removeClass('active');

            $('#link_{{ $_GET["bodega"] }}').addClass(' active');
            $('#productos_bodega_{{ $_GET["bodega"] }}').addClass(' active');
    @endif
</script>

<script>
    @foreach($bodegas as $bodega)
        $(document).ready(function () {
                $("#tablaProductosBodega_{{ $bodega->id }}").DataTable({
                pageLength: 10,
                lengthMenu: [5, 10, 20, 50, 75, 100],
                processing: true,
                serverSide: true,
                @if(isset($_GET['search']) and isset($_GET['bodega']))
                    @if ($_GET['bodega'] == $bodega->id)
                        search: {
                            search: '{{ $_GET['search'] }}',
                        },
                    @endif
                @endif
                ajax: {
                    url: '{{ route('getProductsBodega') }}',
                    type: 'POST',
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'bodega_id': {{ $bodega->id }},
                    },
                },
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
                },
                columns: [
                    {data: 'codigo'},
                    {data: null,
                        render:function (data) {
                            var ruta= data.imagen;
                            var img= '';
                            if (ruta === 'product.png'){

                                img= "<img width='100' src='/storage/"+ruta+"' />";
                            }else{
                                ruta= ruta.replace("public","/storage");
                                img= "<img width='100' src='"+ruta+"' />";
                            }
                            return img;
                        }
                    },
                    {data: 'nombre'},
                    {data: 'precio_compra'},
                    {data: 'precio_venta'},
                    {data: 'mostrador'},
                    {data: 'existencias'},
                    {data: null,
                        render: function (data) {
                            var status= data.estado;
                            if (status === 1 || status === '1'){
                                var estado= '<div class="tdStatus" id="status_'+data.producto_id+'"><span class="badge badge-pill bg-success text-white">ACTIVO</span></div>';
                            }else{
                                var estado= '<div class="tdStatus" id="status_'+data.producto_id+'"><span class="badge badge-pill bg-danger text-white">INACTIVO</span></div>';
                            }
                            return estado;
                        }
                    },
                    {data: null,
                        render: function (data) {
                            var acciones=
                                '<a href="/productos/'+data.id+'/edit" title="Editar Producto" data-toggle="tooltip" class="btn btn-warning m-2"><i class="ti-pencil text-white"></i></a>' +
                                '<a href="/productos/'+data.id+'/traslado" data-toggle="tooltip" title="Realizar Translado" class="btn btn-success m-2"><i class=" ti-exchange-vertical text-white"></i></a>' +
                                '<a href="/productos/'+data.id+'/changeStatus" data-toggle="tooltip" title="Cambiar Estado"   class="btn btn-info m-2"><i class="ti-reload text-white"></i></a>';
                            return acciones;
                        }
                    }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [ 0, ':visible' ]
                        }
                    },
                    /*{
                        extend: 'copy',
                        exportOptions: {
                            columns: [ 0, ':visible' ]
                        }
                    },*/
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [ 0, ':visible' ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [ 0, ':visible' ]
                        }
                    },
                    {
                        extend: 'colvis',
                        text: 'Ocultar Columnas'
                    }
                ]
            });

        });
    @endforeach
    $('[data-toggle="tooltip"]').tooltip();
</script>
<script src="{{ asset('js/scripts/producto.js') }}"></script>
@endsection
