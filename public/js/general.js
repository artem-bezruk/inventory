const Toast = Swal.mixin({
	toast: true,
	position: 'top',
	showConfirmButton: false,
	timer: 4000,
});
function alertar (data)
{
	switch (data.tipo) {
		case 's':
			type = 'success';
			break;
		case 'e':
			type = 'error';
			break;
	}
	Toast.fire({
		type: type,
		title: data.mensaje
	});
}
function crearTabla (locale, id, data, columns)
{
	var traduccion = new Object();
	traduccion.en = {};
	traduccion.es = {
	    "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        "buttons": {
            "copy": "Copiar",
            "colvis": "Visibilidad"
        },
	};
	$('#' + id).DataTable({
		paging: true,
		ordering: true,
		info: true,
		destroy: true,
		data: data,
		columns: columns,
		language: traduccion[locale]
	});
}
