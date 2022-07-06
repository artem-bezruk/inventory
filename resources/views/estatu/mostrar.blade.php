@extends('modals.media')
@section('modal-id', 'mostrarestatu')
@section('modal-title')
	{{ __('Show') }} {{ __('Status') }}
@endsection
@section('modal-content')
	<table>
		<tbody id="muestraData">
			<tr>
				<th>{{ __('Status') }}</th>
				<td>{{ $data->estatu }}</td>
			</tr>
		</tbody>
	</table>
@endsection
@section('modal-footer')
	<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
@endsection
