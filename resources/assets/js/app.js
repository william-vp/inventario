
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./scripts/index');

window.Vue = require('vue');

$(document).ready(function () {
    function logout() {
        setTimeout(function(){ document.getElementById("logout-form").submit(); }, 10000);
    }

    function show_message_suscription_out(date) {
        var container_message= $("#message_suscripction");
        var loader= $("#loader");
        //$("body").mouseover(function () {
            loader.removeClass("fadeOut");
            loader.addClass("active");
            content_message= '<div class="alert alert-info">' +
                '            <img src="/images/alert.png" width="100" alt="alert">' +
                '            <p class="mt-4">' +
                '                <i class="ti-info"></i> Tu Suscripción terminó en '+date+'. Contactanos para reactivarla.' +
                '            </p>' +
                '        </div>';
            container_message.html(content_message);
            logout();
            logout();
        //});
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/getDateSuscription',
        type: 'POST',
        success: function (data) {
            var date_start= data.start_subscription;
            var date_end= data.end_subscription;

            const second = 1000,
                minute = second * 60,
                hour = minute * 60,
                day = hour * 24;
            //var date= 'Jul 25, 2019 09:47:00';

            let countDown = new Date(date_end).getTime(),
                x = setInterval(function() {
                    let now = new Date().getTime(),
                        distance = countDown - now;

                        if (distance <= 0) {
                            show_message_suscription_out(date_end);
                            clearInterval(x);
                        }

                        document.getElementById('days').innerText = Math.floor(distance / (day)),
                        document.getElementById('hours').innerText = Math.floor((distance % (day)) / (hour));
                        document.getElementById('minutes').innerText = Math.floor((distance % (hour)) / (minute)),
                        document.getElementById('seconds').innerText = Math.floor((distance % (minute)) / second);

                }, second);
                document.getElementById('dateIni').innerText = data.start_date_string;
                document.getElementById('dateFin').innerText = data.end_date_string;
        }
    });

});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/*Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});*/