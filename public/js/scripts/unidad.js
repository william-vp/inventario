$(document).on('click', ".btnEdit", function () {
    const idC= $(this).data('id');
    $("#input_"+idC).show();
    $("#btn_"+idC).show();
    $("#tdAcciones_"+idC).hide();
});
$(document).on('click', ".btnSave", function () {
    id = $(this).data('id');
    route = $("#form_"+id).data('route');
    if ($('#nombre_'+id).val() == '' || $('#nombre_'+id).val() == null ) {
        toastr.error('Complete el campo.', 'Error', {timeOut: 3000});
        $('#nombre_'+id).focus();
        return false;
    }
    const nombre= $('#nombre_'+id).val();
    const token= $('#token_'+id).val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: route,
        type: 'PUT',
        data: 'nombre='+nombre+'&token='+token+'&id='+id,
        success: function (data) {
            if (data == 'exito'){
                toastr.success('Unidad de medida Actualizada.', 'Correcto', {timeOut: 3000});
                document.getElementById("td_"+id).innerHTML = nombre;

                $("#input_"+id).hide();
                $("#btn_"+id).hide();
                $("#tdAcciones_"+id).show();
                //location.reload();
            }else {
                toastr.error('Ha ocurrido un error actualizando. Intente de nuevo.', 'Error', {timeOut: 3000});
                return false;
            }

        }
    });
});

//store
$('.modal-footer').on('click', ".add", function () {
    if ($('#nombre_add').val() == '' || $('#nombre_add').val() == null ) {
        toastr.error('Complete el campo.', 'Error', {timeOut: 3000});
        $('#nombre_add').focus();
        return false;
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'unidades_medida',
        type: 'POST',
        data: {
            '_token': $('input[name=_token]').val(),
            'nombre': $('#nombre_add').val(),
        },
        success: function (data) {
            if (data == 'exito'){
                toastr.success('Unidad de medida ingresada.', 'Correcto', {timeOut: 3000});
                location.reload();
            }else {
                toastr.error('Ha ocurrido un error ingresando Unidad de medida. Intente de nuevo.', 'Error', {timeOut: 3000});
                return false;
            }

        }
    });
});
$('.modal-footer').on('click', ".add", function () {
    if ($('#nombre_add').val() == '' || $('#nombre_add').val() == null ) {
        toastr.error('Complete el campo.', 'Error', {timeOut: 3000});
        $('#nombre_add').focus();
        return false;
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'unidades_medida',
        type: 'POST',
        data: {
            '_token': $('input[name=_token]').val(),
            'nombre': $('#nombre_add').val(),
        },
        success: function (data) {
            if (data == 'exito'){
                toastr.success('Unidad de medida ingresada.', 'Correcto', {timeOut: 3000});
                location.reload();
            }else {
                toastr.error('Ha ocurrido un error ingresando Unidad de medida. Intente de nuevo.', 'Error', {timeOut: 3000});
                return false;
            }

        }
    });
});