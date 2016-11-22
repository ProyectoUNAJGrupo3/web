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