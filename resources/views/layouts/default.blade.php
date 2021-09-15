<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="{{ asset('img/icon70x70.png') }}">
	<title>Inventaris - @yield('title')</title>
	@yield('css-main')
</head>
<body class="hold-transition">
	@yield('content-main')
	@yield('js-main')
</body>
</html>
