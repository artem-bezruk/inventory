@extends('modals.media')
@section('modal-id', 'mostrarcapacidad')
@section('modal-title')
	{{ __('Show') }} {{ __('Capacity') }}
@endsection
@section('modal-content')
	<table>
		<tbody id="muestraData">
			<tr>
				<th>{{ __('Capacity') }}</th>
				<td>{{ $data->capacidad }} {{ $data->nomenclatura }}</td>
			</tr>
		</tbody>
	</table>
@endsection
@section('modal-footer')
	<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
@endsection
