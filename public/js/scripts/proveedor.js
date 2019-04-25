$('.modal-footer').on('click', ".btnProveedorAdd", function () {
    var reg = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
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
        toastr.error('Complete el campo: Id del Proveedor', 'Error', {timeOut: 3000});
        $('#id_add').focus();
        return false;
    }else if ($('#nombre_add').val() == '') {
        toastr.error('Complete el campo: Nombre del Proveedor', 'Error', {timeOut: 3000});
        $('#nombre_add').focus();
        return false;
    }else if ($('#telefono_add').val() == '') {
        toastr.error('Complete el campo: Teléfono.', 'Error', {timeOut: 3000});
        $('#telefono_add').focus();
        return false;
    }else if ($('#correo_add').val() != ''){

        if (reg.test($('#correo_add').val()) == false){
            toastr.error('Verifique el campo: Correo.', 'Error', {timeOut: 3000});
            $('#correo_add').focus();
            return false;
        }

    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/proveedores',
        type: 'POST',
        data: $('#formNuevoProveedor').serialize(),
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
                toastr.success('Proveedor Ingresado Correctamente.', 'Correcto', {timeOut: 4000});

                var str2= location.href;
                if (str2.indexOf("proveedores") != -1){
                    location.href= '/proveedores/?search='+$('#nombre_add').val();
                }else{
                    $("#inputProveedor").val($('#id_add').val());
                    $("#inputProveedor").keyup();
                    $('#ModalNuevoProveedor').modal('toggle');
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
                toastr.warning('El Id de Proveedor ingresado ya existe.', 'Error', {timeOut: 2000});
                
                $("#id_add").focus();
                $("#inputProveedor").val($('#id_add').val());
                return false;
                
            }else {
                toastr.error('Ha ocurrido un error ingresando nuevo Proveedor. Intente de nuevo.', 'Error', {timeOut: 3000});
                return false;
            }

        }
    });
});


$(document).on('click', "#btnUpdateProveedor", function () {
    var reg = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
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
        toastr.error('Complete el campo: Id del Proveedor', 'Error', {timeOut: 3000});
        $('#id_edit').focus();
        return false;
    }else if ($('#nombre_edit').val() == '') {
        toastr.error('Complete el campo: Nombre del Proveedor', 'Error', {timeOut: 3000});
        $('#nombre_edit').focus();
        return false;
    }else if ($('#telefono_edit').val() == '') {
        toastr.error('Complete el campo: Teléfono.', 'Error', {timeOut: 3000});
        $('#telefono_edit').focus();
        return false;
    }else if ($('#correo_edit').val() != ''){

        if (reg.test($('#correo_edit').val()) == false){
            toastr.error('Verifique el campo: Correo.', 'Error', {timeOut: 3000});
            $('#correo_edit').focus();
            return false;
        }

    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'update',
        type: 'PUT',
        data: $('#formEditProveedor').serialize(),
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
                toastr.success('Datos de Proveedor guardados Correctamente.', 'Correcto', {timeOut: 4000});

                var str2= location.href;
                if (str2.indexOf("proveedores") != -1){
                    location.href= '/proveedores/?search='+$('#nombre_edit').val();
                }else{
                    $("#inputProveedor").val($('#id_edit').val());
                    $("#inputProveedor").keyup();
                    $('#ModalNuevoProveedor').modal('toggle');
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
                toastr.warning('El Id de Proveedor ingresado ya existe.', 'Error', {timeOut: 2000});
                
                $('#ModalNuevoProveedor').modal('toggle');
                $("#inputProveedor").val($('#id_edit').val());
                return false;
                
            }else {
                toastr.error('Ha ocurrido un error ingresando nuevo Proveedor. Intente de nuevo.', 'Error', {timeOut: 3000});
                return false;
            }

        }
    });
});


$(document).on('keyup', "#inputProveedor", function () {
    if ($("inputProveedor").val() != ''){
        $("#divNom").hide();
        $("#nombre_proveedor").val("");
        $("#divDir").hide();
        $("#direccion_proveedor").val("");
        $("#divTel").hide();
        $("#telefono_proveedor").val("");
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'getDataProveedor',
        type: 'POST',
        data: 'id='+$("#inputProveedor").val(),
        success: function (data) {
            if (data != ''){
                $("#idProveedor").val(data.id);
                $("#divNom").show();
                $("#nombre_proveedor").val(data.nombre);
                $("#divDir").show();
                $("#direccion_proveedor").val(data.direccion);
                $("#divTel").show();
                $("#telefono_proveedor").val(data.telefono);
            }else {
                $("#divNom").hide();
                $("#divDir").hide();
                $("#divTel").hide();
            }

        }
    });
});