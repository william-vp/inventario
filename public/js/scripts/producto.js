
//store
$(document).on('click', ".btnProduct", function () {
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

    if ($('#id_add').val() == '' ) {
        toastr.error('Complete el campo: Id de Producto', 'Error', {timeOut: 3000});
        $('#id_add').focus();
        return false;
    }else if ($('#nombre_add').val() == '' ) {
        toastr.error('Complete el campo: Nombre de Producto', 'Error', {timeOut: 3000});
        $('#nombre_add').focus();
        return false;
    }else if ($('#precioc_add').val() == '' ) {
        toastr.error('Complete el campo: Precio de Compra', 'Error', {timeOut: 3000});
        $('#precioc_add').focus();
        return false;
    }else if ($('#preciov_add').val() == '' ) {
        toastr.error('Complete el campo: Precio de Venta', 'Error', {timeOut: 3000});
        $('#preciov_add').focus();
        return false;
    }else if ($('#cantidadm_add').val() == '') {
        toastr.error('Complete el campo: Cantidad en Mostrador', 'Error', {timeOut: 3000});
        $('#cantidadm_add').focus();
        return false;
    }else if ($('#cantidadb_add').val() == '' ) {
        toastr.error('Complete el campo: Cantidad en Bodega', 'Error', {timeOut: 3000});
        $('#cantidadb_add').focus();
        return false;
    }else if ($('#fecha_add').val() == '' ) {
        //toastr.error('Complete el campo: Fecha de Vencimiento', 'Error', {timeOut: 3000});
        //$('#fecha_add').focus();
        //return false;
    }else if ($('#categoria_add').val() == null) {
        toastr.error('Complete el campo: Categoria/Tipo Productoa', 'Error', {timeOut: 3000});
        $('#categoria_add').focus();
        return false;
    }else if ($('#unidad_add').val() == null) {
        toastr.error('Complete el campo: Unidad de Medida', 'Error', {timeOut: 3000});
        $('#unidad_add').focus();
        return false;
    }else if ($('#estado_add').val() == null) {
        toastr.error('Complete el campo: Estado del Producto', 'Error', {timeOut: 3000});
        $('#estado_add').focus();
        return false;
    }


    var imagen = $("#imagen_add");
    if (imagen.val().trim() != ''){
        var sizeByte = imagen[0].files[0].size;
        var sizekiloBytes = parseInt(sizeByte / 1024);
        if (sizekiloBytes > 2000) {
            toastr.info('La Imagen no puede pesar más de 2MB', 'Error', {timeOut: 3000});
            $('#imagen_add').focus();
            return false;
        }
    }

    const formData = new FormData($("#formNewProduct")[0]);
    formData.append('imagen', $('#imagen_add').val());

    $.ajax({
        url: '/productos',
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
                toastr.success('Producto Ingresado.', 'Correcto', {timeOut: 3000});
                location.href= '/productos/?search='+$('#nombre_add').val();
            }else if (data == 'dup'){
                toastr.warning('Este nombre de producto ya esta registrado.', 'Error', {timeOut: 3000});
                return false;
            }else if (data == 'dup2'){
                toastr.warning('Este Id de producto ya esta en uso.', 'Error', {timeOut: 3000});
                return false;
            }else {
                toastr.error('Ha ocurrido un error ingresando el producto. Intente de nuevo.', 'Error', {timeOut: 3000});
                return false;
            }

        }
    });
});

//update
$(document).on('click', ".btnUpdate", function () {
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

    if ($('#id_edit').val() == '' ) {
        toastr.error('Complete el campo: Id de Producto', 'Error', {timeOut: 3000});
        $('#id_edit').focus();
        return false;
    }else if ($('#nombre_edit').val() == '' ) {
        toastr.error('Complete el campo: Nombre de Producto', 'Error', {timeOut: 3000});
        $('#nombre_edit').focus();
        return false;
    }else if ($('#precioc_edit').val() == '' ) {
        toastr.error('Complete el campo: Precio de Compra', 'Error', {timeOut: 3000});
        $('#precioc_edit').focus();
        return false;
    }else if ($('#preciov_edit').val() == '' ) {
        toastr.error('Complete el campo: Precio de Venta', 'Error', {timeOut: 3000});
        $('#preciov_edit').focus();
        return false;
    }else if ($('#cantidadm_edit').val() == '') {
        toastr.error('Complete el campo: Cantidad en Mostrador', 'Error', {timeOut: 3000});
        $('#cantidadm_edit').focus();
        return false;
    }else if ($('#cantidadb_edit').val() == '' ) {
        toastr.error('Complete el campo: Cantidad en Bodega', 'Error', {timeOut: 3000});
        $('#cantidadb_edit').focus();
        return false;
    }else if ($('#fecha_edit').val() == '' ) {
        //toastr.error('Complete el campo: Fecha de Vencimiento', 'Error', {timeOut: 3000});
        //$('#fecha_edit').focus();
        //return false;
    }else if ($('#categoria_edit').val() == null) {
        toastr.error('Complete el campo: Categoria/Tipo Productoa', 'Error', {timeOut: 3000});
        $('#categoria_edit').focus();
        return false;
    }else if ($('#unidad_edit').val() == null) {
        toastr.error('Complete el campo: Unidad de Medida', 'Error', {timeOut: 3000});
        $('#unidad_edit').focus();
        return false;
    }else if ($('#estado_edit').val() == null) {
        toastr.error('Complete el campo: Estado del Producto', 'Error', {timeOut: 3000});
        $('#estado_edit').focus();
        return false;
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

    const formDataUpdate = new FormData($("#formEditProduct")[0]);
    formDataUpdate.append('imagen', $('#imagen_edit').val());

    $.ajax({
        url: 'update',
        type: 'POST',
        data: formDataUpdate,
        /*data: {
            '_token': $('input[name=_token]').val(),
            'nombre': $('#nombre_edit').val(),
            'precio_compra': $('#precioc_edit').val(),
            'precio_venta': $('#preciov_edit').val(),
            'mostrador': $('#cantidadm_edit').val(),
            'existencias': $('#cantidadb_edit').val(),
            'fecha': $('#fecha_edit').val(),
            'categoria_id': $('#categoria_edit').val(),
            'unidad_id': $('#unidad_edit').val(),
            'descripcion': $('#descripcion_edit').val(),
            'imagen': $('#imagen_edit').val(),
            'estado': $('#estado_edit').val(),
        },*/
        cache:false,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
                }
                toastr.success('Producto Actualizado.', 'Correcto', {timeOut: 3000});
                location.href= '/productos/?search='+$('#nombre_edit').val();
            }else if (data == 'dup'){
                toastr.warning('Este Id de producto ya esta registrado.', 'Error', {timeOut: 3000});
                return false;
            }else if (data == 'dup2'){
                toastr.warning('Este Nombre de producto ya esta en uso.', 'Error', {timeOut: 3000});
                return false;
            }else {
                toastr.error('Ha ocurrido un error actualizando el producto. Intente de nuevo.', 'Error', {timeOut: 3000});
                return false;
            }

        }
    });
});


//mostrador
$(document).on('click', ".btnplus1", function () {
    var existente= $("#cantExist").val();
    var mostrador= $('#cantidadm_edit').val();
    var bodega= $('#cantidadb_edit').val();

    mostrador= parseInt(mostrador);
    bodega= parseInt(bodega);
    existente= parseInt(existente);
    var sumatoria= mostrador + bodega;

    if (mostrador > existente ){
        toastr.error('el valor sobrepasa a la existencia total.', 'Error', {timeOut: 3000});
        $('#cantidadm_edit').focus();
        $('.btnTraslado').hide();
        return false;
    }
    if (sumatoria > existente ){
        toastr.error('el valor sobrepasa a la existencia total.', 'Error', {timeOut: 3000});
        $('#cantidadm_edit').focus();
        $('.btnTraslado').hide();
        return false;
    }

    $('#cantidadm_edit').val(mostrador + 1);
    $('#cantidadb_edit').val(bodega - 1);
    $('.btnTraslado').show();
});

$(document).on('click', ".btnminus1", function () {
    var existente= $("#cantExist").val();
    var mostrador= $('#cantidadm_edit').val();
    var bodega= $('#cantidadb_edit').val();

    mostrador= parseInt(mostrador);
    bodega= parseInt(bodega);
    existente= parseInt(existente);
    var sumatoria= mostrador + bodega;

    if (mostrador > existente || mostrador < 0){
       toastr.error('el valor sobrepasa a la existencia total.', 'Error', {timeOut: 3000});
        $('#cantidadm_edit').focus();
        $('.btnTraslado').hide();
        return false;
    }

    if (sumatoria > existente ){
        toastr.error('el valor sobrepasa a la existencia total.', 'Error', {timeOut: 3000});
        $('#cantidadm_edit').focus();
        $('.btnTraslado').hide();
        return false;
    }

    $('#cantidadm_edit').val(mostrador - 1);
    $('#cantidadb_edit').val(bodega + 1);
    $('.btnTraslado').show();
});

$(document).on('change', "#cantidadm_edit", function () {
    var existente= $("#cantExist").val();
    var mostrador= $('#cantidadm_edit').val();
    var bodega= $('#cantidadb_edit').val();
    mostrador= parseInt(mostrador);
    bodega= parseInt(bodega);
    existente= parseInt(existente);
    var sumatoria= mostrador + bodega;

    if (mostrador < 0){
        toastr.error('cantidad invalida.', 'Error', {timeOut: 3000});
        $('#cantidadm_edit').val('0');
        return false;
    }
    if (mostrador > existente || mostrador < 0){
        toastr.error('el valor sobrepasa a la existencia total.', 'Error', {timeOut: 3000});
        $('#cantidadm_edit').focus();
        $('.btnTraslado').hide();
        return false;
    }

    var resta= existente - mostrador;
    $('#cantidadm_edit').val(mostrador);
    $('#cantidadb_edit').val(resta);
    $('.btnTraslado').show();
});



//bodega
$(document).on('click', ".btnplus2", function () {
    var existente= $("#cantExist").val();
    var mostrador= $('#cantidadm_edit').val();
    var bodega= $('#cantidadb_edit').val();

    mostrador= parseInt(mostrador);
    bodega= parseInt(bodega);
    existente= parseInt(existente);
    var sumatoria= mostrador + bodega;

    if (bodega > existente){
        toastr.error('el valor sobrepasa a la existencia total.', 'Error', {timeOut: 3000});
        $('#cantidadb_edit').focus();
        $('.btnTraslado').hide();
        return false;
    }

    if (sumatoria > existente ){
        toastr.error('el valor sobrepasa a la existencia total.', 'Error', {timeOut: 3000});
        $('#cantidadb_edit').focus();
        $('.btnTraslado').hide();
        return false;
    }

    $('#cantidadb_edit').val(bodega + 1);
    $('#cantidadm_edit').val(mostrador - 1);
    $('.btnTraslado').show();
});

$(document).on('click', ".btnminus2", function () {
    var existente= $("#cantExist").val();
    var mostrador= $('#cantidadm_edit').val();
    var bodega= $('#cantidadb_edit').val();

    mostrador= parseInt(mostrador);
    bodega= parseInt(bodega);
    existente= parseInt(existente);
    var sumatoria= mostrador + bodega;

    if (bodega > existente || bodega < 0){
        toastr.error('el valor sobrepasa a la existencia total.', 'Error', {timeOut: 3000});
        $('#cantidadb_edit').focus();
        $('.btnTraslado').hide();
        return false;
    }

    if (sumatoria > existente){
        toastr.error('el valor sobrepasa a la existencia total.', 'Error', {timeOut: 3000});
        $('#cantidadb_edit').focus();
        $('.btnUpdate').hide();
        return false;
    }

    $('#cantidadb_edit').val(bodega - 1);
    $('#cantidadm_edit').val(mostrador + 1);
    $('.btnTraslado').show();
});

$(document).on('change', "#cantidadb_edit", function () {
    var existente= $("#cantExist").val();
    var mostrador= $('#cantidadm_edit').val();
    var bodega= $('#cantidadb_edit').val();
    mostrador= parseInt(mostrador);
    bodega= parseInt(bodega);
    existente= parseInt(existente);
    var sumatoria= mostrador + bodega;

    if (bodega > existente || bodega < 0){
        toastr.error('el valor sobrepasa a la existencia total.', 'Error', {timeOut: 3000});
        $('#cantidadb_edit').focus();
        $('.btnTraslado').hide();
        return false;
    }

    var resta= existente - bodega;
    $('#cantidadm_edit').val(resta);
    $('#cantidadb_edit').val(bodega);
    $('.btnTraslado').show();
});



//traslado
$(document).on('click', ".btnTraslado", function () {
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

    if ($('#cantidadm_edit').val() == '') {
        toastr.error('Complete el campo: Cantidad en Mostrador', 'Error', {timeOut: 3000});
        $('#cantidadm_edit').focus();
        return false;
    }else if ($('#cantidadb_edit').val() == '' ) {
        toastr.error('Complete el campo: Cantidad en Bodega', 'Error', {timeOut: 3000});
        $('#cantidadb_edit').focus();
        return false;
    }

    const formDataUpdate = new FormData($("#formTransladoProducto")[0]);

    $.ajax({
        url: 'trasladar',
        type: 'POST',
        data: formDataUpdate,
        cache:false,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
                }
                toastr.success('Traslado de Producto Realizado Exitosamente.', 'Correcto', {timeOut: 3000});
                location.href= '/productos/?search='+$('#nombre_producto').val();
            }else {
                toastr.error('Ha ocurrido un error realizando el traslado del producto. Intente de nuevo.', 'Error', {timeOut: 3000});
                return false;
            }

        }
    });
});
