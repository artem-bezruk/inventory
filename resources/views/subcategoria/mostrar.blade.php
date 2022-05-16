@extends('modals.media')
@section('modal-id', 'mostrarsubcategoria')
@section('modal-title')
	{{ __('Show') }} {{ __('Subcategory') }}
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
				<th>{{ __('Subcategory') }}</th>
				<td>{{ $data->subcategoria }}</td>
			</tr>
		</tbody>
	</table>
@endsection
@section('modal-footer')
	<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
@endsection
