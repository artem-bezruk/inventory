function validacionForm() {
	if (rol.val().length == 0) {
		rol.removeClass('is-valid').addClass('is-invalid');
		$('#rolEmpty').show();
		$('#rolNotOnly').hide();
		$('#rolResponse').hide();
		rolValido = false;
	}
	else {
		if (validarOnlyLetrasBoolean(rol.val())) {
			rol.removeClass('is-invalid').addClass('is-valid');
			$('#rolEmpty').hide();
			$('#rolNotOnly').hide();
			$('#rolResponse').hide();
			rolValido = true;
		}
		else {
			rol.removeClass('is-valid').addClass('is-invalid');
			$('#rolEmpty').hide();
			$('#rolNotOnly').show();
			$('#rolResponse').hide();
			rolValido = false;
		}
	}
	if (prioridad.val().length == 0) {
		prioridad.removeClass('is-valid').addClass('is-invalid');
		$('#prioridadEmpty').show();
		$('#prioridadNotOnly').hide();
		$('#prioridadResponse').hide();
		prioridadValido = false;
	}
	else {
		if (validateOnlyNumbers(prioridad.val())) {
			prioridad.removeClass('is-invalid').addClass('is-valid');
			$('#prioridadEmpty').hide();
			$('#prioridadNotOnly').hide();
			$('#prioridadResponse').hide();
			prioridadValido = true;
		}
		else {
			prioridad.removeClass('is-valid').addClass('is-invalid');
			$('#prioridadEmpty').hide();
			$('#prioridadNotOnly').show();
			$('#prioridadResponse').hide();
			prioridadValido = false;
		}
	}
	if (descripcion.val().length != 0) {
		if (validarLetrasyOtrosCaracteres(descripcion.val())) {
			descripcion.removeClass('is-invalid').addClass('is-valid');
			$('#descripcionNotOnly').hide();
			$('#descripcionResponse').hide();
			descripcionValido = true;
		}
		else {
			descripcion.removeClass('is-valid').addClass('is-invalid');
			$('#descripcionNotOnly').show();
			$('#descripcionResponse').hide();
			descripcionValido = false;
		}
	}
}
function validacionRespuesta(errors) {
	if (errors.rol != undefined && errors.rol.length > 0) {
		rol.removeClass('is-valid').addClass('is-invalid');
		$('#rolEmpty').hide();
		$('#rolNotOnly').hide();
		$('#rolResponse').show();
		$('#rolResponseTexto').text(errors.rol[0]);
	}
	else {
		rol.removeClass('is-invalid').addClass('is-valid');
		$('#rolEmpty').hide();
		$('#rolNotOnly').hide();
		$('#rolResponse').hide();
	}
	if (errors.prioridad != undefined && errors.prioridad.length > 0) {
		prioridad.removeClass('is-valid').addClass('is-invalid');
		$('#prioridadEmpty').hide();
		$('#prioridadNotOnly').hide();
		$('#prioridadResponse').show();
		$('#prioridadResponseTexto').text(errors.prioridad[0]);
	}
	else {
		prioridad.removeClass('is-invalid').addClass('is-valid');
		$('#prioridadEmpty').hide();
		$('#prioridadNotOnly').hide();
		$('#prioridadResponse').hide();
	}
	if (errors.descripcion != undefined && errors.descripcion.length > 0) {
		descripcion.removeClass('is-valid').addClass('is-invalid');
		$('#descripcionNotOnly').hide();
		$('#descripcionResponse').show();
		$('#descripcionResponseTexto').text(errors.descripcion[0]);
	}
	else {
		descripcion.removeClass('is-invalid').addClass('is-valid');
		$('#descripcionNotOnly').hide();
		$('#descripcionResponse').hide();
	}
}
