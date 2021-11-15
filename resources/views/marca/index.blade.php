@extends('layouts.base')
@section('tab-title', __('Configurations'))
@section('css')
@endsection
@section('breadcrumb-title', __('Marks'))
@section('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{{ route('config.index', ['locale' => app()->getLocale()]) }}">{{ __('Configurations') }}</a>
	</li>
	<li class="breadcrumb-item active">{{ __('Marks') }}</li>
@endsection
@section('content')
@endsection
@section('script')
@endsection
