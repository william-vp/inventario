function number_format(number, decimals, dec_point, thousands_sep) {
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}
function cargarDatos(data, descuento) {
    var formaPago= $("#formaPago").val();
    var descuento=  descuento;
    if (descuento == null || descuento <= '0' || descuento=='undefined'){
        descuento= 0;
    }else if (formaPago == '0'){
        descuento= 0;
    }

    var total= 0;
    var subtotal= 0;
    var totalFactura= 0;
    var impuesto= 0;
    var totalIVa= 0;
    var valDescuento= 0;
    var ids= [];
    var cantidades= [];
    var precios= [];
    var impuestos= [];

    $("#divProductAdds").show();
    $('#divBtnSave').show();

    for (i = 0; i < data.length; i++){

        $('#check_'+data[i].idProd).show();
        var table = document.getElementById("tablaDetalles");
        {
            cantidad= parseInt(data[i].cantidad);
            precio= parseFloat(data[i].precio);
            impuesto= data[i].impuesto;

            ids.push(data[i].idProd);
            cantidades.push(cantidad);
            precios.push(precio);
            impuestos.push(impuesto);

            $('#cant_'+data[i].idProd).val(cantidad);

            total= precio * cantidad;

            ivaP= total*(impuesto / 100);
            ivaP= parseFloat(ivaP);

            totalIVa+= ivaP;

            subtotal += total;
            subtotal= parseFloat(subtotal);

            iva= subtotal*(0.19);
            iva= parseFloat(iva);

            if (descuento > 0){
                valDescuento= subtotal * (descuento / 100);
            }else{
                valDescuento= 0;
            }

            totalFactura= subtotal + totalIVa;
            totalFactura= totalFactura - parseFloat(valDescuento);
            totalFactura= parseFloat(totalFactura);

            var row = table.insertRow();
            row.className= 'trAgProduct';
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            var cell7 = row.insertCell(6);
            var cell8 = row.insertCell(7);
            cell1.innerHTML = data[i].idProd;
            cell2.innerHTML = data[i].nombre;
            cell3.innerHTML = "<input type='text' class='form-control inputTable col-sm-10 col-xs-6' style='' value='"+cantidad+"' data-id='"+data[i].idTemp+"' id='editCant_"+data[i].idTemp+"' >";
            cell4.innerHTML = precio;
            cell5.innerHTML = impuesto+'%';
            cell6.innerHTML = '$'+number_format(ivaP,'2',',','.');
            cell7.innerHTML = '$'+number_format(total,'2',',','.');
            cell8.innerHTML = "<button type='button' class='btn btn-danger' data-toggle='tooltip' title='Quitar este producto' id='btnDeleteProduct' data-id='"+data[i].idTemp+"'><i class='ti-trash'></i></button>";
        }
    }
    var table = document.getElementById("tablaDetalles");
    {
        var row = table.insertRow();
        row.className= 'trAgProduct';
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);
        var cell7 = row.insertCell(6);
        var cell8 = row.insertCell(7);
        cell1.innerHTML = '';
        cell2.innerHTML = '';
        cell3.innerHTML = '';
        cell4.innerHTML = '';
        cell5.innerHTML = '';
        cell6.innerHTML = '<strong>SUBTOTAL</strong>';
        cell7.innerHTML = '$'+number_format(subtotal,'2',',','.');
        cell8.innerHTML = "<button type='button' class='btn btn-danger' data-toggle='tooltip' title='Quitar todos los productos' id='btnDeleteAll'><i class='ti-trash'></i></button>";

    }
    var table = document.getElementById("tablaDetalles");
    {
        var row = table.insertRow();
        row.className= 'trAgProduct';
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);
        var cell7 = row.insertCell(6);
        var cell8 = row.insertCell(7);
        cell1.innerHTML = '';
        cell2.innerHTML = '';
        cell3.innerHTML = '';
        cell4.innerHTML = '';
        cell5.innerHTML = '';
        cell6.innerHTML = '<strong>IVA</strong>';
        cell7.innerHTML = '$'+number_format(totalIVa,'2',',','.');
        cell8.innerHTML = '';
    }
    var table = document.getElementById("tablaDetalles");
    {
        var row = table.insertRow();
        row.className = 'trAgProduct';
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);
        var cell7 = row.insertCell(6);
        var cell8 = row.insertCell(7);
        var cell9 = row.insertCell(8);

        if (formaPago == '0') {
            cell1.innerHTML = '';
            cell2.innerHTML = '';
            cell3.innerHTML = '';
            cell4.innerHTML = '';
        }else {
            cell1.innerHTML = '<strong>DESCUENTO</strong>';
            cell2.innerHTML = "<input type='text' class='form-control inputDescuento' style='' value='" + descuento + "' id='descuento' placeholder='Porcentaje descuento' >";
            cell3.innerHTML = '<strong>VALOR DESCUENTO</strong>';
            cell4.innerHTML = '$' + number_format(valDescuento, '2', ',', '.');
        }
        cell5.innerHTML = '';
        cell6.innerHTML = '<strong>TOTAL</strong>';
        cell7.innerHTML = '$' + number_format(totalFactura, '2', ',', '.');
        cell8.innerHTML = '';
    }

    $("#nPd").val(ids);
    $("#cPd").val(cantidades);
    $("#pPd").val(precios);
    $("#iPd").val(impuestos);
    $("#sF").val(subtotal);
    $("#iF").val(totalIVa);
    $("#tF").val(totalFactura);
}

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
                toastr.success('CAJA ABIERTA.', 'Correcto', {timeOut: 4000});
                location.reload();
            }else {
                toastr.error('Ha ocurrido un error abriendo la caja. Intente de nuevo.', 'Error', {timeOut: 3000});
                return false;
            }

        }
    });
});


$(document).on('keyup', "#inputCliente", function () {
    if ($("inputCliente").val() != ''){
        $("#divNom").hide();
        $("#nombre_cliente").val("");
        $("#divDir").hide();
        $("#direccion_cliente").val("");
        $("#divTel").hide();
        $("#telefono_cliente").val("");
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'getDataClient',
        type: 'POST',
        data: 'id='+$("#inputCliente").val(),
        success: function (data) {
            if (data != ''){
                $("#idCliente").val(data.id);
                $("#divNom").show();
                $("#nombre_cliente").val(data.nombre);
                $("#divDir").show();
                $("#direccion_cliente").val(data.direccion);
                $("#divTel").show();
                $("#telefono_cliente").val(data.telefono);
            }else {
                $("#divNom").hide();
                $("#divDir").hide();
                $("#divTel").hide();
            }

        }
    });
});

$(document).on('click', "#btnAddProducto", function () {
    const id = $(this).data('id');
    const max = $(this).data('max');
    var precio=  $('#precio_'+id).val();
    var cantidad=  $('#cant_'+id).val();
    var nombre=  $('#nom_'+id).text();
    var caja=  $('#id_caja').val();
    var formaPago= $("#formaPago").val();

    if (cantidad > max){
        toastr.warning('<strong>No es posible vender esa cantidad. Sobrepasa la cantidad en mostrador: '+max+'</strong>', 'Error', {timeOut: 6000});
        $('#cant_'+id).focus();
        return false;
    }

    if (formaPago == '0'){
        descuento= 0;
    }else{
        var descuento=  $('#descuento').val();
    }

    if (precio.trim() == '' || precio.trim() == '' || precio.trim() <= 0) {
        $('#precio_'+id).focus();
        return false;
    }else if(cantidad.trim() == '' || cantidad <= 0){
        $('#cant_'+id).focus();
        return false;
    }else{
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'addProduct',
            type: 'POST',
            data: 'id='+id+'&precio='+precio+'&cantidad='+cantidad+'&caja_id='+caja,
            success: function (data) {
                if (data != ''){
                    $("#divProductAdds").show();
                    $('.checkProducto').hide();
                    $(".trAgProduct").remove();
                    $('#divBtnSave').show();

                    cargarDatos(data, descuento);

                }else {
                    $("#divProductAdds").hide();
                }

            }
        });
    }
});

$(document).on('keyup', ".inputTable", function () {
    const id = $(this).data('id');
    var caja=  $('#id_caja').val();
    var cantidad=  $('#editCant_'+id).val();
    var formaPago= $("#formaPago").val();
    if (formaPago == '0' || formaPago == 0){
        descuento= 0;
    }else{
        var descuento=  $('#descuento').val();
    }
    if (cantidad <= 0){
        toastr.error('Ninguna cantidad puede ser igual o inferior a cero (0). puedes quitar el producto.', 'Error', {timeOut: 5000});
        $('#editCant_'+id).val('1');

        return false;
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: 'editProduct',
        data: 'caja_id=' + caja+'&id='+id+'&cantidad='+cantidad,
        success: function (data) {
            if (data != ''){
                $(".trAgProduct").remove();
                $("#divProductAdds").hide();
                $('.checkProducto').hide();
                $('#divBtnSave').hide();
                cargarDatos(data, descuento);
            }else{
                $("#divProductAdds").hide();
                $('.btnSearchProducts').focus();
                $('.checkProducto').hide();
            }

        }
    });
});

$(document).on('change', "#formaPago", function () {
    var formaPago= $("#formaPago").val();
    if (formaPago == 0 || formaPago=='0'){
        $(".divNoFac").hide();
        $(".divNoCredito").show();
        $("#valBtnSave").text("Generar Credito");
    }else{
        $(".divNoFac").show();
        $(".divNoCredito").hide();
        $("#valBtnSave").text("Generar Factura");
    }
    queryProducts();
});

$(document).on('keyup', ".inputDescuento", function () {
    queryProducts();
});

function queryProducts(){
    if (formaPago == '0'){
        descuento= 0;
    }else{
        var descuento=  $('#descuento').val();
    }

    var caja=  $('#id_caja').val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'queryProducts',
        type: 'POST',
        data: 'caja_id=' + caja,
        success: function (data) {
            if (data != ''){
                $("#divProductAdds").show();
                $('.checkProducto').hide();
                $(".trAgProduct").remove();
                $('#divBtnSave').show();

                cargarDatos(data, descuento);
            }
        }
    });
}

$(document).on('click', "#btnDeleteProduct", function () {
    const id = $(this).data('id');
    var caja=  $('#id_caja').val();
    var formaPago= $("#formaPago").val();
    if (formaPago == '0'){
        descuento= 0;
    }else{
        var descuento=  $('#descuento').val();
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'removeProduct',
        type: 'POST',
        data: 'caja_id=' + caja+'&id='+id,
        success: function (data) {
            if (data != ''){
                $(".trAgProduct").remove();
                $("#divProductAdds").hide();
                $('.checkProducto').hide();
                $('#divBtnSave').hide();
                cargarDatos(data, descuento);
            }else{
                $("#divProductAdds").hide();
                $('.btnSearchProducts').focus();
                $('.checkProducto').hide();
            }

        }
    });
});

$(document).on('click', "#btnDeleteAll", function () {
    var caja=  $('#id_caja').val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'removeAll',
        type: 'POST',
        data: 'caja_id=' + caja,
        success: function (data) {
            if (data == 'exito'){
                $(".trAgProduct").remove();
                $("#divProductAdds").hide();
                $('.checkProducto').hide();
                $('.btnSearchProducts').focus();
                $('#divBtnSave').hide();

            }else{
                toastr.error('Ha ocurrido un error. intente de nuevo.', 'Error', {timeOut: 3000});
            }

        }
    });
});
$(document).on('click', ".btnP", function () {
    $('#cliente').append($('<option>', {
        value: 1222,
        text: 'My option'
    }));
});

$(document).on('click', "#btnSave", function () {
    //cargar datos
    queryProducts();
    var formaPago = $("#formaPago").val();
    if (formaPago == 0 || formaPago=='0'){
        crearCredito();
    }else{
        generarFactura();
    }
});

function generarFactura() {
    //datos
    const id = $("#no_fac").val();
    var cliente = $("#idCliente").val();
    var descuento = $("#descuento").val();

    var caja=  $('#id_caja').val();
    var observaciones=  $('#observaciones').val();
    var idsProd= $("#nPd").val();
    var cants= $("#cPd").val();
    var precios= $("#pPd").val();
    var impuestos= $("#iPd").val();
    var subtotal= $("#sF").val();
    var iva= $("#iF").val();
    var total= $("#tF").val();

    if (cliente.trim() == null || cliente.trim() == ''){
        toastr.error('Elije un cliente.', 'Error', {timeOut: 5000});
        $("#inputCliente").focus();
        return false;
    }
    if (formaPago== null || formaPago== ''){
        toastr.error('Elije Forma de pago.', 'Error', {timeOut: 5000});
        $("#formaPago").focus();
        return false;
    }
    var ids = idsProd.split(",");
    if (ids.length <= 0){
        toastr.error('Añade al menos un producto a la factura.', 'Error', {timeOut: 5000});
        $("#btnSave").focus();
        return false;
    }
    var arrayCants= cants.split(",");
    for (var i in arrayCants) {
        if(arrayCants[i] <= 0){
            toastr.error('Ninguna cantidad puede ser igual o inferior a cero (0).', 'Error', {timeOut: 4000});
            return false;
        }
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'store',
        type: 'POST',
        data: 'caja_id=' + caja+'&idFac='+id+'&cliente='+cliente
            +'&ids='+idsProd+'&cants='+cants+'&precios='+precios+'&impuestos='+impuestos
            +'&subtotal='+subtotal+'&descuento='+descuento+'&iva='+iva+'&total='+total
            +'&observacion='+observaciones,
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
                    toastr.success('Factura Generada.', 'Correcto', {timeOut: 3000});
                    location.href='/ventas/'+id;
            }else{
                toastr.error('Ha ocurrido un error generando la factura. Intente de nuevo.', 'Error', {timeOut: 3000});
            }

        }
    });
}

function crearCredito() {
        //datos
        const id = $("#no_credito").val();
        var cliente = $("#idCliente").val();

        var caja=  $('#id_caja').val();
        var observaciones=  $('#observaciones').val();
        var idsProd= $("#nPd").val();
        var cants= $("#cPd").val();
        var precios= $("#pPd").val();
        var impuestos= $("#iPd").val();
        var subtotal= $("#sF").val();
        var iva= $("#iF").val();
        var total= $("#tF").val();

        if (cliente.trim() == null || cliente.trim() == ''){
            toastr.error('Elije un cliente.', 'Error', {timeOut: 5000});
            $("#inputCliente").focus();
            return false;
        }
        var ids = idsProd.split(",");
        if (ids.length <= 0){
            toastr.error('Añade al menos un producto a la factura.', 'Error', {timeOut: 5000});
            $("#btnSave").focus();
            return false;
        }
        var arrayCants= cants.split(",");
        for (var i in arrayCants) {
            if(arrayCants[i] <= 0){
                toastr.error('Ninguna cantidad puede ser igual o inferior a cero (0).', 'Error', {timeOut: 4000});
                return false;
            }
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'storeCredit',
            type: 'POST',
            data: 'caja_id=' + caja+'&idCredito='+id+'&cliente='+cliente
                +'&ids='+idsProd+'&cants='+cants+'&precios='+precios+'&impuestos='+impuestos
                +'&subtotal='+subtotal+'&iva='+iva+'&total='+total
                +'&observacion='+observaciones,
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
                        toastr.success('Credito Generado Exitosamente.', 'Correcto', {timeOut: 3000});
                        location.href='/creditos/'+id;
                }else{
                    toastr.error('Ha ocurrido un error generando el credito. Intente de nuevo.', 'Error', {timeOut: 3000});
                }

            }
        });
}

    $('#contado').on('hidden.bs.collapse', function () {
        document.getElementById("btnCollapseContado").text = "Mostrar";
        document.getElementById("btnCollapseContado").className = "btn btn-success text-white";
    });
    $('#contado').on('shown.bs.collapse', function () {
        document.getElementById("btnCollapseContado").text = "Ocultar";
        document.getElementById("btnCollapseContado").className = "btn btn-danger text-white";
    });
    $('#credito').on('hidden.bs.collapse', function () {
        document.getElementById("btnCollapseCredito").text = "Mostrar";
        document.getElementById("btnCollapseCredito").className = "btn btn-success text-white";
    });
    $('#credito').on('shown.bs.collapse', function () {
        document.getElementById("btnCollapseCredito").text = "Ocultar";
        document.getElementById("btnCollapseCredito").className = "btn btn-danger text-white";
    });

$(document).on('click', ".btnAnular", function () {
    var codigo= $(this).data('id');
    swal({
        title: "Anular Factura",
        text: "Estas a punto de anular la factura: "+codigo,
        icon: "error",
        //buttons: true,
        dangerMode: true,
        closeOnClickOutside: true,
        buttons: ["Cancelar", "Continuar"],
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/ventas/{id}/anular',
                type: 'POST',
                data: 'id=' + codigo,
                success: function (data) {
                    if (data === 'ok'){
                        toastr.success('<strong>La Factura ha sido anulada correctamente.</strong>', 'Hecho', {timeOut: 6000});
                        location.reload();
                    }else{
                        toastr.error('<strong>No es posible anular esta factura. Intente nuevamente</strong>', 'Error', {timeOut: 6000});
                    }
                }
            });
        }
    });
});
