@extends('modals.media')
@section('modal-id', 'mostraruser')
@section('modal-title')
	{{ __('Show') }} {{ __('User') }}
@endsection
@section('modal-content')
	<table>
		<tbody id="muestraData">
			<tr>
				<th>{{ __('Username') }}:</th>
				<td>{{ $data->username }}</td>
			</tr>
			<tr>
				<th>{{ __('Name') }}:</th>
				<td>{{ ucwords($data->nombre) }}</td>
			</tr>
			<tr>
				<th>{{ __('Last name') }}:</th>
				<td>{{ ucwords($data->apellido) }}</td>
			</tr>
			<tr>
				<th>{{ __('Identity document') }}:</th>
				@if ($data->cedula)
					<td>{{ $data->cedula }}</td>
				@else
					<td class="text-muted">{{ __('Doesn\'t apply') }}</td>
				@endif
			</tr>
			<tr>
				<th>{{ __('Gender') }}:</th>
				<td>{{ $data->genero }}</td>
			</tr>
			<tr>
				<th>{{ __('Rol') }}:</th>
				<td>{{ $data->rol }}</td>
			</tr>
			<tr>
				<th>{{ __('Status') }}:</th>
				<td>{{ $data->estatus }}</td>
			</tr>
			<tr>
				<th>{{ __('Register Date') }}:</th>
				<td>{{ $data->fecha_registro }}</td>
			</tr>
			<tr>
				<th>{{ __('Update Date') }}:</th>
				@if ($data->fecha_modificacion)
					<td>{{ $data->fecha_modificacion }}</td>
				@else
					<td class="text-muted">{{ __('Doesn\'t apply') }}</td>
				@endif
			</tr>
		</tbody>
	</table>
@endsection
@section('modal-footer')
	<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
@endsection
