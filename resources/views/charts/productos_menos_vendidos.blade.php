@extends('layouts.app')
@section('title', 'Reporte de productos menos vendidos')
@section('color-style', 'bg-info')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="form">
                    <form id="formFiltrarProductos" name="formFiltrarProductos" method="GET">
                        <div class="row">

                        <?php if (isset($_GET['fechaIni']) and isset($_GET['fechaFin'])){ ?>
                        <!--
                            <div class="col-sm-1">
                                <label></label><br>
                                <a href="{{ url('/reportes/productos_menos_vendidos') }}"  data-toggle="tooltip" title="Quitar Filtro" class="btn btn-danger"><i class="ti-close"></i></a>
                            </div>
                            <div class="col-sm-3">
                                <label><i class="ti-calendar"></i> Fecha Inicio</label>
                                <input type="date" id="fechaIni" value="<?=$_GET['fechaIni']?>" name="fechaIni" class="form-control" name="">
                            </div>

                            <div class="col-sm-3">
                                <label><i class="ti-calendar"></i> Fecha Finalización</label>
                                <input type="date" id="fechaFin" value="<?=$_GET['fechaFin']?>" name="fechaFin" class="form-control" name="">
                            </div>
                            -->
                        <?php }else{ ?>
                            <!--
                            <div class="col-sm-3">
                                <label><i class="ti-calendar"></i> Fecha Inicio</label>
                                <input type="date" id="fechaIni" name="fechaIni" class="form-control" name="">
                            </div>

                            <div class="col-sm-3">
                                <label><i class="ti-calendar"></i> Fecha Finalización</label>
                                <input type="date" id="fechaFin" name="fechaFin" class="form-control" name="">
                            </div>-->
                        <?php } ?>

                        </div><br>

                        
                    </form>
                </div>

                <div class="row mt-5">
                    <div class="col-md-2">
                        <table id="datatable" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Id/Producto</th>
                                <th>Cantidad Vendida</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($productos as $producto)
                                <tr>
                                    <td><strong>{{ $producto->id }}</strong><br> {{ $producto->nombre }}</td>
                                    @if ($producto->total_ventas === null)
                                        <td>0</td>
                                    @else
                                        <td>{{ $producto->total_ventas }}</td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="panel-body col-md-10" id="containerChart">
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/highcharts7.11.js') }}"></script>
<script src="{{ asset('js/data_highcharts.js') }}"></script>
<script src="{{ asset('js/exporting.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/export-data-highcharts.js')}}" type="text/javascript"></script>

<script type="text/javascript">
    Highcharts.chart('containerChart', {
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Reporte de Ventas'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Cantidad vendida'
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' ' + this.point.name.toLowerCase();
            }
        }
    });

    /*Highcharts.chart('containerChart', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Productos menos vendidos'
    },
    tooltip: {
        pointFormat: '{series.name} <b>{point.y}</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.y}',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            },
            showInLegend: true
        }
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'Cantidad:',
        colorByPoint: true,
        data: [

        <?php  for($i= 0; $i < count($productos); $i++){ ?>
        {
            name: '<?=$productos[$i]->nombre ?>',
            y: <?=$productos[$i]->total_ventas?>
        }
        <?php if (count($productos)-1 != $i){
            echo ",";
        } ?>

    <?php } ?>

        ]
    }]
});*/


</script>
<script src="{{ asset('js/scripts/reporte.js') }}"></script>
@endsection
