@extends('layouts.app')
@section('title', 'Reporte de Utilidad de productos vendidos')
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
                                <a href="{{ url('/reportes/utilidad_productos') }}"  data-toggle="tooltip" title="Quitar Filtro" class="btn btn-danger"><i class="ti-close"></i></a>
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
                                    <th>Producto/Cantidad Vendida</th>
                                    <th>Utilidad</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($productos as $producto)
                                    <tr>
                                        <td>{{ $producto->nombre }} <br> <strong>{{ $producto->total_ventas }}</strong> </td>
                                        <?php
                                            $precio_compra= $producto->precio_compra;
                                            $precio_venta= $producto->precio_venta;
                                            $utilidad= $precio_venta - $precio_compra;
                                        ?>
                                        <td>{{ number_format($utilidad, 0, ',','.') }}</td>
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
                    text: 'Valor Utilidad'
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
