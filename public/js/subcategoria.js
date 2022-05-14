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
	if (selectCategoria.val() == null) {
		selectCategoria.removeClass('is-valid').addClass('is-invalid');
		$('#categoriaEmpty').show();
		$('#categoriaNotNumber').hide();
		$('#categoriaResponse').hide();
		categoriaValido = false;
	}
	else {
		if (validateOnlyNumbers(selectCategoria.val())) {
			selectCategoria.removeClass('is-invalid').addClass('is-valid');
			$('#categoriaEmpty').hide();
			$('#categoriaNotNumber').hide();
			$('#categoriaResponse').hide();
			categoriaValido = true;
		}
		else {
			selectCategoria.removeClass('is-valid').addClass('is-invalid');
			$('#categoriaEmpty').hide();
			$('#categoriaNotNumber').show();
			$('#categoriaResponse').hide();
			categoriaValido = false;
		}
	}
	if (selectSubclase.val() == null) {
		selectSubclase.removeClass('is-valid').addClass('is-invalid');
		$('#subclaseEmpty').show();
		$('#subclaseNotNumber').hide();
		$('#subclaseResponse').hide();
		subclaseValido = false;
	}
	else {
		if (validateOnlyNumbers(selectSubclase.val())) {
			selectSubclase.removeClass('is-invalid').addClass('is-valid');
			$('#subclaseEmpty').hide();
			$('#subclaseNotNumber').hide();
			$('#subclaseResponse').hide();
			subclaseValido = true;
		}
		else {
			selectSubclase.removeClass('is-valid').addClass('is-invalid');
			$('#subclaseEmpty').hide();
			$('#subclaseNotNumber').show();
			$('#subclaseResponse').hide();
			subclaseValido = false;
		}
	}
	if (subcategoria.val().length == 0) {
		subcategoria.removeClass('is-valid').addClass('is-invalid');
		$('#subcategoriaEmpty').show();
		$('#subcategoriaNotOnly').hide();
		$('#subcategoriaResponse').hide();
		subcategoriaValido = false;
	}
	else {
		if (validarOnlyLetrasBoolean(subcategoria.val())) {
			subcategoria.removeClass('is-invalid').addClass('is-valid');
			$('#subcategoriaEmpty').hide();
			$('#subcategoriaNotOnly').hide();
			$('#subcategoriaResponse').hide();
			subcategoriaValido = true;
		}
		else {
			subcategoria.removeClass('is-valid').addClass('is-invalid');
			$('#subcategoriaEmpty').hide();
			$('#subcategoriaNotOnly').show();
			$('#subcategoriaResponse').hide();
			subcategoriaValido = false;
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
		selectSubclase.removeClass('is-valid').addClass('is-invalid');
		$('#subclaseEmpty').hide();
		$('#subclaseNotNumber').hide();
		$('#subclaseResponse').show();
		$('#subclaseResponseTexto').text(errors.subclase[0]);
	}
	else {
		selectSubclase.removeClass('is-invalid').addClass('is-valid');
		$('#subclaseEmpty').hide();
		$('#subclaseNotOnly').hide();
		$('#subclaseResponse').hide();
	}
	if (errors.categoria != undefined && errors.categoria.length > 0) {
		selectCategoria.removeClass('is-valid').addClass('is-invalid');
		$('#categoriaEmpty').hide();
		$('#categoriaNotNumber').hide();
		$('#categoriaResponse').show();
		$('#categoriaResponseTexto').text(errors.categoria[0]);
	}
	else {
		selectCategoria.removeClass('is-invalid').addClass('is-valid');
		$('#categoriaEmpty').hide();
		$('#categoriaNotOnly').hide();
		$('#categoriaResponse').hide();
	}
	if (errors.subcategoria != undefined && errors.subcategoria.length > 0) {
		subcategoria.removeClass('is-valid').addClass('is-invalid');
		$('#subcategoriaEmpty').hide();
		$('#subcategoriaNotOnly').hide();
		$('#subcategoriaResponse').show();
		$('#subcategoriaResponseTexto').text(errors.subcategoria[0]);
	}
	else {
		subcategoria.removeClass('is-invalid').addClass('is-valid');
		$('#subcategoriaEmpty').hide();
		$('#subcategoriaNotOnly').hide();
		$('#subcategoriaResponse').hide();
	}
}
