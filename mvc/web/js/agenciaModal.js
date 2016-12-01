$(function () {
    $('#modalButton').click(function () {
        $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
    }
    )});

$(function () {
    $('#actualizarButton').click(function () {
        var keys = $('#grid tr.success').attr('rowid');
        var operacion = $(this).attr('valor');
        $.ajax({
            type: 'post',
            cache: false,
            data: { keylist: keys , operaciones: operacion },
            processData: true,
            success: function () {
                $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
            },
            error: function () {
                alert('Error');
                $('#modal').modal('hide');
            }
        }); $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));

    });
});
$(function () {
    $('#eliminarButton').click(function () {
        var keys = $('#grid tr.success').attr('rowid');
        var operacion = $(this).attr('valor');
        $.ajax({
            type: 'post',
            cache: false,
            data: { keylist: keys, operaciones: operacion },
            processData: true,

        }); 
    });
});