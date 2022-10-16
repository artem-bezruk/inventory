@extends('modals.media')
@section('modal-id', 'mostrar')
@section('modal-title')
	{{ __('Show') }} {{ __('Mark') }} {{ __('by') }} {{ __('Category') }}
@endsection
@section('modal-content')
	<table>
		<tbody id="muestraData">
			<tr>
				<th>{{ __('Mark') }}</th>
				<td>{{ $data->marca }}</td>
			</tr>
			<tr>
				<th>{{ __('Category') }}</th>
				<td>{{ $data->categoria }}</td>
			</tr>
		</tbody>
	</table>
@endsection
@section('modal-footer')
	<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
@endsection
