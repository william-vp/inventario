<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> {{session('app_name')}} | @yield('title', 'Inicio') </title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buttons.dataTables.min.css') }}">
    <link rel="icon" href="{{ Storage::url(session('app_logo')) }}"/>

    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/toastr.js') }}"></script>
    <script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>

    <script type="text/javascript">
      $(document).ready(function(){
        $('#tdarrow').on('click', function () {
            if ($(".tdmob").is(":visible") == true){
              $(".tdmob").hide();
              document.getElementById("icontdarrow").className= "ti-arrow-circle-down";
            }else{
              $(".tdmob").show();
              document.getElementById("icontdarrow").className= "ti-arrow-circle-up";
            }
        });

       $('.sidebar .sidebar-menu li a').on('click', function () {
        const $this = $(this);

        if ($this.parent().hasClass('open')) {
          $this
            .parent()
            .children('.dropdown-menu')
            .slideUp(200, () => {
              $this.parent().removeClass('open');
            });
        } else {
          $this
            .parent()
            .parent()
            .children('li.open')
            .children('.dropdown-menu')
            .slideUp(200);

          $this
            .parent()
            .parent()
            .children('li.open')
            .children('a')
            .removeClass('open');

          $this
            .parent()
            .parent()
            .children('li.open')
            .removeClass('open');

          $this
            .parent()
            .children('.dropdown-menu')
            .slideDown(200, () => {
              $this.parent().addClass('open');
            });
        }
      });

           const sidebarLinks = $('.sidebar').find('.sidebar-link');

      sidebarLinks
        .each((index, el) => {
          $(el).removeClass('active');
        })
        .filter(function () {
          const href = $(this).attr('href');
          const pattern = href[0] === '/' ? href.substr(1) : href;
          return pattern === (window.location.pathname).substr(1);
        })
        .addClass('active');

      // ٍSidebar Toggle
      $('.sidebar-toggle').on('click', e => {
        $('.app').toggleClass('is-collapsed');
        e.preventDefault();
      });

      /**
       * Wait untill sidebar fully toggled (animated in/out)
       * then trigger window resize event in order to recalculate
       * masonry layout widths and gutters.
       */
      $('#sidebar-toggle').click(e => {
        e.preventDefault();
        setTimeout(() => {
          window.dispatchEvent(window.EVENT);
        }, 300);
      });

       }); 
    </script>
    <style>
      #loader {
        transition: all 0.3s ease-in-out;
        opacity: 1;
        visibility: visible;
        position: fixed;
        height: 100vh;
        width: 100%;
        background: #fff;
        z-index: 90000;
      }

      #loader.fadeOut {
        opacity: 0;
        visibility: hidden;
      }

      .spinner {
        width: 40px;
        height: 40px;
        position: absolute;
        top: calc(50% - 20px);
        left: calc(50% - 20px);
        background-color: red;
        border-radius: 100%;
        -webkit-animation: sk-scaleout 1.0s infinite ease-in-out;
        animation: sk-scaleout 1.0s infinite ease-in-out;
      }

      #tdarrow{
        display: none;
      }

      @media (max-width: 576px){
          #tdarrow{
            display: block;
          }
      }

      @-webkit-keyframes sk-scaleout {
        0% { -webkit-transform: scale(0) }
        100% {
          -webkit-transform: scale(1.0);
          opacity: 0;
        }
      }

      @keyframes sk-scaleout {
        0% {
          -webkit-transform: scale(0);
          transform: scale(0);
        } 100% {
          -webkit-transform: scale(1.0);
          transform: scale(1.0);
          opacity: 0;
        }
      }
    </style>
  </head>
  <body class="app">
    <div id='loader'>
      <div class="spinner"></div>
    </div>

    <script>
      window.addEventListener('load', () => {
        const loader = document.getElementById('loader');
        setTimeout(() => {
          loader.classList.add('fadeOut');
        }, 300);
      });
    </script>

    <!-- @App Content -->
    <!-- =================================================== -->
    <div>
      <!-- #Left Sidebar ==================== -->


      @if (Route::has('login'))
              @if (Auth::check() and Auth::user()->type == "ADMIN" )
                <!--SIDEBAR ADMIN-->
              <div class="sidebar is-collapsed">
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
                        <span class="title">Ventas</span>
                        <span class="arrow">
                          <i class="ti-angle-right"></i>
                        </span>
                      </a>
                      <ul class="dropdown-menu">
                        <li>
                          <a class='sidebar-link' href="{{ url('/ventas/create') }}"><i class="ti-plus"></i> Nueva venta</a>
                        </li>
                        <li>
                          <a class='sidebar-link' href="{{ url('/ventas') }}"><i class="ti-view-list-alt"></i> Listado de Ventas</a>
                        </li>
                        <li>
                          <a class='sidebar-link' href="{{ url('/clientes') }}"><i class='fa fa-group'></i> Clientes</a>
                        </li>
                      </ul>
                    </li>

                    <li class="nav-item dropdown">
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
                          <a class='sidebar-link' href="{{ url('/pedidos/create') }}"><i class="ti-plus"></i> Nuevo Pedido</a>
                        </li>
                        <li>
                          <a class='sidebar-link' href="{{ route('pedidos.index') }}"><i class="ti-view-list-alt"></i> Listado de Pedidos</a>
                        </li>
                        <li>
                          <a class='sidebar-link' href="{{ url('/proveedores') }}"><i class='fa fa-group'></i> Proveedores</a>
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
                          <a class='sidebar-link' href="{{ url('/creditos') }}"><i class="ti-plus"></i> Ventas a Credito</a>
                        </li>
                        <li>
                          <a class='sidebar-link' href="{{ url('/pedidos_credito') }}"><i class="ti-view-list-alt"></i> Pedidos a Creditos</a>
                        </li>
                      </ul>
                    </li>


                      <!--<li class="nav-item">
                          <a class="sidebar-link" href="{{ url('/creditos') }}">
                        <span class="icon-holder">
                          <i class="c-red-500 ti-agenda"></i>
                        </span>
                              <span class="title">Creditos</span>
                          </a>
                      </li>-->


                    <li class="nav-item dropdown">
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
                          <a class='sidebar-link' href="{{ url('/productos/create') }}"><i class="ti-plus"></i> Agregar Producto</a>
                        </li>
                        <li>
                          <a class='sidebar-link' href="{{ url('/productos') }}"><i class="ti-view-list-alt"></i> Ver Productos</a>
                        </li>
                        <li>
                            <a class='sidebar-link' href="{{ url('/unidades_medida') }}"><i class='ti-tag'></i> Unidades de medida</a>
                        </li>
                        <li>
                          <a class='sidebar-link' href="{{ url('/categorias') }}"><i class='ti-tag'></i> Categorias</a>
                        </li>
                      </ul>
                    </li>

                      <li class="nav-item">
                          <a class="sidebar-link" href="{{ url('/usuarios') }}">
                        <span class="icon-holder">
                          <i class="c-green-500 ti-user"></i>
                        </span>
                              <span class="title">Usuarios</span>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a class="sidebar-link" href="{{ url('/general') }}">
                        <span class="icon-holder">
                          <i class="c-red-500 ti-settings"></i>
                        </span>
                              <span class="title">Ajustes</span>
                          </a>
                      </li>

                      <li class="nav-item dropdown">
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
                            <a class='sidebar-link' href="{{ url('/reportes/productos_mas_vendidos') }}"><i class="ti-bar-chart-alt"></i> Productos más vendidos</a>
                        </li>
                        <li>
                            <a class='sidebar-link' href="{{ url('/reportes/productos_menos_vendidos') }}"><i class="ti-bar-chart"></i> Productos menos vendidos</a>
                        </li>
                      <li>
                          <a class='sidebar-link' href="{{ url('/reportes/ventas_mes') }}"><i class="ti-agenda"></i> Ventas del mes</a>
                      </li>
                        <li>
                          <a class='sidebar-link' href="{{ url('/reportes/utilidad_productos') }}"><i class="ti-clipboard"></i> Utilidad de productos Vendidos</a>
                        </li>
                        <li>
                            <a class='sidebar-link' href="{{ url('/reportes/ventas_creditos') }}"><i class="ti-shopping-cart"></i> Ventas / Creditos</a>
                        </li>
                        <li>
                            <a class='sidebar-link' href="{{ url('/reportes/cajas') }}"><i class="ti-calendar"></i> Historial Cajas</a>
                        </li>

                      </ul>
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
                                <img src="{{ Storage::url(session('app_logo')) }}"  width="70"  alt="">
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
                                <img src="{{ Storage::url(session('app_logo')) }}"  width="70"  alt="">
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
                          <a class='sidebar-link' href="{{ url('/ventas/create') }}"><i class="ti-plus"></i> Nueva venta</a>
                        </li>
                        <li>
                          <a class='sidebar-link' href="{{ url('/ventas') }}"><i class="ti-view-list-alt"></i> Listado de Ventas</a>
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
                          <a class='sidebar-link' href="{{ url('/creditos') }}"><i class="ti-plus"></i> Ventas a Credito</a>
                        </li>
                      </ul>
                    </li>

                  </ul>
                </div>
              </div>
              <!--SIDEBAR VENDEDOR-->
              @endif
      @endif





      <!-- #Main ============================ -->
      <div class="page-container" >
        <!-- ### $Topbar ### -->
        <div class="header navbar" style="background: rgba(255, 255, 255, 0.95);">
          <div class="header-container">
            <ul class="nav-left">
              <li>
                <a id='sidebar-toggle' class="sidebar-toggle" href="javascript:void(0);">
                  <i class="ti-menu"></i>
                </a>
              </li>
              <!--<li class="search-box">
                <a class="search-toggle no-pdd-right" href="javascript:void(0);">
                  <i class="search-icon ti-search pdd-right-10"></i>
                  <i class="search-icon-close ti-close pdd-right-10"></i>
                </a>
              </li>-->
              <li class="search-input">
                <input class="form-control" type="text" placeholder="Search...">
              </li>
              
              @if (session('caja_id') != null)
                <li>
                  <a  href="{{ url('/cajas') }}">
                    <i class="ti-desktop"></i> <strong id="idCaja">CAJA {{ session('caja_id') }}  </strong>
                  </a>
                </li>
              @endif
                <li id="tdarrow"  data-toggle="tooltip" title="Expandir/Minimizar Nav">
                    <a  href="#">
                      <i class="ti-arrow-circle-up" id="icontdarrow"></i>
                    </a>
                </li>

                <li class="tdmob">
                  <a  href="#">
                     <?php 
                    setlocale(LC_ALL,"es_ES");
                    $fecha= strftime("%A %d de %B del %Y");
                    ?>
                    <i class="ti-calendar"></i> <strong>{{ucfirst($fecha)}}</strong>
                  </a>
                </li>
            
            </ul>



            @if (Route::has('login'))
              @if (Auth::check())
            <ul class="nav-right tdmob">
            
              <!--<li class="notifications dropdown">
                <span class="counter bgc-red">3</span>
                <a href="" class="dropdown-toggle no-after" data-toggle="dropdown">
                  <i class="ti-bell"></i>
                </a>

                <ul class="dropdown-menu">
                  <li class="pX-20 pY-15 bdB">
                    <i class="ti-bell pR-10"></i>
                    <span class="fsz-sm fw-600 c-grey-900">Notifications</span>
                  </li>
                  <li>
                    <ul class="ovY-a pos-r scrollable lis-n p-0 m-0 fsz-sm">
                      <li>
                        <a href="" class='peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100'>
                          <div class="peer mR-15">
                            <img class="w-3r bdrs-50p" src="https://randomuser.me/api/portraits/men/1.jpg" alt="">
                          </div>
                          <div class="peer peer-greed">
                            <span>
                              <span class="fw-500">John Doe</span>
                              <span class="c-grey-600">liked your <span class="text-dark">post</span>
                              </span>
                            </span>
                            <p class="m-0">
                              <small class="fsz-xs">5 mins ago</small>
                            </p>
                          </div>
                        </a>
                      </li>
                      <li>
                        <a href="" class='peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100'>
                          <div class="peer mR-15">
                            <img class="w-3r bdrs-50p" src="https://randomuser.me/api/portraits/men/2.jpg" alt="">
                          </div>
                          <div class="peer peer-greed">
                            <span>
                              <span class="fw-500">Moo Doe</span>
                              <span class="c-grey-600">liked your <span class="text-dark">cover image</span>
                              </span>
                            </span>
                            <p class="m-0">
                              <small class="fsz-xs">7 mins ago</small>
                            </p>
                          </div>
                        </a>
                      </li>
                      <li>
                        <a href="" class='peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100'>
                          <div class="peer mR-15">
                            <img class="w-3r bdrs-50p" src="https://randomuser.me/api/portraits/men/3.jpg" alt="">
                          </div>
                          <div class="peer peer-greed">
                            <span>
                              <span class="fw-500">Lee Doe</span>
                              <span class="c-grey-600">commented on your <span class="text-dark">video</span>
                              </span>
                            </span>
                            <p class="m-0">
                              <small class="fsz-xs">10 mins ago</small>
                            </p>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="pX-20 pY-15 ta-c bdT">
                    <span>
                      <a href="" class="c-grey-600 cH-blue fsz-sm td-n">View All Notifications <i class="ti-angle-right fsz-xs mL-10"></i></a>
                    </span>
                  </li>
                </ul>
              </li>-->
              <!--<li class="notifications dropdown">
                <span class="counter bgc-blue">3</span>
                <a href="" class="dropdown-toggle no-after" data-toggle="dropdown">
                  <i class="ti-email"></i>
                </a>

                <ul class="dropdown-menu">
                  <li class="pX-20 pY-15 bdB">
                    <i class="ti-email pR-10"></i>
                    <span class="fsz-sm fw-600 c-grey-900">Emails</span>
                  </li>
                  <li>
                    <ul class="ovY-a pos-r scrollable lis-n p-0 m-0 fsz-sm">
                      <li>
                        <a href="" class='peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100'>
                          <div class="peer mR-15">
                            <img class="w-3r bdrs-50p" src="https://randomuser.me/api/portraits/men/1.jpg" alt="">
                          </div>
                          <div class="peer peer-greed">
                            <div>
                              <div class="peers jc-sb fxw-nw mB-5">
                                <div class="peer">
                                  <p class="fw-500 mB-0">John Doe</p>
                                </div>
                                <div class="peer">
                                  <small class="fsz-xs">5 mins ago</small>
                                </div>
                              </div>
                              <span class="c-grey-600 fsz-sm">
                                Want to create your own customized data generator for your app...
                              </span>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li>
                        <a href="" class='peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100'>
                          <div class="peer mR-15">
                            <img class="w-3r bdrs-50p" src="https://randomuser.me/api/portraits/men/2.jpg" alt="">
                          </div>
                          <div class="peer peer-greed">
                            <div>
                              <div class="peers jc-sb fxw-nw mB-5">
                                <div class="peer">
                                  <p class="fw-500 mB-0">Moo Doe</p>
                                </div>
                                <div class="peer">
                                  <small class="fsz-xs">15 mins ago</small>
                                </div>
                              </div>
                              <span class="c-grey-600 fsz-sm">
                                Want to create your own customized data generator for your app...
                              </span>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li>
                        <a href="" class='peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100'>
                          <div class="peer mR-15">
                            <img class="w-3r bdrs-50p" src="https://randomuser.me/api/portraits/men/3.jpg" alt="">
                          </div>
                          <div class="peer peer-greed">
                            <div>
                              <div class="peers jc-sb fxw-nw mB-5">
                                <div class="peer">
                                  <p class="fw-500 mB-0">Lee Doe</p>
                                </div>
                                <div class="peer">
                                  <small class="fsz-xs">25 mins ago</small>
                                </div>
                              </div>
                              <span class="c-grey-600 fsz-sm">
                                Want to create your own customized data generator for your app...
                              </span>
                            </div>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="pX-20 pY-15 ta-c bdT">
                    <span>
                      <a href="email.html" class="c-grey-600 cH-blue fsz-sm td-n">View All Email <i class="fs-xs ti-angle-right mL-10"></i></a>
                    </span>
                  </li>
                </ul>
              </li>-->

              <li class="dropdown">
                <a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-toggle="dropdown">
                  <div class="peer mR-10">
                    @if (Auth::User()->avatar == 'default')
                      <img class="w-2r bdrs-50p" src="{{ asset('images/user.png') }}" alt="">
                    @else
                      <img class="w-2r bdrs-50p" width="60" height="35" src="{{ Storage::url(Auth::User()->avatar) }}" alt="">
                    @endif
                  </div>
                  <div class="peer">
                    <span class="fsz-sm c-grey-900">{{ Auth::User()->name }} </span><br>
                     <span class="fsz-sm c-grey-600 pT-5">{{ Auth::User()->type }}</span>
                  </div>
                </a>
                <ul class="dropdown-menu fsz-sm">
                  <li>
                    <a href="{{ url('/perfil') }}" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                      <i class="ti-user mR-10"></i>
                      <span>Mi Perfil</span>
                    </a>
                  </li>
                  <li role="separator" class="divider"></li>
                  <li>
                    <a href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                       class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                      <i class="ti-power-off mR-10"></i>
                      <span>Salir</span>
                    </a>
                  </li>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                </ul>
              </li>
              @endif
            </ul>
            @endif

          </div>
        </div>

        <!-- ### $App Screen Content ### -->
        <main class='main-content bgc-grey-100'>
          <div id='mainContent'>
            <div class="row gap-20 masonry pos-r">
              <div class="masonry-item  w-100">
                <div class="row">

                  <div class="card col-sm-12 p-0" >
                    <div class="card-header text-center text-white p-5 border-0 @yield('color-style', 'bg-dark')">
                      <h2 class="mt-lg-0 mt-sm-5 mB-2 text-capitalize">@yield('title', '')</h2>
                    </div>
                    <div class="card-body">
                            <div class="layer w-100 mB-3"></div>
                            @yield('content')
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </main>

        <!-- ### $App Screen Footer ### -->
        <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600">
          <span>Copyright © {{session('app_name')}} 2018 | 

            <i class="ti-email"></i> <a style="color: gray;" href="mailto:{{session('app_email')}}">{{session('app_email')}}</a> <i class="ti-mobile"></i> {{session('app_telefono')}}
          </span>
          
        </footer>
      </div>
    </div>
  </body>

  <script>
      toastr.options = {
          "closeButton": false,
          "debug": false,
          "newestOnTop": false,
          "progressBar": true,
          "positionClass": "toast-top-full-width",
          "preventDuplicates": true,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
      }
   @if(Session::has('message'))
      var type = "{{ Session::get('alert-type', 'info') }}";
      switch(type){
          case 'info':
              toastr.info("{{ Session::get('message') }}");
              break;
          case 'warning':
              toastr.warning("{{ Session::get('message') }}");
              break;
          case 'success':
              toastr.success("{{ Session::get('message') }}");
              break;
          case 'error':
              toastr.error("{{ Session::get('message') }}");
              break;
      }
    @endif
    $('[data-toggle="tooltip"]').tooltip();
  </script>
</html>
