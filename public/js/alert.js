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
