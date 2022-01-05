@extends('layouts.default')
@section('main-css')
	<link rel="stylesheet" href="{{ asset('plugins/pace-progress/themes/blue/pace-theme-center-radar.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
	<link href="{{ asset('fonts/SourceSansPro.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/general.css') }}">
	@yield('css')
@endsection
@section('main-content')
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
					@yield('content')
				</div>
			</section>
		</div>
		<footer class="main-footer">
			@include('layouts.footer')
		</footer>
	</div>
@endsection
@section('main-js')
	<script src="{{ asset('plugins/pace-progress/pace.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
	<script>
		$.widget.bridge('uibutton', $.ui.button)
	</script>
	<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
	<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
	<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
	<script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
	<script src="{{ asset('js/adminlte.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/general.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
		$('body').addClass('sidebar-mini layout-fixed');
		var data = @json(session()->get('alerta'));
		if (data != null) {
			alertar(data);
		}
	</script>
	@yield('script')
@endsection
