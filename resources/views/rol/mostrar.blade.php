@extends('modals.media')
@section('modal-id', 'mostrar')
@section('modal-title')
	{{ __('Show') }} {{ __('Rol') }}
@endsection
@section('modal-content')
	<table>
		<tbody id="muestraData">
			<tr>
				<th>{{ __('Rol') }}</th>
				<td>{{ $data->rol }}</td>
			</tr>
			<tr>
				<th>{{ __('Priority') }}</th>
				<td>{{ $data->prioridad }}</td>
			</tr>
			<tr>
				<th>{{ __('Description') }}</th>
				<td>{{ $data->descripcion }}</td>
			</tr>
		</tbody>
	</table>
@endsection
@section('modal-footer')
	<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
@endsection
