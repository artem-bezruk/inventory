function validacionForm ()
{
	if (capacidad.val().length == 0) {
		capacidad.removeClass('is-valid').addClass('is-invalid');
		$('#capacidadEmpty').show();
		$('#capacidadNotInteger').hide();
		$('#capacidadResponse').hide();
		capacidadValido = false;
	}
	else {
		if (validateOnlyNumbers(capacidad.val())) {
			capacidad.removeClass('is-invalid').addClass('is-valid');
			$('#capacidadEmpty').hide();
			$('#capacidadNotInteger').hide();
			$('#capacidadResponse').hide();
			capacidadValido = true;
		}
		else {
			capacidad.removeClass('is-valid').addClass('is-invalid');
			$('#capacidadEmpty').hide();
			$('#capacidadNotInteger').show();
			$('#capacidadResponse').hide();
			capacidadValido = false;
		}
	}
	if (selectNomenclatura.val() == null) {
		selectNomenclatura.removeClass('is-valid').addClass('is-invalid');
		$('#nomenclaturaEmpty').show();
		$('#nomenclaturaNotNumber').hide();
		$('#nomenclaturaResponse').hide();
		nomenclaturaValido = false;
	}
	else {
		if (validateOnlyNumbers(selectNomenclatura.val())) {
			selectNomenclatura.removeClass('is-invalid').addClass('is-valid');
			$('#nomenclaturaEmpty').hide();
			$('#nomenclaturaNotNumber').hide();
			$('#nomenclaturaResponse').hide();
			nomenclaturaValido = true;
		}
		else {
			selectNomenclatura.removeClass('is-valid').addClass('is-invalid');
			$('#nomenclaturaEmpty').hide();
			$('#nomenclaturaNotNumber').show();
			$('#nomenclaturaResponse').hide();
			nomenclaturaValido = false;
		}
	}
}
function validacionRespuesta (errors)
{
	if (errors.capacidad != undefined && errors.capacidad.length > 0) {
		capacidad.removeClass('is-valid').addClass('is-invalid');
		$('#capacidadEmpty').hide();
		$('#capacidadNotInteger').hide();
		$('#capacidadResponse').show();
		$('#capacidadResponseTexto').text(errors.capacidad[0]);
	}
	else {
		capacidad.removeClass('is-invalid').addClass('is-valid');
		$('#capacidadEmpty').hide();
		$('#capacidadNotInteger').hide();
		$('#capacidadResponse').hide();
	}
	if (errors.nomenclatura != undefined && errors.nomenclatura.length > 0) {
		selectNomenclatura.removeClass('is-valid').addClass('is-invalid');
		$('#nomenclaturaEmpty').hide();
		$('#nomenclaturaNotNumber').hide();
		$('#nomenclaturaResponse').show();
		$('#nomenclaturaResponseTexto').text(errors.nomenclatura[0]);
	}
	else {
		selectNomenclatura.removeClass('is-invalid').addClass('is-valid');
		$('#nomenclaturaEmpty').hide();
		$('#nomenclaturaNotOnly').hide();
		$('#nomenclaturaResponse').hide();
	}
}
