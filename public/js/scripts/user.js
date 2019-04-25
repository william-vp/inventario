$(document).on('click', "#btnSave", function () {
    var reg = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    var regPass= /^(?=.*\d)(?=.*[A-Z])[a-zA-Z0-9]{6,}$/;

    if ($('#id_edit').val() == '' ) {
        toastr.error('Complete el campo: Id', 'Error', {timeOut: 3000});
        $('#id_edit').focus();
        return false;
    }
    if ($('#nombre_edit').val() == '' ) {
        toastr.error('Complete el campo: Nombre', 'Error', {timeOut: 3000});
        $('#nombre_edit').focus();
        return false;
    }
    if (reg.test($('#email_edit').val()) == false) {
        toastr.error('Verifique el campo: Correo Electrónico.', 'Error', {timeOut: 3000});
        $('#email_edit').focus();
        return false;
    }

    if ($('#actual_pass').val() != '' || $('#nueva_pass').val() != '' ){

        if ($('#actual_pass').val() == ''){
            toastr.error('Complete el campo: Actual Contraseña.', 'Error', {timeOut: 3000});
            $('#actual_pass').focus();
            return false;
        }
        if ($('#nueva_pass').val() == ''){
            toastr.error('Complete el campo: Nueva Contraseña..', 'Error', {timeOut: 3000});
            $('#nueva_pass').focus();
            return false;
        }

        if (regPass.test($('#actual_pass').val()) == false){
            //toastr.error('La contraseña debe contener 6 caracteres como mínimo, un Digito y una Mayuscula', 'Error', {timeOut: 4000});
            //$('#actual_pass').focus();
            //return false;
        }
        if (regPass.test($('#nueva_pass').val()) == false){
            toastr.error('La contraseña debe contener 6 caracteres como mínimo, un Digito y una Mayuscula', 'Error', {timeOut: 4000});
            $('#nueva_pass').focus();
            return false;
        }

    }
    
    var imagen = $("#imagen_edit");
    if (imagen.val().trim() != ''){
        var sizeByte = imagen[0].files[0].size;
        var sizekiloBytes = parseInt(sizeByte / 1024);
        if (sizekiloBytes > 2000) {
            toastr.info('La Imagen no puede pesar más de 2MB', 'Error', {timeOut: 3000});
            $('#imagen_edit').focus();
            return false;
        }
    }

    var formData = new FormData($("#formEditProfile")[0]);
    formData.append('imagen', $('#imagen_edit').val());

    
    $.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/editarPerfil',
        type: 'POST',
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function (data) {

            if (data == 'exito'){
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
                toastr.success('Perfil Actualizado.', 'Correcto', {timeOut: 3000});
                location.reload();

            }else if (data == 'dup'){
                toastr.warning('El Id ingresando ya esta registrado.', 'Error', {timeOut: 3000});
                return false;
            }else if (data == 'incorrectpass'){
                toastr.warning('La contraseña Actual es incorrecta.', 'Error', {timeOut: 3000});
                return false;
            }else {
                toastr.error('Ha ocurrido un error. Intente de nuevo.', 'Error', {timeOut: 3000});
                return false;
            }

        }
    });
});


$(document).on('click', "#btnEdit", function () {
    var reg = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    var regPass= /^(?=.*\d)(?=.*[A-Z])[a-zA-Z0-9]{6,}$/;

    /*if ($('#id_edit').val() == '' ) {
        toastr.error('Complete el campo: Id', 'Error', {timeOut: 3000});
        $('#id_edit').focus();
        return false;
    }*/
    if ($('#nombre_edit').val() == '' ) {
        toastr.error('Complete el campo: Nombre', 'Error', {timeOut: 3000});
        $('#nombre_edit').focus();
        return false;
    }
    if (reg.test($('#email_edit').val()) == false) {
        toastr.error('Verifique el campo: Correo Electrónico.', 'Error', {timeOut: 3000});
        $('#email_edit').focus();
        return false;
    }

    if ($('#nueva_pass').val() != null && $('#nueva_pass').val().trim() != '' ){
        if (regPass.test($('#nueva_pass').val()) == false){
            toastr.error('La contraseña debe contener 6 caracteres como mínimo, un Digito y una Mayuscula', 'Error', {timeOut: 4000});
            $('#nueva_pass').focus();
            return false;
        }
    }
    
    var formData = new FormData($("#formEditUser")[0]);
    
    $.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'update',
        type: 'PUT',
        data: $('#formEditUser').serialize(),
        success: function (data) {

            if (data == 'exito'){
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
                toastr.success('Perfil Actualizado.', 'Correcto', {timeOut: 3000});
                location.reload();

            }else if (data == 'dup'){
                toastr.warning('El Id ingresando ya esta registrado.', 'Error', {timeOut: 3000});
                return false;
            }else {
                toastr.error('Ha ocurrido un error actualizando el usuario. Intente de nuevo.', 'Error', {timeOut: 3000});
                return false;
            }
        }
    });
});
