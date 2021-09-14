<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	@include('layouts.headers')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
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
	@include('layouts.scripts')
</body>
</html>
