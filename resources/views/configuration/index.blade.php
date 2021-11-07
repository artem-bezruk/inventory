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
		<div class="col-lg-3 col-6">
			<div class="small-box bg-info">
				<div class="inner">
					<h3>{{ __('Classes') }}</h3>
	                <span class="info-box-number"></span>
				</div>
				<div class="icon">
					<i class="fas fa-cubes"></i>
				</div>
				<a href="{{ route('clase.index', ['locale' => app()->getLocale()]) }}" class="small-box-footer">
					<span>{{ __('Go') }}</span>
					<i class="fas fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>
		<div class="col-lg-3 col-6">
			<div class="small-box bg-info">
				<div class="inner">
					<h3>{{ __('Subclasses') }}</h3>
	                <span class="info-box-number"></span>
				</div>
				<div class="icon">
					<i class="fas fa-cubes"></i>
				</div>
				<a href="{{ route('subclase.index', ['locale' => app()->getLocale()]) }}" class="small-box-footer">
					<span>{{ __('Go') }}</span>
					<i class="fas fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>
	</div>
@endsection
@section('script')
@endsection
