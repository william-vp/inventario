$(document).on('click', ".btnOpen", function () {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
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
    if ($('#base_add').val() == '') {
        toastr.error('Complete el campo.', 'Error', {timeOut: 3000});
        $('#base_add').focus();
        return false;
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'cajas',
        type: 'POST',
        data: $('#formOpen').serialize(),
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
                },
                //toastr.success('CAJA ABIERTA.', 'Correcto', {timeOut: 4000});
                location.reload();
            }else if (data == 'error'){
                toastr.error('Ha ocurrido un error abriendo la caja. Intente de nuevo.', 'Error', {timeOut: 3000});
                return false;
            }

        }
    });
});

$(document).on('click', ".btnClose", function () {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
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
    if ($('#total_close').val() == '') {
        toastr.error('Complete el campo: Valor Total', 'Error', {timeOut: 3000});
        $('#total_close').focus();
        return false;
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'cajas/'+$('input[name=id_caja]').val()+'/close',
        type: 'POST',
        data: {
            '_token': $('input[name=_token]').val(),
            'total': $('#total_close').val(),
            'descripcion': $('#descripcion_add').val(),
        },
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
                },
                toastr.success('CAJA CERRADA EXITOSAMENTE', 'Correcto', {timeOut: 5000});
                location.reload();
            }else {
                toastr.error('Ha ocurrido un error cerrando la caja. Intente de nuevo.', 'Error', {timeOut: 3000});
                return false;
            }

        }
    });
});