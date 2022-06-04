@extends('modals.media')
@section('modal-id', 'mostrarmarca')
@section('modal-title')
	{{ __('Show') }} {{ __('Mark') }}
@endsection
@section('modal-content')
	<table>
		<tbody id="muestraData">
			<tr>
				<th>{{ __('Mark') }}</th>
				<td>{{ $data->marca }}</td>
			</tr>
		</tbody>
	</table>
@endsection
@section('modal-footer')
	<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
@endsection
