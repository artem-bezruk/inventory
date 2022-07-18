function validacionForm ()
{
	if (genero.val().length == 0) {
		genero.removeClass('is-valid').addClass('is-invalid');
		$('#generoEmpty').show();
		$('#generoNotOnly').hide();
		$('#generoResponse').hide();
		generoValido = false;
	}
	else {
		if (validarOnlyLetrasBoolean(genero.val())) {
			genero.removeClass('is-invalid').addClass('is-valid');
			$('#generoEmpty').hide();
			$('#generoNotOnly').hide();
			$('#generoResponse').hide();
			generoValido = true;
		}
		else {
			genero.removeClass('is-valid').addClass('is-invalid');
			$('#generoEmpty').hide();
			$('#generoNotOnly').show();
			$('#generoResponse').hide();
			generoValido = false;
		}
	}
}
function validacionRespuesta (errors)
{
	if (errors.genero != undefined && errors.genero.length > 0) {
		genero.removeClass('is-valid').addClass('is-invalid');
		$('#generoEmpty').hide();
		$('#generoNotOnly').hide();
		$('#generoResponse').show();
		$('#generoResponseTexto').text(errors.genero[0]);
	}
	else {
		genero.removeClass('is-invalid').addClass('is-valid');
		$('#generoEmpty').hide();
		$('#generoNotOnly').hide();
		$('#generoResponse').hide();
	}
}
