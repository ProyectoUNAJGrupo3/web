$(function () {
    $('#modalButton').click(function () {
        $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
    });
});

$(function () {
        $('#actualizarButton').click(function () {
        var keys = $('#grid').yiiGridView('getSelectedRows');
        $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
    });
});
