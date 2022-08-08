@extends('modals.media')
@section('modal-id', 'crear')
@section('modal-title')
	{{ __('Add') }} {{ __('Module') }}
@endsection
@section('modal-content')
	<form id="formCrear" action="{{ route('modulo.store', ['locale' => app()->getLocale()]) }}" autocomplete="off">
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
				<input type="text" name="modulo" id="modulo" class="form-control" placeholder="{{ __('Module') }}" onkeypress="return keypressvalidarOnlyLetras(event)">
				<span class="invalid-feedback" id="moduloEmpty" style="display: none;">
					<strong>{{ __('validation.required', ['attribute' => __('Module')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="moduloNotOnly" style="display: none;">
					<strong>{{ __('validation.regex', ['attribute' => __('Module')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="moduloResponse" style="display: none;">
					<strong id="moduleResponseTexto"></strong>
				</span>
			</div>
		</div>
		<div class="form-row">
			<div class="from-group col-md-12">
				<div class="custom-control custom-switch">
					<input type="checkbox" class="custom-control-input" name="filtrable" id="filtrable">
					<label class="custom-control-label" for="filtrable">{{ __('It is filterable?') }}</label>
					<span class="invalid-feedback" id="filtrableResponse" style="display: none;">
						<strong id="filtrableResponseTexto"></strong>
					</span>
                </div>
			</div>
		</div>
	</form>
@endsection
@section('modal-footer')
	<button class="btn btn-secondary" data-dismiss="modal" type="button">{{ __('Close') }}</button>
	<button class="btn btn-primary" id="btnCrear" type="button">{{ __('Create') }}</button>
@endsection
@section('modal-script')
	<script src="{{ asset('js/modulo.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
		var modulo = $('#modulo');
		var moduloValido = false;
		$('#btnCrear').on('click', function () {
			$('#formCrear').submit();
		});
		$('#filtrable').attr('checked', false).attr('value', 0)
		.on('change', function () {
			if ($(this).is(':checked')) {
				$(this).attr('value', 1);
			}
			else {
				$(this).attr('value', 0);
			}
		});
		$('#formCrear').on('submit', function (e) {
			e.preventDefault();
			var data = $(this).serializeArray();
			validacionForm();
			if (moduloValido) {
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
							listaModulos();
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
@endsection
