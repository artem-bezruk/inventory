@extends('modals.media')
@section('modal-id', 'crearuser')
@section('modal-title')
	{{ __('Add') }} {{ __('User') }}
@endsection
@section('modal-content')
	<form id="formCrear" action="{{ route('user.store', ['locale' => app()->getLocale()]) }}">
		<div class="form-row">
			<div class="col-md-12 text-info mb-3" style="font-size: 15px;">
				<table>
					<tbody>
						<tr>
							<th>Nota:</th>
						</tr>
						<tr>
							<td>{{ __('The fields marked with') }} <span class="required"></span> {{ __('are required') }}.</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="form-row mb-2">
			<div class="form-check form-check-inline col-md-12 f-flex justify-content-center">
				<label class="form-check-label text-muted">{{ __('Personal Information') }}</label>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label class="required" for="nombre">{{ __('Name') }}</label>
				<input type="text" class="form-control" name="nombre" id="nombre" placeholder="{{ __('Name') }}" onkeypress="return keypressvalidarOnlyLetras(event)" required autocomplete="off">
				<span class="invalid-feedback" id="nombreEmpty" style="display: none;">
					<strong>{{ __('validation.required', ['attribute' => __('Name')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="nombreNotOnly" style="display: none;">
					<strong>{{ __('validation.regex', ['attribute' => __('Name')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="nombreResponse" style="display: none;">
					<strong id="nombreResponseTexto"></strong>
				</span>
			</div>
			<div class="form-group col-md-6">
				<label class="required" for="apellido">{{ __('Last name') }}</label>
				<input type="text" class="form-control" name="apellido" id="apellido" placeholder="{{ __('Last name') }}" onkeypress="return keypressvalidarOnlyLetras(event)" required autocomplete="off">
				<span class="invalid-feedback" id="apellidoEmpty" style="display: none;">
					<strong>{{ __('validation.required', ['attribute' => __('Last name')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="apellidoNotOnly" style="display: none;">
					<strong>{{ __('validation.regex', ['attribute' => __('Last name')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="apellidoResponse" style="display: none;">
					<strong id="apellidoResponseTexto"></strong>
				</span>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
				<label class="required" for="cedula">{{ __('Identity document') }}</label>
				<input type="text" class="form-control" name="cedula" id="cedula" placeholder="{{ __('Identity document') }}" onkeypress="return keypressNumbersInteger(event)" required autocomplete="off">
				<span class="invalid-feedback" id="cedulaEmpty" style="display: none;">
					<strong>{{ __('validation.required', ['attribute' => __('Identity document')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="cedulaLenght" style="display: none;">
					<strong>{{ __('validation.digits_between', ['attribute' => __('Identity document'), 'min' => 7, 'max' => 8]) }}</strong>
				</span>
				<span class="invalid-feedback" id="cedulaNotNumber" style="display: none;">
					<strong>{{ __('validation.integer', ['attribute' => __('Identity document')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="cedulaResponse" style="display: none;">
					<strong id="cedulaResponseTexto"></strong>
				</span>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
				<label class="required" for="genero">{{ __('Gender') }}</label>
				<select name="genero" id="genero" class="custom-select">
					<option value="" selected disabled>{{ __('Choose') }} {{ __('Gender') }}</option>
					@foreach ($extras->generos as $element)
						<option value="{{ $element->id }}">{{ __($element->genero) }}</option>
					@endforeach
				</select>
				<span class="invalid-feedback" id="generoEmpty" style="display: none;">
					<strong>{{ __('validation.required', ['attribute' => __('Gender')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="generoNotNumber" style="display: none;">
					<strong>{{ __('validation.numeric', ['attribute' => __('Gender')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="generoResponse" style="display: none;">
					<strong id="generoResponseTexto"></strong>
				</span>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
				<label class="required" for="correo" >{{ __('E-Mail Address') }}</label>
				<input type="email" class="form-control" name="correo" id="correo" placeholder="{{ __('E-Mail Address') }}" onkeypress="return keyPressValidarLetrasyOtrosCaracteres(event)" required autocomplete="off">
				<span class="invalid-feedback" id="correoEmpty" style="display: none">
					<strong>{{ __('validation.required', ['attribute' => __('E-Mail Address')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="correoNotValid" style="display: none">
					<strong>{{ __('validation.email', ['attribute' => __('E-Mail Address')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="correoResponse" style="display: none">
					<strong id="correoResponseTexto"></strong>
				</span>
			</div>
		</div>
		<div class="form-row mb-2">
			<div class="form-check form-check-inline col-md-12 d-flex justify-content-center">
				<label class="form-check-label text-muted" for="2">{{ __('User Information') }}</label>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
				<label class="required" for="usuario">{{ __('Username') }}</label>
				<input type="text" class="form-control" name="username" id="username" placeholder="{{ __('Username') }}" onkeypress="return keyPressValidarLetrasNumeros(event)" required autocomplete="off">
				<span class="invalid-feedback" id="usernameEmpty" style="display: none">
					<strong>{{ __('validation.required', ['attribute' => __('Username')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="usernameNotValid" style="display: none">
					<strong>{{ __('validation.regex', ['attribute' => __('Username')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="usernameResponse" style="display: none">
					<strong id="usernameResponseTexto"></strong>
				</span>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
				<label class="required" for="rol">{{ __('Rol') }}</label>
				<select name="rol" id="rol" class="custom-select">
					<option value="" selected disabled>{{ __('Choose') }} Rol</option>
					@foreach ($extras->roles as $element)
						<option value="{{ $element->id }}">{{ __($element->rol) }}</option>
					@endforeach
				</select>
				<span class="invalid-feedback" id="rolEmpty" style="display: none">
					<strong>{{ __('validation.required', ['attribute' => 'Rol']) }}</strong>
				</span>
				<span class="invalid-feedback" id="rolNotNumber" style="display: none;">
					<strong>{{ __('validation.numeric', ['attribute' => 'Rol']) }}</strong>
				</span>
				<span class="invalid-feedback" id="rolResponse" style="display: none;">
					<strong id="rolResponseTexto"></strong>
				</span>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label class="required" for="contraseña">{{ __('Password') }}</label>
				<input type="password" class="form-control" name="password" id="password" placeholder="{{ __('Password') }}" required autocomplete="off">
				<span class="invalid-feedback" id="passwordEmpty" style="display: none">
					<strong>{{ __('validation.required', ['attribute' => __('Password')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="passwordResponse" style="display: none">
					<strong id="passwordResponseTexto"></strong>
				</span>
			</div>
			<div class="form-group col-md-6">
				<label class="required" for="contraseña">{{ __('Confirm Password') }}</label>
				<input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="{{ __('Confirm Password') }}" required autocomplete="off">
					<span class="invalid-feedback" id="password_confirmationEmpty" style="display: none">
						<strong>{{ __('validation.required', ['attribute' => __('Confirm Password')]) }}</strong>
					</span>
					<span class="invalid-feedback" id="password_confirmationNotSame" style="display: none">
						<strong>{{ __('validation.same', ['attribute' => __('Confirm Password'), 'other' => __('Password')]) }}</strong>
					</span>
					<span class="invalid-feedback" id="password_confirmationResponse" style="display: none">
						<strong id="password_confirmationResponseTexto"></strong>
					</span>
			</div>
		</div>
	</form>
@endsection
@section('modal-footer')
	<button class="btn btn-secondary" data-dismiss="modal" type="button">{{ __('Close') }}</button>
	<button class="btn btn-primary" id="btnCrear" type="button">{{ __('Create') }}</button>
@endsection
@section('modal-script')
	<script type="text/javascript">
		var nombre = $('#nombre');
		var nombreValidado = true;
		var apellido = $('#apellido');
		var apellidoValidado = true;
		var cedula = $('#cedula');
		var cedulaValidado = true;
		var genero = $('#genero');
		var generoValidado = true;
		var correo = $('#correo');
		var correoValidado = true;
		var username = $('#username');
		var usernameValidado = true;
		var rol = $('#rol');
		var rolValidado = true;
		var password = $('#password');
		var passwordValidado = true;
		var password_confirmation = $('#password_confirmation');
		var password_confirmationValidado = true;
		$('#btnCrear').on('click', function () {
			$('#formCrear').submit();
		});
		$('#formCrear').on('submit', function (e) {
			e.preventDefault();
			var data = $(this).serializeArray();
			if (nombre.val().length <= 0) {
				nombre.removeClass('is-valid').addClass('is-invalid');
				$('#nombreEmpty').show();
				$('#nombreNotOnly').hide();
				$('#nombreResponse').hide();
				nombreValidado = false;
			}
			else if (validarOnlyLetrasBoolean(nombre.val())) {
				nombre.removeClass('is-invalid').addClass('is-valid');
				$('#nombreEmpty').hide();
				$('#nombreNotOnly').hide();
				$('#nombreResponse').hide();
				nombreValidado = true;
			}
			else {
				nombre.removeClass('is-valid').addClass('is-invalid');
				$('#nombreEmpty').hide();
				$('#nombreNotOnly').show();
				$('#nombreResponse').hide();
				nombreValidado = false;
			}
			if (apellido.val().length <= 0) {
				apellido.removeClass('is-valid').addClass('is-invalid');
				$('#apellidoEmpty').show();
				$('#apellidoNotOnly').hide();
				$('#apellidoResponse').hide();
				apellidoValidado = false;
			}
			else if (validarOnlyLetrasBoolean(apellido.val())) {
				apellido.removeClass('is-invalid').addClass('is-valid');
				$('#apellidoEmpty').hide();
				$('#apellidoNotOnly').hide();
				$('#apellidoResponse').hide();
				apellidoValidado = true;
			}
			else {
				apellido.removeClass('is-valid').addClass('is-invalid');
				$('#apellidoEmpty').hide();
				$('#apellidoNotOnly').show();
				$('#apellidoResponse').hide();
				apellidoValidado = false;
			}
			if (cedula.val().length == 0) {
				cedula.removeClass('is-valid').addClass('is-invalid');
				$('#cedulaEmpty').show();
				$('#cedulaLenght').hide();
				$('#cedulaNotNumber').hide();
				$('#cedulaResponse').hide();
				cedulaValidado = false;
			}
			else if (cedula.val().length < 7 || cedula.val().length > 8) {
				cedula.removeClass('is-valid').addClass('is-invalid');
				$('#cedulaEmpty').hide();
				$('#cedulaLenght').show();
				$('#cedulaNotNumber').hide();
				$('#cedulaResponse').hide();
				cedulaValidado = false;
			}
			else {
				if (validateOnlyNumbers(cedula.val())) {
					cedula.removeClass('is-invalid').addClass('is-valid');
					$('#cedulaEmpty').hide();
					$('#cedulaLenght').hide();
					$('#cedulaNotNumber').hide();
					$('#cedulaResponse').hide();
					cedulaValidado = true;
				}
				else {
					cedula.removeClass('is-valid').addClass('is-invalid');
					$('#cedulaEmpty').hide();
					$('#cedulaLenght').hide();
					$('#cedulaNotNumber').show();
					$('#cedulaResponse').hide();
					cedulaValidado = false;
				}
			}
			if (genero.val() == null) {
				genero.removeClass('is-valid').addClass('is-invalid');
				$('#generoEmpty').show();
				$('#generoNotNumber').hide();
				$('#generoResponse').hide();
				generoValidado = false;
			}
			else {
				if (validateOnlyNumbers(genero.val())) {
					genero.removeClass('is-invalid').addClass('is-valid');
					$('#generoEmpty').hide();
					$('#generoNotNumber').hide();
					$('#generoResponse').hide();
					generoValidado = true;
				}
				else {
					genero.removeClass('is-valid').addClass('is-invalid');
					$('#generoEmpty').hide();
					$('#generoNotNumber').show();
					$('#generoResponse').hide();
					generoValidado = false;
				}
			}
			if (correo.val().length == 0) {
				correo.removeClass('is-valid').addClass('is-invalid');
				$('#correoEmpty').show();
				$('#correoNotValid').hide();
				$('#correoResponse').hide();
				correoValidado = false;
			}
			else if (validarEmail(correo.val())) {
				correo.removeClass('is-invalid').addClass('is-valid');
				$('#correoEmpty').hide();
				$('#correoNotValid').hide();
				$('#correoResponse').hide();
				correoValidado = true;
			}
			else {
				correo.removeClass('is-valid').addClass('is-invalid');
				$('#correoEmpty').hide();
				$('#correoNotValid').show();
				$('#correoResponse').hide();
				correoValidado = false;
			}
			if (username.val().length == 0) {
				username.removeClass('is-valid').addClass('is-invalid');
				$('#usernameEmpty').show();
				$('#usernameNotValid').hide();
				$('#usernameResponse').hide();
				usernameValidado = false;
			}
			else {
				if (validarLetrasNumeros(username.val())) {
					username.removeClass('is-invalid').addClass('is-valid');
					$('#usernameEmpty').hide();
					$('#usernameNotValid').hide();
					$('#usernameResponse').hide();
					usernameValidado = true;
				}
				else {
					username.removeClass('is-valid').addClass('is-invalid');
					$('#usernameEmpty').hide();
					$('#usernameNotValid').show();
					$('#usernameResponse').hide();
					usernameValidado = false;
				}
			}
			if (rol.val() == null) {
				rol.removeClass('is-valid').addClass('is-invalid');
				$('#rolEmpty').show();
				$('#rolNotNumber').hide();
				$('#rolResponse').hide();
				rolValidado = false;
			}
			else {
				if (validateOnlyNumbers(rol.val())) {
					rol.removeClass('is-invalid').addClass('is-valid');
					$('#rolEmpty').hide();
					$('#rolNotNumber').hide();
					$('#rolResponse').hide();
					rolValidado = true;
				}
				else {
					rol.removeClass('is-valid').addClass('is-invalid');
					$('#rolEmpty').hide();
					$('#rolNotNumber').show();
					$('#rolResponse').hide();
					rolValidado = false;
				}
			}
			if (password.val().length == 0) {
				password.removeClass('is-valid').addClass('is-invalid');
				$('#passwordEmpty').show();
				$('#passwordResponse').hide();
				passwordValidado = false;
			}
			else {
				password.removeClass('is-invalid').addClass('is-valid');
				$('#passwordEmpty').hide();
				$('#passwordResponse').hide();
				passwordValidado = true;
			}
			if (password_confirmation.val().length == 0) {
				password_confirmation.removeClass('is-valid').addClass('is-invalid');
				$('#password_confirmationEmpty').show();
				$('#password_confirmationNotSame').hide();
				$('#password_confirmationResponse').hide();
				password_confirmationValidado = false;
			}
			else {
				if (password.val() === password_confirmation.val()) {
					password_confirmation.removeClass('is-invalid').addClass('is-valid');
					$('#password_confirmationEmpty').hide();
					$('#password_confirmationNotSame').hide();
					$('#password_confirmationResponse').hide();
					password_confirmationValidado = true;
				}
				else {
					password_confirmation.removeClass('is-valid').addClass('is-invalid');
					$('#password_confirmationEmpty').hide();
					$('#password_confirmationNotSame').show();
					$('#password_confirmationResponse').hide();
					password_confirmationValidado = false;
				}
			}
			if (nombreValidado && apellidoValidado && cedulaValidado && generoValidado && correoValidado && usernameValidado && rolValidado && passwordValidado && password_confirmationValidado) {
				$.ajax({
					type: 'POST',
					url: $(this).attr('action'),
					headers: {
				        'X-CSRF-TOKEN': "{{ csrf_token() }}"
				    },
					data: data,
					cache:false,
					beforeSend: function ()
					{
						Swal.fire({
							type: 'info',
							title: "{{ __('Sending information') }}",
							showConfirmButton: false,
							allowEscapeKey: false,
							allowOutsideClick: false,
						})
					}
				})
				.done(function (response, statusText, jqXHR) {
					if (jqXHR.status == 201) {
						$("#crearuser").modal("toggle");
						Swal.fire({
							type: 'success',
							title: response.mensaje,
							showConfirmButton: false,
							allowEscapeKey: false,
							allowOutsideClick: false,
							timer: 1700
						})
						setTimeout(function () {
							listaUsuarios();
						}, 1700)
					}
				})
				.fail(function (e) {
					if (e.status == 422) {
						validacionRespuesta(e.responseJSON.errors);
					}
					Swal.fire({
						type: 'error',
						title: "{{ __('Oops! Something went wrong') }}",
						showConfirmButton: false,
						allowEscapeKey: false,
						allowOutsideClick: false,
						timer: 1700
					})
				});
			}
		})
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
	</script>
@endsection
