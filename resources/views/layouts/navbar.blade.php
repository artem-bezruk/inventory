<ul class="navbar-nav">
	<li class="nav-item">
		<a class="nav-link btn" data-widget="pushmenu"><i class="fas fa-bars"></i></a>
	</li>
	<li class="nav-item d-none d-sm-inline-block">
		<a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="nav-link">{{ __('Home') }}</a>
	</li>
</ul>
<ul class="navbar-nav ml-auto">
	@php
		$lang = config('app.locale');
	@endphp
	<li class="nav-item dropdown">
		<a class="nav-link" data-toggle="dropdown">
			<img src="{{ asset('img/' . $lang . '.png') }}" alt="en" width="30" height="30">
		</a>
		<div class="dropdown-menu dropdown-menu-right p-0">
			<a class="dropdown-item" href="{{ route('dashboard', ['locale' => 'en']) }}">
				<img src="{{ asset('img/en.png') }}" alt="en" width="30" height="30">
				<span class="text-language">{{ __('English') }}</span>
			</a>
			<a class="dropdown-item" href="{{ route('dashboard', ['locale' => 'es']) }}">
				<img src="{{ asset('img/es.png') }}" alt="es" width="30" height="30">
				<span class="text-language">{{ __('Spanish') }}</span>
			</a>
		</div>
	</li>
	<li class="nav-item dropdown user-menu">
		<a class="nav-link dropdown-toggle btn" data-toggle="dropdown">
			<img src="{{ asset('img/user3-128x128.jpg') }}" class="user-image img-circle elevation-2" alt="User Image">
			<span class="d-none d-md-inline">{{ ucwords(auth()->user()->nombre) }} {{ ucwords(auth()->user()->apellido) }}</span>
		</a>
		<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
			<li class="user-header bg-primary">
				<img src="{{ asset('img/user3-128x128.jpg') }}" class="img-circle elevation-2" alt="User Image">
				<p>
					{{ ucwords(auth()->user()->nombre) }} {{ ucwords(auth()->user()->apellido) }} - {{ __(auth()->user()->rol()->first()->rol) }}
				</p>
			</li>
			<li class="user-footer">
				<a href="{{ route('user.perfil', ['locale' => app()->getLocale(), 'user' => auth()->user()->id]) }}" class="btn btn-default btn-flat">{{ __('Profile') }}</a>
				<a class="btn btn-default btn-flat float-right" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
					{{ __('Logout') }}
				</a>
                <form id="logout-form" action="{{ route('logout', ['locale' => app()->getLocale()]) }}" method="POST" style="display: none;">
                    @csrf
                </form>
			</li>
		</ul>
	</li>
</ul>
