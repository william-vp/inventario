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
        $(document).ready(function () {
            $('#tdarrow').on('click', function () {
                if ($(".tdmob").is(":visible") == true) {
                    $(".tdmob").hide();
                    document.getElementById("icontdarrow").className = "ti-arrow-circle-down";
                } else {
                    $(".tdmob").show();
                    document.getElementById("icontdarrow").className = "ti-arrow-circle-up";
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

        #tdarrow {
            display: none;
        }

        @media (max-width: 576px) {
            #tdarrow {
                display: block;
            }
        }

        @-webkit-keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0)
            }
            100% {
                -webkit-transform: scale(1.0);
                opacity: 0;
            }
        }

        @keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0);
                transform: scale(0);
            }
            100% {
                -webkit-transform: scale(1.0);
                transform: scale(1.0);
                opacity: 0;
            }
        }
    </style>
    <!--custom card-->
    <style>
        .card-custom {
            overflow: hidden;
            height: auto;
            box-shadow: 0 0 15px rgba(10, 10, 10, 0.3);
        }

        .card-custom-img {
            height: 200px;
            min-height: 200px;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            border-color: inherit;
        }

        /* First border-left-width setting is a fallback
        .card-custom-img::after {
            position: absolute;
            content: '';
            top: 161px;
            left: 0;
            width: 0;
            height: 0;
            border-style: solid;
            border-top-width: 40px;
            border-right-width: 0;
            border-bottom-width: 0;
            border-left-width: 545px;
            border-left-width: calc(575px - 5vw);
            border-top-color: transparent;
            border-right-color: transparent;
            border-bottom-color: transparent;
            border-left-color: inherit;
        }
        */
        .card-custom-avatar img {
            border-radius: 50%;
            box-shadow: 0 0 15px rgba(10, 10, 10, 0.3);
            position: absolute;
            top: 100px;
            left: 1.25rem;
            width: 100px;
            height: 100px;
        }

    </style>

    <!--material card-->
    <style>
        .fa-spin-fast {
            -webkit-animation: fa-spin-fast 0.2s infinite linear;
            animation: fa-spin-fast 0.2s infinite linear;
        }
        @-webkit-keyframes fa-spin-fast {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(359deg);
                transform: rotate(359deg);
            }
        }
        @keyframes fa-spin-fast {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(359deg);
                transform: rotate(359deg);
            }
        }
        .material-card {
            position: relative;
            height: 0;
            padding-bottom: calc(100% - 16px);
            margin-bottom: 6.6em;
        }
        .material-card h2 {
            position: absolute;
            top: calc(100% - 16px);
            left: 0;
            width: 100%;
            padding: 10px 16px;
            color: #fff;
            font-size: 1.4em;
            line-height: 1.6em;
            margin: 0;
            z-index: 10;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }
        .material-card h2 span {
            display: block;
        }
        .material-card h2 strong {
            font-weight: 400;
            display: block;
            font-size: .8em;
        }
        .material-card h2:before,
        .material-card h2:after {
            content: ' ';
            position: absolute;
            left: 0;
            top: -16px;
            width: 0;
            border: 8px solid;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }
        .material-card h2:after {
            top: auto;
            bottom: 0;
        }
        @media screen and (max-width: 767px) {
            .material-card.mc-active {
                padding-bottom: 0;
                height: auto;
            }
        }
        .material-card.mc-active h2 {
            top: 0;
            padding: 10px 16px 10px 90px;
        }
        .material-card.mc-active h2:before {
            top: 0;
        }
        .material-card.mc-active h2:after {
            bottom: -16px;
        }
        .material-card .mc-content {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 16px;
            left: 16px;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }
        .material-card .mc-btn-action {
            position: absolute;
            right: 16px;
            top: 15px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
            border: 5px solid;
            width: 54px;
            height: 54px;
            line-height: 44px;
            text-align: center;
            color: #fff !important;
            cursor: pointer;
            z-index: 20;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }
        .material-card.mc-active .mc-btn-action {
            top: 62px;
        }
        .material-card .mc-description {
            position: absolute;
            top: 100%;
            right: 30px;
            left: 30px;
            bottom: 54px;
            overflow: hidden;
            opacity: 0;
            filter: alpha(opacity=0);
            -webkit-transition: all 1.2s;
            -moz-transition: all 1.2s;
            -ms-transition: all 1.2s;
            -o-transition: all 1.2s;
            transition: all 1.2s;
        }
        .material-card .mc-footer {
            height: 0;
            overflow: hidden;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
            text-align: center;
        }
        .material-card .mc-footer h4 {
            position: absolute;
            top: 200px;
            left: 30px;
            padding: 0;
            margin: 0;
            font-size: 16px;
            font-weight: 700;
            -webkit-transition: all 1.4s;
            -moz-transition: all 1.4s;
            -ms-transition: all 1.4s;
            -o-transition: all 1.4s;
            transition: all 1.4s;
            z-index: 999;
            text-transform: uppercase;
            background: #FFF;
            padding: 10px ;
        }
        .material-card .mc-footer a {
            display: block;
            float: none;
            position: relative;
            height: auto;
            width: 80%;
            margin-left: 5px;
            margin-bottom: 15px;
            font-size: 15px;
            color: #fff;
            text-decoration: none;
            top: 200px;
            font-weight: 400;
            text-transform: uppercase;
        }
        .material-card .mc-footer a:nth-child(1) {
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
            -ms-transition: all 0.5s;
            -o-transition: all 0.5s;
            transition: all 0.5s;
        }
        .material-card .mc-footer a:nth-child(2) {
            -webkit-transition: all 0.6s;
            -moz-transition: all 0.6s;
            -ms-transition: all 0.6s;
            -o-transition: all 0.6s;
            transition: all 0.6s;
        }
        .material-card .mc-footer a:nth-child(3) {
            -webkit-transition: all 0.7s;
            -moz-transition: all 0.7s;
            -ms-transition: all 0.7s;
            -o-transition: all 0.7s;
            transition: all 0.7s;
        }
        .material-card .mc-footer a:nth-child(4) {
            -webkit-transition: all 0.8s;
            -moz-transition: all 0.8s;
            -ms-transition: all 0.8s;
            -o-transition: all 0.8s;
            transition: all 0.8s;
        }
        .material-card .mc-footer a:nth-child(5) {
            -webkit-transition: all 0.9s;
            -moz-transition: all 0.9s;
            -ms-transition: all 0.9s;
            -o-transition: all 0.9s;
            transition: all 0.9s;
        }
        .material-card .img-container {
            overflow: hidden;
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 3;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }
        .material-card.mc-active .img-container {
            /*-webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;*/
            left: 10px;
            top: 12px;
            width: 60px;
            height: 60px;
            z-index: 20;
        }
        .img-responsive{
            max-width: 100%;
        }
        .material-card.mc-active .mc-content {
            padding-top: 5.6em;
        }
        @media screen and (max-width: 767px) {
            .material-card.mc-active .mc-content {
                position: relative;
                margin-right: 16px;
            }
        }
        .material-card.mc-active .mc-description {
            top: 50px;
            padding-top: 5.6em;
            opacity: 1;
            filter: alpha(opacity=100);
            color: #1b1e21;
        }
        @media screen and (max-width: 767px) {
            .material-card.mc-active .mc-description {
                position: relative;
                top: auto;
                right: auto;
                left: auto;
                padding: 50px 30px 70px 30px;
                bottom: 0;
            }
        }
        .material-card.mc-active .mc-footer {
            overflow: visible;
            position: absolute;
            top: calc(100% - 16px);
            left: 16px;
            right: 0;
            height: 82px;
            padding-top: 15px;
            padding-left: 25px;
        }
        .material-card.mc-active .mc-footer a {
            top: 0;
        }
        .material-card.mc-active .mc-footer h4 {
            top: -32px;
            background: transparent;
            padding: 2px;
            display: none;
        }
        .material-card.Red h2 {
            background-color: #F44336;
        }
        .material-card.Red h2:after {
            border-top-color: #F44336;
            border-right-color: #F44336;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Red h2:before {
            border-top-color: transparent;
            border-right-color: #B71C1C;
            border-bottom-color: #B71C1C;
            border-left-color: transparent;
        }
        .material-card.Red.mc-active h2:before {
            border-top-color: transparent;
            border-right-color: #F44336;
            border-bottom-color: #F44336;
            border-left-color: transparent;
        }
        .material-card.Red.mc-active h2:after {
            border-top-color: #B71C1C;
            border-right-color: #B71C1C;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Red .mc-btn-action {
            background-color: #F44336;
        }
        .material-card.Red .mc-btn-action:hover {
            background-color: #B71C1C;
        }
        .material-card.Red .mc-footer h4 {
            color: #B71C1C;
        }
        .material-card.Red .mc-footer a {
            background-color: #B71C1C;
        }
        .material-card.Red.mc-active .mc-content {
            background-color: #FFEBEE;
        }
        .material-card.Red.mc-active .mc-footer {
            background-color: #FFCDD2;
        }
        .material-card.Red.mc-active .mc-btn-action {
            border-color: #FFEBEE;
        }
        .material-card.Blue-Grey h2 {
            background-color: #607D8B;
        }
        .material-card.Blue-Grey h2:after {
            border-top-color: #607D8B;
            border-right-color: #607D8B;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Blue-Grey h2:before {
            border-top-color: transparent;
            border-right-color: #263238;
            border-bottom-color: #263238;
            border-left-color: transparent;
        }
        .material-card.Blue-Grey.mc-active h2:before {
            border-top-color: transparent;
            border-right-color: #607D8B;
            border-bottom-color: #607D8B;
            border-left-color: transparent;
        }
        .material-card.Blue-Grey.mc-active h2:after {
            border-top-color: #263238;
            border-right-color: #263238;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Blue-Grey .mc-btn-action {
            background-color: #607D8B;
        }
        .material-card.Blue-Grey .mc-btn-action:hover {
            background-color: #263238;
        }
        .material-card.Blue-Grey .mc-footer h4 {
            color: #263238;
        }
        .material-card.Blue-Grey .mc-footer a {
            background-color: #263238;
        }
        .material-card.Blue-Grey.mc-active .mc-content {
            background-color: #ECEFF1;
        }
        .material-card.Blue-Grey.mc-active .mc-footer {
            background-color: #CFD8DC;
        }
        .material-card.Blue-Grey.mc-active .mc-btn-action {
            border-color: #ECEFF1;
        }
        .material-card.Pink h2 {
            background-color: #E91E63;
        }
        .material-card.Pink h2:after {
            border-top-color: #E91E63;
            border-right-color: #E91E63;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Pink h2:before {
            border-top-color: transparent;
            border-right-color: #880E4F;
            border-bottom-color: #880E4F;
            border-left-color: transparent;
        }
        .material-card.Pink.mc-active h2:before {
            border-top-color: transparent;
            border-right-color: #E91E63;
            border-bottom-color: #E91E63;
            border-left-color: transparent;
        }
        .material-card.Pink.mc-active h2:after {
            border-top-color: #880E4F;
            border-right-color: #880E4F;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Pink .mc-btn-action {
            background-color: #E91E63;
        }
        .material-card.Pink .mc-btn-action:hover {
            background-color: #880E4F;
        }
        .material-card.Pink .mc-footer h4 {
            color: #880E4F;
        }
        .material-card.Pink .mc-footer a {
            background-color: #880E4F;
        }
        .material-card.Pink.mc-active .mc-content {
            background-color: #FCE4EC;
        }
        .material-card.Pink.mc-active .mc-footer {
            background-color: #F8BBD0;
        }
        .material-card.Pink.mc-active .mc-btn-action {
            border-color: #FCE4EC;
        }
        .material-card.Purple h2 {
            background-color: #9C27B0;
        }
        .material-card.Purple h2:after {
            border-top-color: #9C27B0;
            border-right-color: #9C27B0;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Purple h2:before {
            border-top-color: transparent;
            border-right-color: #4A148C;
            border-bottom-color: #4A148C;
            border-left-color: transparent;
        }
        .material-card.Purple.mc-active h2:before {
            border-top-color: transparent;
            border-right-color: #9C27B0;
            border-bottom-color: #9C27B0;
            border-left-color: transparent;
        }
        .material-card.Purple.mc-active h2:after {
            border-top-color: #4A148C;
            border-right-color: #4A148C;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Purple .mc-btn-action {
            background-color: #9C27B0;
        }
        .material-card.Purple .mc-btn-action:hover {
            background-color: #4A148C;
        }
        .material-card.Purple .mc-footer h4 {
            color: #4A148C;
        }
        .material-card.Purple .mc-footer a {
            background-color: #4A148C;
        }
        .material-card.Purple.mc-active .mc-content {
            background-color: #F3E5F5;
        }
        .material-card.Purple.mc-active .mc-footer {
            background-color: #E1BEE7;
        }
        .material-card.Purple.mc-active .mc-btn-action {
            border-color: #F3E5F5;
        }
        .material-card.Deep-Purple h2 {
            background-color: #673AB7;
        }
        .material-card.Deep-Purple h2:after {
            border-top-color: #673AB7;
            border-right-color: #673AB7;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Deep-Purple h2:before {
            border-top-color: transparent;
            border-right-color: #311B92;
            border-bottom-color: #311B92;
            border-left-color: transparent;
        }
        .material-card.Deep-Purple.mc-active h2:before {
            border-top-color: transparent;
            border-right-color: #673AB7;
            border-bottom-color: #673AB7;
            border-left-color: transparent;
        }
        .material-card.Deep-Purple.mc-active h2:after {
            border-top-color: #311B92;
            border-right-color: #311B92;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Deep-Purple .mc-btn-action {
            background-color: #673AB7;
        }
        .material-card.Deep-Purple .mc-btn-action:hover {
            background-color: #311B92;
        }
        .material-card.Deep-Purple .mc-footer h4 {
            color: #311B92;
        }
        .material-card.Deep-Purple .mc-footer a {
            background-color: #311B92;
        }
        .material-card.Deep-Purple.mc-active .mc-content {
            background-color: #EDE7F6;
        }
        .material-card.Deep-Purple.mc-active .mc-footer {
            background-color: #D1C4E9;
        }
        .material-card.Deep-Purple.mc-active .mc-btn-action {
            border-color: #EDE7F6;
        }
        .material-card.Indigo h2 {
            background-color: #3F51B5;
        }
        .material-card.Indigo h2:after {
            border-top-color: #3F51B5;
            border-right-color: #3F51B5;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Indigo h2:before {
            border-top-color: transparent;
            border-right-color: #1A237E;
            border-bottom-color: #1A237E;
            border-left-color: transparent;
        }
        .material-card.Indigo.mc-active h2:before {
            border-top-color: transparent;
            border-right-color: #3F51B5;
            border-bottom-color: #3F51B5;
            border-left-color: transparent;
        }
        .material-card.Indigo.mc-active h2:after {
            border-top-color: #1A237E;
            border-right-color: #1A237E;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Indigo .mc-btn-action {
            background-color: #3F51B5;
        }
        .material-card.Indigo .mc-btn-action:hover {
            background-color: #1A237E;
        }
        .material-card.Indigo .mc-footer h4 {
            color: #1A237E;
        }
        .material-card.Indigo .mc-footer a {
            background-color: #1A237E;
        }
        .material-card.Indigo.mc-active .mc-content {
            background-color: #E8EAF6;
        }
        .material-card.Indigo.mc-active .mc-footer {
            background-color: #C5CAE9;
        }
        .material-card.Indigo.mc-active .mc-btn-action {
            border-color: #E8EAF6;
        }
        .material-card.Blue h2 {
            background-color: #2196F3;
        }
        .material-card.Blue h2:after {
            border-top-color: #2196F3;
            border-right-color: #2196F3;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Blue h2:before {
            border-top-color: transparent;
            border-right-color: #0D47A1;
            border-bottom-color: #0D47A1;
            border-left-color: transparent;
        }
        .material-card.Blue.mc-active h2:before {
            border-top-color: transparent;
            border-right-color: #2196F3;
            border-bottom-color: #2196F3;
            border-left-color: transparent;
        }
        .material-card.Blue.mc-active h2:after {
            border-top-color: #0D47A1;
            border-right-color: #0D47A1;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Blue .mc-btn-action {
            background-color: #2196F3;
        }
        .material-card.Blue .mc-btn-action:hover {
            background-color: #0D47A1;
        }
        .material-card.Blue .mc-footer h4 {
            color: #0D47A1;
        }
        .material-card.Blue .mc-footer a {
            background-color: #0D47A1;
        }
        .material-card.Blue.mc-active .mc-content {
            background-color: #E3F2FD;
        }
        .material-card.Blue.mc-active .mc-footer {
            background-color: #BBDEFB;
        }
        .material-card.Blue.mc-active .mc-btn-action {
            border-color: #E3F2FD;
        }
        .material-card.Light-Blue h2 {
            background-color: #03A9F4;
        }
        .material-card.Light-Blue h2:after {
            border-top-color: #03A9F4;
            border-right-color: #03A9F4;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Light-Blue h2:before {
            border-top-color: transparent;
            border-right-color: #01579B;
            border-bottom-color: #01579B;
            border-left-color: transparent;
        }
        .material-card.Light-Blue.mc-active h2:before {
            border-top-color: transparent;
            border-right-color: #03A9F4;
            border-bottom-color: #03A9F4;
            border-left-color: transparent;
        }
        .material-card.Light-Blue.mc-active h2:after {
            border-top-color: #01579B;
            border-right-color: #01579B;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Light-Blue .mc-btn-action {
            background-color: #03A9F4;
        }
        .material-card.Light-Blue .mc-btn-action:hover {
            background-color: #01579B;
        }
        .material-card.Light-Blue .mc-footer h4 {
            color: #01579B;
        }
        .material-card.Light-Blue .mc-footer a {
            background-color: #01579B;
        }
        .material-card.Light-Blue.mc-active .mc-content {
            background-color: #E1F5FE;
        }
        .material-card.Light-Blue.mc-active .mc-footer {
            background-color: #B3E5FC;
        }
        .material-card.Light-Blue.mc-active .mc-btn-action {
            border-color: #E1F5FE;
        }
        .material-card.Cyan h2 {
            background-color: #00BCD4;
        }
        .material-card.Cyan h2:after {
            border-top-color: #00BCD4;
            border-right-color: #00BCD4;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Cyan h2:before {
            border-top-color: transparent;
            border-right-color: #006064;
            border-bottom-color: #006064;
            border-left-color: transparent;
        }
        .material-card.Cyan.mc-active h2:before {
            border-top-color: transparent;
            border-right-color: #00BCD4;
            border-bottom-color: #00BCD4;
            border-left-color: transparent;
        }
        .material-card.Cyan.mc-active h2:after {
            border-top-color: #006064;
            border-right-color: #006064;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Cyan .mc-btn-action {
            background-color: #00BCD4;
        }
        .material-card.Cyan .mc-btn-action:hover {
            background-color: #006064;
        }
        .material-card.Cyan .mc-footer h4 {
            color: #006064;
        }
        .material-card.Cyan .mc-footer a {
            background-color: #006064;
        }
        .material-card.Cyan.mc-active .mc-content {
            background-color: #E0F7FA;
        }
        .material-card.Cyan.mc-active .mc-footer {
            background-color: #B2EBF2;
        }
        .material-card.Cyan.mc-active .mc-btn-action {
            border-color: #E0F7FA;
        }
        .material-card.Teal h2 {
            background-color: #009688;
        }
        .material-card.Teal h2:after {
            border-top-color: #009688;
            border-right-color: #009688;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Teal h2:before {
            border-top-color: transparent;
            border-right-color: #004D40;
            border-bottom-color: #004D40;
            border-left-color: transparent;
        }
        .material-card.Teal.mc-active h2:before {
            border-top-color: transparent;
            border-right-color: #009688;
            border-bottom-color: #009688;
            border-left-color: transparent;
        }
        .material-card.Teal.mc-active h2:after {
            border-top-color: #004D40;
            border-right-color: #004D40;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Teal .mc-btn-action {
            background-color: #009688;
        }
        .material-card.Teal .mc-btn-action:hover {
            background-color: #004D40;
        }
        .material-card.Teal .mc-footer h4 {
            color: #004D40;
        }
        .material-card.Teal .mc-footer a {
            background-color: #004D40;
        }
        .material-card.Teal.mc-active .mc-content {
            background-color: #E0F2F1;
        }
        .material-card.Teal.mc-active .mc-footer {
            background-color: #B2DFDB;
        }
        .material-card.Teal.mc-active .mc-btn-action {
            border-color: #E0F2F1;
        }
        .material-card.Green h2 {
            background-color: #4CAF50;
        }
        .material-card.Green h2:after {
            border-top-color: #4CAF50;
            border-right-color: #4CAF50;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Green h2:before {
            border-top-color: transparent;
            border-right-color: #1B5E20;
            border-bottom-color: #1B5E20;
            border-left-color: transparent;
        }
        .material-card.Green.mc-active h2:before {
            border-top-color: transparent;
            border-right-color: #4CAF50;
            border-bottom-color: #4CAF50;
            border-left-color: transparent;
        }
        .material-card.Green.mc-active h2:after {
            border-top-color: #1B5E20;
            border-right-color: #1B5E20;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Green .mc-btn-action {
            background-color: #4CAF50;
        }
        .material-card.Green .mc-btn-action:hover {
            background-color: #1B5E20;
        }
        .material-card.Green .mc-footer h4 {
            color: #1B5E20;
        }
        .material-card.Green .mc-footer a {
            background-color: #1B5E20;
        }
        .material-card.Green.mc-active .mc-content {
            background-color: #E8F5E9;
        }
        .material-card.Green.mc-active .mc-footer {
            background-color: #C8E6C9;
        }
        .material-card.Green.mc-active .mc-btn-action {
            border-color: #E8F5E9;
        }
        .material-card.Light-Green h2 {
            background-color: #8BC34A;
        }
        .material-card.Light-Green h2:after {
            border-top-color: #8BC34A;
            border-right-color: #8BC34A;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Light-Green h2:before {
            border-top-color: transparent;
            border-right-color: #33691E;
            border-bottom-color: #33691E;
            border-left-color: transparent;
        }
        .material-card.Light-Green.mc-active h2:before {
            border-top-color: transparent;
            border-right-color: #8BC34A;
            border-bottom-color: #8BC34A;
            border-left-color: transparent;
        }
        .material-card.Light-Green.mc-active h2:after {
            border-top-color: #33691E;
            border-right-color: #33691E;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Light-Green .mc-btn-action {
            background-color: #8BC34A;
        }
        .material-card.Light-Green .mc-btn-action:hover {
            background-color: #33691E;
        }
        .material-card.Light-Green .mc-footer h4 {
            color: #33691E;
        }
        .material-card.Light-Green .mc-footer a {
            background-color: #33691E;
        }
        .material-card.Light-Green.mc-active .mc-content {
            background-color: #F1F8E9;
        }
        .material-card.Light-Green.mc-active .mc-footer {
            background-color: #DCEDC8;
        }
        .material-card.Light-Green.mc-active .mc-btn-action {
            border-color: #F1F8E9;
        }
        .material-card.Lime h2 {
            background-color: #CDDC39;
        }
        .material-card.Lime h2:after {
            border-top-color: #CDDC39;
            border-right-color: #CDDC39;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Lime h2:before {
            border-top-color: transparent;
            border-right-color: #827717;
            border-bottom-color: #827717;
            border-left-color: transparent;
        }
        .material-card.Lime.mc-active h2:before {
            border-top-color: transparent;
            border-right-color: #CDDC39;
            border-bottom-color: #CDDC39;
            border-left-color: transparent;
        }
        .material-card.Lime.mc-active h2:after {
            border-top-color: #827717;
            border-right-color: #827717;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Lime .mc-btn-action {
            background-color: #CDDC39;
        }
        .material-card.Lime .mc-btn-action:hover {
            background-color: #827717;
        }
        .material-card.Lime .mc-footer h4 {
            color: #827717;
        }
        .material-card.Lime .mc-footer a {
            background-color: #827717;
        }
        .material-card.Lime.mc-active .mc-content {
            background-color: #F9FBE7;
        }
        .material-card.Lime.mc-active .mc-footer {
            background-color: #F0F4C3;
        }
        .material-card.Lime.mc-active .mc-btn-action {
            border-color: #F9FBE7;
        }
        .material-card.Yellow h2 {
            background-color: #FFEB3B;
        }
        .material-card.Yellow h2:after {
            border-top-color: #FFEB3B;
            border-right-color: #FFEB3B;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Yellow h2:before {
            border-top-color: transparent;
            border-right-color: #F57F17;
            border-bottom-color: #F57F17;
            border-left-color: transparent;
        }
        .material-card.Yellow.mc-active h2:before {
            border-top-color: transparent;
            border-right-color: #FFEB3B;
            border-bottom-color: #FFEB3B;
            border-left-color: transparent;
        }
        .material-card.Yellow.mc-active h2:after {
            border-top-color: #F57F17;
            border-right-color: #F57F17;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Yellow .mc-btn-action {
            background-color: #FFEB3B;
        }
        .material-card.Yellow .mc-btn-action:hover {
            background-color: #F57F17;
        }
        .material-card.Yellow .mc-footer h4 {
            color: #F57F17;
        }
        .material-card.Yellow .mc-footer a {
            background-color: #F57F17;
        }
        .material-card.Yellow.mc-active .mc-content {
            background-color: #FFFDE7;
        }
        .material-card.Yellow.mc-active .mc-footer {
            background-color: #FFF9C4;
        }
        .material-card.Yellow.mc-active .mc-btn-action {
            border-color: #FFFDE7;
        }
        .material-card.Amber h2 {
            background-color: #FFC107;
        }
        .material-card.Amber h2:after {
            border-top-color: #FFC107;
            border-right-color: #FFC107;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Amber h2:before {
            border-top-color: transparent;
            border-right-color: #FF6F00;
            border-bottom-color: #FF6F00;
            border-left-color: transparent;
        }
        .material-card.Amber.mc-active h2:before {
            border-top-color: transparent;
            border-right-color: #FFC107;
            border-bottom-color: #FFC107;
            border-left-color: transparent;
        }
        .material-card.Amber.mc-active h2:after {
            border-top-color: #FF6F00;
            border-right-color: #FF6F00;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Amber .mc-btn-action {
            background-color: #FFC107;
        }
        .material-card.Amber .mc-btn-action:hover {
            background-color: #FF6F00;
        }
        .material-card.Amber .mc-footer h4 {
            color: #FF6F00;
        }
        .material-card.Amber .mc-footer a {
            background-color: #FF6F00;
        }
        .material-card.Amber.mc-active .mc-content {
            background-color: #FFF8E1;
        }
        .material-card.Amber.mc-active .mc-footer {
            background-color: #FFECB3;
        }
        .material-card.Amber.mc-active .mc-btn-action {
            border-color: #FFF8E1;
        }
        .material-card.Orange h2 {
            background-color: #FF9800;
        }
        .material-card.Orange h2:after {
            border-top-color: #FF9800;
            border-right-color: #FF9800;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Orange h2:before {
            border-top-color: transparent;
            border-right-color: #E65100;
            border-bottom-color: #E65100;
            border-left-color: transparent;
        }
        .material-card.Orange.mc-active h2:before {
            border-top-color: transparent;
            border-right-color: #FF9800;
            border-bottom-color: #FF9800;
            border-left-color: transparent;
        }
        .material-card.Orange.mc-active h2:after {
            border-top-color: #E65100;
            border-right-color: #E65100;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Orange .mc-btn-action {
            background-color: #FF9800;
        }
        .material-card.Orange .mc-btn-action:hover {
            background-color: #E65100;
        }
        .material-card.Orange .mc-footer h4 {
            color: #E65100;
        }
        .material-card.Orange .mc-footer a {
            background-color: #E65100;
        }
        .material-card.Orange.mc-active .mc-content {
            background-color: #FFF3E0;
        }
        .material-card.Orange.mc-active .mc-footer {
            background-color: #FFE0B2;
        }
        .material-card.Orange.mc-active .mc-btn-action {
            border-color: #FFF3E0;
        }
        .material-card.Deep-Orange h2 {
            background-color: #FF5722;
        }
        .material-card.Deep-Orange h2:after {
            border-top-color: #FF5722;
            border-right-color: #FF5722;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Deep-Orange h2:before {
            border-top-color: transparent;
            border-right-color: #BF360C;
            border-bottom-color: #BF360C;
            border-left-color: transparent;
        }
        .material-card.Deep-Orange.mc-active h2:before {
            border-top-color: transparent;
            border-right-color: #FF5722;
            border-bottom-color: #FF5722;
            border-left-color: transparent;
        }
        .material-card.Deep-Orange.mc-active h2:after {
            border-top-color: #BF360C;
            border-right-color: #BF360C;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Deep-Orange .mc-btn-action {
            background-color: #FF5722;
        }
        .material-card.Deep-Orange .mc-btn-action:hover {
            background-color: #BF360C;
        }
        .material-card.Deep-Orange .mc-footer h4 {
            color: #BF360C;
        }
        .material-card.Deep-Orange .mc-footer a {
            background-color: #BF360C;
        }
        .material-card.Deep-Orange.mc-active .mc-content {
            background-color: #FBE9E7;
        }
        .material-card.Deep-Orange.mc-active .mc-footer {
            background-color: #FFCCBC;
        }
        .material-card.Deep-Orange.mc-active .mc-btn-action {
            border-color: #FBE9E7;
        }
        .material-card.Brown h2 {
            background-color: #795548;
        }
        .material-card.Brown h2:after {
            border-top-color: #795548;
            border-right-color: #795548;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Brown h2:before {
            border-top-color: transparent;
            border-right-color: #3E2723;
            border-bottom-color: #3E2723;
            border-left-color: transparent;
        }
        .material-card.Brown.mc-active h2:before {
            border-top-color: transparent;
            border-right-color: #795548;
            border-bottom-color: #795548;
            border-left-color: transparent;
        }
        .material-card.Brown.mc-active h2:after {
            border-top-color: #3E2723;
            border-right-color: #3E2723;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Brown .mc-btn-action {
            background-color: #795548;
        }
        .material-card.Brown .mc-btn-action:hover {
            background-color: #3E2723;
        }
        .material-card.Brown .mc-footer h4 {
            color: #3E2723;
        }
        .material-card.Brown .mc-footer a {
            background-color: #3E2723;
        }
        .material-card.Brown.mc-active .mc-content {
            background-color: #EFEBE9;
        }
        .material-card.Brown.mc-active .mc-footer {
            background-color: #D7CCC8;
        }
        .material-card.Brown.mc-active .mc-btn-action {
            border-color: #EFEBE9;
        }
        .material-card.Grey h2 {
            background-color: #9E9E9E;
        }
        .material-card.Grey h2:after {
            border-top-color: #9E9E9E;
            border-right-color: #9E9E9E;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Grey h2:before {
            border-top-color: transparent;
            border-right-color: #212121;
            border-bottom-color: #212121;
            border-left-color: transparent;
        }
        .material-card.Grey.mc-active h2:before {
            border-top-color: transparent;
            border-right-color: #9E9E9E;
            border-bottom-color: #9E9E9E;
            border-left-color: transparent;
        }
        .material-card.Grey.mc-active h2:after {
            border-top-color: #212121;
            border-right-color: #212121;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Grey .mc-btn-action {
            background-color: #9E9E9E;
        }
        .material-card.Grey .mc-btn-action:hover {
            background-color: #212121;
        }
        .material-card.Grey .mc-footer h4 {
            color: #212121;
        }
        .material-card.Grey .mc-footer a {
            background-color: #212121;
        }
        .material-card.Grey.mc-active .mc-content {
            background-color: #FAFAFA;
        }
        .material-card.Grey.mc-active .mc-footer {
            background-color: #F5F5F5;
        }
        .material-card.Grey.mc-active .mc-btn-action {
            border-color: #FAFAFA;
        }
        .material-card.Blue-Grey h2 {
            background-color: #607D8B;
        }
        .material-card.Blue-Grey h2:after {
            border-top-color: #607D8B;
            border-right-color: #607D8B;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Blue-Grey h2:before {
            border-top-color: transparent;
            border-right-color: #263238;
            border-bottom-color: #263238;
            border-left-color: transparent;
        }
        .material-card.Blue-Grey.mc-active h2:before {
            border-top-color: transparent;
            border-right-color: #607D8B;
            border-bottom-color: #607D8B;
            border-left-color: transparent;
        }
        .material-card.Blue-Grey.mc-active h2:after {
            border-top-color: #263238;
            border-right-color: #263238;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        .material-card.Blue-Grey .mc-btn-action {
            background-color: #607D8B;
        }
        .material-card.Blue-Grey .mc-btn-action:hover {
            background-color: #263238;
        }
        .material-card.Blue-Grey .mc-footer h4 {
            color: #263238;
        }
        .material-card.Blue-Grey .mc-footer a {
            background-color: #263238;
        }
        .material-card.Blue-Grey.mc-active .mc-content {
            background-color: #ECEFF1;
        }
        .material-card.Blue-Grey.mc-active .mc-footer {
            background-color: #CFD8DC;
        }
        .material-card.Blue-Grey.mc-active .mc-btn-action {
            border-color: #ECEFF1;
        }
        h1,
        h2,
        h3 {
            font-weight: 200;
        }
        @media only screen and (max-width: 600px) {
            .material-card {
                margin-bottom: -7em;
            }
            .mc-active{
                margin-bottom: 6em;
            }
        }
    </style>
</head>
<body class="app">
<div id='loader'>
    <div class="spinner"></div>
</div>

@include('layouts.partials.sidebar')
<div class="page-container">
    <!-- ### $Topbar ### -->
    <div class="header navbar" style="background: rgba(255, 255, 255, 0.95);">
        <div class="header-container">
            <ul class="nav-left">
                <li>
                    <a id='sidebar-toggle' class="sidebar-toggle" href="javascript:void(0);">
                        <i class="ti-menu" style="line-height: 0!important;"></i>
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
                        <a href="{{ url('/cajas') }}">
                            <i class="ti-desktop"></i> <strong id="idCaja">CAJA {{ session('caja_id') }}  </strong>
                        </a>
                    </li>
                @endif
                <li id="tdarrow" data-toggle="tooltip" title="Expandir/Minimizar Nav">
                    <a href="#">
                        <i class="ti-arrow-circle-up" id="icontdarrow"></i>
                    </a>
                </li>

                <li class="tdmob">
                    <a href="#">
                        <?php
                        setlocale(LC_ALL, "es_ES");
                        $fecha = strftime("%A %d de %B del %Y");
                        ?>
                        <i class="ti-calendar"></i> <strong>{{ucfirst($fecha)}}</strong>
                    </a>
                </li>

            </ul>


            @if (Route::has('login'))
                @if (Auth::check())
                    <ul class="nav-right tdmob">

                        <li class="dropdown">
                            <a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1"
                               data-toggle="dropdown">
                                <div class="peer mR-10">
                                    @if (Auth::User()->avatar == 'default')
                                        <img class="w-2r bdrs-50p" src="{{ asset('images/user.png') }}" alt="">
                                    @else
                                        <img class="w-2r bdrs-50p" width="60" height="35"
                                             src="{{ Storage::url(Auth::User()->avatar) }}" alt="">
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
                                    <a href="{{route('logout')}}"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                       class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                                        <i class="ti-power-off mR-10"></i>
                                        <span>Salir</span>
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
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
    <main id="content-main" class='main-content bgc-grey-100 mb-0'>
        <div id='mainContent'>
            <div class="row gap-20 masonry pos-r">
                <div class="masonry-item  w-100">
                    <div class="row">

                        <div class="card col-sm-12 p-0">
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
    <div style="display: none;" id="menuContainer" class="main-content bg-light mb-0">
        <div id='mainContent'>
            <div class="row gap-20 masonry pos-r">
                <div class="masonry-item  w-100">
                    <div class="row">

                        <div class="card col-sm-12 p-0 bg-light">
                            <div class="card-header text-center text-white p-5 border-0 bg-dark">
                                <h2 class="mt-lg-0 mt-sm-5 mB-2 text-capitalize text-white" id="title-menu"></h2>
                            </div>
                            <div class="card-body container">

                                <div id="ventas" class="row tabs-options" style="display: none;">
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <a href="{{ url('/ventas') }}">
                                            <article class="material-card Cyan text-center justify-content-center">
                                                <div class="mc-content">
                                                    <div class="img-container h-auto">
                                                        <img class="img-responsive" width="250" src="{{ asset('images/menu/venta.png') }}">
                                                    </div>
                                                    <div class="mc-description">
                                                        Ver o imprimir facturas de ventas.
                                                    </div>
                                                </div>
                                                <a class="mc-btn-action">
                                                    <i class="fa fa-bars"></i>
                                                </a>
                                                <div class="mc-footer">
                                                    <h4 align="center">Ventas</h4>
                                                    <a href="{{ url('/ventas') }}">
                                                        Ventas
                                                    </a>
                                                </div>
                                            </article>
                                        </a>
                                    </div>

                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <a href="{{ url('/ventas/create') }}">
                                            <article class="material-card Cyan text-center justify-content-center">
                                                <div class="mc-content">
                                                    <div class="img-container h-auto">
                                                        <img class="img-responsive" width="250" src="{{ asset('images/menu/nueva_venta.ico') }}">
                                                    </div>
                                                    <div class="mc-description">
                                                        Crear una nueva factura de venta.
                                                    </div>
                                                </div>
                                                <a class="mc-btn-action">
                                                    <i class="fa fa-bars"></i>
                                                </a>
                                                <div class="mc-footer">
                                                    <h4 align="center">Nueva Venta</h4>
                                                    <a href="{{ url('/ventas/create') }}">
                                                        Nueva Venta
                                                    </a>
                                                </div>
                                            </article>
                                        </a>
                                    </div>

                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <a href="{{ url('/clientes/') }}">
                                            <article class="material-card Cyan text-center justify-content-center">
                                                <div class="mc-content">
                                                    <div class="img-container h-auto">
                                                        <img class="img-responsive" width="250" src="{{ asset('images/menu/client_list.png') }}">
                                                    </div>
                                                    <div class="mc-description">
                                                        Ver o registrar nuevos clientes.
                                                    </div>
                                                </div>
                                                <a class="mc-btn-action">
                                                    <i class="fa fa-bars"></i>
                                                </a>
                                                <div class="mc-footer">
                                                    <h4 align="center">Clientes</h4>
                                                    <a href="{{ url('/clientes') }}">
                                                        Clientes
                                                    </a>
                                                </div>
                                            </article>
                                        </a>
                                    </div>
                                </div>

                                <div id="pedidos" class="row tabs-options" style="display: none;">
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <a href="{{ route('pedidos.index') }}">
                                            <article class="material-card Green text-center justify-content-center">
                                                <div class="mc-content">
                                                    <div class="img-container h-auto">
                                                        <img class="img-responsive" width="250" src="{{ asset('images/menu/pedidos.png') }}">
                                                    </div>
                                                    <div class="mc-description">
                                                        Ver y realizar pedidos de productos.
                                                    </div>
                                                </div>
                                                <a class="mc-btn-action">
                                                    <i class="fa fa-bars"></i>
                                                </a>
                                                <div class="mc-footer">
                                                    <h4 align="center">Pedidos</h4>
                                                    <a href="{{ route('pedidos.index') }}">
                                                        Pedidos
                                                    </a>
                                                </div>
                                            </article>
                                        </a>
                                    </div>

                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <a href="{{ url('/pedidos/create') }}">
                                            <article class="material-card Green text-center justify-content-center">
                                                <div class="mc-content">
                                                    <div class="img-container h-auto">
                                                        <img class="img-responsive" width="250" src="{{ asset('images/menu/nuevo_pedido.png') }}">
                                                    </div>
                                                    <div class="mc-description">
                                                        Crear un nuevo pedido de productos.
                                                    </div>
                                                </div>
                                                <a class="mc-btn-action">
                                                    <i class="fa fa-bars"></i>
                                                </a>
                                                <div class="mc-footer">
                                                    <h4 align="center">Nuevo Pedido</h4>
                                                    <a href="{{ url('/pedidos/create') }}">
                                                        Nuevo Pedido
                                                    </a>
                                                </div>
                                            </article>
                                        </a>
                                    </div>

                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <a href="{{ url('/proveedores/') }}">
                                            <article class="material-card Green text-center justify-content-center">
                                                <div class="mc-content">
                                                    <div class="img-container h-auto">
                                                        <img class="img-responsive" width="250" src="{{ asset('images/menu/client_list.png') }}">
                                                    </div>
                                                    <div class="mc-description">
                                                        Ver o registrar nuevos proveedores.
                                                    </div>
                                                </div>
                                                <a class="mc-btn-action">
                                                    <i class="fa fa-bars"></i>
                                                </a>
                                                <div class="mc-footer">
                                                    <h4 align="center">Proveedores</h4>
                                                    <a href="{{ url('/proveedores') }}">
                                                        Proveedores
                                                    </a>
                                                </div>
                                            </article>
                                        </a>
                                    </div>
                                </div>

                                <div id="creditos" class="row tabs-options" style="display: none;">
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <a href="{{ url('/creditos') }}">
                                            <article class="material-card Red text-center justify-content-center">
                                                <div class="mc-content">
                                                    <div class="img-container h-auto">
                                                        <img class="img-responsive" width="250" src="{{ asset('images/menu/credito.png') }}">
                                                    </div>
                                                    <div class="mc-description">
                                                        Ver información de creditos de ventas y realizar abonos.
                                                    </div>
                                                </div>
                                                <a class="mc-btn-action">
                                                    <i class="fa fa-bars"></i>
                                                </a>
                                                <div class="mc-footer">
                                                    <h4 align="center">Ventas a Credito</h4>
                                                    <a href="{{ url('/creditos') }}">
                                                        Ventas a credito
                                                    </a>
                                                </div>
                                            </article>
                                        </a>
                                    </div>

                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <a href="{{ url('/pedidos_credito') }}">
                                            <article class="material-card Red text-center justify-content-center">
                                                <div class="mc-content">
                                                    <div class="img-container h-auto">
                                                        <img class="img-responsive" width="250" src="{{ asset('images/menu/pedidos.png') }}">
                                                    </div>
                                                    <div class="mc-description">
                                                        Ver información de creditos de ventas y realizar abonos.
                                                    </div>
                                                </div>
                                                <a class="mc-btn-action">
                                                    <i class="fa fa-bars"></i>
                                                </a>
                                                <div class="mc-footer">
                                                    <h4 align="center">Pedidos a Credito</h4>
                                                    <a href="{{ url('/pedidos_credito') }}">
                                                        Pedidos a Credito
                                                    </a>
                                                </div>
                                            </article>
                                        </a>
                                    </div>

                                </div>

                                <div id="inventario" class="row tabs-options" style="display: none;">
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <a href="{{ url('/productos') }}">
                                            <article class="material-card Orange text-center justify-content-center">
                                                <div class="mc-content">
                                                    <div class="img-container h-auto">
                                                        <img class="img-responsive" width="250" src="{{ asset('images/menu/lista_productos.png') }}">
                                                    </div>
                                                    <div class="mc-description">
                                                        Ver, Editar y realizar traslados de productos.
                                                    </div>
                                                </div>
                                                <a class="mc-btn-action">
                                                    <i class="fa fa-bars"></i>
                                                </a>
                                                <div class="mc-footer">
                                                    <h4 align="center">Productos</h4>
                                                    <a href="{{ url('/productos') }}">
                                                        Productos
                                                    </a>
                                                </div>
                                            </article>
                                        </a>
                                    </div>

                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <a href="{{ url('/productos/create') }}">
                                            <article class="material-card Orange text-center justify-content-center">
                                                <div class="mc-content">
                                                    <div class="img-container h-auto">
                                                        <img class="img-responsive" width="250" src="{{ asset('images/menu/nuevo_pedido.png') }}">
                                                    </div>
                                                    <div class="mc-description">
                                                        Crear un nuevo producto en el inventario.
                                                    </div>
                                                </div>
                                                <a class="mc-btn-action">
                                                    <i class="fa fa-bars"></i>
                                                </a>
                                                <div class="mc-footer">
                                                    <h4 align="center">Crear Nuevo Producto</h4>
                                                    <a href="{{ url('/productos/create') }}">
                                                        Crear Nuevo Producto
                                                    </a>
                                                </div>
                                            </article>
                                        </a>
                                    </div>

                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <a href="{{ url('/bodegas') }}">
                                            <article class="material-card Orange text-center justify-content-center">
                                                <div class="mc-content">
                                                    <div class="img-container h-auto">
                                                        <img class="img-responsive" width="250" src="{{ asset('images/menu/almacen.png') }}">
                                                    </div>
                                                    <div class="mc-description">
                                                        Administar Bodegas
                                                    </div>
                                                </div>
                                                <a class="mc-btn-action">
                                                    <i class="fa fa-bars"></i>
                                                </a>
                                                <div class="mc-footer">
                                                    <h4 align="center">Bodegas</h4>
                                                    <a href="{{ url('/bodegas') }}">
                                                        Bodegas
                                                    </a>
                                                </div>
                                            </article>
                                        </a>
                                    </div>

                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <a href="{{ url('/unidades_medida') }}">
                                            <article class="material-card Orange text-center justify-content-center">
                                                <div class="mc-content">
                                                    <div class="img-container h-auto">
                                                        <img class="img-responsive" width="250" src="{{ asset('images/menu/unidad_medida.png') }}">
                                                    </div>
                                                    <div class="mc-description">
                                                        Administar Unidades de Medida
                                                    </div>
                                                </div>
                                                <a class="mc-btn-action">
                                                    <i class="fa fa-bars"></i>
                                                </a>
                                                <div class="mc-footer">
                                                    <h4 align="center">Unidades de Medida</h4>
                                                    <a href="{{ url('/unidades_medida') }}">
                                                        Unidades de Medida
                                                    </a>
                                                </div>
                                            </article>
                                        </a>
                                    </div>

                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <a href="{{ url('/categorias') }}">
                                            <article class="material-card Orange text-center justify-content-center">
                                                <div class="mc-content">
                                                    <div class="img-container h-auto">
                                                        <img class="img-responsive" width="250" src="{{ asset('images/menu/categorias.png') }}">
                                                    </div>
                                                    <div class="mc-description">
                                                        Administar Categorias
                                                    </div>
                                                </div>
                                                <a class="mc-btn-action">
                                                    <i class="fa fa-bars"></i>
                                                </a>
                                                <div class="mc-footer">
                                                    <h4 align="center">Categorias</h4>
                                                    <a href="{{ url('/categorias') }}">
                                                        Categorias
                                                    </a>
                                                </div>
                                            </article>
                                        </a>
                                    </div>

                                </div>

                                <div id="reportes" class="row tabs-options" style="display: none;">
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <a href="{{ url('/reportes/productos_mas_vendidos') }}">
                                            <article class="material-card Red text-center justify-content-center">
                                                <div class="mc-content">
                                                    <div class="img-container h-auto">
                                                        <img class="img-responsive" width="250" src="{{ asset('images/menu/reporte1.png') }}">
                                                    </div>
                                                    <div class="mc-description">
                                                        Ver reportes de los productos más vendidos.
                                                    </div>
                                                </div>
                                                <a class="mc-btn-action">
                                                    <i class="fa fa-bars"></i>
                                                </a>
                                                <div class="mc-footer">
                                                    <h4 align="center">Productos más vendidos</h4>
                                                    <a href="{{ url('/reportes/productos_mas_vendidos') }}">
                                                        Productos más vendidos
                                                    </a>
                                                </div>
                                            </article>
                                        </a>
                                    </div>

                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <a href="{{ url('/reportes/productos_menos_vendidos') }}">
                                            <article class="material-card Red text-center justify-content-center">
                                                <div class="mc-content">
                                                    <div class="img-container h-auto">
                                                        <img class="img-responsive" width="250" src="{{ asset('images/menu/reporte1.png') }}">
                                                    </div>
                                                    <div class="mc-description">
                                                        Ver reportes de los productos menos vendidos.
                                                    </div>
                                                </div>
                                                <a class="mc-btn-action">
                                                    <i class="fa fa-bars"></i>
                                                </a>
                                                <div class="mc-footer">
                                                    <h4 align="center">Productos menos vendidos</h4>
                                                    <a href="{{ url('/reportes/productos_menos_vendidos') }}">
                                                        Productos menos vendidos
                                                    </a>
                                                </div>
                                            </article>
                                        </a>
                                    </div>

                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <a href="{{ url('/reportes/ventas_mes') }}">
                                            <article class="material-card Red text-center justify-content-center">
                                                <div class="mc-content">
                                                    <div class="img-container h-auto">
                                                        <img class="img-responsive" width="250" src="{{ asset('images/menu/reporte1.png') }}">
                                                    </div>
                                                    <div class="mc-description">
                                                        Ver reporte de las ventas del mes
                                                    </div>
                                                </div>
                                                <a class="mc-btn-action">
                                                    <i class="fa fa-bars"></i>
                                                </a>
                                                <div class="mc-footer">
                                                    <h4 align="center">Ventas del mes</h4>
                                                    <a href="{{ url('/reportes/ventas_mes') }}">
                                                        Ventas del mes
                                                    </a>
                                                </div>
                                            </article>
                                        </a>
                                    </div>

                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <a href="{{ url('/reportes/utilidad_productos') }}">
                                            <article class="material-card Red text-center justify-content-center">
                                                <div class="mc-content">
                                                    <div class="img-container h-auto">
                                                        <img class="img-responsive" width="250" src="{{ asset('images/menu/reporte1.png') }}">
                                                    </div>
                                                    <div class="mc-description">
                                                        Ver reporte de las ventas del mes
                                                    </div>
                                                </div>
                                                <a class="mc-btn-action">
                                                    <i class="fa fa-bars"></i>
                                                </a>
                                                <div class="mc-footer">
                                                    <h4 align="center">Utilidad de Productos</h4>
                                                    <a href="{{ url('/reportes/utilidad_productos') }}">
                                                        Utilidad de Productos
                                                    </a>
                                                </div>
                                            </article>
                                        </a>
                                    </div>

                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <a href="{{ url('/reportes/ingresos_egresos') }}">
                                            <article class="material-card Red text-center justify-content-center">
                                                <div class="mc-content">
                                                    <div class="img-container h-auto">
                                                        <img class="img-responsive" width="250" src="{{ asset('images/menu/reporte1.png') }}">
                                                    </div>
                                                    <div class="mc-description">
                                                        Ver reporte de ingresos y egresos.
                                                    </div>
                                                </div>
                                                <a class="mc-btn-action">
                                                    <i class="fa fa-bars"></i>
                                                </a>
                                                <div class="mc-footer">
                                                    <h4 align="center">Ingresos y Egresos</h4>
                                                    <a href="{{ url('/reportes/ingresos_egresos') }}">
                                                        Ingresos y Egresos
                                                    </a>
                                                </div>
                                            </article>
                                        </a>
                                    </div>

                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <a href="{{ url('/reportes/ventas_creditos') }}">
                                            <article class="material-card Red text-center justify-content-center">
                                                <div class="mc-content">
                                                    <div class="img-container h-auto">
                                                        <img class="img-responsive" width="250" src="{{ asset('images/menu/reporte1.png') }}">
                                                    </div>
                                                    <div class="mc-description">
                                                        Ver reporte de ventas y creditos.
                                                    </div>
                                                </div>
                                                <a class="mc-btn-action">
                                                    <i class="fa fa-bars"></i>
                                                </a>
                                                <div class="mc-footer">
                                                    <h4 align="center">Ventas y Creditos</h4>
                                                    <a href="{{ url('/reportes/ventas_creditos') }}">
                                                        Ventas y Creditos
                                                    </a>
                                                </div>
                                            </article>
                                        </a>
                                    </div>

                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <a href="{{ url('/reportes/cajas') }}">
                                            <article class="material-card Red text-center justify-content-center">
                                                <div class="mc-content">
                                                    <div class="img-container h-auto">
                                                        <img class="img-responsive" width="250" src="{{ asset('images/menu/calendar.png') }}">
                                                    </div>
                                                    <div class="mc-description">
                                                        Ver reporte del historial de cajas abiertas por los usuarios.
                                                    </div>
                                                </div>
                                                <a class="mc-btn-action">
                                                    <i class="fa fa-bars"></i>
                                                </a>
                                                <div class="mc-footer">
                                                    <h4 align="center">Historial Cajas</h4>
                                                    <a href="{{ url('/reportes/cajas') }}">
                                                        Historial Cajas
                                                    </a>
                                                </div>
                                            </article>
                                        </a>
                                    </div>


                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ### Footer ### -->
    <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600">
          <span>Copyright © {{session('app_name')}} 2018 |
            <i class="ti-email"></i> <a style="color: gray;"
                                        href="mailto:{{session('app_email')}}">{{session('app_email')}}</a> <i
                      class="ti-mobile"></i> {{session('app_telefono')}}
          </span>
    </footer>

</div>

</body>

<script>
    window.addEventListener('load', () => {
        const loader = document.getElementById('loader');
        setTimeout(() => {
            loader.classList.add('fadeOut');
        }, 300);
    });
</script>
<script>
    $('[data-toggle="tooltip"]').tooltip();
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
        switch (type) {
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

    $(document).ready(function () {
        $("li.nav-item").click(function () {
            var link= $(this).data('link');
            if (link != null){
                $("body").removeClass('is-collapsed');
                $("#content-main").hide('fast');
                $("#menuContainer").show('slow');

                $(".tabs-options").hide();
                $("#title-menu").text("Menú de "+link);
                $("#"+link).show('slow');

            }
        });

        $(function() {
            $('.material-card > .mc-btn-action').click(function () {
                var card = $(this).parent('.material-card');
                var icon = $(this).children('i');
                icon.addClass('fa-spin-fast');

                if (card.hasClass('mc-active')) {
                    card.removeClass('mc-active');

                    window.setTimeout(function() {
                        icon
                            .removeClass('fa-arrow-left')
                            .removeClass('fa-spin-fast')
                            .addClass('fa-bars');

                    }, 800);
                } else {
                    card.addClass('mc-active');

                    window.setTimeout(function() {
                        icon
                            .removeClass('fa-bars')
                            .removeClass('fa-spin-fast')
                            .addClass('fa-arrow-left');

                    }, 800);
                }
            });
        });

    });
</script>
</html>
