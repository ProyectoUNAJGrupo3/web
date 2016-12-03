/*JS de ADMINISTRADOR DE VIAJES*/
$(function () {
	$('#actualizarButton').click(function () {
		var keys = $('#viajes_grid tr.success').attr('rowid');
        $.ajax({
            type: 'post',
            cache: false,
            data: { keylist: keys },
            processData: true,
            error: function () {
                alert('Error');
                $('#modal').modal('hide');
            }
        }); $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));

    });
});
$(function () {
	$('#buttonsOperaciones :button').click(function(){
		var keys = $('#viajes_grid tr.success').attr('rowid');
		var operacion = $(this).attr('operacion');
		if (operacion == 'actualizar') return; //SI LA OPERACION ES ACTUALIZACION NO CONTINUA AQUI SINO EN EL JS DE ARRIBA
		$('#processmodal').modal('show');
		$.ajax({
			type     :'post',
			cache    : true,
			data: {keylist: keys,viajeoperacion: operacion},
			url  : $(this).attr('value'),
			success: function () {
			$.pjax.reload({ container: '#containerpjax', timeout: 20000 }); 
			$('#processmodal').modal('hide');
			
		},
		error: function(){
			alert('Error');
			$('#processmodal').modal('hide');
		}
		});

		return false;
});
});

/*JS de ADMINISTRADOR DE SOLICITUDES*/
$(function () {
	$('#autorizarButton').click(function () {
		var keys = $('#solicitudes_grid tr.success').attr('rowid');
		$.ajax({
			type: 'post',
			cache: false,
			data: { keylist: keys },
			processData: true,
			error: function () {
				alert('Error');
				$('#solicitudes_modal').modal('hide');
			}
		}); $('#solicitudes_modal').modal('show').find('#modalContent').load($(this).attr('value'));

	});
});
$(function () {
	$('#solicitudesbuttonsOperaciones :button').click(function () {
		var keys = $('#solicitudes_grid tr.success').attr('rowid');
		var operacion = $(this).attr('operacion');
		if (operacion == 'autorizar') return; //SI LA OPERACION ES ACTUALIZACION NO CONTINUA AQUI SINO EN EL JS DE ARRIBA
		$('#solicitudes_processmodal').modal('show');
		$.ajax({
			type: 'post',
			cache: true,
			data: { keylist: keys, viajeoperacion: operacion },
			url: $(this).attr('value'),
			success: function () {
				$.pjax.reload({ container: '#solicitudes_containerpjax', timeout: 20000 });
				$('#solicitudes_processmodal').modal('hide');

			},
			error: function () {
				alert('Error');
				$('#processmodal').modal('hide');
			}
		});

		return false;
	});
});


/*JS DE ADMINISTRADOR DE TARIFAS*/
$(function () {
	$('#tarifasbuttonsOperaciones :button').click(function () {
		var keys = $('#tarifas_grid tr.success').attr('rowid');
		var operacion = $(this).attr('operacion');
		if (operacion!='agregar'){
			$.ajax({
			type: 'post',
			cache: false,
			data: { keylist: keys, tarifa_operacion:operacion },
			processData: true,
		});
		}
		if (operacion != 'eliminar')
		{
			$('#tarifa_modal').modal('show').find('#modalContent').load($(this).attr('value'));
		}
	});
});

/*JS DE ADMINISTRADOR DE CLIENTES*/
$(function () {
	$('#clientesbuttonsOperaciones :button').click(function () {
		var keys = $('#clientes_grid tr.success').attr('rowid');
		var operacion = $(this).attr('operacion');
		if (operacion != 'agregar')
		{
			$.ajax({
				type: 'post',
				cache: false,
				data: { keylist: keys, cliente_operacion: operacion },
				processData: true,
			});
		}
		if (operacion != 'eliminar')
		{
			$('#cliente_modal').modal('show').find('#modalContent').load($(this).attr('value'));
		}
	});
});