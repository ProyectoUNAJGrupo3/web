$(function() {
    $('#modalButton').click(function()
    {
        $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
    });
});

$(function() {
    $('#modalButtonRegistrarUsuario').click(function()
    {
        $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
    });
});

$(function() {
    $('#modalButtonLogin').click(function()
    {
        $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
    });
});

$(function() {
    $('#modalButtonEmail').click(function()
    {
        $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
    });
});
$(function() {
    $('#modalButtonCalificarUsuario').click(function()
    {
        $('#modal').modal('show').find('#modalContentChofer').load($(this).attr('value'));
    });
});
/*
$(function () {
    $('#buttonAbrirCalificacion').click(function () {
        $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
    });
});
*/
/*
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
                alert('Sucess');
            },
            error: function () {
                alert('Error');
                $('#modal').modal('hide');
            }
        }); $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));

    });
});
*/