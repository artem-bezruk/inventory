@extends('modals.media')
@section('modal-id', 'mostrarbien')
@section('modal-title')
	{{ __('Show') }} {{ __('Bien') }}
@endsection
@section('modal-content')
	<table>
		<tbody id="muestraData">
			<tr>
				<th>{{ __('Class') }}:</th>
				<td>{{ $data->clase }}</td>
			</tr>
			<tr>
				<th>{{ __('Subclass') }}:</th>
				<td>{{ $data->subclase }}</td>
			</tr>
			<tr>
				<th>{{ __('Category') }}:</th>
				<td>{{ $data->categoria }}</td>
			</tr>
			<tr>
				<th>{{ __('Subcategory') }}:</th>
				<td>{{ $data->subcategoria }}</td>
			</tr>
			<tr>
				<th>{{ __('Marca') }}:</th>
				<td>{{ $data->marca }}</td>
			</tr>
			<tr>
				<th>{{ __('Model') }}:</th>
				<td>{{ $data->modelo }}</td>
			</tr>
			@if ($data->capacidad)
				<tr>
					<th>{{ __('Capacity') }}:</th>
					<td>{{ $data->capacidad }}</td>
				</tr>
			@endif
			<tr>
				<th>{{ __('Quantity') }}:</th>
				<td>{{ $data->cantidad }}</td>
			</tr>
			<tr>
				<th>{{ __('Register Date') }}:</th>
				<td>{{ $data->fecha_registro }}</td>
			</tr>
			<tr>
				<th>{{ __('Update Date') }}:</th>
				@if ($data->fecha_modificacion)
					<td>{{ $data->fecha_modificacion }}</td>
				@else
					<td class="text-muted">{{ __('Doesn\'t apply') }}</td>
				@endif
			</tr>
		</tbody>
	</table>
@endsection
@section('modal-footer')
	<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
@endsection
