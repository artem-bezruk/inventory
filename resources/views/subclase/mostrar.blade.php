@extends('modals.media')
@section('modal-id', 'mostrarsubclase')
@section('modal-title')
	{{ __('Show') }} {{ __('Subclass') }}
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
		</tbody>
	</table>
@endsection
@section('modal-footer')
	<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
@endsection
