
$(function () {
    $('#modalButtonCalificar').click(function () {
        $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
    });
});
/*
$(function () {
    $('#modalButtonCalificarServicio').click(function () {
        $('#modal').modal('show').find('#modalContentChofer').load($(this).attr('value'));
    });
});
*/
$(function () {
    $('#buttonAbrirCalificacion').click(function () {
        var keys = $('#grid').yiiGridView('getSelectedRows');
        $.ajax({
            type: 'post',
            cache: false,
            data: { keylist: keys },
            processData: true,
            success: function () {
                $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
                alert('sucess');
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
