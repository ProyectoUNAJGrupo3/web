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
