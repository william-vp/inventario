function convertir_moneda() {
    if ($('#input1').val() == '' ) {
        //toastr.error('Complete el campo: Nombre', 'Error', {timeOut: 3000});
        //$('#nombre_edit').focus();
        //return false;
    }
    if ($('#input2').val() == '' ) {
        //toastr.error('Complete el campo: Nombre', 'Error', {timeOut: 3000});
        //$('#nombre_edit').focus();
        //return false;
    }

    var formData = new FormData($("#formCurrency")[0]);

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'convertir_moneda',
        type: 'POST',
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function (data) {
            console.log(data);
        }
    });
}

$(document).on('keyup', "#input1", function () {
   convertir_moneda();
});
$(document).on('keyup', "#input2", function () {
    convertir_moneda();
});
