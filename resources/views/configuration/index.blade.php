@extends('layouts.base')
@section('tab-title', __('Configurations'))
@section('css')
@endsection
@section('breadcrumb-title', __('Configurations'))
@section('breadcrumb')
	<li class="breadcrumb-item active">{{ __('Configurations') }}</li>
@endsection
@section('content')
	<div class="row">
		@if (session()->get('modulos')->clases->r)
			<div class="col-12 col-sm-6 col-md-6 col-lg-3">
				<div class="small-box bg-info">
					<div class="inner">
						<h3>{{ __('Classes') }}</h3>
					</div>
					<div class="icon">
						<i class="far fa-circle"></i>
					</div>
					<a href="{{ route('clase.index', ['locale' => app()->getLocale()]) }}" class="small-box-footer">
						<span>{{ __('Go') }}</span>
						<i class="fas fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
		@endif
		@if (session()->get('modulos')->sub_clases->r)
			<div class="col-12 col-sm-6 col-md-6 col-lg-3">
				<div class="small-box bg-info">
					<div class="inner">
						<h3>{{ __('Subclasses') }}</h3>
					</div>
					<div class="icon">
						<i class="fas fa-circle"></i>
					</div>
					<a href="{{ route('subclase.index', ['locale' => app()->getLocale()]) }}" class="small-box-footer">
						<span>{{ __('Go') }}</span>
						<i class="fas fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
		@endif
		@if (session()->get('modulos')->categorias->r)
			<div class="col-12 col-sm-6 col-md-6 col-lg-3">
				<div class="small-box bg-info">
					<div class="inner">
						<h3>{{ __('Categories') }}</h3>
					</div>
					<div class="icon">
						<i class="far fa-circle"></i>
					</div>
					<a href="{{ route('categoria.index', ['locale' => app()->getLocale()]) }}" class="small-box-footer">
						<span>{{ __('Go') }}</span>
						<i class="fas fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
		@endif
		@if (session()->get('modulos')->sub_categorias->r)
			<div class="col-12 col-sm-6 col-md-6 col-lg-3">
				<div class="small-box bg-info">
					<div class="inner">
						<h3>{{ __('Subcategories') }}</h3>
					</div>
					<div class="icon">
						<i class="fas fa-circle"></i>
					</div>
					<a href="{{ route('subcategoria.index', ['locale' => app()->getLocale()]) }}" class="small-box-footer">
						<span>{{ __('Go') }}</span>
						<i class="fas fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
		@endif
		@if (session()->get('modulos')->marcas->r)
			<div class="col-12 col-sm-6 col-md-6 col-lg-3">
				<div class="small-box bg-info">
					<div class="inner">
						<h3>{{ __('Marks') }}</h3>
					</div>
					<div class="icon">
						<i class="far fa-circle"></i>
					</div>
					<a href="{{ route('marca.index', ['locale' => app()->getLocale()]) }}" class="small-box-footer">
						<span>{{ __('Go') }}</span>
						<i class="fas fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
		@endif
		@if (session()->get('modulos')->capacidades->r)
			<div class="col-12 col-sm-6 col-md-6 col-lg-3">
				<div class="small-box bg-info">
					<div class="inner">
						<h3>{{ __('Capacities') }}</h3>
					</div>
					<div class="icon">
						<i class="fas fa-circle"></i>
					</div>
					<a href="{{ route('capacidad.index', ['locale' => app()->getLocale()]) }}" class="small-box-footer">
						<span>{{ __('Go') }}</span>
						<i class="fas fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
		@endif
		@if (session()->get('modulos')->estatus->r)
			<div class="col-12 col-sm-6 col-md-6 col-lg-3">
				<div class="small-box bg-info">
					<div class="inner">
						<h3>{{ __('Status') }}</h3>
					</div>
					<div class="icon">
						<i class="far fa-circle"></i>
					</div>
					<a href="{{ route('estatu.index', ['locale' => app()->getLocale()]) }}" class="small-box-footer">
						<span>{{ __('Go') }}</span>
						<i class="fas fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
		@endif
		@if (session()->get('modulos')->generos->r)
			<div class="col-12 col-sm-6 col-md-6 col-lg-3">
				<div class="small-box bg-info">
					<div class="inner">
						<h3>{{ __('Genders') }}</h3>
					</div>
					<div class="icon">
						<i class="fas fa-venus-mars"></i>
					</div>
					<a href="{{ route('genero.index', ['locale' => app()->getLocale()]) }}" class="small-box-footer">
						<span>{{ __('Go') }}</span>
						<i class="fas fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
		@endif
		@if (session()->get('modulos')->modulos->r)
			<div class="col-12 col-sm-6 col-md-6 col-lg-3">
				<div class="small-box bg-info">
					<div class="inner">
						<h3>{{ __('Modules') }}</h3>
					</div>
					<div class="icon">
						<i class="far fa-circle"></i>
					</div>
					<a href="{{ route('modulo.index', ['locale' => app()->getLocale()]) }}" class="small-box-footer">
						<span>{{ __('Go') }}</span>
						<i class="fas fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
		@endif
		@if (session()->get('modulos')->nomenclaturas->r)
			<div class="col-12 col-sm-6 col-md-6 col-lg-3">
				<div class="small-box bg-info">
					<div class="inner">
						<h3>{{ __('Nomenclatures') }}</h3>
					</div>
					<div class="icon">
						<i class="fas fa-circle"></i>
					</div>
					<a href="{{ route('nomenclatura.index', ['locale' => app()->getLocale()]) }}" class="small-box-footer">
						<span>{{ __('Go') }}</span>
						<i class="fas fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
		@endif
		@if (session()->get('modulos')->roles->r)
			<div class="col-12 col-sm-6 col-md-6 col-lg-3">
				<div class="small-box bg-info">
					<div class="inner">
						<h3>{{ __('Roles') }}</h3>
					</div>
					<div class="icon">
						<i class="far fa-circle"></i>
					</div>
					<a href="{{ route('rol.index', ['locale' => app()->getLocale()]) }}" class="small-box-footer">
						<span>{{ __('Go') }}</span>
						<i class="fas fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
		@endif
		@if (session()->get('modulos')->modulos_has_roles->r)
			<div class="col-12 col-sm-6 col-md-6 col-lg-3">
				<div class="small-box bg-info">
					<div class="inner">
						<h3>{{ __('Modules') }} {{ __('by') }}</h3>
						<h3>{{ __('Roles') }}</h3>
					</div>
					<div class="icon">
						<i class="fas fa-circle"></i>
					</div>
					<a href="{{ route('modulorol.index', ['locale' => app()->getLocale()]) }}" class="small-box-footer">
						<span>{{ __('Go') }}</span>
						<i class="fas fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
		@endif
		@if (session()->get('modulos')->marcas_has_categorias->r)
			<div class="col-12 col-sm-6 col-md-6 col-lg-3">
				<div class="small-box bg-info">
					<div class="inner">
						<h3>{{ __('Marks') }} {{ __('by') }}</h3>
						<h3>{{ __('Subcategories') }}</h3>
					</div>
					<div class="icon">
						<i class="far fa-circle"></i>
					</div>
					<a href="{{ route('marcasubcategoria.index', ['locale' => app()->getLocale()]) }}" class="small-box-footer">
						<span>{{ __('Go') }}</span>
						<i class="fas fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
		@endif
	</div>
@endsection
@section('script')
@endsection
