@extends('modals.media')
@section('modal-id', 'crearsubclase')
@section('modal-title')
	{{ __('Add') }} {{ __('Subclass') }}
@endsection
@section('modal-content')
	<form id="formCrear" action="{{ route('subclase.store', ['locale' => app()->getLocale()]) }}" autocomplete="off">
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
				<label for="clase" class="required">{{ __('Class') }}</label>
				<select class="form-control" name="clase" id="selectClase">
					<option value="" selected disabled>{{ __('Choose') }} {{ __('Class') }}</option>
					@foreach ($extras->clases as $clase)
						<option value="{{ $clase->id }}">{{ __($clase->clase) }}</option>
					@endforeach
				</select>
				<span class="invalid-feedback" id="claseEmpty" style="display: none;">
					<strong>{{ __('validation.required', ['attribute' => __('Class')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="claseNotNumber" style="display: none;">
					<strong>{{ __('validation.numeric', ['attribute' => __('Class')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="claseResponse" style="display: none;">
					<strong id="claseResponseTexto"></strong>
				</span>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
				<label class="required" for="subclases">{{ __('Subclass') }}</label>
				<input type="text" class="form-control" name="subclase" id="subclase" placeholder="{{ __('Subclass') }}" onkeypress="return keypressvalidarOnlyLetras(event)">
				<span class="invalid-feedback" id="subclaseEmpty" style="display: none;">
					<strong>{{ __('validation.required', ['attribute' => __('Subclass')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="subclaseNotNumber" style="display: none;">
					<strong>{{ __('validation.numeric', ['attribute' => __('Subclass')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="subclaseResponse" style="display: none;">
					<strong id="subclaseResponseTexto"></strong>
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
	<script src="{{ asset('js/subclase.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
		var selectClase = $('#selectClase');
		var claseValido = false;
		var subclase = $('#subclase');
		var subclaseValido = false;
		$('#btnCrear').on('click', function () {
			$('#formCrear').submit();
		});
		$('#formCrear').on('submit', function (e) {
			e.preventDefault();
			var data = $(this).serializeArray();
			validacionForm();
			if (claseValido && subclaseValido) {
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
						$("#crearsubclase").modal("toggle");
						Swal.fire({
							type: 'success',
							title: response.mensaje,
							showConfirmButton: false,
							allowEscapeKey: false,
							allowOutsideClick: false,
							timer: 1700
						})
						setTimeout(function () {
							listaSubclases();
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
