@extends('modals.media')
@section('modal-id', 'mostrarcategoria')
@section('modal-title')
	{{ __('Show') }} {{ __('Category') }}
@endsection
@section('modal-content')
	<table>
		<tbody id="muestraData">
			<tr>
				<th>{{ __('Class') }}</th>
				<td>{{ $data->clase }}</td>
			</tr>
			<tr>
				<th>{{ __('Subclass') }}</th>
				<td>{{ $data->subclase }}</td>
			</tr>
			<tr>
				<th>{{ __('Category') }}</th>
				<td>{{ $data->categoria }}</td>
			</tr>
			<tr>
				<th>{{ __('See') }} {{ __('Capacity') }}</th>
				@if ($data->ver_capacidad)
					<td>{{ __('Yes') }}</td>
				@else
					<td>{{ __('No') }}</td>
				@endif
			</tr>
		</tbody>
	</table>
@endsection
@section('modal-footer')
	<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
@endsection
