$(document).on('click', ".btnEdit", function () {
    const idC= $(this).data('id');
   $("#input_"+idC).show();
   $("#input2_"+idC).show();
   $("#btn_"+idC).show();
   $("#tdAcciones_"+idC).hide();
});
$(document).on('click', ".btnSave", function () {
    id = $(this).data('id');
    route = $("#form_"+id).data('route');
    if ($('#nombre_'+id).val() == '' || $('#nombre_'+id).val() == null ) {
        toastr.error('Complete el campo: Nombre', 'Error', {timeOut: 3000});
        $('#nombre_'+id).focus();
        return false;
    }
    if ($('#imp_'+id).val() == '' || $('#imp_'+id).val() == null ) {
        toastr.error('Complete el campo: Impuesto', 'Error', {timeOut: 3000});
        $('#nombre_'+id).focus();
        return false;
    }

    var nombre= $('#nombre_'+id).val();
    var impuesto= $('#imp_'+id).val();
    const token= $('#token_'+id).val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: route,
        type: 'PUT',
        data: 'nombre='+nombre+'&token='+token+'&id='+id+'&impuesto='+impuesto,
        success: function (data) {
            if (data == 'exito'){
                toastr.success('Categoria Actualizada.', 'Correcto', {timeOut: 3000});
                document.getElementById("td_"+id).innerHTML = nombre;
                document.getElementById("td2_"+id).innerHTML = impuesto;

                $("#input_"+id).hide();
                $("#input2_"+id).hide();
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


$('.modal-footer').on('click', ".add", function () {
    if ($('#nombre_add').val() == '' || $('#nombre_add').val() == null ) {
        toastr.error('Complete el campo.', 'Error', {timeOut: 3000});
        $('#nombre_add').focus();
        return false;
    }
    if ($('#impuesto_add').val() == '' || $('#impuesto_add').val() == null ) {
        toastr.error('Complete el campo.', 'Error', {timeOut: 3000});
        $('#impuesto_add').focus();
        return false;
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'categorias',
        type: 'POST',
        data: {
            '_token': $('input[name=_token]').val(),
            'nombre': $('#nombre_add').val(),
            'impuesto': $('#impuesto_add').val(),
        },
        success: function (data) {
            if (data == 'exito'){
                toastr.success('Categoria ingresada.', 'Correcto', {timeOut: 3000});
                /* $('#tablaCategorias > tbody').append('' +
                    '<tr>' +
                        '<td>'+data+'</td>' +
                        '<td>'+$("#nombre_add").val()+'</td>' +
                        '<td>'+s+'</td>' +
                    '</tr>'); */
                location.reload();
            }else {
                toastr.error('Ha ocurrido un error ingresando categoria. Intente de nuevo.', 'Error', {timeOut: 3000});
                return false;
            }

        }
    });
});
