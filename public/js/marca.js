function validacionForm ()
{
	if (marca.val().length == 0) {
		marca.removeClass('is-valid').addClass('is-invalid');
		$('#marcaEmpty').show();
		$('#marcaNotOnly').hide();
		$('#marcaResponse').hide();
		marcaValido = false;
	}
	else {
		if (validarOnlyLetrasBoolean(marca.val())) {
			marca.removeClass('is-invalid').addClass('is-valid');
			$('#marcaEmpty').hide();
			$('#marcaNotOnly').hide();
			$('#marcaResponse').hide();
			marcaValido = true;
		}
		else {
			marca.removeClass('is-valid').addClass('is-invalid');
			$('#marcaEmpty').hide();
			$('#marcaNotOnly').show();
			$('#marcaResponse').hide();
			marcaValido = false;
		}
	}
}
function validacionRespuesta (errors)
{
	if (errors.marca != undefined && errors.marca.length > 0) {
		marca.removeClass('is-valid').addClass('is-invalid');
		$('#marcaEmpty').hide();
		$('#marcaNotOnly').hide();
		$('#marcaResponse').show();
		$('#marcaResponseTexto').text(errors.marca[0]);
	}
	else {
		marca.removeClass('is-invalid').addClass('is-valid');
		$('#marcaEmpty').hide();
		$('#marcaNotOnly').hide();
		$('#marcaResponse').hide();
	}
}
