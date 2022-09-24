function validacionForm ()
{
	if (modulo.val() == null) {
		modulo.removeClass('is-valid').addClass('is-invalid');
		$('#moduloEmpty').show();
		$('#moduloNotNumber').hide();
		$('#moduloResponse').hide();
		moduloValido = false;
	}
	else {
		if (validateOnlyNumbers(modulo.val())) {
			modulo.removeClass('is-invalid').addClass('is-valid');
			$('#moduloEmpty').hide();
			$('#moduloNotNumber').hide();
			$('#moduloResponse').hide();
			moduloValido = true;
		}
		else {
			modulo.removeClass('is-valid').addClass('is-invalid');
			$('#moduloEmpty').hide();
			$('#moduloNotNumber').show();
			$('#moduloResponse').hide();
			moduloValido = false;
		}
	}
	if (rol.val() == null) {
		rol.removeClass('is-valid').addClass('is-invalid');
		$('#rolEmpty').show();
		$('#rolNotNumber').hide();
		$('#rolResponse').hide();
		rolValido = false;
	}
	else {
		if (validateOnlyNumbers(rol.val())) {
			rol.removeClass('is-invalid').addClass('is-valid');
			$('#rolEmpty').hide();
			$('#rolNotNumber').hide();
			$('#rolResponse').hide();
			rolValido = true;
		}
		else {
			rol.removeClass('is-valid').addClass('is-invalid');
			$('#rolEmpty').hide();
			$('#rolNotNumber').show();
			$('#rolResponse').hide();
			rolValido = false;
		}
	}
}
function validacionRespuesta (errors)
{
	var errorPermisos = false;
	if (errors.modulo != undefined && errors.modulo.length > 0) {
		modulo.removeClass('is-valid').addClass('is-invalid');
		$('#moduloEmpty').hide();
		$('#moduloNotNumber').hide();
		$('#moduloResponse').show();
		$('#moduloResponseTexto').text(errors.modulo[0]);
	}
	else {
		modulo.removeClass('is-invalid').addClass('is-valid');
		$('#moduloEmpty').hide();
		$('#moduloNotNumber').hide();
		$('#moduloResponse').hide();
	}
	if (errors.rol != undefined && errors.rol.length > 0) {
		rol.removeClass('is-valid').addClass('is-invalid');
		$('#rolEmpty').hide();
		$('#rolNotNumber').hide();
		$('#rolResponse').show();
		$('#rolResponseTexto').text(errors.rol[0]);
	}
	else {
		rol.removeClass('is-invalid').addClass('is-valid');
		$('#rolEmpty').hide();
		$('#rolNotNumber').hide();
		$('#rolResponse').hide();
	}
	if (errors.crear != undefined && errors.crear.length > 0) {
		errorPermisos = true;
		$('#permisosResponseTexto').text(errors.crear[0]);
	}
	if (errors.mostrar != undefined && errors.mostrar.length > 0) {
		errorPermisos = true;
		$('#permisosResponseTexto').text(errors.mostrar[0]);
	}
	if (errors.editar != undefined && errors.editar.length > 0) {
		errorPermisos = true;
		$('#permisosResponseTexto').text(errors.editar[0]);
	}
	if (errors.eliminar != undefined && errors.eliminar.length > 0) {
		errorPermisos = true;
		$('#permisosResponseTexto').text(errors.eliminar[0]);
	}
	if (errorPermisos) {
		$('#permisosResponse').show();
	}
	else {
		$('#permisosResponse').hide();
	}
}
