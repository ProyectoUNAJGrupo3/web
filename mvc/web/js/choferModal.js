$(function () {
    $('#buttonAbrirCalificacion').click(function () {
    	//var keys = $('#grid').yiiGridView('getSelectedRows'); //var keys = $('#grid tr.success').attr('rowid'); 
    	var keys = $('#grid tr.success').attr('rowid');
        $.ajax({
            type: 'post',
            cache: false,
            data: { keylist: keys },
            processData: true,
            success: function () {
                $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
                //alert('Sucess');
            },
            error: function () {
                alert('Error');
                $('#modal').modal('hide');
            }
        }); $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));

    });
});

$(function () {
    $('#btn-carga-calificacion').click(function () {
        $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
    });
});
$(function () {
    $('#btn-cancelar').click(function () {
        $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
    });
});