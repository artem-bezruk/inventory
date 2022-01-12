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
					<strong>{{ __('validation.between.numeric', ['attribute' => __('Identity document'), 'min' => 7, 'max' => 8]) }}</strong>
				</span>
				<span class="invalid-feedback" id="cedulaNotNumber" style="display: none;">
					<strong>{{ __('validation.integer', ['attribute' => __('Identity document')]) }}</strong>
				</span>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
				<label class="required" for="genero">{{ __('Gender') }}</label>
				<select name="genero" id="genero" class="custom-select">
					<option value="" selected disabled>seleccione genero</option>
					@foreach ($extras->generos as $element)
						<option value="{{ $element->id }}">{{ __($element->genero) }}</option>
					@endforeach
				</select>
				<span class="invalid-feedback" id="generoEmpty" style="display: none;">
					<strong>{{ __('validation.required', ['attribute' => __('Gender')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="generoNotNumber" style="display: none;">
					<strong>{{ __('validation.regex', ['attribute' => __('Gender')]) }}</strong>
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
				<input type="text" class="form-control" name="username" id="username" placeholder="{{ __('Username') }}" onkeypress="return keyPressValidarLetrasyOtrosCaracteres(event)" required autocomplete="off">
				<span class="invalid-feedback" id="usernameEmpty" style="display: none">
					<strong>{{ __('validation.required', ['attribute' => __('Username')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="usernameNotValid" style="display: none">
					<strong>{{ __('validation.regex', ['attribute' => __('Username')]) }}</strong>
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
			</div>
			<div class="form-group col-md-6">
				<label class="required" for="contraseña">{{ __('Confirm Password') }}</label>
				<input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="{{ __('Confirm Password') }}" required autocomplete="off">
					<span class="invalid-feedback" id="password_confirmationEmpty" style="display: none">
						<strong>{{ __('validation.required', ['attribute' => __('Confirm Password')]) }}</strong>
					</span>
					<span class="invalid-feedback" id="password_confirmationNotSame" style="display: none">
						<strong>{{ __('validation.same', ['attribute' => __('Password'), 'other' => __('Confirm Password')]) }}</strong>
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
			// if (nombre.val().length <= 0) {
			// 	nombre.removeClass('is-valid').addClass('is-invalid');
			// 	$('#nombreEmpty').show();
			// 	$('#nombreNotOnly').hide();
			// }
			// else if (validarOnlyLetrasBoolean(nombre.val())) {
			// 	nombre.removeClass('is-invalid').addClass('is-valid');
			// 	$('#nombreEmpty').hide();
			// 	$('#nombreNotOnly').hide();
			// }
			// else {
			// 	nombre.removeClass('is-valid').addClass('is-invalid');
			// 	$('#nombreEmpty').hide();
			// 	$('#nombreNotOnly').show();
			// }
			// if (apellido.val().length <= 0) {
			// 	apellido.removeClass('is-valid').addClass('is-invalid');
			// 	$('#apellidoEmpty').show();
			// 	$('#apellidoNotOnly').hide();
			// }
			// else if (validarOnlyLetrasBoolean(apellido.val())) {
			// 	apellido.removeClass('is-invalid').addClass('is-valid');
			// 	$('#apellidoEmpty').hide();
			// 	$('#apellidoNotOnly').hide();
			// }
			// else {
			// 	apellido.removeClass('is-valid').addClass('is-invalid');
			// 	$('#apellidoEmpty').hide();
			// 	$('#apellidoNotOnly').show();
			// }
			// if (cedula.val().length == 0) {
			// 	cedula.removeClass('is-valid').addClass('is-invalid');
			// 	$('#cedulaEmpty').show();
			// 	$('#cedulaLenght').hide();
			// 	$('#cedulaNotNumber').hide();
			// }
			// else if (cedula.val().length < 7 || cedula.val().length > 8) {
			// 	cedula.removeClass('is-valid').addClass('is-invalid');
			// 	$('#cedulaEmpty').hide();
			// 	$('#cedulaLenght').show();
			// 	$('#cedulaNotNumber').hide();
			// }
			// else {
			// 	if (validateOnlyNumbers(cedula.val())) {
			// 		cedula.removeClass('is-invalid').addClass('is-valid');
			// 		$('#cedulaEmpty').hide();
			// 		$('#cedulaLenght').hide();
			// 		$('#cedulaNotNumber').hide();
			// 	}
			// 	else {
			// 		cedula.removeClass('is-valid').addClass('is-invalid');
			// 		$('#cedulaEmpty').hide();
			// 		$('#cedulaLenght').hide();
			// 		$('#cedulaNotNumber').show();
			// 	}
			// }
			// if (genero.val() == null) {
			// 	genero.removeClass('is-valid').addClass('is-invalid');
			// 	$('#generoEmpty').show();
			// 	$('#generoNotNumber').hide();
			// }
			// else {
			// 	if (validateOnlyNumbers(genero.val())) {
			// 		genero.removeClass('is-invalid').addClass('is-valid');
			// 		$('#generoEmpty').hide();
			// 		$('#generoNotNumber').hide();
			// 	}
			// 	else {
			// 		genero.removeClass('is-valid').addClass('is-invalid');
			// 		$('#generoEmpty').hide();
			// 		$('#generoNotNumber').show();
			// 	}
			// }
			// if (correo.val().length == 0) {
			// 	correo.removeClass('is-valid').addClass('is-invalid');
			// 	$('#correoEmpty').show();
			// 	$('#correoNotValid').hide();
			// }
			// else if (validarEmail(correo.val())) {
			// 	correo.removeClass('is-invalid').addClass('is-valid');
			// 	$('#correoEmpty').hide();
			// 	$('#correoNotValid').hide();
			// }
			// else {
			// 	correo.removeClass('is-valid').addClass('is-invalid');
			// 	$('#correoEmpty').hide();
			// 	$('#correoNotValid').show();
			// }
			// if (username.val().length == 0) {
			// 	username.removeClass('is-valid').addClass('is-invalid');
			// 	$('#usernameEmpty').show();
			// 	$('#usernameNotValid').hide();
			// }
			// else {
			// 	if (validarLetrasyOtrosCaracteres(username.val())) {
			// 		username.removeClass('is-invalid').addClass('is-valid');
			// 		$('#usernameEmpty').hide();
			// 		$('#usernameNotValid').hide();
			// 	}
			// 	else {
			// 		username.removeClass('is-valid').addClass('is-invalid');
			// 		$('#usernameEmpty').hide();
			// 		$('#usernameNotValid').show();
			// 	}
			// }
			// if (password.val().length == 0) {
			// 	password.removeClass('is-valid').addClass('is-invalid');
			// 	$('#passwordEmpty').show();
			// 	passwordValidado = false;
			// }
			// else {
			// 	password.removeClass('is-invalid').addClass('is-valid');
			// 	$('#passwordEmpty').hide();
			// 	passwordValidado = true;
			// }
			// if (password_confirmation.val().length == 0) {
			// 	password_confirmation.removeClass('is-valid').addClass('is-invalid');
			// 	$('#password_confirmationEmpty').show();
			// 	$('#password_confirmationNotSame').hide();
			// 	password_confirmationValidado = false;
			// }
			// else {
			// 	if (password.val() === password_confirmation.val()) {
			// 		password_confirmation.removeClass('is-invalid').addClass('is-valid');
			// 		$('#password_confirmationEmpty').hide();
			// 		$('#password_confirmationNotSame').hide();
			// 		password_confirmationValidado = true;
			// 	}
			// 	else {
			// 		password_confirmation.removeClass('is-valid').addClass('is-invalid');
			// 		$('#password_confirmationEmpty').hide();
			// 		$('#password_confirmationNotSame').show();
			// 		password_confirmationValidado = false;
			// 	}
			// }
			if (nombreValidado && apellidoValidado && cedulaValidado && generoValidado && correoValidado && usernameValidado && passwordValidado && password_confirmationValidado) {
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
					if (jqXHR.status == 204) {
						Swal.fire({
							type: 'info',
							title: "{{ __('Nothing to update') }}",
							showConfirmButton: false,
							allowEscapeKey: false,
							allowOutsideClick: false,
							timer: 1700
						})
					}
					if (jqXHR.status == 200) {
						$("#editaruser").modal("toggle");
						Swal.fire({
							type: 'success',
							title: response.mensaje,
							showConfirmButton: false,
							allowEscapeKey: false,
							allowOutsideClick: false,
							timer: 1700
						})
					}
					console.log(response, statusText, jqXHR.status)
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
		function validacionRespuesta (errors) {
			console.log(errors)
			if (errors.nombre != undefined && errors.nombre.length > 0) {
				console.log(errors.nombre, "nombre")
			}
		}
	</script>
@endsection
