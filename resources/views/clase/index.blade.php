@extends('layouts.base')
@section('tab-title', __('Configurations'))
@section('css')
	<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection
@section('breadcrumb-title', __('Classes'))
@section('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{{ route('config.index', ['locale' => app()->getLocale()]) }}">{{ __('Configurations') }}</a>
	</li>
	<li class="breadcrumb-item active">{{ __('Classes') }}</li>
@endsection
@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="text-left">
						<h3 class="card-title">{{ __('Classes List') }}</h3>
					</div>
					@if (session()->get('modulos')->clases->c)
						<div class="text-right">
							<button type="button" class="btn btn-primary" onclick="crearClase()"><i class="fas fa-plus"></i><span class="d-none d-md-inline">&nbsp;&nbsp;{{ __('Add') }}</span></button>
						</div>
					@endif
				</div>
				<div class="card-body">
					<div class="container-fluid">
						<div id="divMensaje">
							<h3 id="mensaje" class="text-center">{{ __('No content to show') }}</h3>
						</div>
						<div id="divTabla" class="row" style="display: none">
							<div class="table-responsive">
								<table id="tabla" class="table table-bordered table-hover" width="100%">
									<thead>
										<tr>
											<th>{{ __('Class') }}</th>
											<th>{{ __('Options') }}</th>
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
	<div id="responseModal"></div>
@endsection
@section('script')
	<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
	<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
	<script type="text/javascript">
		$('[data-toggle="tooltip"]').tooltip();
		Pace.on('done', function () {
			listaClases();
		});
		var locale = "{{ app()->getLocale() }}";
		function listaClases ()
		{
			var url = "{{ route('clase.list', [ 'locale' => app()->getLocale() ]) }}";
			$.ajax({
				type: 'GET',
				url: url,
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
						{ data: 'clase' },
						{ data: 'opciones' },
					];
					var data = [];
					response.data.forEach( function(element, index) {
						divBotonOpen = '<div class="btn-group d-flex justify-content-center" role="group">';
						divBotonClose = '</div>';
						mostrar = '<button type="button" class="btn btn-info" data-toggle="tooltip" title="{{ __('Show') }}" onclick="mostrarClase(' + "'" + element.urlMostrar + "'" +')"><i class="far fa-eye"></i></button>';
						editar = '<button type="button" class="btn btn-secondary" data-toggle="tooltip" title="{{ __('Edit') }}" onclick="editarClase(' + "'" + element.urlEditar + "'" + ')"><i class="far fa-edit"></i></button>';
						eliminar = '<button type="button" class="btn btn-danger" data-toggle="tooltip" title="{{ __('Delete') }}" onclick="eliminarClase(' + "'" + element.urlEliminar + "'" + ')"><i class="fas fa-trash-alt"></i></button>';
						opciones = divBotonOpen + mostrar + editar + eliminar + divBotonClose;
						element.opciones = opciones;
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
		function crearClase ()
		{
			$.ajax({
				type: 'GET',
				url: "{{ route('clase.create', ['locale' => app()->getLocale()]) }}",
				contentType: 'text/html',
				cache: false,
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
					Swal.fire({
						type: 'info',
						title: "{{ __('No content to show') }}",
						showConfirmButton: false,
						allowEscapeKey: false,
						allowOutsideClick: false,
						timer: 1700
					})
				}
				if (jqXHR.status == 200) {
					setTimeout(function () {
						$("#responseModal").html(response)
						$("#crearclase").modal("toggle")
						Swal.close();
					},700);
				}
			})
			.fail(function (e) {
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
		function mostrarClase (url)
		{
			alert(url)
		}
		function editarClase (url)
		{
			alert(url)
		}
		function eliminarClase (url)
		{
			alert(url)
		}
	</script>
@endsection
