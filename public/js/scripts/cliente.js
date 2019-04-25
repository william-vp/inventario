$('.modal-footer').on('click', ".btnClientAdd", function () {
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
    if ($('#id_add').val() == '') {
        toastr.error('Complete el campo: Id del Cliente', 'Error', {timeOut: 3000});
        $('#id_add').focus();
        return false;
    }else if ($('#nombre_add').val() == '') {
        toastr.error('Complete el campo: Nombre del Cliente', 'Error', {timeOut: 3000});
        $('#nombre_add').focus();
        return false;
    }else if ($('#telefono_add').val() == '') {
        toastr.error('Complete el campo: Teléfono.', 'Error', {timeOut: 3000});
        $('#telefono_add').focus();
        return false;
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'clientes',
        type: 'POST',
        data: $('#formNuevoCliente').serialize(),
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
                toastr.success('Cliente Ingresado Correctamente.', 'Correcto', {timeOut: 4000});
                $('#cliente').append($('<option>', {
                    value: $('#id_add').val(),
                    text: $('#nombre_add').val(),
                }));

                var str2= location.href;
                if (str2.indexOf("clientes") != -1){
                    location.href= '/clientes/?search='+$('#nombre_add').val();
                }else{
                    $("#inputCliente").val($('#id_add').val());
                    $("#inputCliente").keyup();
                    $('#ModalNuevoCliente').modal('toggle');
                }

                
            }else if (data == 'dup'){
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
                toastr.warning('El Id del cliente ingresado ya existe.', 'Error', {timeOut: 2000});
                
                $('#ModalNuevoCliente').modal('toggle');
                $("#inputCliente").val($('#id_add').val());
                return false;
                
            }else {
                toastr.error('Ha ocurrido un error ingresando nuevo cliente. Intente de nuevo.', 'Error', {timeOut: 3000});
                return false;
            }

        }
    });
});


$(document).on('click', "#btnUpdate", function (){
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
    if ($('#id_edit').val() == '') {
        toastr.error('Complete el campo: Id del Cliente', 'Error', {timeOut: 3000});
        $('#id_edit').focus();
        return false;
    }else if ($('#nombre_edit').val() == '') {
        toastr.error('Complete el campo: Nombre del Cliente', 'Error', {timeOut: 3000});
        $('#nombre_edit').focus();
        return false;
    }else if ($('#telefono_edit').val() == '') {
        toastr.error('Complete el campo: Teléfono.', 'Error', {timeOut: 3000});
        $('#telefono_edit').focus();
        return false;
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'update',
        type: 'PUT',
        data: $('#formEditCliente').serialize(),
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
                toastr.success('Datos de Cliente guardados Correctamente.', 'Correcto', {timeOut: 4000});
                $('#cliente').append($('<option>', {
                    value: $('#id_edit').val(),
                    text: $('#nombre_edit').val(),
                }));

                var str2= location.href;
                if (str2.indexOf("clientes") != -1){
                    location.href= '/clientes/?search='+$('#nombre_edit').val();
                }else{
                    $("#inputCliente").val($('#id_edit').val());
                    $("#inputCliente").keyup();
                    $('#ModalNuevoCliente').modal('toggle');
                }

                
            }else if (data == 'dup'){
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
                toastr.warning('El Id de cliente ingresado ya existe.', 'Error', {timeOut: 2000});
                
                $('#ModalNuevoCliente').modal('toggle');
                $("#inputCliente").val($('#id_edit').val());
                return false;
                
            }else {
                toastr.error('Ha ocurrido un error ingresando nuevo cliente. Intente de nuevo.', 'Error', {timeOut: 3000});
                return false;
            }

        }
    });
});
