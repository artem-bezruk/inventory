@extends('modals.media')
@section('modal-id', 'editar')
@section('modal-title')
	{{ __('Edit') }} {{ __('Module') }} {{ __('by') }} {{ __('Rol') }}
@endsection
@section('modal-content')
	<form  id="formEditar" action="{{ route('modulorol.update', ['locale' => app()->getLocale(), 'modulorol' => $data->id]) }}" autocomplete="off">
		@method('PUT')
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
		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="modulo" class="required">{{ __('Module') }}</label>
				<select name="modulo" id="modulo" class="form-control">
					<option value="" selected disabled>{{ __('Choose') }} {{ __('Module') }}</option>
					@foreach ($extras->modulos as $modulo)
						@if ($modulo->id == $data->modulo)
							<option value="{{ $modulo->id }}" selected>{{ __($modulo->modulo) }}</option>
						@else
							<option value="{{ $modulo->id }}">{{ __($modulo->modulo) }}</option>
						@endif
					@endforeach
				</select>
				<span class="invalid-feedback" id="moduloEmpty" style="display: none;">
					<strong>{{ __('validation.required', ['attribute' => __('Module')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="moduloNotNumber" style="display: none;">
					<strong>{{ __('validation.numeric', ['attribute' => __('Module')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="moduloResponse" style="display: none;">
					<strong id="moduloResponseTexto"></strong>
				</span>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="rol" class="required">{{ __('Rol') }}</label>
				<select name="rol" id="rol" class="form-control">
					<option value="" selected disabled>{{ __('Choose') }} {{ __('Rol') }}</option>
					@foreach ($extras->roles as $rol)
						@if ($rol->id == $data->rol)
							<option value="{{ $rol->id }}" selected>{{ __($rol->rol) }}</option>
						@else
							<option value="{{ $rol->id }}">{{ __($rol->rol) }}</option>
						@endif
					@endforeach
				</select>
				<span class="invalid-feedback" id="rolEmpty" style="display: none;">
					<strong>{{ __('validation.required', ['attribute' => __('Rol')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="rolNotNumber" style="display: none;">
					<strong>{{ __('validation.numeric', ['attribute' => __('Rol')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="rolResponse" style="display: none;">
					<strong id="rolResponseTexto"></strong>
				</span>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="permisos">{{ __('Permissions') }}</label><br>
				<span class="invalid-feedback" id="permisosResponse" style="display: none;">
					<strong id="permisosResponseTexto"></strong>
				</span>
			</div>
			<div class="form-group col-md-3">
				<div class="custom-control custom-checkbox">
					<input class="custom-control-input formatCheckbox" type="checkbox" name="crear" value="{{ $data->crear }}" id="crearCheckbox" @if($data->crear) checked @endif>
					<label for="crearCheckbox" class="custom-control-label">{{ __('Add') }}</label>
				</div>
			</div>
			<div class="form-group col-md-3">
				<div class="custom-control custom-checkbox">
					<input type="checkbox" name="mostrar" id="mostrarCheckbox" class="custom-control-input formatCheckbox" value="{{ $data->mostrar }}" @if($data->mostrar) checked @endif>
					<label class="custom-control-label" for="mostrarCheckbox">{{ __('Show') }}</label>
				</div>
			</div>
			<div class="form-group col-md-3">
				<div class="custom-control custom-checkbox">
					<input type="checkbox" name="editar" id="editarCheckbox" class="custom-control-input formatCheckbox" value="{{ $data->editar }}" @if($data->editar) checked @endif>
					<label class="custom-control-label" for="editarCheckbox">{{ __('Edit') }}</label>
				</div>
			</div>
			<div class="form-group col-md-3">
				<div class="custom-control custom-checkbox">
					<input type="checkbox" name="eliminar" id="eliminarCheckbox" class="custom-control-input formatCheckbox" value="{{ $data->eliminar }}" @if($data->eliminar) checked @endif>
					<label class="custom-control-label" for="eliminarCheckbox">{{ __('Delete') }}</label>
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
	<script src="{{ asset('js/modulorol.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
		var modulo = $('#modulo');
		var moduloValido = false;
		var rol = $('#rol');
		var rolValido = false;
		$('#btnEditar').on('click', function () {
			$('#formEditar').submit();
		});
		$('.formatCheckbox').on('change', function () {
			if ($(this).is(':checked')) {
				$(this).attr('value', 1);
			}
			else {
				$(this).attr('value', 0);
			}
		});
		$('#formEditar').on('submit', function (e) {
			e.preventDefault();
			var data = $(this).serializeArray();
			validacionForm();
			if (moduloValido && rolValido) {
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
						$("#editar").modal("toggle");
						Swal.fire({
							type: 'success',
							title: response.mensaje,
							showConfirmButton: false,
							allowEscapeKey: false,
							allowOutsideClick: false,
							timer: 1700
						})
						setTimeout(function () {
							listaModulosRoles();
						}, 1700)
					}
				})
				.fail(function (e) {
					var message = "{{ __('Oops! Something went wrong') }}";
					if (e.status == 422) {
						validacionRespuesta(e.responseJSON.errors);
					}
					if (e.status == 400) {
						message = e.responseJSON.mensaje;
					}
					Swal.fire({
						type: 'error',
						title: message,
						showConfirmButton: false,
						allowEscapeKey: false,
						allowOutsideClick: false,
						timer: 1700
					})
				});
			}
		});
	</script>
@endsection
