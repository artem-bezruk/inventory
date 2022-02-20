@extends('layouts.default')
@section('tab-title', __('Login'))
@section('main-css')
	<link rel="stylesheet" href="{{ asset('plugins/pace-progress/themes/blue/pace-theme-center-radar.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
	<link href="{{ asset('fonts/SourceSansPro.css') }}" rel="stylesheet">
@endsection
@section('main-content')
	<div class="login-box">
		<div class="card">
			<div class="card-header" style="border-bottom-width: 0px;padding-bottom: 5px;">
				<div class="login-logo">
					<a href="{{ route('home', ['locale' => app()->getLocale()]) }}">
					<img src="{{ asset('img/logo189x58.png') }}" alt="logo">
					</a>
				</div>
			</div>
			<div class="card-body login-card-body" style="padding-top: 5px;">
				<p class="login-box-msg">{{ __('Sign in to start your session') }}</p>
				<form method="POST" action="{{ route('login', ['locale' => app()->getLocale()]) }}">
					@csrf
					<div class="input-group mb-3">
						<input id="username" type="text" class="form-control @error('username') is-invalid @enderror" placeholder="{{ __('Username') }}" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
						@error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ __('auth.failed') }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="input-group mb-3">
						<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" required autocomplete="current-password">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
						@error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="row">
						<div class="col-8">
							<div class="icheck-primary">
								<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
								<label for="remember">{{ __('Remember Me') }}</label>
							</div>
						</div>
						<div class="col-4">
							<button class="btn btn-primary btn-block" type="submit">{{ __('Login') }}</button>
						</div>
					</div>
				</form>
			</div>
			<div class="card-footer text-center">
				<a href="{{ route('login', ['locale' => 'en']) }}">
					<img src="{{ asset('img/en.png') }}" alt="en" width="30" height="30">
				</a>
				<a href="{{ route('login', ['locale' => 'es']) }}">
					<img src="{{ asset('img/es.png') }}" alt="es" width="30" height="30">
				</a>
			</div>
		</div>
	</div>
@endsection
@section('main-js')
	<script src="{{ asset('plugins/pace-progress/pace.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('js/adminlte.min.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
		$('body').addClass('hold-transition login-page');
	</script>
@endsection
