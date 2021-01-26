function componente(action, id) {
	switch (action) {
		case 'formEdit':
			$.confirm({
				title: 'Edit Component!',
				columnClass: 'xlarge',
				type: 'red',
				content: 'url:../class/classComponente.php?action=' + action + '&id=' + id,
				buttons: {
					Actualizar: {
						btnClass: 'btn-success',
						action: function () {
							componente('update');
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
				url: '../class/classComponente.php',
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
						content: 'Componente Actualizado',
					});
				},
			});
			break;
		case 'formNew':
			$.confirm({
				title: 'New Component!',
				columnClass: 'xlarge',
				type: 'red',
				content: 'url:../class/classComponente.php?action=' + action,
				buttons: {
					Registrar: {
						btnClass: 'btn-success',
						action: function () {
							componente('insert');
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
				url: '../class/classComponente.php',
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
							url: '../class/classComponente.php',
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
