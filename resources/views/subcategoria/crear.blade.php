@extends('modals.media')
@section('modal-id', 'crearsubcategoria')
@section('modal-title')
	{{ __('Add') }} {{ __('Subcategory') }}
@endsection
@section('modal-content')
	<form id="formCrear" action="{{ route('subcategoria.store', ['locale' => app()->getLocale()]) }}" autocomplete="off">
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
				<select class="form-control" name="clase" id="selectClase" onchange="subclases(this.value)">
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
				<select class="form-control" name="subclase" id="selectSubclase" disabled onchange="categorias(this.value)">
					<option value="" selected disabled>{{ __('Choose') }} {{ __('Subclass') }}</option>
				</select>
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
		<div class="form-row">
			<div class="form-group col-md-12">
				<label class="required" for="categorias">{{ __('Category') }}</label>
				<select class="form-control" name="categoria" id="selectCategoria" disabled>
					<option value="" selected disabled>{{ __('Choose') }} {{ __('Category') }}</option>
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
		<div class="form-row">
			<div class="form-group col-md-12">
				<label class="required" for="subcategorias">{{ __('Subcategory') }}</label>
				<input type="text" class="form-control" name="subcategoria" id="subcategoria" placeholder="{{ __('Subcategory') }}" onkeypress="return keypressvalidarOnlyLetras(event)">
				<span class="invalid-feedback" id="subcategoriaEmpty" style="display: none;">
					<strong>{{ __('validation.required', ['attribute' => __('Subcategory')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="subcategoriaNotNumber" style="display: none;">
					<strong>{{ __('validation.numeric', ['attribute' => __('Subcategory')]) }}</strong>
				</span>
				<span class="invalid-feedback" id="subcategoriaResponse" style="display: none;">
					<strong id="subcategoriaResponseTexto"></strong>
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
	<script src="{{ asset('js/subcategoria.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
		var selectClase = $('#selectClase');
		var claseValido = false;
		var selectSubclase = $('#selectSubclase');
		var subclaseValido = false;
		var selectCategoria = $('#selectCategoria');
		var categoriaValido = false;
		var subcategoria = $('#subcategoria');
		var subcategoriaValido = false;
		$('#btnCrear').on('click', function () {
			$('#formCrear').submit();
		});
		$('#capacidad').attr('checked', false).attr('value', 0)
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
			if (claseValido && subclaseValido && categoriaValido && subcategoriaValido) {
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
						$("#crearsubcategoria").modal("toggle");
						Swal.fire({
							type: 'success',
							title: response.mensaje,
							showConfirmButton: false,
							allowEscapeKey: false,
							allowOutsideClick: false,
							timer: 1700
						})
						setTimeout(function () {
							listaSubcategorias();
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
		function subclases (clase)
		{
			var url = "{{ route('subclases', ['locale' => app()->getLocale(), 'clase' => ':clase']) }}";
			var select = $('#selectSubclase');
			$.ajax({
				type: 'GET',
				url: url.replace(':clase', clase),
				cache:false,
			})
			.done(function (response, statusText, jqXHR) {
				if (jqXHR.status == 200) {
					select.prop('disabled', false);
					select.empty();
					var option = document.createElement('option');
					option.value = "";
					option.text = "{{ __('Choose') }}" + " " + "{{ __('Subclass') }}";
					option.selected = true;
					option.disabled = true;
					select.append(option);
					response.subclases.forEach( function(element, index) {
						var option1 = document.createElement('option');
						option1.value = element.id;
						option1.text = element.sub_clase;
						select.append(option1);
					});
				}
				if (jqXHR.status == 204) {
					select.prop('disabled', true);
					select.empty();
					var option = document.createElement('option');
					option.value = "";
					option.text = "{{ __('No content to show') }}";
					option.selected = true;
					option.disabled = true;
					select.append(option);
				}
			})
			.fail(function (e) {
				select.prop('disabled', true);
				select.empty();
				var option = document.createElement('option');
				option.value = "";
				option.text = "{{ __('No content to show') }}";
				option.selected = true;
				option.disabled = true;
				select.append(option);
			});
		}
		function categorias (subclase)
		{
			var url = "{{ route('categorias', ['locale' => app()->getLocale(), 'subclase' => ':subclase']) }}";
			var select = $('#selectCategoria');
			$.ajax({
				type: 'GET',
				url: url.replace(':subclase', subclase),
				cache:false,
			})
			.done(function (response, statusText, jqXHR) {
				if (jqXHR.status == 200) {
					select.prop('disabled', false);
					select.empty();
					var option = document.createElement('option');
					option.value = "";
					option.text = "{{ __('Choose') }}" + " " + "{{ __('Categories') }}";
					option.selected = true;
					option.disabled = true;
					select.append(option);
					response.categorias.forEach( function(element, index) {
						var option1 = document.createElement('option');
						option1.value = element.id;
						option1.setAttribute('data-ver_capacidad', element.ver_capacidad);
						option1.text = element.categoria;
						select.append(option1);
					});
				}
				if (jqXHR == 204) {
					select.prop('disabled', true);
					select.empty();
					var option = document.createElement('option');
					option.value = "";
					option.text = "{{ __('No content to show') }}";
					option.selected = true;
					option.disabled = true;
					select.append(option);
				}
			})
			.fail(function (e) {
				select.prop('disabled', true);
				select.empty();
				var option = document.createElement('option');
				option.value = "";
				option.text = "{{ __('No content to show') }}";
				option.selected = true;
				option.disabled = true;
				select.append(option);
			});
		}
	</script>
@endsection
