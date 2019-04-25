$(document).on('click', ".btnFilter", function () {
    if ($("#fechaIni").val() == ''){
        $("#fechaIni").focus();
        return false;
    }else if ($("#fechaFin").val() == ''){
    	$("#fechaFin").focus();
    	return false;
    }
});