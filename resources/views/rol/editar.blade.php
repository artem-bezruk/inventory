@extends('modals.media')
@section('modal-id', 'editar')
@section('modal-title')
	{{ __('Edit') }} {{ __('Rol') }}
@endsection
@section('modal-content')
	<form  id="formEditar" action="{{ route('rol.update', ['locale' => app()->getLocale(), 'rol' => $data->id]) }}" autocomplete="off">
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
						<tr>
							<td>{{ __('The lower the number, the higher the priority') }}.</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="rol" class="required">{{ __('Rol') }}</label>
			<input type="text" name="rol" id="rol" class="form-control" placeholder="{{ __('Rol') }}" value="{{ $data->rol }}" onkeypress="return keypressvalidarOnlyLetras(event)">
				<span class="invalid-feedback" id="rolEmpty" style="display: none;">
					<strong>{{ __('validation.required', ['attribute' => __('Rol')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="rolNotOnly" style="display: none;">
					<strong>{{ __('validation.regex', ['attribute' => __('Rol')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="rolResponse" style="display: none;">
					<strong id="rolResponseTexto"></strong>
				</span>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="prioridad" class="required">{{ __('Priority') }}</label>
				<input type="text" name="prioridad" id="prioridad" class="form-control" placeholder="{{ __('Priority') }}" value="{{ $data->prioridad }}" onkeypress="return keypressNumbersInteger(event)">
				<span class="invalid-feedback" id="prioridadEmpty" style="display: none;">
					<strong>{{ __('validation.required', ['attribute' => __('Priority')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="prioridadNotOnly" style="display: none;">
					<strong>{{ __('validation.regex', ['attribute' => __('Priority')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="prioridadResponse" style="display: none;">
					<strong id="prioridadResponseTexto"></strong>
				</span>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="descripcion">{{ __('Description') }}</label>
				<textarea class="form-control" name="descripcion" id="descripcion" cols="10" rows="5" placeholder="{{ __('Description') }}" onkeypress="return keyPressValidarLetrasyOtrosCaracteres(event)" style="resize: none;">{{ $data->descripcion }}</textarea>
				<span class="invalid-feedback" id="descripcionNotOnly" style="display: none;">
					<strong>{{ __('validation.regex', ['attribute' => __('Description')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="descripcionResponse" style="display: none;">
					<strong id="descripcionResponseTexto"></strong>
				</span>
			</div>
		</div>
	</form>
@endsection
@section('modal-footer')
	<button class="btn btn-secondary" data-dismiss="modal" type="button">{{ __('Close') }}</button>
	<button class="btn btn-primary" id="btnEditar" type="button">{{ __('Modify') }}</button>
@endsection
@section('modal-script')
	<script src="{{ asset('js/rol.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
		var rol = $('#rol');
		var rolValido = false;
		var descripcion = $('#descripcion');
		var descripcionValido = true;
		var prioridad = $('#prioridad');
		var prioridadValido = false;
		$('#btnEditar').on('click', function () {
			$('#formEditar').submit();
		});
		$('#formEditar').on('submit', function (e) {
			e.preventDefault();
			var data = $(this).serializeArray();
			validacionForm();
			if (rolValido && descripcionValido && prioridadValido) {
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
							listaRoles();
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
		});
	</script>
@endsection
