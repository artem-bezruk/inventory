@extends('modals.media')
@section('modal-id', 'mostrarclase')
@section('modal-title')
	{{ __('Show') }} {{ __('Class') }}
@endsection
@section('modal-content')
	<table>
		<tbody id="muestraData">
			<tr>
				<th>{{ __('Class') }}</th>
				<td>{{ $data->clase }}</td>
			</tr>
		</tbody>
	</table>
@endsection
@section('modal-footer')
	<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
@endsection
