@extends('modals.media')
@section('modal-id', 'mostrar')
@section('modal-title')
	{{ __('Show') }} {{ __('Gender') }}
@endsection
@section('modal-content')
	<table>
		<tbody id="muestraData">
			<tr>
				<th>{{ __('Gender') }}</th>
				<td>{{ $data->genero }}</td>
			</tr>
		</tbody>
	</table>
@endsection
@section('modal-footer')
	<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
@endsection
