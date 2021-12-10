<a href="{{ route('dashboard', ['locale' => app()->getLocale()]) }}" class="brand-link">
	<img src="{{ asset('img/icon200x200.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8; background-color: white;">
	<span class="brand-text font-weight-light">{{ config('app.name') }}</span>
</a>
<div class="sidebar">
	<nav class="mt-2">
		<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			<li class="nav-item">
				<a href="{{ route('dashboard', ['locale' => app()->getLocale()]) }}" class="nav-link {{ Request::is('*/dashboard') ? 'active' : '' }}">
					<i class="nav-icon fas fa-tachometer-alt"></i>
					<p>{{ __('Dashboard') }}</p>
				</a>
			</li>
			@if (session()->get('modulos')->bienes->r)
				<li class="nav-item">
					<a href="{{ route('bien.index', ['locale' => app()->getLocale()]) }}" class="nav-link {{ Request::is('*/properties') ? 'active' : '' }}">
						<i class="nav-icon fa fa-desktop"></i>
						<p>{{ __('Properties') }}</p>
					</a>
				</li>
			@endif
			@if (session()->get('modulos')->users->r)
				<li class="nav-item">
					<a href="{{ route('user.index', ['locale' => app()->getLocale()]) }}" class="nav-link {{ Request::is('*/users') ? 'active' : '' }}">
						<i class="nav-icon fas fa-users"></i>
						<p>{{ __('Users') }}</p>
					</a>
				</li>
			@endif
			@if (session()->get('modulos')->bitacora->r)
				<li class="nav-item">
					<a href="{{ route('bitacora', ['locale' => app()->getLocale()]) }}" class="nav-link {{ Request::is('*/binnacle') ? 'active' : '' }}">
						<i class="nav-icon fas fa-clipboard-list"></i>
						<p>{{ __('Binnacle') }}</p>
					</a>
				</li>
			@endif
			@if (session()->get('modulos')->configuraciones->r)
				<li class="nav-item">
					<a href="{{ route('config.index', ['locale' => app()->getLocale()]) }}" class="nav-link {{ Request::is('*/configurations') ? 'active' : '' }}">
						<i class="nav-icon fas fa-cogs"></i>
						<p>{{ __('Configurations') }}</p>
					</a>
				</li>
			@endif
		</ul>
	</nav>
</div>
