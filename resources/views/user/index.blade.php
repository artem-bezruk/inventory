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
						<button type="button" class="btn btn-primary" onclick="crearUsuario()"><i class="fas fa-user-plus"></i><span class="d-none d-md-inline">&nbsp;&nbsp;{{ __('Add') }}</span></button>
					</div>
				</div>
				<div class="card-body">
					<div id="divMensaje">
						<h3 id="mensaje" class="text-center">{{ __('No content to show') }}</h3>
					</div>
					<div id="divTabla" class="table-responsive" style="display: none">
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
	<div id="responseModal"></div>
@endsection
@section('script')
	<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
	<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
	<script src="{{ asset('plugins/datatables-select/js/dataTables.select.min.js') }}"></script>
	<script type="text/javascript">
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
						editar = '<button type="button" class="btn btn-secondary" data-toggle="tooltip" title="{{ __('Edit') }}" onclick="editarUsuario(' + "'" + element.urlEditar + "'" + ')"><i class="far fa-edit"></i></button>';
						eliminar = '<button type="button" class="btn btn-danger" data-toggle="tooltip" title="{{ __('Delete') }}" onclick="eliminarUsuario(' + "'" + element.urlEliminar + "'" + ')"><i class="fas fa-trash-alt"></i></button>';
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
		function crearUsuario ()
		{
			$.ajax({
				type: 'GET',
				url: "{{ route('user.create', ['locale' => app()->getLocale()]) }}",
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
						$("#crearuser").modal("toggle")
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
		function editarUsuario (url)
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
						$("#editaruser").modal("toggle")
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
		function eliminarUsuario (url)
		{
			Swal.fire({
				title: "{{ __('Are you sure?') }}",
				html: "{{ __('You won\'t be able to revert this!') }}",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: "{{ __('Yes, delete it!') }}",
				cancelButtonText: "{{ __('Cancel') }}"
			})
			.then((result) => {
				if (result.value) {
					$.ajax({
						type: 'DELETE',
						url: url,
						headers: {
					        'X-CSRF-TOKEN': "{{ csrf_token() }}"
					    },
						cache: false,
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
						Swal.fire({
							type: 'info',
							title: response.mensaje,
							showConfirmButton: false,
							allowEscapeKey: false,
							allowOutsideClick: false,
							timer: 1700
						})
						setTimeout(function () {
							listaUsuarios();
						}, 1700)
						console.log(response, statusText, jqXHR)
					})
					.fail(function (e) {
						if (e.responseJSON.mensaje) {
							mensaje = e.responseJSON.mensaje;
						}
						else {
							mensaje = "{{ __('Oops! Something went wrong') }}";
						}
						Swal.fire({
							type: 'error',
							title: mensaje,
							showConfirmButton: false,
							allowEscapeKey: false,
							allowOutsideClick: false,
							timer: 1700
						})
					})
				}
			})
		}
	</script>
@endsection
