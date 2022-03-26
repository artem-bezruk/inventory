@extends('layouts.base')
@section('tab-title', __('Dashboard'))
@section('css')
@endsection
@section('breadcrumb-title', __('Dashboard'))
@section('breadcrumb')
@endsection
@section('content')
	@if (!empty($data))
		<div class="row">
			@if (auth()->user()->rol()->rol == "Administrator")
				<div class="col-sm-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">{{ __('Users') }}</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-12 col-md-6">
									<div class="info-box">
										<span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
										<div class="info-box-content">
											<span class="info-box-text">{{ __('Total') }}</span>
											<span class="info-box-number">{{ $data->usuarios["total"] }}</span>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="info-box">
										<span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-check"></i></span>
										<div class="info-box-content">
											<span class="info-box-text">{{ __('Actives') }}</span>
											<span class="info-box-number">{{ $data->usuarios["activos"] }}</span>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="info-box">
										<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user-alt-slash"></i></span>
										<div class="info-box-content">
											<span class="info-box-text">{{ __('Inactives') }}</span>
											<span class="info-box-number">{{ $data->usuarios["inactivos"] }}</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			@endif
			<div class="col-sm-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">{{ __('Properties') }}</h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-12 col-md-6">
								<div class="info-box">
									<span class="info-box-icon bg-primary elevation-1"><i class="fa fa-desktop"></i></span>
									<div class="info-box-content">
										<span class="info-box-text">{{ __('Total') }}</span>
										<span class="info-box-number">{{ $data->bienes["total"] }}</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">{{ __('Last Activities') }}</h5>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-hover" width="100%">
							<thead>
								<tr>
									<th>{{ __('Action') }}</th>
									<th>{{ __('Ip') }}</th>
									<th>{{ __('Date') }}</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($data->actividades as $actividad)
									<tr>
										<td>{{ __($actividad->descripcion) }}</td>
										<td>{{ __($actividad->ip) }}</td>
										<td>{{ $actividad->fecha }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	@endif
@endsection
@section('script')
@endsection
