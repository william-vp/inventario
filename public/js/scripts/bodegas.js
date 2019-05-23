$(document).on('click', ".btnEdit", function () {
    const idB= $(this).data('id');
    $("#td_"+idB).hide();
    $("#td1_"+idB).hide();
    $("#td2_"+idB).hide();
    $("#input_"+idB).show();
    $("#input1_"+idB).show();
    $("#input2_"+idB).show();
   $("#btn_"+idB).show();
   $("#tdAcciones_"+idB).hide();
});

$(document).on('click', ".btnSave", function () {
    id = $(this).data('id');
    route = $("#form_"+id).data('route');
    if ($('#codigo_'+id).val() == '' || $('#codigo_'+id).val() == null ) {
        toastr.error('Complete el campo: Código', 'Error', {timeOut: 3000});
        $('#codigo'+id).focus();
        return false;
    }
    if ($('#nombre_'+id).val() == '' || $('#nombre_'+id).val() == null ) {
        toastr.error('Complete el campo: Nombre', 'Error', {timeOut: 3000});
        $('#nombre_'+id).focus();
        return false;
    }
    /*if ($('#desc_'+id).val() == '' || $('#desc_'+id).val() == null ) {
        toastr.error('Complete el campo: Descripción', 'Error', {timeOut: 3000});
        $('#nombre_'+id).focus();
        return false;
    }*/

    var codigo= $('#codigo_'+id).val();
    var nombre= $('#nombre_'+id).val();
    var descripcion= $('#desc_'+id).val();
    const token= $('#token_'+id).val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: route,
        type: 'PUT',
        data: 'nombre='+nombre+'&token='+token+'&id='+id+'&descripcion='+descripcion+'&codigo='+codigo,
        success: function (data) {
            if (data === 'exito'){
                toastr.success('Bodega Actualizada.', 'Correcto', {timeOut: 3000});
                $("#td_"+id).show();
                $("#td1_"+id).show();
                $("#td2_"+id).show();
                document.getElementById("td_"+id).innerHTML = codigo;
                document.getElementById("td1_"+id).innerHTML = nombre;
                document.getElementById("td2_"+id).innerHTML = descripcion;

                $("#input_"+id).hide();
                $("#input1_"+id).hide();
                $("#input2_"+id).hide();
                $("#btn_"+id).hide();
                $("#tdAcciones_"+id).show();
                //location.reload();
            }else if (data === 'dup'){
                toastr.warning('El Código ingresado ya esta registrado en otra Bodega.', 'Error', {timeOut: 3000});
                $("#input_"+id).focus();
                return false;
            }else {
                toastr.error('Ha ocurrido un error actualizando. Intente de nuevo.', 'Error', {timeOut: 3000});
                return false;
            }

        }
    });
});


$('.modal-footer').on('click', ".add", function () {
    if ($('#codigo_add').val() == '' || $('#codigo_add').val() == null ) {
        toastr.error('Complete el campo: Código.', 'Error', {timeOut: 3000});
        $('#codigo_add').focus();
        return false;
    }
    if ($('#nombre_add').val() == '' || $('#nombre_add').val() == null ) {
        toastr.error('Complete el campo: Nombre', 'Error', {timeOut: 3000});
        $('#nombre_add').focus();
        return false;
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'bodegas',
        type: 'POST',
        data: {
            '_token': $('input[name=_token]').val(),
            'nombre': $('#nombre_add').val(),
            'codigo': $('#codigo_add').val(),
            'descripcion': $('#descripcion_add').val(),
        },
        success: function (data) {
            if (data === 'exito'){
                toastr.success('Bodega ingresada.', 'Correcto', {timeOut: 3000});
                location.reload();
            }else if (data === 'dup'){
                toastr.warning('El Código ingresado ya esta registrado en otra Bodega.', 'Error', {timeOut: 3000});
                $("#input_"+id).focus();
                return false;
            }else {
                toastr.error('Ha ocurrido un error ingresando la bodega. Intente de nuevo.', 'Error', {timeOut: 3000});
                return false;
            }

        }
    });
});
