@extends('layouts.base')
@section('tab-title', __('Profile'))
@section('css')
@endsection
@section('breadcrumb-title', __('Profile'))
@section('breadcrumb')
	<li class="breadcrumb-item active">{{ __('Profile') }}</li>
@endsection
@section('content')
	<div class="row">
		<div class="col-md-3">
			<div class="card card-primary card-outline">
				<div class="card-body box-profile">
					<div class="text-center">
						<img class="profile-user-img img-fluid img-circle" src="{{ asset('img/user3-128x128.jpg') }}" alt="User profile picture">
					</div>
					<h3 class="profile-username text-center">{{ ucwords(auth()->user()->nombre) }} {{ ucwords(auth()->user()->apellido) }}</h3>
					<p class="text-muted text-center">{{ __(auth()->user()->rol()->rol) }}</p>
				</div>
			</div>
		</div>
		<div class="col-md-9">
			<div class="card">
				<div class="card-header p-2">
					<h4>{{ __('Information') }}</h4>
				</div>
				<div class="card-body">
					<form class="form-horizontal">
						<div class="form-group row">
							<label for="nombre" class="col-6 col-sm-2 col-form-label dd">{{ __('Name') }}</label>
							<div class="col-6 col-sm-10">
								<input type="text" class="form-control-plaintext" name="nombre" id="nombre" value="{{ ucwords($data->nombre) }}" placeholder="{{ __('Name') }}" disabled>
							</div>
						</div>
						<div class="form-group row">
							<label for="apellido" class="col-6 col-sm-2 col-form-label dd">{{ __('Last name') }}</label>
							<div class="col-6 col-sm-10">
								<input type="text" class="form-control-plaintext" name="apellido" id="apellido" value="{{ ucwords($data->apellido) }}" placeholder="{{ __('Last name') }}" disabled>
							</div>
						</div>
						<div class="form-group row">
							<label for="genero" class="col-6 col-sm-2 col-form-label dd">{{ __('Gender') }}</label>
							<div class="col-6 col-sm-10">
								<input type="text" class="form-control-plaintext" name="genero" id="genero" value="{{ ucwords($data->genero) }}" placeholder="{{ __('Gender') }}" disabled>
							</div>
						</div>
						<div class="form-group row">
							<label for="estatu" class="col-6 col-sm-2 col-form-label dd">{{ __('Status') }}</label>
							<div class="col-6 col-sm-10">
								<input type="text" class="form-control-plaintext" name="estatu" id="estatu" value="{{ ucwords($data->estatus) }}" placeholder="{{ __('Status') }}" disabled>
							</div>
						</div>
						<div class="form-group row">
							<label for="correo" class="col-6 col-sm-2 col-form-label dd">{{ __('E-Mail Address') }}</label>
							<div class="col-6 col-sm-10">
								<input type="email" class="form-control-plaintext" name="correo" id="correo" value="{{ ucwords($data->correo) }}" placeholder="{{ __('E-Mail Address') }}" disabled>
							</div>
						</div>
						<div class="form-group row">
							<label for="username" class="col-6 col-sm-2 col-form-label dd">{{ __('Username') }}</label>
							<div class="col-6 col-sm-10">
								<input type="text" class="form-control-plaintext" name="username" id="username" value="{{ $data->username }}" placeholder="{{ __('Username') }}" disabled>
							</div>
						</div>
						<table class="d-flex justify-content-end mt-4">
							<tbody style="font-size: 14px;">
								<tr>
									<th class="dd">{{ __('User') }} {{ __('since') }}</th>
									<td>{{ $data->fecha_registro }}</td>
								</tr>
								@if ($data->fecha_modificacion)
									<tr>
										<th class="dd">{{ __('Last update') }}</th>
										<td>{{ $data->fecha_modificacion }}</td>
									</tr>
								@endif
							</tbody>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('script')
@endsection
