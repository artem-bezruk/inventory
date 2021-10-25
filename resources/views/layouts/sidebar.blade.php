<a href="{{ route('dashboard', ['locale' => app()->getLocale()]) }}" class="brand-link">
	<img src="{{ asset('img/icon200x200.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8; background-color: white;">
	<span class="brand-text font-weight-light">{{ config('app.name') }}</span>
</a>
<div class="sidebar">
	<nav class="mt-2">
		<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			<li class="nav-item">
				<a href="{{ route('dashboard', ['locale' => app()->getLocale()]) }}" class="nav-link">
					<i class="nav-icon fas fa-tachometer-alt"></i>
					<p>{{ __('Dashboard') }}</p>
				</a>
			</li>
		</ul>
	</nav>
</div>
