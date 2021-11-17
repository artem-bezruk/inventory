<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6">
			<h1 class="m-0 text-dark">@yield('breadcrumb-title')</h1>
		</div>
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				@if (Route::currentRouteName() == 'dashboard')
					<li class="breadcrum-item active">{{ __('Dashboard') }}</li>
				@else
					<li class="breadcrumb-item">
						<a href="{{ route('dashboard', ['locale' => app()->getLocale()]) }}">{{ __('Dashboard') }}</a>
					</li>
				@endif
				@yield('breadcrumb')
			</ol>
		</div>
	</div>
</div>
