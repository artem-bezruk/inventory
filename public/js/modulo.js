function validacionForm ()
{
	if (modulo.val().length == 0) {
		modulo.removeClass('is-valid').addClass('is-invalid');
		$('#moduloEmpty').show();
		$('#moduloNotOnly').hide();
		$('#moduloResponse').hide();
		moduloValido = false;
	}
	else {
		if (validarOnlyLetrasBoolean(modulo.val())) {
			modulo.removeClass('is-invalid').addClass('is-valid');
			$('#moduloEmpty').hide();
			$('#moduloNotOnly').hide();
			$('#moduloResponse').hide();
			moduloValido = true;
		}
		else {
			modulo.removeClass('is-valid').addClass('is-invalid');
			$('#moduloEmpty').hide();
			$('#moduloNotOnly').show();
			$('#moduloResponse').hide();
			moduloValido = false;
		}
	}
}
function validacionRespuesta (errors)
{
	if (errors.modulo != undefined && errors.modulo.length > 0) {
		modulo.removeClass('is-valid').addClass('is-invalid');
		$('#moduloEmpty').hide();
		$('#moduloNotOnly').hide();
		$('#moduloResponse').show();
		$('#moduloResponseTexto').text(errors.modulo[0]);
	}
	else {
		modulo.removeClass('is-invalid').addClass('is-valid');
		$('#moduloEmpty').hide();
		$('#moduloNotOnly').hide();
		$('#moduloResponse').hide();
	}
	if (errors.filtrable != undefined && errors.filtrable.length > 0) {
		$('#filtrableResponse').show();
		$('#filtrableResponseTexto').text(errors.filtrable[0]);
	}
	else {
		$('#filtrableResponse').hide();
	}
}
