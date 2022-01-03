@extends('layouts.default')
@section('tab-title', __('404 Page not found'))
@section('main-css')
	<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
	<link href="{{ asset('fonts/SourceSansPro.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('plugins/pace-progress/themes/blue/pace-theme-center-radar.css') }}">
	<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection
@section('main-content')
	<div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
            	<i class="fas fa-exclamation-triangle text-danger"></i>
            	<span>400</span>
            </div>
            <div>
            	<p class="text-monospace">{{ __('We could not find the page you were looking for') }}.</p>
            </div>
        	<div>
        		<a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="btn btn-danger" role="button">{{ __('Go home') }}</a>
	        </div>
        </div>
    </div>
@endsection
@section('main-js')
	<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('js/adminlte.min.js') }}" type="text/javascript"></script>
	<script>
		$('body').addClass('lockscreen')
	</script>
	<script src="{{ asset('plugins/pace-progress/pace.min.js') }}" type="text/javascript"></script>
@endsection
