function validacionForm ()
{
	if (selectClase.val() == null) {
		selectClase.removeClass('is-valid').addClass('is-invalid');
		$('#claseEmpty').show();
		$('#claseNotNumber').hide();
		$('#claseResponse').hide();
		claseValido = false;
	}
	else {
		if (validateOnlyNumbers(selectClase.val())) {
			selectClase.removeClass('is-invalid').addClass('is-valid');
			$('#claseEmpty').hide();
			$('#claseNotNumber').hide();
			$('#claseResponse').hide();
			claseValido = true;
		}
		else {
			selectClase.removeClass('is-valid').addClass('is-invalid');
			$('#claseEmpty').hide();
			$('#claseNotNumber').show();
			$('#claseResponse').hide();
			claseValido = false;
		}
	}
	if (subclase.val().length == 0) {
		subclase.removeClass('is-valid').addClass('is-invalid');
		$('#subclaseEmpty').show();
		$('#subclaseNotOnly').hide();
		$('#subclaseResponse').hide();
		subclaseValido = false;
	}
	else {
		if (validarOnlyLetrasBoolean(subclase.val())) {
			subclase.removeClass('is-invalid').addClass('is-valid');
			$('#subclaseEmpty').hide();
			$('#subclaseNotOnly').hide();
			$('#subclaseResponse').hide();
			subclaseValido = true;
		}
		else {
			subclase.removeClass('is-valid').addClass('is-invalid');
			$('#subclaseEmpty').hide();
			$('#subclaseNotOnly').show();
			$('#subclaseResponse').hide();
			subclaseValido = false;
		}
	}
}
function validacionRespuesta (errors)
{
	if (errors.clase != undefined && errors.clase.length > 0) {
		selectClase.removeClass('is-valid').addClass('is-invalid');
		$('#claseEmpty').hide();
		$('#claseNotNumber').hide();
		$('#claseResponse').show();
		$('#claseResponseTexto').text(errors.clase[0]);
	}
	else {
		selectClase.removeClass('is-invalid').addClass('is-valid');
		$('#claseEmpty').hide();
		$('#claseNotOnly').hide();
		$('#claseResponse').hide();
	}
	if (errors.subclase != undefined && errors.subclase.length > 0) {
		subclase.removeClass('is-valid').addClass('is-invalid');
		$('#subclaseEmpty').hide();
		$('#subclaseNotOnly').hide();
		$('#subclaseResponse').show();
		$('#subclaseResponseTexto').text(errors.subclase[0]);
	}
	else {
		subclase.removeClass('is-invalid').addClass('is-valid');
		$('#claseEmpty').hide();
		$('#claseNotOnly').hide();
		$('#claseResponse').hide();
	}
}
