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
    $('#modalButtonRegistrarAgencias').click(function()
    {
        $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
    });
});