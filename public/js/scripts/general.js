$(document).on('click', "#btnSave", function () {
    var reg = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    var regPass= /^(?=.*\d)(?=.*[A-Z])[a-zA-Z0-9]{6,}$/;

    if ($('#nombre_edit').val() == '' ) {
        toastr.error('Complete el campo: Nombre', 'Error', {timeOut: 3000});
        $('#nombre_edit').focus();
        return false;
    }
    if (reg.test($('#email_edit').val()) == false) {
        toastr.error('Verifique el campo: Email Contacto.', 'Error', {timeOut: 3000});
        $('#email_edit').focus();
        return false;
    }
    if ($('#telefono_edit').val() == '' ) {
        toastr.error('Complete el campo: Telefono Contacto', 'Error', {timeOut: 3000});
        $('#telefono_edit').focus();
        return false;
    }

    var logo = $("#logo_edit");
    if (logo.val().trim() != ''){
        var sizeByte = logo[0].files[0].size;
        var sizekiloBytes = parseInt(sizeByte / 1024);
        if (sizekiloBytes > 2000) {
            toastr.info('El Logo no puede pesar más de 2MB', 'Error', {timeOut: 3000});
            $('#logo_edit').focus();
            return false;
        }
    }
    var portada = $("#portada_edit");
    if (portada.val().trim() != ''){
        var sizeByteP = portada[0].files[0].size;
        var sizekiloBytesP = parseInt(sizeByteP / 1024);
        if (sizekiloBytesP > 2000) {
            toastr.info('La portada no puede pesar más de 2MB', 'Error', {timeOut: 3000});
            $('#portada_edit').focus();
            return false;
        }
    }
    
    var formData = new FormData($("#formEditGeneral")[0]);
    formData.append('logo', $('#logo_edit').val());
    formData.append('portada', $('#portada_edit').val());
    
    $.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'general',
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
                toastr.success('Datos Actualizados.', 'Correcto', {timeOut: 3000});
                location.reload();

            }else {
                toastr.error('Ha ocurrido un error actualizando datos. Intente de nuevo.', 'Error', {timeOut: 3000});
                return false;
            }

        }
    });
});
