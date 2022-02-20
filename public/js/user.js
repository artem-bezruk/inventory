function validacionRespuesta (errors)
{
	if (errors.nombre != undefined && errors.nombre.length > 0) {
		nombre.removeClass('is-valid').addClass('is-invalid');
		$('#nombreEmpty').hide();
		$('#nombreNotOnly').hide();
		$('#nombreResponse').show();
		$('#nombreResponseTexto').text(errors.nombre[0]);
	}
	else {
		nombre.removeClass('is-invalid').addClass('is-valid');
		$('#nombreEmpty').hide();
		$('#nombreNotOnly').hide();
		$('#nombreResponse').hide();
	}
	if (errors.apellido != undefined && errors.apellido.length > 0) {
		apellido.removeClass('is-valid').addClass('is-invalid');
		$('#apellidoEmpty').hide();
		$('#apellidoNotOnly').hide();
		$('#apellidoResponse').show();
		$('#apellidoResponseTexto').text(errors.apellido[0]);
	}
	else {
		apellido.removeClass('is-invalid').addClass('is-valid');
		$('#apellidoEmpty').hide();
		$('#apellidoNotOnly').hide();
		$('#apellidoResponse').hide();
	}
	if (errors.cedula != undefined && errors.cedula.length > 0) {
		cedula.removeClass('is-valid').addClass('is-invalid');
		$('#cedulaEmpty').hide();
		$('#cedulaLenght').hide();
		$('#cedulaNotNumber').hide();
		$('#cedulaResponse').show();
		$('#cedulaResponseTexto').text(errors.cedula[0]);
	}
	else {
		cedula.removeClass('is-invalid').addClass('is-valid');
		$('#cedulaEmpty').hide();
		$('#cedulaLenght').hide();
		$('#cedulaNotNumber').hide();
		$('#cedulaResponse').hide();
	}
	if (errors.genero != undefined && errors.genero.length > 0) {
		genero.removeClass('is-valid').addClass('is-invalid');
		$('#generoEmpty').hide();
		$('#generoNotNumber').hide();
		$('#generoResponse').show();
		$('#generoResponseTexto').text(errors.genero[0]);
	}
	else {
		genero.removeClass('is-invalid').addClass('is-valid');
		$('#generoEmpty').hide();
		$('#generoNotNumber').hide();
		$('#generoResponse').hide();
	}
	if (errors.correo != undefined && errors.correo.length > 0) {
		correo.removeClass('is-valid').addClass('is-invalid');
		$('#correoEmpty').hide();
		$('#correoNotValid').hide();
		$('#correoResponse').show();
		$('#correoResponseTexto').text(errors.correo[0]);
	}
	else {
		correo.removeClass('is-invalid').addClass('is-valid');
		$('#correoEmpty').hide();
		$('#correoNotValid').hide();
		$('#correoResponse').hide();
	}
	if (errors.username != undefined && errors.username.length > 0) {
		username.removeClass('is-valid').addClass('is-invalid');
		$('#usernameEmpty').hide();
		$('#usernameNotValid').hide();
		$('#usernameResponse').show();
		$('#usernameResponseTexto').text(errors.username[0]);
	}
	else {
		username.removeClass('is-invalid').addClass('is-valid');
		$('#usernameEmpty').hide();
		$('#usernameNotValid').hide();
		$('#usernameResponse').hide();
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
	if (errors.password != undefined && errors.password.length > 0) {
		password.removeClass('is-valid').addClass('is-invalid');
		$('#passwordEmpty').hide();
		$('#passwordResponse').show();
		$('#passwordResponseTexto').text(errors.password[0]);
	}
	else {
		password.removeClass('is-invalid').addClass('is-valid');
		$('#passwordEmpty').hide();
		$('#passwordResponse').hide();
	}
	if (errors.password_confirmation != undefined && errors.password_confirmation.length > 0) {
		password_confirmation.removeClass('is-valid').addClass('is-invalid');
		$('#password_confirmationEmpty').hide();
		$('#password_confirmationNotSame').hide();
		$('#password_confirmationResponse').show();
		$('#password_confirmationResponseTexto').text(errors.password_confirmation[0]);
	}
	else {
		password_confirmation.removeClass('is-invalid').addClass('is-valid');
		$('#password_confirmationEmpty').hide();
		$('#password_confirmationNotSame').hide();
		$('#password_confirmationResponse').hide();
	}
}
