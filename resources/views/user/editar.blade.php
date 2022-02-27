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
							<th>{{ __('Note') }}:</th>
						</tr>
						<tr>
							<td>{{ __('The fields marked with') }} <span class="required"></span> {{ __('are required') }}.</td>
						</tr>
						<tr>
							<td>{{ __('Choose') }} <strong>{{ __('Personal Information') }} (PI)</strong> {{ __('or') }} <strong>{{ __('User Information') }} (UI)</strong> {{ __('to change the respective data') }}.</td>
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
					<span class="invalid-feedback" id="nombreResponse" style="display: none;">
						<strong id="nombreResponseTexto"></strong>
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
					<span class="invalid-feedback" id="apellidoResponse" style="display: none;">
						<strong id="apellidoResponseTexto"></strong>
					</span>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
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
						<strong>{{ __('validation.numeric', ['attribute' => __('Gender')]) }}</strong>
					</span>
					<span class="invalid-feedback" id="generoResponse" style="display: none;">
						<strong id="generoResponseTexto"></strong>
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
						<strong>{{ __('validation.numeric', ['attribute' => __('Status')]) }}</strong>
					</span>
					<span class="invalid-feedback" id="estatusResponse" style="display: none">
						<strong id="estatusResponseTexto"></strong>
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
					<span class="invalid-feedback" id="correoResponse" style="display: none">
						<strong id="correoResponseTexto"></strong>
					</span>
				</div>
			</div>
		</div>
		<div id="ui" style="display: none;">
			<div class="form-row">
				<div class="form-group col-md-12">
					<label for="usuario">{{ __('Username') }}</label>
					<input type="text" class="form-control-plaintext" name="username" id="username" value="{{ $data->username }}" placeholder="{{ __('Username') }}" onkeypress="return keyPressValidarLetrasyOtrosCaracteres(event)" readonly disabled autocomplete="off">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label class="required" for="rol">{{ __('Rol') }}</label>
					<select name="rol" id="rol" class="custom-select">
						<option value="" selected disabled>{{ __('Choose') }} Rol</option>
						@foreach ($extras->roles as $element)
							@if ($data->rol == $element->id)
								<option value="{{ $element->id }}" selected>{{ __($element->rol) }}</option>
							@else
								<option value="{{ $element->id }}">{{ __($element->rol) }}</option>
							@endif
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
		</div>
	</form>
@endsection
@section('modal-footer')
	<button class="btn btn-secondary" data-dismiss="modal" type="button">{{ __('Close') }}</button>
	<button class="btn btn-primary" id="btnEditar" type="button">{{ __('Modify') }}</button>
@endsection
@section('modal-script')
	<script src="{{ asset('js/user.js') }}" type="text/javascript"></script>
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
		var rol = $('#rol');
		var rolValidado = false;
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
				rol.removeClass('is-valid').removeClass('is-invalid').prop('disabled', true);
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
				rol.removeClass('is-valid').removeClass('is-invalid').prop('disabled', false);
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
				if (estatus.val() == null) {
					estatus.removeClass('is-valid').addClass('is-invalid');
					$('#estatusEmpty').show();
					$('#estatusNotNumber').hide();
					$('#estatusResponse').hide();
					estatusValidado = false;
				}
				else {
					if (validateOnlyNumbers(estatus.val())) {
						estatus.removeClass('is-invalid').addClass('is-valid');
						$('#estatusEmpty').hide();
						$('#estatusNotNumber').hide();
						$('#estatusResponse').hide();
						estatusValidado = true;
					}
					else {
						estatus.removeClass('is-valid').addClass('is-invalid');
						$('#estatusEmpty').hide();
						$('#estatusNotNumber').show();
						$('#estatusResponse').hide();
						estatusValidado = false;
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
			}
			if (editar == 2) {
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
			}
			if ((editar == 1 && nombreValidado && apellidoValidado && generoValidado && estatusValidado && correoValidado) || (editar == 2 && rolValidado && passwordValidado && password_confirmationValidado)) {
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
	</script>
@endsection
