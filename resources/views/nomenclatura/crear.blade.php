@extends('modals.media')
@section('modal-id', 'crear')
@section('modal-title')
	{{ __('Add') }} {{ __('Nomenclature') }}
@endsection
@section('modal-content')
	<form id="formCrear" action="{{ route('nomenclatura.store', ['locale' => app()->getLocale()]) }}" autocomplete="off">
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
				<label for="nomenclatura" class="required">{{ __('Nomenclature') }}</label>
				<input type="text" name="nomenclatura" id="nomenclatura" class="form-control" placeholder="{{ __('Nomenclature') }}" onkeypress="return keypressvalidarOnlyLetras(event)">
				<span class="invalid-feedback" id="nomenclaturaEmpty" style="display: none;">
					<strong>{{ __('validation.required', ['attribute' => __('Nomenclature')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="nomenclaturaNotOnly" style="display: none;">
					<strong>{{ __('validation.regex', ['attribute' => __('Nomenclature')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="nomenclaturaResponse" style="display: none;">
					<strong id="nomenclaturaResponseTexto"></strong>
				</span>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="abreviatura" class="required">{{ __('Abbreviation') }}</label>
				<input type="text" name="abreviatura" id="abreviatura" class="form-control" placeholder="{{ __('Abbreviation') }}" onkeypress="return keypressvalidarOnlyLetras(event)">
				<span class="invalid-feedback" id="abreviaturaEmpty" style="display: none;">
					<strong>{{ __('validation.required', ['attribute' => __('Abbreviation')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="abreviaturaNotOnly" style="display: none;">
					<strong>{{ __('validation.regex', ['attribute' => __('Abbreviation')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="abreviaturaResponse" style="display: none;">
					<strong id="abreviaturaResponseTexto"></strong>
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
	<script src="{{ asset('js/nomenclatura.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
		var nomenclatura = $('#nomenclatura');
		var nomenclaturaValido = false;
		var abreviatura = $('#abreviatura');
		var abreviaturaValido = false;
		$('#btnCrear').on('click', function () {
			$('#formCrear').submit();
		});
		$('#formCrear').on('submit', function (e) {
			e.preventDefault();
			var data = $(this).serializeArray();
			validacionForm();
			if (nomenclaturaValido && abreviaturaValido) {
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
						$("#crear").modal("toggle");
						Swal.fire({
							type: 'success',
							title: response.mensaje,
							showConfirmButton: false,
							allowEscapeKey: false,
							allowOutsideClick: false,
							timer: 1700
						})
						setTimeout(function () {
							listaNomenclaturas();
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
