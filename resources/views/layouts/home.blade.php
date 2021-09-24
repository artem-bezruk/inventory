@extends('layouts.default')
@section('title', __('Home'))
@section('css-main')
	<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
	<link href="{{ asset('fonts/SourceSansPro.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('plugins/pace-progress/themes/blue/pace-theme-center-radar.css') }}">
	<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection
@section('content-main')
	@php
		$lang = config('app.locale');
		$route = Route::currentRouteName();
	@endphp
	<div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ route('dashboard', ['locale' => app()->getLocale()]) }}">Dashboard</a>
                @else
                    <a href="{{ route('login', ['locale' => app()->getLocale()]) }}">{{ __('Login') }}</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register', ['locale' => app()->getLocale()]) }}">{{ __('Register') }}</a>
                    @endif
                @endauth
            </div>
        @endif
        <div class="top-left">
			<ul class="nav nav-tabs">
				<li class="nav-item dropdown">
					<a class="nav-link" data-toggle="dropdown">
						<img src="{{ asset('img/' . $lang . '.png') }}" alt="en" width="30" height="30">
					</a>
					<div class="dropdown-menu dropdown-menu-right p-0">
						<a class="dropdown-item" href="{{ route($route, ['locale' => 'en']) }}">
							<img src="{{ asset('img/en.png') }}" alt="en" width="30" height="30">
							Ingles
						</a>
						<a class="dropdown-item" href="{{ route($route, ['locale' => 'es']) }}">
							<img src="{{ asset('img/es.png') }}" alt="es" width="30" height="30">
							Español
						</a>
					</div>
				</li>
			</ul>
		</div>
        <div class="content">
            <div class="title m-b-md">
            	<img src="{{ asset('img/icon200x200.png') }}" alt="">
            	<span>Inventaris</span>
            </div>
        </div>
    </div>
@endsection
@section('js-main')
	<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('js/adminlte.min.js') }}" type="text/javascript"></script>
	<script>
		$('body').addClass('lockscreen')
	</script>
	<script src="{{ asset('plugins/pace-progress/pace.min.js') }}" type="text/javascript"></script>
@endsection
