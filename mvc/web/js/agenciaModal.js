$(function () {
    $('#modalButton').click(function () {
        $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
    }
    )});

$(function () {
    $('#actualizarButton').click(function () {
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