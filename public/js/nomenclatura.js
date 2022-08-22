function validacionForm() {
	if (nomenclatura.val().length == 0) {
		nomenclatura.removeClass('is-valid').addClass('is-invalid');
		$('#nomenclaturaEmpty').show();
		$('#nomenclaturaNotOnly').hide();
		$('#nomenclaturaResponse').hide();
		nomenclaturaValido = false;
	}
	else {
		if (validarOnlyLetrasBoolean(nomenclatura.val())) {
			nomenclatura.removeClass('is-invalid').addClass('is-valid');
			$('#nomenclaturaEmpty').hide();
			$('#nomenclaturaNotOnly').hide();
			$('#nomenclaturaResponse').hide();
			nomenclaturaValido = true;
		}
		else {
			nomenclatura.removeClass('is-valid').addClass('is-invalid');
			$('#nomenclaturaEmpty').hide();
			$('#nomenclaturaNotOnly').show();
			$('#nomenclaturaResponse').hide();
			nomenclaturaValido = false;
		}
	}
	if (abreviatura.val().length == 0) {
		abreviatura.removeClass('is-valid').addClass('is-invalid');
		$('#abreviaturaEmpty').show();
		$('#abreviaturaNotOnly').hide();
		$('#abreviaturaResponse').hide();
		abreviaturaValido = false;
	}
	else {
		if (validarOnlyLetrasBoolean(abreviatura.val())) {
			abreviatura.removeClass('is-invalid').addClass('is-valid');
			$('#abreviaturaEmpty').hide();
			$('#abreviaturaNotOnly').hide();
			$('#abreviaturaResponse').hide();
			abreviaturaValido = true;
		}
		else {
			abreviatura.removeClass('is-valid').addClass('is-invalid');
			$('#abreviaturaEmpty').hide();
			$('#abreviaturaNotOnly').show();
			$('#abreviaturaResponse').hide();
			abreviaturaValido = false;
		}
	}
}
function validacionRespuesta(errors) {
	if (errors.nomenclatura != undefined && errors.nomenclatura.length > 0) {
		nomenclatura.removeClass('is-valid').addClass('is-invalid');
		$('#nomenclaturaEmpty').hide();
		$('#nomenclaturaNotOnly').hide();
		$('#nomenclaturaResponse').show();
		$('#nomenclaturaResponseTexto').text(errors.nomenclatura[0]);
	}
	else {
		nomenclatura.removeClass('is-invalid').addClass('is-valid');
		$('#nomenclaturaEmpty').hide();
		$('#nomenclaturaNotOnly').hide();
		$('#nomenclaturaResponse').hide();
	}
	if (errors.abreviatura != undefined && errors.abreviatura.length > 0) {
		abreviatura.removeClass('is-valid').addClass('is-invalid');
		$('#abreviaturaEmpty').hide();
		$('#abreviaturaNotOnly').hide();
		$('#abreviaturaResponse').show();
		$('#abreviaturaResponseTexto').text(errors.abreviatura[0]);
	}
	else {
		abreviatura.removeClass('is-invalid').addClass('is-valid');
		$('#abreviaturaEmpty').hide();
		$('#abreviaturaNotOnly').hide();
		$('#abreviaturaResponse').hide();
	}
}
