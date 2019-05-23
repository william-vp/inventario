@extends('layouts.app')
@section('title', 'Reporte de Ingresos-Egresos')
@section('color-style', 'bg-info')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="form">
                    <form id="formFiltrarVentasCreditos" name="formFiltrarVentasCreditos" method="GET">
                        <div class="row">

                        <?php if (isset($_GET['fechaIni']) and isset($_GET['fechaFin'])){ ?>
                            <div class="col-sm-1">
                                <label></label><br>
                                <a href="{{ url('/reportes/ingresos_egresos') }}"  data-toggle="tooltip" title="Quitar Filtro" class="btn btn-danger"><i class="ti-close"></i></a>
                            </div>

                            <div class="col-sm-3">
                                <label><i class="ti-calendar"></i> Fecha Inicio</label>
                                <input type="date" id="fechaIni" value="<?=$_GET['fechaIni']?>" name="fechaIni" class="form-control" name="">
                            </div>

                            <div class="col-sm-3">
                                <label><i class="ti-calendar"></i> Fecha Finalización</label>
                                <input type="date" id="fechaFin" value="<?=$_GET['fechaFin']?>" name="fechaFin" class="form-control" name="">
                            </div>
                        <?php }else{ ?>

                            <div class="col-sm-3">
                                <label><i class="ti-calendar"></i> Fecha Inicio</label>
                                <input type="date" id="fechaIni" name="fechaIni" class="form-control" name="">
                            </div>

                            <div class="col-sm-3">
                                <label><i class="ti-calendar"></i> Fecha Finalización</label>
                                <input type="date" id="fechaFin" name="fechaFin" class="form-control" name="">
                            </div>
                        <?php } ?>

                            <div class="col-sm-3">
                                <label></label><br>
                                <button class="btn btn-success btnFilter" type="submit"><i class="ti-filter"></i>Filtrar</button>
                            </div>

                        </div><br>
                        
                        
                    </form>
                </div>

                <div class="panel-body" id="containerChart">
                </div>
 
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
<script type="text/javascript">
    
    Highcharts.createElement('link', {
    href: 'https://fonts.googleapis.com/css?family=Dosis:400,600',
    rel: 'stylesheet',
    type: 'text/css'
}, null, document.getElementsByTagName('head')[0]);

Highcharts.theme = {
    colors: ['#7cb5ec', '#f7a35c', '#90ee7e', '#7798BF', '#aaeeee', '#ff0066',
        '#eeaaee', '#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],
    chart: {
        backgroundColor: null,
        style: {
            fontFamily: 'Doris, sans-serif'
        }
    },
    title: {
        style: {
            fontSize: '16px',
            fontWeight: 'bold',
            textTransform: 'uppercase'
        }
    },
    tooltip: {
        borderWidth: 0,
        backgroundColor: 'rgba(219,219,216,0.8)',
        shadow: false
    },
    legend: {
        itemStyle: {
            fontWeight: 'bold',
            fontSize: '13px'
        }
    },
    xAxis: {
        gridLineWidth: 1,
        labels: {
            style: {
                fontSize: '12px'
            }
        }
    },
    yAxis: {
        minorTickInterval: 'auto',
        title: {
            style: {
                textTransform: 'uppercase'
            }
        },
        labels: {
            style: {
                fontSize: '12px'
            }
        }
    },
    plotOptions: {
        candlestick: {
            lineColor: '#404048'
        }
    },


    // General
    background2: '#F0F0EA'

};

// Apply the theme
Highcharts.setOptions(Highcharts.theme);

</script>

<script type="text/javascript">
    Highcharts.chart('containerChart', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Ingresos / Egresos'
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
        name: 'Valor:',
        colorByPoint: true,
        data: [
            {
                name: "Ingresos",
                y: <?=$ingresos?>
            },
            {
                name: "Egresos",
                y: <?=$egresos?>
            }

        ]
    }]
});


</script>
<script src="{{ asset('js/scripts/reporte.js') }}"></script>
@endsection
