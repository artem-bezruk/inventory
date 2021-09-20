@extends('layouts.default')
@section('title',  __('500 Error'))
@section('css-main')
	<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
	<link href="{{ asset('fonts/SourceSansPro.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('plugins/pace-progress/themes/blue/pace-theme-center-radar.css') }}">
	<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection
@section('content-main')
	<div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
            	<i class="fas fa-exclamation-triangle text-danger"></i>
            	<span>500</span>
            </div>
            <div>
            	<p class="text-monospace">{{ __('Oops! Something went wrong.') }}</p>
            </div>
        	<div>
        		<a href="/" class="btn btn-danger" role="button">{{ __('Go home') }}</a>
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
