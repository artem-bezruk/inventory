@extends('layouts.base')
@section('tab-title', __('Configurations'))
@section('css')
@endsection
@section('breadcrumb-title', __('Categories'))
@section('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{{ route('config.index', ['locale' => app()->getLocale()]) }}">{{ __('Configurations') }}</a>
	</li>
	<li class="breadcrumb-item active">{{ __('Categories') }}</li>
@endsection
@section('content')
@endsection
@section('script')
@endsection