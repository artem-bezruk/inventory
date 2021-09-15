@extends('layouts.default')
@section('css-main')
	<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
	<link href="{{ asset('fonts/SourceSansPro.css') }}" rel="stylesheet">
	@yield('css')
@endsection
@section('content-main')
	<div class="wrapper">
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			@include('layouts.navbar')
		</nav>
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			@include('layouts.sidebar')
		</aside>
		<div class="content-wrapper">
			<div class="content-header">
				@include('layouts.content-header')
			</div>
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						@yield('content')
					</div>
				</div>
			</section>
		</div>
		<footer class="main-footer">
			@include('layouts.footer')
		</footer>
	</div>
@endsection
@section('js-main')
	<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
	<script>
		$.widget.bridge('uibutton', $.ui.button)
	</script>
	<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
	<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
	<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
	<script src="{{ asset('js/adminlte.min.js') }}" type="text/javascript"></script>
	<script>
		$('body').addClass('sidebar-mini layout-fixed')
	</script>
	@yield('script')
@endsection
