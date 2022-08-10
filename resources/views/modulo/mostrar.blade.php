@extends('modals.media')
@section('modal-id', 'mostrar')
@section('modal-title')
	{{ __('Show') }} {{ __('Module') }}
@endsection
@section('modal-content')
	<table>
		<tbody id="muestraData">
			<tr>
				<th>{{ __('Module') }}</th>
				<td>{{ $data->modulo }}</td>
			</tr>
		<tbody id="muestraData">
			<tr>
				<th>{{ __('It is filterable?') }}</th>
				<td>{{ $data->filtrable }}</td>
			</tr>
		</tbody>
	</table>
@endsection
@section('modal-footer')
	<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
@endsection
