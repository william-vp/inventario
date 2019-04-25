<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Invent | Registrarse</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/toastr.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/toastr.css') }}">

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
<div class="peers ai-s fxw-nw h-100vh">
    <?php $bg= Storage::url('public/bg.jpg'); ?>
    <div class="peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv bg-banner">
        <div class="pos-a centerXY">
            <div class="pos-r" style='width: 120px; height: 120px;'>
                <img class="pos-a centerXY" width="100" src="{{ Storage::url($datos->logo) }}" alt="">
            </div>
            <h1 class="text-white name_app">{{$datos->nombre}}</h1>
        </div>
    </div>
    <div class="col-12 col-md-4 peer pX-40 pY-80 h-100 bgc-white scrollable pos-r" style='min-width: 320px;'>
        <h4 class="fw-300 c-grey-900 mB-40">Registrarse</h4>
        <form data-method="POST" data-route="{{ route('register') }}" id="register" name="register">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label class="text-normal text-dark">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" Placeholder='Escribe tu nombre aquí.'>
            </div>
            <div class="form-group">
                <label class="text-normal text-dark">Correo electrónico</label>
                <input type="text" name="email" id="email" class="form-control" Placeholder='email@example.com'>
            </div>
            <div class="form-group">
                <label class="text-normal text-dark">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="*********">
            </div>
            <div class="form-group">
                <label class="text-normal text-dark">Confirma contraseña</label>
                <input type="password" name="password2" id="password2" class="form-control" placeholder="*********">
            </div>
            <div class="form-group">
                <button type="button" id="btnRegister" data-form="register" class="btn btn-primary">Registrarme</button> 
                <br>o si ya tienes una cuenta 
                <a href="{{ route('login') }}" ><strong>Iniciar Sesion</strong></a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
<script src="{{ asset('js/scripts/auth.js') }}"></script>
