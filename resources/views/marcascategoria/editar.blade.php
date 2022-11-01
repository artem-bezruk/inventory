@extends('modals.media')
@section('modal-id', 'editar')
@section('modal-title')
	{{ __('Edit') }} {{ __('Mark') }} {{ __('by') }} {{ __('Category') }}
@endsection
@section('modal-content')
	<form  id="formEditar" action="{{ route('marcacategoria.update', ['locale' => app()->getLocale(), 'marcacategoria' => $data->id]) }}" autocomplete="off">
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
				<label class="required" for="marcas">{{ __('Mark') }}</label>
				<select class="form-control" name="marca" id="selectMarca">
					<option value="" selected disabled>{{ __('Choose') }} {{ __('Mark') }}</option>
					@foreach ($extras->marcas as $marca)
						@if ($marca->id == $data->marca)
							<option value="{{ $marca->id }}" selected>{{ __($marca->marca) }}</option>
						@else
							<option value="{{ $marca->id }}">{{ __($marca->marca) }}</option>
						@endif
					@endforeach
				</select>
				<span class="invalid-feedback" id="marcaEmpty" style="display: none;">
					<strong>{{ __('validation.required', ['attribute' => __('Mark')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="marcaNotNumber" style="display: none;">
					<strong>{{ __('validation.numeric', ['attribute' => __('Mark')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="marcaResponse" style="display: none;">
					<strong id="marcaResponseTexto"></strong>
				</span>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
				<label class="required" for="categorias">{{ __('Category') }}</label>
				<select class="form-control" name="categoria" id="selectCategoria">
					<option value="" selected disabled>{{ __('Choose') }} {{ __('Category') }}</option>
					@foreach ($extras->categorias as $categoria)
						@if ($categoria->id == $data->categoria)
							<option value="{{ $categoria->id }}" selected>{{ __($categoria->categoria) }}</option>
						@else
							<option value="{{ $categoria->id }}">{{ __($categoria->categoria) }}</option>
						@endif
					@endforeach
				</select>
				<span class="invalid-feedback" id="categoriaEmpty" style="display: none;">
					<strong>{{ __('validation.required', ['attribute' => __('Category')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="categoriaNotNumber" style="display: none;">
					<strong>{{ __('validation.numeric', ['attribute' => __('Category')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="categoriaResponse" style="display: none;">
					<strong id="categoriaResponseTexto"></strong>
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
	<script src="{{ asset('js/marcacategoria.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
		var selectMarca = $('#selectMarca');
		var marcaValido = false;
		var selectCategoria = $('#selectCategoria');
		var categoriaValido = false;
		$('#btnEditar').on('click', function () {
			$('#formEditar').submit();
		});
		$('#formEditar').on('submit', function (e) {
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
							listaMarcasCategorias();
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
