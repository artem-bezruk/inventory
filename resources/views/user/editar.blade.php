@extends('modals.media')
@section('modal-id', 'editaruser')
@section('modal-title')
	{{ __('Edit') }} {{ __('User') }}
@endsection
@section('modal-content')
	<form id="formModificar" action="{{ route('user.update', ['locale' => app()->getLocale(), 'user' => $data->id]) }}">
		@method('PUT')
		<div class="form-row">
			<div class="col-md-12 text-info mb-3">
				<table>
					<tbody>
						<tr>
							<td>{{ __('Choose') }} <strong>{{ __('Personal Information') }} (PI)</strong> {{ __('or') }} <strong>{{ __('User Information') }} (UI)</strong> {{ __('to change the respective data') }}.</td>
						</tr>
						<tr>
							<th>{{ __('Note') }}:</th>
						</tr>
						<tr>
							<td>{{ __('The fields marked with') }} <span class="required"></span> {{ __('are required') }}.</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="form-row mb-2">
			<div class="form-check form-check-inline col-md-12 d-flex justify-content-center">
				<input type="radio" class="form-check-input" name="editar" value="1" checked>
				<label class="form-check-label">PI</label>
				&nbsp;
				<input type="radio" class="form-check-input" name="editar" value="2">
				<label class="form-check-label">UI</label>
			</div>
		</div>
		<div id="pi">
			<div class="form-row">
				<div class="form-group col-md-6">
					<label class="required" for="nombre">{{ __('Name') }}</label>
					<input type="text" class="form-control" name="nombre" id="nombre" value="{{ $data->nombre }}" placeholder="{{ __('Name') }}" onkeypress="return keypressvalidarOnlyLetras(event)" required autocomplete="off">
					<span class="invalid-feedback" id="nombreEmpty" style="display: none;">
						<strong>{{ __('validation.required', ['attribute' => __('Name')]) }}</strong>
					</span>
					<span class="invalid-feedback" id="nombreNotOnly" style="display: none;">
						<strong>{{ __('validation.regex', ['attribute' => __('Name')]) }}</strong>
					</span>
				</div>
				<div class="form-group col-md-6">
					<label class="required" for="apellido">{{ __('Last name') }}</label>
					<input type="text" class="form-control" name="apellido" id="apellido" value="{{ $data->apellido }}" placeholder="{{ __('Last name') }}" onkeypress="return keypressvalidarOnlyLetras(event)" required autocomplete="off">
					<span class="invalid-feedback" id="apellidoEmpty" style="display: none;">
						<strong>{{ __('validation.required', ['attribute' => __('Last name')]) }}</strong>
					</span>
					<span class="invalid-feedback" id="apellidoNotOnly" style="display: none;">
						<strong>{{ __('validation.regex', ['attribute' => __('Last name')]) }}</strong>
					</span>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="cedula">{{ __('Identity document') }}</label>
					<input type="text" class="form-control-plaintext" name="cedula" id="cedula" value="{{ $data->cedula }}" placeholder="{{ __('Identity document') }}" onkeypress="return keypressNumbersInteger(event)" readonly disabled autocomplete="off">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label class="required" for="genero">{{ __('Gender') }}</label>
					<select name="genero" id="genero" class="custom-select">
						<option value="" selected disabled>{{ __('Choose') }} {{ __('Gender') }}</option>
						@foreach ($extras->generos as $element)
							@if ($data->genero == $element->id)
								<option value="{{ $element->id }}" selected>{{ __($element->genero) }}</option>
							@else
								<option value="{{ $element->id }}">{{ __($element->genero) }}</option>
							@endif
						@endforeach
					</select>
					<span class="invalid-feedback" id="generoEmpty" style="display: none;">
						<strong>{{ __('validation.required', ['attribute' => __('Gender')]) }}</strong>
					</span>
					<span class="invalid-feedback" id="generoNotNumber" style="display: none;">
						<strong>{{ __('validation.regex', ['attribute' => __('Gender')]) }}</strong>
					</span>
				</div>
				<div class="form-group col-md-6">
					<label class="required" for="estatus">{{ __('Status') }}</label>
					<select name="estatus" id="estatus" class="custom-select">
						<option value="" selected disabled>{{ __('Choose') }} {{ __('Status') }}</option>
						@foreach ($extras->estatus as $element)
							@if ($data->estatus == $element->id)
								<option value="{{ $element->id }}" selected>{{ __($element->estado) }}</option>
							@else
								<option value="{{ $element->id }}">{{ __($element->estado) }}</option>
							@endif
						@endforeach
					</select>
					<span class="invalid-feedback" id="estatusEmpty" style="display: none;">
						<strong>{{ __('validation.required', ['attribute' => __('Status')]) }}</strong>
					</span>
					<span class="invalid-feedback" id="estatusNotNumber" style="display: none;">
						<strong>{{ __('validation.regex', ['attribute' => __('Status')]) }}</strong>
					</span>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label class="required" for="correo" >{{ __('E-Mail Address') }}</label>
					<input type="email" class="form-control" name="correo" id="correo" value="{{ $data->correo }}" placeholder="{{ __('E-Mail Address') }}" onkeypress="return keyPressValidarLetrasyOtrosCaracteres(event)" required autocomplete="off">
					<span class="invalid-feedback" id="correoEmpty" style="display: none">
						<strong>{{ __('validation.required', ['attribute' => __('E-Mail Address')]) }}</strong>
					</span>
					<span class="invalid-feedback" id="correoNotValid" style="display: none">
						<strong>{{ __('validation.email', ['attribute' => __('E-Mail Address')]) }}</strong>
					</span>
				</div>
			</div>
		</div>
		<div id="ui" style="display: none;">
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="usuario">{{ __('Username') }}</label>
					<input type="text" class="form-control-plaintext" name="username" id="username" value="{{ $data->username }}" placeholder="{{ __('Username') }}" onkeypress="return keyPressValidarLetrasyOtrosCaracteres(event)" readonly disabled autocomplete="off">
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
					<label for="contraseña">{{ __('Password') }}</label>
					<input type="password" class="form-control" name="password" id="password" placeholder="{{ __('Password') }}" required autocomplete="off">
					<span class="invalid-feedback" id="passwordEmpty" style="display: none">
						<strong>{{ __('validation.required', ['attribute' => __('Password')]) }}</strong>
					</span>
				</div>
				<div class="form-group col-md-6">
					<label for="contraseña">{{ __('Confirm Password') }}</label>
					<input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="{{ __('Confirm Password') }}" required autocomplete="off">
					<span class="invalid-feedback" id="password_confirmationEmpty" style="display: none">
						<strong>{{ __('validation.required', ['attribute' => __('Confirm Password')]) }}</strong>
					</span>
					<span class="invalid-feedback" id="password_confirmationNotSame" style="display: none">
						<strong>{{ __('validation.same', ['attribute' => __('Password'), 'other' => __('Confirm Password')]) }}</strong>
					</span>
				</div>
			</div>
		</div>
	</form>
@endsection
@section('modal-footer')
	<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
	<button class="btn btn-primary" id="btnEditar" type="button">Modificar</button>
@endsection
@section('modal-script')
	<script type="text/javascript">
		var nombre = $('#nombre');
		var nombreValidado = false;
		var apellido = $('#apellido');
		var apellidoValidado = false;
		var cedula = $('#cedula');
		var cedulaValidado = false;
		var genero = $('#genero');
		var generoValidado = false;
		var estatus = $('#estatus');
		var estatusValidado = false;
		var correo = $('#correo');
		var correoValidado = false;
		var username = $('#username');
		var usernameValidado = false;
		var password = $('#password');
		var passwordValidado = false;
		var password_confirmation = $('#password_confirmation');
		var password_confirmationValidado = false;
		$(document).ready(function () {
			password.prop('disabled', true);
				password_confirmation.prop('disabled', true);
		});
		$('#btnEditar').on('click', function () {
			$('#formModificar').submit();
		});
		$('input:radio[name="editar"]').on('change', function () {
			if ($(this).val() == 1) {
				$('#pi').show();
				$('#ui').hide();
				nombre.removeClass('is-valid').removeClass('is-invalid').prop('disabled', false);
				apellido.removeClass('is-valid').removeClass('is-invalid').prop('disabled', false);
				cedula.removeClass('is-valid').removeClass('is-invalid').prop('disabled', false);
				genero.removeClass('is-valid').removeClass('is-invalid').prop('disabled', false);
				estatus.removeClass('is-valid').removeClass('is-invalid').prop('disabled', false);
				correo.removeClass('is-valid').removeClass('is-invalid').prop('disabled', false);
				username.removeClass('is-valid').removeClass('is-invalid');
				password.removeClass('is-valid').removeClass('is-invalid').prop('disabled', true);
				password_confirmation.removeClass('is-valid').removeClass('is-invalid').prop('disabled', true);
			}
			if ($(this).val() == 2) {
				$('#pi').hide();
				$('#ui').show();
				nombre.removeClass('is-valid').removeClass('is-invalid').prop('disabled', true);
				apellido.removeClass('is-valid').removeClass('is-invalid').prop('disabled', true);
				cedula.removeClass('is-valid').removeClass('is-invalid').prop('disabled', true);
				genero.removeClass('is-valid').removeClass('is-invalid').prop('disabled', true);
				estatus.removeClass('is-valid').removeClass('is-invalid').prop('disabled', true);
				correo.removeClass('is-valid').removeClass('is-invalid').prop('disabled', true);
				password.removeClass('is-valid').removeClass('is-invalid').prop('disabled', false);
				password_confirmation.removeClass('is-valid').removeClass('is-invalid').prop('disabled', false);
			}
		});
		$('#formModificar').on('submit', function (e) {
			e.preventDefault();
			var data = $(this).serializeArray();
			var editar = $('input:radio[name="editar"]:checked').val();
			if (editar == 1) {
				if (nombre.val().length <= 0) {
					nombre.removeClass('is-valid').addClass('is-invalid');
					$('#nombreEmpty').show();
					$('#nombreNotOnly').hide();
					nombreValidado = false;
				}
				else if (validarOnlyLetrasBoolean(nombre.val())) {
					nombre.removeClass('is-invalid').addClass('is-valid');
					$('#nombreEmpty').hide();
					$('#nombreNotOnly').hide();
					nombreValidado = true;
				}
				else {
					nombre.removeClass('is-valid').addClass('is-invalid');
					$('#nombreEmpty').hide();
					$('#nombreNotOnly').show();
					nombreValidado = false;
				}
				if (apellido.val().length <= 0) {
					apellido.removeClass('is-valid').addClass('is-invalid');
					$('#apellidoEmpty').show();
					$('#apellidoNotOnly').hide();
					apellidoValidado = false;
				}
				else if (validarOnlyLetrasBoolean(apellido.val())) {
					apellido.removeClass('is-invalid').addClass('is-valid');
					$('#apellidoEmpty').hide();
					$('#apellidoNotOnly').hide();
					apellidoValidado = true;
				}
				else {
					apellido.removeClass('is-valid').addClass('is-invalid');
					$('#apellidoEmpty').hide();
					$('#apellidoNotOnly').show();
					apellidoValidado = false;
				}
				if (cedula.val().length == 0) {
					cedula.removeClass('is-valid').addClass('is-invalid');
					$('#cedulaEmpty').show();
					$('#cedulaLenght').hide();
					$('#cedulaNotNumber').hide();
					cedulaValidado = false;
				}
				else if (cedula.val().length < 7 || cedula.val().length > 8) {
					cedula.removeClass('is-valid').addClass('is-invalid');
					$('#cedulaEmpty').hide();
					$('#cedulaLenght').show();
					$('#cedulaNotNumber').hide();
					cedulaValidado = false;
				}
				else {
					if (validateOnlyNumbers(cedula.val())) {
						cedula.removeClass('is-invalid').addClass('is-valid');
						$('#cedulaEmpty').hide();
						$('#cedulaLenght').hide();
						$('#cedulaNotNumber').hide();
						cedulaValidado = true;
					}
					else {
						cedula.removeClass('is-valid').addClass('is-invalid');
						$('#cedulaEmpty').hide();
						$('#cedulaLenght').hide();
						$('#cedulaNotNumber').show();
						cedulaValidado = false;
					}
				}
				if (genero.val() == null) {
					genero.removeClass('is-valid').addClass('is-invalid');
					$('#generoEmpty').show();
					$('#generoNotNumber').hide();
					generoValidado = false;
				}
				else {
					if (validateOnlyNumbers(genero.val())) {
						genero.removeClass('is-invalid').addClass('is-valid');
						$('#generoEmpty').hide();
						$('#generoNotNumber').hide();
						generoValidado = true;
					}
					else {
						genero.removeClass('is-valid').addClass('is-invalid');
						$('#generoEmpty').hide();
						$('#generoNotNumber').show();
						generoValidado = false;
					}
				}
				if (estatus.val() == null) {
					estatus.removeClass('is-valid').addClass('is-invalid');
					$('#generoEmpty').show();
					$('#generoNotNumber').hide();
					estatusValidado = false;
				}
				else {
					if (validateOnlyNumbers(estatus.val())) {
						estatus.removeClass('is-invalid').addClass('is-valid');
						$('#generoEmpty').hide();
						$('#generoNotNumber').hide();
						estatusValidado = true;
					}
					else {
						estatus.removeClass('is-valid').addClass('is-invalid');
						$('#generoEmpty').hide();
						$('#generoNotNumber').show();
						estatusValidado = false;
					}
				}
				if (correo.val().length == 0) {
					correo.removeClass('is-valid').addClass('is-invalid');
					$('#correoEmpty').show();
					$('#correoNotValid').hide();
					correoValidado = false;
				}
				else if (validarEmail(correo.val())) {
					correo.removeClass('is-invalid').addClass('is-valid');
					$('#correoEmpty').hide();
					$('#correoNotValid').hide();
					correoValidado = true;
				}
				else {
					correo.removeClass('is-valid').addClass('is-invalid');
					$('#correoEmpty').hide();
					$('#correoNotValid').show();
					correoValidado = false;
				}
			}
			if (editar == 2) {
				if (username.val().length == 0) {
					username.removeClass('is-valid').addClass('is-invalid');
					$('#usernameEmpty').show();
					$('#usernameNotValid').hide();
					usernameValidado = false;
				}
				else {
					if (validarLetrasyOtrosCaracteres(username.val())) {
						username.removeClass('is-invalid').addClass('is-valid');
						$('#usernameEmpty').hide();
						$('#usernameNotValid').hide();
						usernameValidado = true;
					}
					else {
						username.removeClass('is-valid').addClass('is-invalid');
						$('#usernameEmpty').hide();
						$('#usernameNotValid').show();
						usernameValidado = false;
					}
				}
				if (password.val().length == 0) {
					password.removeClass('is-valid').addClass('is-invalid');
					$('#passwordEmpty').show();
					passwordValidado = false;
				}
				else {
					password.removeClass('is-invalid').addClass('is-valid');
					$('#passwordEmpty').hide();
					passwordValidado = true;
				}
				if (password_confirmation.val().length == 0) {
					password_confirmation.removeClass('is-valid').addClass('is-invalid');
					$('#password_confirmationEmpty').show();
					$('#password_confirmationNotSame').hide();
					password_confirmationValidado = false;
				}
				else {
					if (password.val() === password_confirmation.val()) {
						password_confirmation.removeClass('is-invalid').addClass('is-valid');
						$('#password_confirmationEmpty').hide();
						$('#password_confirmationNotSame').hide();
						password_confirmationValidado = true;
					}
					else {
						password_confirmation.removeClass('is-valid').addClass('is-invalid');
						$('#password_confirmationEmpty').hide();
						$('#password_confirmationNotSame').show();
						password_confirmationValidado = false;
					}
				}
			}
			if ((editar == 1 && nombreValidado && apellidoValidado && generoValidado && estatusValidado && correoValidado) || (editar == 2 && passwordValidado && password_confirmationValidado)) {
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
							title: "{{ __('Requesting information') }}",
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
	</script>
@endsection
