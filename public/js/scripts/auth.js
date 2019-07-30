$(document).ready(function () {
    $('#email').keypress(function (e) {
        if (e.which == 13) {
            $('#btnLogin').click();
        }
    });
    $('#password').keypress(function (e) {
        if (e.which == 13) {
            $('#btnLogin').click();
        }
    });
});


//LOGIN
$(document).on('click', "#btnLogin", function () {
    var reg = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

    if (reg.test($('#email').val()) == false) {
        toastr.error('Verifique el campo: Correo Electrónico.', 'Error', {timeOut: 3000});
        $('#email').focus();
        return false;
    } else if ($('#password').val() == '') {
        toastr.error('Complete el campo: Contraseña', 'Error', {timeOut: 3000});
        $('#password').focus();
        return false;
    }
    idForm = $(this).data('form');
    route = $('#'+idForm).data('route');
    method = $('#'+idForm).data('method');

    $.ajax({
        url: route,
        type: method,
        data: $('#' + idForm).serialize(),
        success: function (d) {
                if (d == 'noexiste') {
                    toastr.error('El usuario ingresado no existe.', 'Error', {timeOut: 3000});
                    $('#email').focus();
                    return false;
                } else if (d == 'incorrecto') {
                    toastr.error('La contraseña ingresada es incorrecta.', 'Error', {timeOut: 3000});
                    $('#password').focus();
                    return false;
                } else if (d == 'exito') {
                    toastr.success('Inicio de sesión exitoso. Espere un momento...', 'Correcto!!', {timeOut: 3000});
                    location.href= '/home';
                    return true;
                } else if (d == 'subscription_out'){
                    toastr.error('Su suscripción ha terminado. Por Favor contactese con un técnico para solucionarlo.', 'Suscripción Terminada', {timeOut: 3000});
                    location.reload();
                    return false;
                } else {
                    toastr.error('Compruebe que los campos ingresados sean correctos', 'Error', {timeOut: 3000});
                    $('#email').focus();
                    return false;
                }

            }
    });
});

//REGISTER
$(document).on('click', "#btnRegister", function () {
    var reg = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    var regPass= /^(?=.*\d)(?=.*[A-Z])[a-zA-Z0-9]{6,}$/;

    if ($('#name').val() == '') {
        toastr.error('Completa el campo: Nombre.', 'Error', {timeOut: 3000});
        $('#name').focus();
        return false;
    }else if (reg.test($('#email').val()) == false) {
        toastr.error('Verifique el campo: Correo Electrónico.', 'Error', {timeOut: 3000});
        $('#email').focus();
        return false;
    } else if ($('#password').val() == '') {
        toastr.error('Complete el campo: Contraseña', 'Error', {timeOut: 3000});
        $('#password').focus();
        return false;
    }else if ($('#password').val() == '') {
        toastr.error('Complete el campo: Contraseña', 'Error', {timeOut: 3000});
        $('#password').focus();
        return false;
    }else if ($('#password2').val() == '') {
        toastr.error('Complete el campo: Confirma Contraseña', 'Error', {timeOut: 3000});
        $('#password2').focus();
        return false;
    }else if (regPass.test($('#password').val()) == false){
        toastr.error('La contraseña debe contener 6 caracteres como mínimo, un Digito y una Mayuscula', 'Error', {timeOut: 3000});
        return false;
    }else if ($('#password').val() != $('#password2').val()){
        toastr.error('Las contraseñas no coinciden.', 'Error', {timeOut: 3000});
        return false;
    }
    idForm = $(this).data('form');
    route = $('#'+idForm).data('route');
    method = $('#'+idForm).data('method');

    $.ajax({
        url: route,
        type: method,
        data: $('#' + idForm).serialize(),
        success: function (d) {

            if (d == 'maildup') {
                toastr.warning('El correo electrónico ingresado ya existe.', 'Error', {timeOut: 3000});
                return false;
            }else if (d == 'exito') {
                toastr.success('Registro exitoso. Espere un momento...', 'Correcto!!', {timeOut: 3000});
                location.href= '/login';
                return true;
            } else {
                toastr.error('Compruebe que los campos ingresados sean correctos', 'Error', {timeOut: 3000});
                $('#email').focus();
                return false;
            }

        }
    });
});
