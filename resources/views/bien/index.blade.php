@extends('layouts.base')
@section('tab-title', __('Properties'))
@section('css')
	<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection
@section('breadcrumb-title', __('Properties'))
@section('breadcrumb')
	<li class="breadcrumb-item active">{{ __('Properties') }}</li>
@endsection
@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="text-left">
						<h3 class="card-title">{{ __('Properties list') }}</h3>
					</div>
					@if (session()->get('modulos')->bienes->c)
						<div class="text-right">
							<button type="button" class="btn btn-primary" onclick="crearBien()"><i class="fas fa-laptop"></i><span class="d-none d-md-inline">&nbsp;&nbsp;{{ __('Add') }}</span></button>
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
		function listaBienes ()
		{
		}
		function crearBien ()
		{
			$.ajax({
				type: 'GET',
				url: "{{ route('bien.create', ['locale' => app()->getLocale()]) }}",
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
						$("#crearbien").modal("toggle")
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
