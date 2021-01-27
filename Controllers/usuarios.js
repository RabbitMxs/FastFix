function usuarios(action, id) {
	switch (action) {
		case 'formEdit':
			$.confirm({
				title: 'Edit Administrator!',
				columnClass: 'xlarge',
				type: 'red',
				content: 'url:../class/classUsuarios.php?action=' + action + '&id=' + id,
				buttons: {
					Actualizar: {
						btnClass: 'btn-success',
						action: function () {
							usuarios('update');
						},
					},
					Cancel: {
						btnClass: 'btn-danger',
					},
				},
			});
			break;
		case 'update':
			datos = $('#formDatos').serialize();
			$.ajax({
				url: '../class/classUsuarios.php',
				data: datos,
				type: 'post',
				beforeSend: function (params) {
					contenido.innerHTML = 'Cargando...';
				},
				success: function (resultado) {
					contenido.innerHTML = resultado;
					$.alert({
						title: 'Aviso',
						type: 'green',
						content: 'Registro Actualizado',
					});
				},
			});
			break;
		case 'formNew':
			$.confirm({
				title: 'New Administrator!',
				columnClass: 'xlarge',
				type: 'red',
				content: 'url:../class/classUsuarios.php?action=' + action,
				buttons: {
					Registrar: {
						btnClass: 'btn-success',
						action: function () {
							usuarios('insert');
						},
					},
					Cancel: {
						btnClass: 'btn-danger',
					},
				},
			});
			break;
		case 'insert':
			datos = $('#formDatos').serialize();
			$.ajax({
				url: '../class/classUsuarios.php',
				data: datos,
				type: 'post',
				beforeSend: function (params) {
					contenido.innerHTML = 'Cargando...';
				},
				success: function (resultado) {
					contenido.innerHTML = resultado;
					$.alert({
						title: 'Aviso',
						type: 'green',
						content: 'Registro Exitoso',
					});
				},
			});
			break;
		case 'delete':
			$.confirm({
				title: 'Atención',
				type: 'red',
				content: '¿Estas Seguro?',
				buttons: {
					Aceptar: function () {
						$.ajax({
							url: '../class/classUsuarios.php',
							data: { action: 'delete', id: id },
							type: 'post',
							beforeSend: function (params) {
								contenido.innerHTML = 'Cargando...';
							},
							success: function (resultado) {
								contenido.innerHTML = resultado;
								$.alert({
									title: 'Aviso',
									type: 'green',
									content: 'Se elimino exitosamente',
								});
							},
						});
					},
					Cancelar: function () {},
				},
			});
			break;
	}
}