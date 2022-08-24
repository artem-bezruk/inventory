@extends('modals.media')
@section('modal-id', 'mostrar')
@section('modal-title')
	{{ __('Show') }} {{ __('Nomenclature') }}
@endsection
@section('modal-content')
	<table>
		<tbody id="muestraData">
			<tr>
				<th>{{ __('Nomenclature') }}</th>
				<td>{{ $data->nomenclatura }}</td>
			</tr>
			<tr>
				<th>{{ __('Abbreviation') }}</th>
				<td>{{ $data->abreviatura }}</td>
			</tr>
		</tbody>
	</table>
@endsection
@section('modal-footer')
	<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
@endsection
