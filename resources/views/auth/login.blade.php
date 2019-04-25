<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/toastr.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/toastr.css') }}">

    <title>Invent | Iniciar Sesión</title>
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
            background-color: #333;
            border-radius: 100%;
            -webkit-animation: sk-scaleout 1.0s infinite ease-in-out;
            animation: sk-scaleout 1.0s infinite ease-in-out;
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
        .bg-banner{
            background-image: url( {{ Storage::url($datos->portada) }} );
        }
        .name_app{
            text-shadow: 1px 1px #eee;
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

<script>
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
</script>
<div class="peers ai-s fxw-nw h-100vh">
    <div class="d-n@sm- peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv bg-banner">
        <div class="pos-a centerXY">
            <div class="pos-r" style='width: 120px; height: 120px;'>
                <img class="pos-a centerXY" width="100" src="{{ Storage::url($datos->logo) }}" alt="">
            </div>
            <h1 class="name_app text-white">{{$datos->nombre}}</h1>
        </div>
    </div>
    <div class="col-12 col-md-4 peer pX-40 pY-80 h-100 bgc-white scrollable pos-r" style='min-width: 320px;'>
        <h4 class="fw-300 c-grey-900 mB-40">Iniciar Sesión</h4>
        <form data-method="POST" data-route="{{ route('login') }}" id="login" name="login">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label class="text-normal text-dark">Correo Electrónico</label>
                <input type="text" autocomplete="on" name="email" id="email" class="form-control" placeholder="email@example.com">
            </div>
            <div class="form-group">
                <label class="text-normal text-dark">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="*********">
            </div>
            <div class="form-group">
                <div class="peers ai-c jc-sb fxw-nw">
                    <!--<div class="peer">
                        <div class="checkbox checkbox-circle checkbox-info peers ai-c">
                            <input type="checkbox" id="inputCall1" name="inputCheckboxesCall" class="peer">
                            <label for="inputCall1" class=" peers peer-greed js-sb ai-c">
                                <span class="peer peer-greed">Remember Me</span>
                            </label>
                        </div>
                    </div>-->
                    <div class="peer">
                        <button type="button" class="btn btn-primary" id="btnLogin" data-form="login">Entrar</button>
                        <br>o si aun no estas registrado
                        <a href="{{ route('register') }}"><strong>Registrate</strong></a>
                    </div>
                </div>
                

            </div>
        </form>
    </div>
</div>
</body>
</html>
<script src="{{ asset('js/scripts/auth.js') }}"></script>
