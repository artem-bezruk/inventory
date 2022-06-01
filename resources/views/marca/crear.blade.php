@extends('modals.media')
@section('modal-id', 'crearmarca')
@section('modal-title')
	{{ __('Add') }} {{ __('Mark') }}
@endsection
@section('modal-content')
	<form id="formCrear" action="{{ route('marca.store', ['locale' => app()->getLocale()]) }}" autocomplete="off">
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
				<label for="marca" class="required">{{ __('Mark') }}</label>
				<input type="text" class="form-control" name="marca" id="marca" placeholder="{{ __('Mark') }}" onkeypress="return keypressvalidarOnlyLetras(event)">
				<span class="invalid-feedback" id="marcaEmpty" style="display: none;">
					<strong>{{ __('validation.required', ['attribute' => __('Mark')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="marcaNotOnly" style="display: none;">
					<strong>{{ __('validation.regex', ['attribute' => __('Mark')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="marcaResponse" style="display: none;">
					<strong id="marcaResponseTexto"></strong>
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
	<script src="{{ asset('js/marca.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
		var marca = $('#marca');
		var marcaValido = false;
		$('#btnCrear').on('click', function () {
			$('#formCrear').submit();
		});
		$('#formCrear').on('submit', function (e) {
			e.preventDefault();
			var data = $(this).serializeArray();
			validacionForm();
			if (marcaValido) {
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
						$("#crearmarca").modal("toggle");
						Swal.fire({
							type: 'success',
							title: response.mensaje,
							showConfirmButton: false,
							allowEscapeKey: false,
							allowOutsideClick: false,
							timer: 1700
						})
						setTimeout(function () {
							listaMarcas();
						}, 1700)
					}
					else
						Swal.close();
					console.log(response);
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
