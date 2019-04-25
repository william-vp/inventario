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

$(document).on('click', ".btnAbono", function () {
	var valor= $("#valor_abono").val();
	var restante= $("._inputVR").val();

	if (valor.trim() == null || valor.trim() == ''){
		toastr.error('Verifique el campo Valor Abono.', 'Error', {timeOut: 3000});
		$("#valor_abono").focus();
        return false;
	}
	valor= parseFloat(valor);
	restante= parseFloat(restante);

	if (valor <= 0 ){
		toastr.error('Verifique el campo Valor Abono.', 'Error', {timeOut: 3000});
		$("#valor_abono").focus();
        return false;
	}
	if (valor > restante ){
		toastr.warning('El Valor ingresado es mayor al saldo.', 'Error', {timeOut: 6000});
		$("#valor_abono").focus();
        return false;
	}

	 $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'store',
        type: 'POST',
        data: $('#formAbono').serialize(),
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
                    "hideMethod": "fadeOut" },

                toastr.success('Abono Ingresado Correctamente.', 'Correcto', {timeOut: 4000});
                location.reload();

            }else {
                toastr.error('Ha ocurrido un error ingresando abono. Intente de nuevo.', 'Error', {timeOut: 5000});
                return false;
            }

        }
    });


});


$(document).on('keyup', "#valor_abono", function () {

    var valor= $("#valor_abono").val();
	var restante= $("._inputVR").val();

	valor= parseFloat(valor);
	restante= parseFloat(restante);

	if (valor >= restante){
		var valor= $("#valor_abono").val();
		var restante= $("._inputVR").val();

		$("#valor_abono").val(restante);
		document.getElementById("valor_abono").disabled = true;
		document.getElementById("checkPayAll").checked = true;
		$(".btnAbono").focus();
	}else{
		document.getElementById("valor_abono").disabled = false;
		document.getElementById("checkPayAll").checked = false;
	}	

});

$(document).on('change', "#checkPayAll", function () {

    if(this.checked){
    	var valor= $("#valor_abono").val();
		var restante= $("._inputVR").val();

		$("#valor_abono").val(restante);
		document.getElementById("valor_abono").disabled = true;
		$(".btnAbono").focus();

    }else{ 
    	document.getElementById("valor_abono").disabled = false;
    }

});