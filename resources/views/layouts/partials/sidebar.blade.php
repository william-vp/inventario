<div>
    <!-- Sidebar ==================== -->
@if (Route::has('login'))
    @if (Auth::check() and Auth::user()->type == "ADMIN" )
        <!--SIDEBAR ADMIN-->
            <div class="sidebar is-collapseed bg-dark">
                <div class="sidebar-inner">
                    <!-- ### $Sidebar Header ### -->
                    <div class="sidebar-logo" style="border-bottom: 1px solid #FFF;">
                        <div class="peers ai-c fxw-nw">
                            <div class="peer peer-greed">
                                <a class="sidebar-link td-n" href="{{ url('/') }}">
                                    <div class="peers ai-c fxw-nw">
                                        <div class="peer">
                                            <div class="logo">
                                                <img src="{{ Storage::url(session('app_logo')) }}" width="70" alt="">
                                            </div>
                                        </div>
                                        <div class="peer peer-greed">
                                            <h5 class="lh-1 mB-0 logo-text text-white">{{session('app_name')}}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="peer">
                                <div class="mobile-toggle sidebar-toggle">
                                    <a href="" class="td-n">
                                        <i class="ti-arrow-circle-left"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ### $Sidebar Menu ### -->
                    <ul class="sidebar-menu scrollable pos-r">
                        <li class="nav-item mT-30 active">
                            <a class="sidebar-link" href="{{ url('/') }}">
                            <span class="icon-holder">
                              <i class="c-blue-500 ti-home"></i>
                            </span>
                                <span class="title">Inicio</span>
                            </a>
                        </li>

                        <li class="nav-item" data-toggle="tooltip" title="Administrar Cajas">
                            <a class="sidebar-link" href="{{ url('/cajas') }}">
                            <span class="icon-holder">
                              <i class="text-white ti-desktop"></i>
                            </span>
                            <span class="title">Cajas</span>
                            </a>
                        </li>

                        <li class="nav-item" data-link="ventas">
                            <a class="sidebar-link" href="#">
                            <span class="icon-holder">
                              <i class="c-cyan-500 ti-shopping-cart"></i>
                            </span>
                                <span class="title">Ventas</span>
                            </a>
                        </li>
                        <!--<li class="nav-item dropdown" data-link="ventas">
                            <a class="dropdown-toggle" href="#">
                        <span class="icon-holder">
                          <i class="c-cyan-500 ti-shopping-cart"></i>
                        </span>
                                <span class="title">Ventas</span>
                                <span class="arrow">
                          <i class="ti-angle-right"></i>
                        </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class='sidebar-link' href="{{ url('/ventas/create') }}"><i class="ti-plus"></i>
                                        Nueva venta</a>
                                </li>
                                <li>
                                    <a class='sidebar-link' href="{{ url('/ventas') }}"><i class="ti-view-list-alt"></i>
                                        Listado de Ventas</a>
                                </li>
                                <li>
                                    <a class='sidebar-link' href="{{ url('/clientes') }}"><i class='fa fa-group'></i>
                                        Clientes</a>
                                </li>
                            </ul>
                        </li>-->

                        <li class="nav-item" data-link="pedidos">
                            <a class="sidebar-link" href="#">
                            <span class="icon-holder">
                              <i class="c-green-500  ti-package"></i>
                            </span>
                                <span class="title">Pedidos</span>
                            </a>
                        </li>
                        <!--<li class="nav-item dropdown" data-link="pedidos">
                            <a class="dropdown-toggle" href="#">
                            <span class="icon-holder">
                                <i class="c-green-500 ti-package"></i>
                            </span>
                            <span class="title">Pedidos</span>
                            <span class="arrow">
                              <i class="ti-angle-right"></i>
                            </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class='sidebar-link' href="{{ url('/pedidos/create') }}"><i class="ti-plus"></i>Nuevo Pedido</a>
                                </li>
                                <li>
                                    <a class='sidebar-link' href="{{ route('pedidos.index') }}">
                                        <i class="ti-view-list-alt"></i>Listado de Pedidos</a>
                                </li>
                                <li>
                                    <a class='sidebar-link' href="{{ url('/proveedores') }}"><i class='fa fa-group'></i>Proveedores</a>
                                </li>
                            </ul>
                        </li>-->

                        <li class="nav-item" data-link="creditos">
                            <a class="sidebar-link" href="#">
                            <span class="icon-holder">
                              <i class="c-red-500 ti-agenda"></i>
                            </span>
                                <span class="title">Creditos</span>
                            </a>
                        </li>
                        <!--<li class="nav-item dropdown" data-link="creditos">
                            <a class="dropdown-toggle" href="#">
                        <span class="icon-holder">
                          <i class="c-red-500 ti-agenda"></i>
                        </span>
                                <span class="title">Creditos</span>
                                <span class="arrow">
                          <i class="ti-angle-right"></i>
                        </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class='sidebar-link' href="{{ url('/creditos') }}"><i class="ti-plus"></i> Ventas
                                        a Credito</a>
                                </li>
                                <li>
                                    <a class='sidebar-link' href="{{ url('/pedidos_credito') }}"><i
                                                class="ti-view-list-alt"></i> Pedidos a Creditos</a>
                                </li>
                            </ul>
                        </li>-->


                        <!--<li class="nav-item">
                          <a class="sidebar-link" href="{{ url('/creditos') }}">
                        <span class="icon-holder">
                          <i class="c-red-500 ti-agenda"></i>
                        </span>
                              <span class="title">Creditos</span>
                          </a>
                      </li>-->

                        <li class="nav-item" data-link="inventario">
                            <a class="sidebar-link" href="#">
                            <span class="icon-holder">
                              <i class="c-yellow-500 ti-layout-grid3"></i>
                            </span>
                                <span class="title">Inventario</span>
                            </a>
                        </li>

                        <!--<li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="#">
                        <span class="icon-holder">
                          <i class="c-yellow-500 ti-layout-grid3"></i>
                        </span>
                                <span class="title">Inventario</span>
                                <span class="arrow">
                          <i class="ti-angle-right"></i>
                        </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class='sidebar-link' href="{{ url('/productos/create') }}"><i
                                                class="ti-plus"></i> Agregar Producto</a>
                                </li>
                                <li>
                                    <a class='sidebar-link' href="{{ url('/productos') }}"><i
                                                class="ti-view-list-alt"></i> Ver Productos</a>
                                </li>
                                <li>
                                    <a class='sidebar-link' href="{{ url('/bodegas') }}"><i class='ti-harddrives'></i>
                                        Bodegas</a>
                                </li>
                                <li>
                                    <a class='sidebar-link' href="{{ url('/unidades_medida') }}"><i class='ti-tag'></i>
                                        Unidades de medida</a>
                                </li>
                                <li>
                                    <a class='sidebar-link' href="{{ url('/categorias') }}"><i class='ti-tag'></i>
                                        Categorias</a>
                                </li>
                            </ul>
                        </li>-->

                        <li class="nav-item">
                            <a class="sidebar-link" href="{{ url('/usuarios') }}">
                        <span class="icon-holder">
                          <i class="c-green-500 ti-user"></i>
                        </span>
                                <span class="title">Usuarios</span>
                            </a>
                        </li>


                        <li class="nav-item" data-link="reportes">
                            <a class="sidebar-link" href="#">
                        <span class="icon-holder">
                          <i class="c-blue-500 ti-pie-chart"></i>
                        </span>
                                <span class="title">Reportes</span>
                            </a>
                        </li>

                        <!--<li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="#">
                        <span class="icon-holder">
                          <i class="c-blue-500 ti-pie-chart"></i>
                        </span>
                                <span class="title">Reportes</span>
                                <span class="arrow">
                          <i class="ti-angle-right"></i>
                        </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class='sidebar-link' href="{{ url('/reportes/productos_mas_vendidos') }}"><i
                                                class="ti-bar-chart-alt"></i> Productos más vendidos</a>
                                </li>
                                <li>
                                    <a class='sidebar-link' href="{{ url('/reportes/productos_menos_vendidos') }}"><i
                                                class="ti-bar-chart"></i> Productos menos vendidos</a>
                                </li>
                                <li>
                                    <a class='sidebar-link' href="{{ url('/reportes/ventas_mes') }}"><i
                                                class="ti-agenda"></i> Ventas del mes</a>
                                </li>
                                <li>
                                    <a class='sidebar-link' href="{{ url('/reportes/utilidad_productos') }}"><i
                                                class="ti-clipboard"></i> Utilidad de productos Vendidos</a>
                                </li>
                                <li>
                                    <a class='sidebar-link' href="{{ url('/reportes/ingresos_egresos') }}"><i
                                                class="ti-pulse"></i> Ingresos / Egresos</a>
                                </li>
                                <li>
                                    <a class='sidebar-link' href="{{ url('/reportes/ventas_creditos') }}"><i
                                                class="ti-shopping-cart"></i> Ventas / Creditos</a>
                                </li>
                                <li>
                                    <a class='sidebar-link' href="{{ url('/reportes/cajas') }}"><i
                                                class="ti-calendar"></i> Historial Cajas</a>
                                </li>

                            </ul>
                        </li>-->

                        <li class="nav-item">
                            <a class="sidebar-link" href="{{ url('/general') }}">
                        <span class="icon-holder">
                          <i class="c-red-500 ti-settings"></i>
                        </span>
                                <span class="title">Ajustes</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <!--SIDEBAR ADMIN-->
    @endif
    @if (Auth::check() and Auth::user()->type == "USER" )
        <!--SIDEBAR USER-->
            <div class="sidebar">
                <div class="sidebar-inner">
                    <!-- ### $Sidebar Header ### -->
                    <div class="sidebar-logo">
                        <div class="peers ai-c fxw-nw">
                            <div class="peer peer-greed">
                                <a class="sidebar-link td-n" href="{{ url('/') }}">
                                    <div class="peers ai-c fxw-nw">
                                        <div class="peer">
                                            <div class="logo">
                                                <img src="{{ Storage::url(session('app_logo')) }}" width="70" alt="">
                                            </div>
                                        </div>
                                        <div class="peer peer-greed">
                                            <h5 class="lh-1 mB-0 logo-text">{{session('app_name')}}</h5>
                                        </div>

                                    </div>
                                </a>
                            </div>
                            <div class="peer">
                                <div class="mobile-toggle sidebar-toggle">
                                    <a href="" class="td-n">
                                        <i class="ti-arrow-circle-left"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ### $Sidebar Menu ### -->
                    <ul class="sidebar-menu scrollable pos-r">
                        <li class="nav-item mT-30 active">
                            <a class="sidebar-link" href="{{ url('/') }}">
                        <span class="icon-holder">
                          <i class="c-blue-500 ti-home"></i>
                        </span>
                                <span class="title">Inicio</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <!--SIDEBAR USER-->
    @endif
    @if (Auth::check() and Auth::user()->type == "VENDEDOR" )
        <!--SIDEBAR VENDEDOR-->
            <div class="sidebar">
                <div class="sidebar-inner">
                    <!-- ### $Sidebar Header ### -->
                    <div class="sidebar-logo">
                        <div class="peers ai-c fxw-nw">
                            <div class="peer peer-greed">
                                <a class="sidebar-link td-n" href="{{ url('/') }}">
                                    <div class="peers ai-c fxw-nw">
                                        <div class="peer">
                                            <div class="logo">
                                                <img src="{{ Storage::url(session('app_logo')) }}" width="70" alt="">
                                            </div>
                                        </div>
                                        <div class="peer peer-greed">
                                            <h5 class="lh-1 mB-0 logo-text">{{session('app_name')}}</h5>
                                        </div>

                                    </div>
                                </a>
                            </div>
                            <div class="peer">
                                <div class="mobile-toggle sidebar-toggle">
                                    <a href="" class="td-n">
                                        <i class="ti-arrow-circle-left"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ### $Sidebar Menu ### -->
                    <ul class="sidebar-menu scrollable pos-r">
                        <li class="nav-item mT-30 active">
                            <a class="sidebar-link" href="{{ url('/') }}">
                        <span class="icon-holder">
                          <i class="c-blue-500 ti-home"></i>
                        </span>
                                <span class="title">Inicio</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="sidebar-link" href="{{ url('/cajas') }}">
                        <span class="icon-holder">
                          <i class="text-dark ti-desktop"></i>
                        </span>
                                <span class="title">Cajas</span>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="#">
                        <span class="icon-holder">
                          <i class="c-cyan-500 ti-shopping-cart"></i>
                        </span>
                                <span class="title">Facturación</span>
                                <span class="arrow">
                          <i class="ti-angle-right"></i>
                        </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class='sidebar-link' href="{{ url('/ventas/create') }}"><i class="ti-plus"></i>
                                        Nueva venta</a>
                                </li>
                                <li>
                                    <a class='sidebar-link' href="{{ url('/ventas') }}"><i class="ti-view-list-alt"></i>
                                        Listado de Ventas</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="#">
                        <span class="icon-holder">
                          <i class="c-red-500 ti-agenda"></i>
                        </span>
                                <span class="title">Creditos</span>
                                <span class="arrow">
                          <i class="ti-angle-right"></i>
                        </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class='sidebar-link' href="{{ url('/creditos') }}"><i class="ti-plus"></i> Ventas
                                        a Credito</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
            <!--SIDEBAR VENDEDOR-->
    @endif
@endif

</div>