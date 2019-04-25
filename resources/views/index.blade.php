@extends('layouts.app')

@section('title', 'Inicio')
@section('color-style', 'bg-info')
@section('content')
<script type="text/javascript" src="{{ asset('js/numscroller.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/scripts/principal.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/fullcalendar.min.css') }}"/>
<style type="text/css">
    .fc-today{
        background: red;
        color: #fff;
    }
    .fc td{
        color: red;
        font-weight: 500;
    }
    .fc-title{
        color: #fff;
        font-weight: 700;
        text-align: center;
    }
    .fc-content, .fc-event{
        background: #FF6E56;
        border: 1px solid transparent;
        text-align: center;
    }
    input{
        padding: 10px;
        border: 1px solid #eee;
        margin-bottom: 5px;
    }
    input:focus{
        border: 1px solid #cd595a;
    }
    .dolar-colombia-widget a{
        color: transparent;
        cursor: none;
    }
    .dolar-colombia-widget img{
        width: 40px;
        height: 20px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-3 col-xs-6 text-center mb-3">
            <div class="bdrs-3 ov-h bgc-white border-0">
                <div class="ta-c p-30 bg-success">
                    <h1 class="fw-300 mB-5 lh-1 c-white numscroller" data-slno='1' data-min='0' data-max='{{ $usuarios }}' data-delay='.5' data-increment="1"> <span class="fsz-def"></span></h1>
                    <h3 class="c-white">Usuarios</h3>
                </div>
                <div class="pos-r">
                    <button type="button" class="mT-nv-50 pos-a r-10 t-2 btn cur-p bdrs-50p p-0 w-3r h-3r btn-success mb-3 border-white">
                        <i class="ti-user"></i>
                    </button>
                    <ul class="m-0 p-0 mT-20 mb-3">
                    </ul>
                </div>
            </div>
            <!--<h6 class="text-info font-weight-bold">CONVERSOR DE MONEDA</h6>
                <form action="#" method="post" id="formCurrency" name="formCurrency">
                @csrf
                    <div class="form-group">
                        <label class="font-weight-bold"><span class="fa fa-dollar"></span>Valor en Dólares: </label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Valor en Dólares" name="input1" id="input1" value="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold"><span class="fa fa-dollar"></span> Valor En Pesos Colombianos: </label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Valor en Pesos Colombianos" name="input2" id="input2" value="">
                        </div>
                    </div>
                </form>
                <script src="https://www.dolar-colombia.com/widget.js?t=3&c=1"></script>-->
        </div>

        <div class="col-md-3 col-xs-6">
            <div class="bdrs-3 ov-h bgc-white border-0">
                <div class="bgc-deep-orange-400 ta-c p-30">
                    <h1 class="fw-300 mB-5 lh-1 c-white numscroller" data-slno='1' data-min='0' data-max='{{ $producto }}' data-delay='.5' data-increment="1"><span class="fsz-def"></span></h1>
                    <h3 class="c-white">Productos</h3>
                </div>
                <div class="pos-r">
                    <button type="button" class="text-white mT-nv-50 pos-a r-10 t-2 btn cur-p bdrs-50p p-0 w-3r h-3r btn-warning mb-3 border-white">
                        <i class="ti-layout-grid3"></i>
                    </button>
                    <ul class="m-0 p-0 mT-20 mb-3">
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-xs-6">
            <div class="bdrs-3 ov-h bgc-white border-0">
                <div class="bg-primary ta-c p-30">
                    <h1 class="fw-300 mB-5 lh-1 c-white numscroller" data-slno='1' data-min='0' data-max='{{ $ventas }}' data-delay='.5' data-increment="1">{{ $ventas }}<span class="fsz-def"></span></h1>
                    <h3 class="c-white">Ventas</h3>
                </div>
                <div class="pos-r">
                    <button type="button" class="mT-nv-50 pos-a r-10 t-2 btn cur-p bdrs-50p p-0 w-3r h-3r btn-danger mb-3 border-white">
                        <i class="ti-shopping-cart"></i>
                    </button>
                    <ul class="m-0 p-0 mT-20 mb-3">
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-xs-6">
            <div class="bdrs-3 ov-h bgc-white border-0">
                <div class="bg-info ta-c p-30">
                    <h1 class="fw-300 mB-5 lh-1 c-white numscroller" data-slno='1' data-min='0' data-max='{{ $pedidos }}' data-delay='.5' data-increment="1">{{ $pedidos }}<span class="fsz-def"></span></h1>
                    <h3 class="c-white">Pedidos</h3>
                </div>
                <div class="pos-r">
                    <button type="button" class="mT-nv-50 pos-a r-10 t-2 btn cur-p bdrs-50p p-0 w-3r h-3r btn-info mb-3 border-white">
                        <i class="ti-package"></i>
                    </button>
                    <ul class="m-0 p-0 mT-20 mb-3">
                    </ul>
                </div>
            </div>
        </div>

    </div>

    <div class="row mt-4">
        <div class="col-xs-12 col-lg-5 col-sm-12">
            <h6 class="text-info font-weight-bold">PRODUCTOS RECIENTEMENTE AÑADIDOS</h6>
            <table id="tablaCajas" class="table table-hover" cellspacing="0" width="100%">
                <thead class="bg-info text-white">
                <tr align="center">
                    <th><i class="ti-image"></i></th>
                    <th>Id</th>
                    <th>Nombre</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($agregados as $producto)
                            <tr  align="center">
                                <td><img src="{{ Storage::url($producto->imagen) }}" width="60"></td>
                                <td>{{ $producto->id }}</td>
                                <td>{{ $producto->nombre }}</td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <div class="row mt-4">
        <div class="col-xs-12 col-lg-8 col-sm-12">
            <h4 class="text-info text-center">CALENDARIO</h4>
            <div id="calendar"></div>
        </div>
    </div>

</div>


<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/fullcalendar.min.js') }}"></script>
<script src="{{ asset('js/locale/es-us.js') }}"></script>

<script type="text/javascript">
$(function() {
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listWeek'
        },
        defaultDate: '<?=date("Y-m-d")?>',
        navLinks: true, // can click day/week names to navigate views
        editable: false,
        eventLimit: true, // allow "more" link when too many events
        locale: 'es-us',
        lang: 'es-us',
        events: [
        {
            title: 'Hoy',
            start: '<?=date("Y-m-d")?>',
        }
        ]
    });
});  
    
</script>
@endsection


