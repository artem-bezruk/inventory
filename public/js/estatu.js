function validacionForm ()
{
	if (estatu.val().length == 0) {
		estatu.removeClass('is-valid').addClass('is-invalid');
		$('#estatuEmpty').show();
		$('#estatuNotOnly').hide();
		$('#estatuResponse').hide();
		estatuValido = false;
	}
	else {
		if (validarOnlyLetrasBoolean(estatu.val())) {
			estatu.removeClass('is-invalid').addClass('is-valid');
			$('#estatuEmpty').hide();
			$('#estatuNotOnly').hide();
			$('#estatuResponse').hide();
			estatuValido = true;
		}
		else {
			estatu.removeClass('is-valid').addClass('is-invalid');
			$('#estatuEmpty').hide();
			$('#estatuNotOnly').show();
			$('#estatuResponse').hide();
			estatuValido = false;
		}
	}
}
function validacionRespuesta (errors)
{
	if (errors.estatu != undefined && errors.estatu.length > 0) {
		estatu.removeClass('is-valid').addClass('is-invalid');
		$('#estatuEmpty').hide();
		$('#estatuNotOnly').hide();
		$('#estatuResponse').show();
		$('#estatuResponseTexto').text(errors.estatu[0]);
	}
	else {
		estatu.removeClass('is-invalid').addClass('is-valid');
		$('#estatuEmpty').hide();
		$('#estatuNotOnly').hide();
		$('#estatuResponse').hide();
	}
}
