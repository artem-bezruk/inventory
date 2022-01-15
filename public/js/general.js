function tipoIcono (tipo)
{
	switch (tipo) {
		case 's':
			type = 'success';
			break;
		case 'e':
			type = 'error';
			break;
		case 'w':
			type = 'warning';
			break;
		case 'i':
			type = 'info';
			break;
		case 'q':
			type = 'question';
			break;
		default:
			type = 'success';
			break;
	}
	return type;
}
function alertar (data)
{
	const Toast = Swal.mixin({
		toast: true,
		position: 'top',
		showConfirmButton: false,
		timer: 4000,
	});
	Toast.fire({
		type: tipoIcono(data.tipo),
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
function keyPressValidarLetrasyOtrosCaracteres(event) {
	var key = event.keyCode || event.which;
	var tecla = String.fromCharCode(key).toLowerCase();
	var letras = "abcdefghijklmnopqrstuvwxyz0123456789\u00D1\u00F1\u00C1\u00E1\u00C9\u00E9\u00CD\u00ED\u00D3\u00F3\u00DA\u00FA";
	var especiales = [8, 32, 35, 36, 37, 38, 64, 45, 95,46,44];
	var tecla_especial = false
	for (var i in especiales) {
		if (key == especiales[i]) {
			tecla_especial = true;
			break;
		}
	}
	if (letras.indexOf(tecla) == -1 && !tecla_especial)
		return false;
}
function keypressvalidarOnlyLetras(event) {
	var key = event.keyCode || event.which;
	var tecla = String.fromCharCode(key).toLowerCase();
	var letras = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ\u00C1\u00E1\u00C9\u00E9\u00CD\u00ED\u00D3\u00F3\u00DA\u00FA\u00D1\u00F1";
	var especiales = [8, 32];
	var tecla_especial = false
	for (var i in especiales) {
		if (key == especiales[i]) {
			tecla_especial = true;
			return true;
		}
	}
	if (letras.indexOf(tecla) == -1 && !tecla_especial)
		return false;
}
function keypressNumbersInteger(event) {
	var key = event.keyCode || event.which;
	var tecla = String.fromCharCode(key).toLowerCase();
	var letras = "0123456789";
	var especiales = [8];
	var tecla_especial = false
	for (var i in especiales) {
		if (key == especiales[i]) {
			tecla_especial = true;
			break;
		}
	}
	if (letras.indexOf(tecla) == -1 && !tecla_especial)
		return false;
}
function keyPressValidarLetrasNumeros(event) {
  var key = event.keyCode || event.which;
  var tecla = String.fromCharCode(key).toLowerCase();
  var letras = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  var especiales = [8];
  var tecla_especial = false
  for (var i in especiales) {
    if (key == especiales[i]) {
      tecla_especial = true;
      break;
    }
  }
  if (letras.indexOf(tecla) == -1 && !tecla_especial)
    return false;
}
function validarEmail(valor) {
	if (valor.indexOf('&') >= 0) {
		return false;
	}
	if (valor.indexOf('/') >= 0) {
		return false;
	}
	if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/.test(valor)) {
		return true;
	} else {
		return false;
	}
}
function validarOnlyLetrasBoolean(data) {
	var patron = /^[a-zA-Z-Z\u00D1\u00F1\u00C1\u00E1\u00C9\u00E9\u00CD\u00ED\u00D3\u00F3\u00DA\u00FAs\s]*$/;
	if (!data.search(patron))
		return true;
	else
		return false;
}
function validateOnlyNumbers(data) {
	var patron = /^[0-9]*$/;
	if (!data.search(patron))
		return true;
	else
		return false;
}
function validarLetrasyOtrosCaracteres(data) {
	var patron = /^([a-zA-Z-Z\u00D1\u00F1\u00C1\u00E1\u00C9\u00E9\u00CD\u00ED\u00D3\u00F3\u00DA\u00FAs\s]|[0-9]|-|_|&|%|.|,)*$/;
	if (patron.test(data))
		return true;
	else
		return false;
}
function validarLetrasNumeros(data) {
  var patron = /^([a-zA-Z]|[0-9])*$/;
  if (patron.test(data))
    return true;
  else
    return false;
}
