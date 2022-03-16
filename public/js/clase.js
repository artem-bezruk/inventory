function validacionForm ()
{
	if (clase.val().length == 0) {
		clase.removeClass('is-valid').addClass('is-invalid');
		$('#claseEmpty').show();
		$('#claseNotOnly').hide();
		$('#claseResponse').hide();
		claseValido = false;
	}
	else {
		if (validarOnlyLetrasBoolean(clase.val())) {
			clase.removeClass('is-invalid').addClass('is-valid');
			$('#claseEmpty').hide();
			$('#claseNotOnly').hide();
			$('#claseResponse').hide();
			claseValido = true;
		}
		else {
			clase.removeClass('is-valid').addClass('is-invalid');
			$('#claseEmpty').hide();
			$('#claseNotOnly').show();
			$('#claseResponse').hide();
			claseValido = false;
		}
	}
}
function validacionRespuesta (errors)
{
	if (errors.clase != undefined && errors.clase.length > 0) {
		clase.removeClass('is-valid').addClass('is-invalid');
		$('#claseEmpty').hide();
		$('#claseNotOnly').hide();
		$('#claseResponse').show();
		$('#claseResponseTexto').text(errors.clase[0]);
	}
	else {
		clase.removeClass('is-invalid').addClass('is-valid');
		$('#claseEmpty').hide();
		$('#claseNotOnly').hide();
		$('#claseResponse').hide();
	}
}
