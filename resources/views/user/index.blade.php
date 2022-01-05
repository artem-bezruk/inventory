@extends('layouts.base')
@section('tab-title', __('Users'))
@section('css')
	<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/datatables-select/css/select.bootstrap4.min.css') }}">
@endsection
@section('breadcrumb-title', __('Users'))
@section('breadcrumb')
	<li class="breadcrumb-item active">{{ __('Users') }}</li>
@endsection
@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="text-left">
						<h3 class="card-title">{{ __('Users list') }}</h3>
					</div>
					<div class="text-right">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearuser"><i class="fas fa-user-plus"></i><span class="d-none d-md-inline">&nbsp;&nbsp;{{ __('Add') }}</span></button>
					</div>
				</div>
				<div class="card-body">
					<div id="divMensaje">
						<h3 id="mensaje" class="text-center">{{ __('No content to show') }}</h3>
					</div>
					<div id="divTabla" class="table-responsive">
						<table id="tabla" class="table table-bordered table-hover" width="100%">
							<thead>
								<tr>
									<th>{{ __('Name') }} {{ __('and') }} {{ __('Last name') }}</th>
									<th>{{ __('Gender') }}</th>
									<th>{{ __('Rol') }}</th>
									<th>{{ __('Status') }}</th>
									<th>{{ __('Register Date') }}</th>
									<th>{{ __('Options') }}</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('user.crear')
	<div id="responseModal"></div>
@endsection
@section('script')
	<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
	<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
	<script src="{{ asset('plugins/datatables-select/js/dataTables.select.min.js') }}"></script>
	<script type="text/javascript">
		$('#divTabla').hide();
		$('[data-toggle="tooltip"]').tooltip();
		Pace.on('done', function () {
			listaUsuarios();
		});
		var locale = "{{ app()->getLocale() }}";
		function listaUsuarios ()
		{
			var url = "{{ route('user.list', [ 'locale' => app()->getLocale() ]) }}";
			$.ajax({
				type: 'GET',
				url: url,
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
						{ data: 'nombre' },
						{ data: 'genero' },
						{ data: 'rol' },
						{ data: 'estatus' },
						{ data: 'fecha_registro' },
						{ data: 'opciones' },
					];
					var data = [];
					response.data.forEach( function(element, index) {
						divBotonOpen = '<div class="btn-group d-flex justify-content-center" role="group">';
						divBotonClose = '</div>';
						mostrar = '<button type="button" class="btn btn-info" data-toggle="tooltip" title="{{ __('Show') }}" onclick="mostrarUsuario(' + "'" + element.urlMostrar + "'" +')"><i class="far fa-eye"></i></button>';
						editar = '<button type="button" class="btn btn-secondary" data-toggle="tooltip" title="{{ __('Edit') }}"><i class="far fa-edit"></i></button>';
						eliminar = '<button type="button" class="btn btn-danger" data-toggle="tooltip" title="{{ __('Delete') }}"><i class="fas fa-trash-alt"></i></button>';
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
		function mostrarUsuario (url)
		{
			$.ajax({
				type: 'GET',
				url: url,
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
						$("#mostraruser").modal("toggle")
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
	</script>
@endsection
