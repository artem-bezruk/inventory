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
					<h3 class="profile-username text-center">{{ ucfirst(auth()->user()->nombre) }} {{ ucfirst(auth()->user()->apellido) }}</h3>
					<p class="text-muted text-center">Software Engineer</p>
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
							<label for="inputName" class="col-sm-2 col-form-label">Name</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" id="inputName" placeholder="Name">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" id="inputEmail" placeholder="Email">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputName2" class="col-sm-2 col-form-label">Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="inputName2" placeholder="Name">
							</div>
						</div>
						<div class="form-group row">
							<div class="offset-sm-2 col-sm-10">
								<button type="submit" class="btn btn-danger">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('script')
@endsection
