@extends('layouts.base')
@section('tab-title', __('Binnacle'))
@section('css')
	<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/datepicker/css/bootstrap-datepicker3.min.css') }}">
@endsection
@section('breadcrumb-title', __('Binnacle'))
@section('breadcrumb')
	<li class="breadcrumb-item active">{{ __('Binnacle') }}</li>
@endsection
@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="text-left">
						<h3 class="card-title">{{ __('Binnacle') }}</h3>
					</div>
				</div>
				<div class="card-body">
					<div class="container-fluid">
						<div class="row mb-4">
							<form id="filtros" class="form-inline">
								<div class="form-group mb-2 mr-1">
									<select name="username" class="form-control">
										<option value="" selected>{{ __('Choose') }} {{ __('Username') }}</option>
										@foreach ($extras->users as $user)
											<option value="{{ $user->id }}">{{ $user->username }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group mb-2 mr-1">
									<select name="modulo" class="form-control">
										<option value="" selected>{{ __('Choose') }} {{ __('Module') }}</option>
										@foreach ($extras->modulos as $modulo)
											<option value="{{ $modulo->id }}">{{ $modulo->modulo }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group mb-2 mr-1">
									<select name="accion" class="form-control">
										<option value="" selected>{{ __('Choose') }} {{ __('Action') }}</option>
										@foreach ($extras->acciones as $accion)
											<option value="{{ $accion->id }}">{{ __($accion->accion) }}</option>
										@endforeach
									</select>
								</div>
								<div class="input-group input-daterange mb-2 mr-1">
									<input class="form-control" type="text" name="fecha_inicio" id="fecha_inicio" placeholder="{{ __('Date') }}" autocomplete="off">
									<div class="input-group-append">
									    <span class="input-group-text">{{ __('to') }}</span>
									</div>
									<input class="form-control" type="text" name="fecha_fin" id="fecha_fin" placeholder="{{ __('Date') }}" autocomplete="off">
								</div>
								<button class="btn btn-primary mb-2">{{ __('Filter') }}</button>
							</form>
						</div>
						<div id="divMensaje">
							<h3 id="mensaje" class="text-center">{{ __('No content to show') }}</h3>
						</div>
						<div id="divTabla" class="row" style="display: none;">
							<div class="table-responsive">
								<table id="tabla" class="table table-bordered table-hover" width="100%">
									<thead>
										<tr>
											<th>{{ __('Username') }}</th>
											<th>{{ __('Module') }}</th>
											<th>{{ __('item') }}</th>
											<th>{{ __('Action') }}</th>
											<th>{{ __('Description') }}</th>
											<th>{{ __('IP') }}</th>
											<th>{{ __('Date') }}</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('script')
	<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
	<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
	<script src="{{ asset('plugins/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ asset('plugins/datepicker/locale/bootstrap-datepicker.es.min.js') }}"></script>
	<script type="text/javascript">
		Pace.on('done', function () {
			lista();
		});
		var locale = "{{ app()->getLocale() }}";
		$('.input-daterange input').each(function() {
			$(this).datepicker({
				autoclose: true,
				format: 'dd-mm-yyyy',
				todayHighlight: true,
				todayBtn: true,
				clearBtn: true,
				disableTouchKeyboard: true,
				language: locale,
			});
		});
		$('#filtros').on('submit', function (e) {
			e.preventDefault();
			var data = $(this).serializeArray();
			lista(data);
		});
		$('#fecha_inicio').on('change', function () {
			console.log('fecha_inicio')
			$('#fecha_fin').datepicker('setStartDate', $(this).val());
			$('#fecha_fin').datepicker('update', $(this).val());
		});
		function lista (data = null)
		{
			var url = "{{ route('bitacora.list', [ 'locale' => app()->getLocale() ]) }}";
			$.ajax({
				type: 'GET',
				url: url,
				data: data,
				contentType: 'application/json',
				cache:false,
				beforeSend: function ()
				{
					Swal.fire({
						type: 'info',
						title: "{{ __('Requesting information') }}",
						showConfirmButton: false,
						allowEscapeKey: false,
						allowOutsideClick: false,
					})
				}
			})
			.done(function (response, statusText, jqXHR) {
				if (jqXHR.status == 204) {
					setTimeout(function () {
						Swal.close();
						if ($('#divMensaje').is(':hidden')) {
						    $('#divMensaje').show();
						}
					}, 700);
					$('#divTabla').hide();
					$('#mensaje').text("{{ __('No content to show') }}");
					$('#mensaje').removeClass('text-danger');
				}
				if (jqXHR.status == 200) {
					setTimeout(function () {
						Swal.close();
						$('#divMensaje').hide();
						$('#divTabla').show();
					}, 700);
					var columns = [
						{ data: 'usuario' },
						{ data: 'modulo' },
						{ data: 'item' },
						{ data: 'accion' },
						{ data: 'descripcion' },
						{ data: 'ip' },
						{ data: 'fecha' },
					];
					var data = [];
					response.data.forEach( function(element, index) {
						data.push(element);
					});
					crearTabla(locale, 'tabla', data, columns);
				}
			})
			.fail(function (e) {
				setTimeout(function () {
					Swal.close();
					if ($('#divMensaje').is(':hidden')) {
					    $('#divMensaje').show();
					}
				}, 700);
				$('#divTabla').hide();
				$('#mensaje').text("{{ __('Oops! Something went wrong') }}");
				$('#mensaje').addClass('text-danger');
			});
		}
	</script>
@endsection
