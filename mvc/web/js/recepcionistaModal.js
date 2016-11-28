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
                $('#processmodal').modal('hide');
            }
        }); $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));

    });
});