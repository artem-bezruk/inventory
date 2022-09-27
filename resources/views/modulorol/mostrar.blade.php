@extends('modals.media')
@section('modal-id', 'mostrar')
@section('modal-title')
	{{ __('Show') }} {{ __('Modules') }} {{ __('by') }} {{ __('Roles') }}
@endsection
@section('modal-content')
	<table>
		<tbody id="muestraData">
			<tr>
				<th>{{ __('Module') }}</th>
				<td>{{ $data->modulo }}</td>
			</tr>
			<tr>
				<th>{{ __('Rol') }}</th>
				<td>{{ $data->rol }}</td>
			</tr>
			<tr>
				<th>{{ __('Permissions') }}</th>
			</tr>
			<tr>
				<th>{{ __('Add') }}</th>
				<td>{{ $data->crear }}</td>
			</tr>
			<tr>
				<th>{{ __('Show') }}</th>
				<td>{{ $data->mostrar }}</td>
			</tr>
			<tr>
				<th>{{ __('Edit') }}</th>
				<td>{{ $data->editar }}</td>
			</tr>
			<tr>
				<th>{{ __('Delete') }}</th>
				<td>{{ $data->eliminar }}</td>
			</tr>
		</tbody>
	</table>
@endsection
@section('modal-footer')
	<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
@endsection
