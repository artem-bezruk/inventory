@extends('modals.media')
@section('modal-id', 'editarcapacidad')
@section('modal-title')
	{{ __('Edit') }} {{ __('Capacity') }}
@endsection
@section('modal-content')
	<form  id="formEditar" action="{{ route('capacidad.update', ['locale' => app()->getLocale(), 'capacidad' => $data->id]) }}" autocomplete="off">
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
				<label for="capacidad" class="required">{{ __('Capacity') }}</label>
				<input type="text" class="form-control" name="capacidad" id="capacidad" value="{{ $data->capacidad }}" placeholder="{{ __('Capacity') }}" onkeypress="return keypressNumbersInteger(event)">
				<span class="invalid-feedback" id="capacidadEmpty" style="display: none;">
					<strong>{{ __('validation.required', ['attribute' => __('Capacity')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="capacidadNotInteger" style="display: none;">
					<strong>{{ __('validation.integer', ['attribute' => __('Capacity')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="capacidadResponse" style="display: none;">
					<strong id="capacidadResponseTexto"></strong>
				</span>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="nomenclatura" class="required">{{ __('Nomenclature') }}</label>
				<select class="form-control" name="nomenclatura" id="selectNomenclatura">
					<option value="" selected disabled>{{ __('Choose') }} {{ __('Nomenclature') }}</option>
					@foreach ($extras->nomenclaturas as $nomenclatura)
						@if ($data->nomenclatura == $nomenclatura->id)
							<option value="{{ $nomenclatura->id }}" selected>{{ __($nomenclatura->nomenclatura) }} ({{ $nomenclatura->abreviatura }})</option>
						@else
							<option value="{{ $nomenclatura->id }}">{{ __($nomenclatura->nomenclatura) }} ({{ $nomenclatura->abreviatura }})</option>
						@endif
					@endforeach
				</select>
				<span class="invalid-feedback" id="nomenclaturaEmpty" style="display: none;">
					<strong>{{ __('validation.required', ['attribute' => __('Nomenclature')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="nomenclaturaNotNumber" style="display: none;">
					<strong>{{ __('validation.numeric', ['attribute' => __('Nomenclature')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="nomenclaturaResponse" style="display: none;">
					<strong id="nomenclaturaResponseTexto"></strong>
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
	<script src="{{ asset('js/capacidad.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
		var capacidad = $('#capacidad');
		var capacidadValido = false;
		var selectNomenclatura = $('#selectNomenclatura');
		var nomenclaturaValido = false;
		$('#btnEditar').on('click', function () {
			$('#formEditar').submit();
		});
		$('#formEditar').on('submit', function (e) {
			e.preventDefault();
			var data = $(this).serializeArray();
			validacionForm();
			if (capacidadValido && nomenclaturaValido) {
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
						$("#editarcapacidad").modal("toggle");
						Swal.fire({
							type: 'success',
							title: response.mensaje,
							showConfirmButton: false,
							allowEscapeKey: false,
							allowOutsideClick: false,
							timer: 1700
						})
						setTimeout(function () {
							listaCapacidades();
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
