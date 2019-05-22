@extends('layouts.app')
@section('title', 'Reporte de ventas')
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
                            <div class="col-sm-1">
                                <label></label><br>
                                <a href="{{ url('/reportes/ventas_mes') }}"  data-toggle="tooltip" title="Quitar Filtro" class="btn btn-danger"><i class="ti-close"></i></a>
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
                            </div>


                        </form>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-2">
                            <table id="datatable" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Venta/Cliente</th>
                                    <th>Valor</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ventas as $venta)
                                    <tr>
                                        <td><strong>{{ $venta->id }}</strong><br> {{ $venta->nombreCliente }}</td>
                                        @if ($venta->total === null)
                                            <td>0</td>
                                        @else
                                            <td>{{ number_format($venta->total, 0, ',','.') }}</td>
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
        /*
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

    */
    </script>

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
                    text: 'Total Venta'
                }
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br/>$' +
                        this.point.y + ' ' + this.point.name.toLowerCase();
                }
            }
        });
    </script>
    <script src="{{ asset('js/scripts/reporte.js') }}"></script>
@endsection
