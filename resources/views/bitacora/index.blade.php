@extends('layouts.base')
@section('tab-title', __('Binnacle'))
@section('css')
	<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
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
					<div id="divMensaje">
						<h3 id="mensaje" class="text-center">{{ __('No content to show') }}</h3>
					</div>
					<div id="divTabla" class="table-responsive">
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
@endsection
@section('script')
	<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
	<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
	<script type="text/javascript">
		Pace.on('done', function () {
			lista();
		});
		var locale = "{{ app()->getLocale() }}";
		function lista ()
		{
			var url = "{{ route('bitacora.list', [ 'locale' => app()->getLocale() ]) }}";
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
						// divBotonOpen = '<div class="btn-group d-flex justify-content-center" role="group">';
						// divBotonClose = '</div>';
						// mostrar = '<button type="button" class="btn btn-info" data-toggle="tooltip" title="{{ __('Show') }}" onclick="mostrarUsuario(' + "'" + element.urlMostrar + "'" +')"><i class="far fa-eye"></i></button>';
						// editar = '<button type="button" class="btn btn-secondary" data-toggle="tooltip" title="{{ __('Edit') }}" onclick="editarUsuario(' + "'" + element.urlEditar + "'" + ')"><i class="far fa-edit"></i></button>';
						// eliminar = '<button type="button" class="btn btn-danger" data-toggle="tooltip" title="{{ __('Delete') }}" onclick="eliminarUsuario(' + "'" + element.urlEliminar + "'" + ')"><i class="fas fa-trash-alt"></i></button>';
						// opciones = divBotonOpen + mostrar + editar + eliminar + divBotonClose;
						// element.opciones = opciones;
						data.push(element);
					});
					crearTabla(locale, 'tabla', data, columns);
				}
				console.log(response)
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
