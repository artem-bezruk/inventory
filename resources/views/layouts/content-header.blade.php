<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6">
			<h1 class="m-0 text-dark">{{ __('Dashboard') }}</h1>
		</div>
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item">
					<a href="{{ route('dashboard', ['locale' => app()->getLocale()]) }}">{{ __('Dashboard') }}</a>
				</li>
				@yield('breadcrumb')
			</ol>
		</div>
	</div>
</div>
