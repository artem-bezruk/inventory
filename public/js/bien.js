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
	if (selectSubcategoria.val() == null) {
		selectSubcategoria.removeClass('is-valid').addClass('is-invalid');
		$('#subcategoriaEmpty').show();
		$('#subcategoriaNotNumber').hide();
		$('#subcategoriaResponse').hide();
		subcategoriaValido = false;
	}
	else {
		if (validateOnlyNumbers(selectSubcategoria.val())) {
			selectSubcategoria.removeClass('is-invalid').addClass('is-valid');
			$('#subcategoriaEmpty').hide();
			$('#subcategoriaNotNumber').hide();
			$('#subcategoriaResponse').hide();
			subcategoriaValido = true;
		}
		else {
			selectSubcategoria.removeClass('is-valid').addClass('is-invalid');
			$('#subcategoriaEmpty').hide();
			$('#subcategoriaNotNumber').show();
			$('#subcategoriaResponse').hide();
			subcategoriaValido = false;
		}
	}
	if (selectMarca.val() == null) {
		selectMarca.removeClass('is-valid').addClass('is-invalid');
		$('#marcaEmpty').show();
		$('#marcaNotNumber').hide();
		$('#marcaResponse').hide();
		marcaValido = false;
	}
	else {
		if (validateOnlyNumbers(selectMarca.val())) {
			selectMarca.removeClass('is-invalid').addClass('is-valid');
			$('#marcaEmpty').hide();
			$('#marcaNotNumber').hide();
			$('#marcaResponse').hide();
			marcaValido = true;
		}
		else {
			selectMarca.removeClass('is-valid').addClass('is-invalid');
			$('#marcaEmpty').hide();
			$('#marcaNotNumber').show();
			$('#marcaResponse').hide();
			marcaValido = false;
		}
	}
	if (ver_capacidad) {
		if (selectCapacidad.val() == null) {
			selectCapacidad.removeClass('is-valid').addClass('is-invalid');
			$('#capacidadEmpty').show();
			$('#capacidadNotNumber').hide();
			$('#capacidadResponse').hide();
			capacidadValido = false;
		}
		else {
			if (validateOnlyNumbers(selectCapacidad.val())) {
				selectCapacidad.removeClass('is-invalid').addClass('is-valid');
				$('#capacidadEmpty').hide();
				$('#capacidadNotNumber').hide();
				$('#capacidadResponse').hide();
				capacidadValido = true;
			}
			else {
				selectCapacidad.removeClass('is-valid').addClass('is-invalid');
				$('#capacidadEmpty').hide();
				$('#capacidadNotNumber').show();
				$('#capacidadResponse').hide();
				capacidadValido = false;
			}
		}
	}
	if (modelo.val().length == 0) {
		modelo.removeClass('is-valid').addClass('is-invalid');
		$('#modeloEmpty').show();
		$('#modeloNotOnly').hide();
		$('#modeloResponse').hide();
		modeloValido = false;
	}
	else {
		if (validarLetrasyOtrosCaracteres(modelo.val())) {
			modelo.removeClass('is-invalid').addClass('is-valid');
			$('#modeloEmpty').hide();
			$('#modeloNotOnly').hide();
			$('#modeloResponse').hide();
			modeloValido = true;
		}
		else {
			modelo.removeClass('is-valid').addClass('is-invalid');
			$('#modeloEmpty').hide();
			$('#modeloNotOnly').show();
			$('#modeloResponse').hide();
			modeloValido = false;
		}
	}
	if (cantidad.val().length == 0) {
		cantidad.removeClass('is-valid').addClass('is-invalid');
		$('#cantidadEmpty').show();
		$('#cantidadNotOnly').hide();
		$('#cantidadResponse').hide();
		cantidadValido = false;
	}
	else {
		if (validateOnlyNumbers(cantidad.val())) {
			cantidad.removeClass('is-invalid').addClass('is-valid');
			$('#cantidadEmpty').hide();
			$('#cantidadNotOnly').hide();
			$('#cantidadResponse').hide();
			cantidadValido = true;
		}
		else {
			cantidad.removeClass('is-valid').addClass('is-invalid');
			$('#cantidadEmpty').hide();
			$('#cantidadNotOnly').show();
			$('#cantidadResponse').hide();
			cantidadValido = false;
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
		selectSubcategoria.removeClass('is-valid').addClass('is-invalid');
		$('#subcategoriaEmpty').hide();
		$('#subcategoriaNotNumber').hide();
		$('#subcategoriaResponse').show();
		$('#subcategoriaResponseTexto').text(errors.subcategoria[0]);
	}
	else {
		selectSubcategoria.removeClass('is-invalid').addClass('is-valid');
		$('#subcategoriaEmpty').hide();
		$('#subcategoriaNotOnly').hide();
		$('#subcategoriaResponse').hide();
	}
	if (errors.marca != undefined && errors.marca.length > 0) {
		selectMarca.removeClass('is-valid').addClass('is-invalid');
		$('#marcaEmpty').hide();
		$('#marcaNotNumber').hide();
		$('#marcaResponse').show();
		$('#marcaResponseTexto').text(errors.marca[0]);
	}
	else {
		selectMarca.removeClass('is-invalid').addClass('is-valid');
		$('#marcaEmpty').hide();
		$('#marcaNotOnly').hide();
		$('#marcaResponse').hide();
	}
	if (errors.capacidad != undefined && errors.capacidad.length > 0) {
		selectCapacidad.removeClass('is-valid').addClass('is-invalid');
		$('#capacidadEmpty').hide();
		$('#capacidadNotNumber').hide();
		$('#capacidadResponse').show();
		$('#capacidadResponseTexto').text(errors.capacidad[0]);
	}
	else {
		selectCapacidad.removeClass('is-invalid').addClass('is-valid');
		$('#capacidadEmpty').hide();
		$('#capacidadNotOnly').hide();
		$('#capacidadResponse').hide();
	}
	if (errors.modelo != undefined && errors.modelo.length > 0) {
		modelo.removeClass('is-valid').addClass('is-invalid');
		$('#modeloEmpty').hide();
		$('#modeloNotOnly').hide();
		$('#modeloResponse').show();
		$('#modeloResponseTexto').text(errors.modelo[0]);
	}
	else {
		modelo.removeClass('is-invalid').addClass('is-valid');
		$('#modeloEmpty').hide();
		$('#modeloNotOnly').hide();
		$('#modeloResponse').hide();
	}
	if (errors.cantidad != undefined && errors.cantidad.length > 0) {
		cantidad.removeClass('is-valid').addClass('is-invalid');
		$('#cantidadEmpty').hide();
		$('#cantidadNotOnly').hide();
		$('#cantidadResponse').show();
		$('#cantidadResponseTexto').text(errors.cantidad[0]);
	}
	else {
		cantidad.removeClass('is-invalid').addClass('is-valid');
		$('#cantidadEmpty').hide();
		$('#cantidadNotOnly').hide();
		$('#cantidadResponse').hide();
	}
}
