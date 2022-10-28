function validacionForm ()
{
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
}
function validacionRespuesta (errors)
{
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
}
