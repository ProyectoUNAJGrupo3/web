function abrirLoginDesdeBotonSolicitarServicioRemiseria() {
    /**Corresponder al Login de Menu*/
    var loginDescargado = false;
    $(document).ready(function () {
        $("#btn-login").click(function () {
            if (!loginDescargado) {
                $.ajax({
                    url: 'login.php',
                    dataType: 'text',
                    async: false,
                    success: function (data) {
                        $('site-index').append(data);
                        loginDescargado = true;
                    },
                });
            }
            $("#myModal").modal();
        });
    });
}

function abrirLoginDesdeBotonLoginHeader() {
    /**Corresponder al Login de Menu*/
    var loginDescargado = false;
    $(document).ready(function () {
        $("#btn-login").click(function () {
            if (!loginDescargado) {
                $.ajax({
                    url: 'login.php',
                    dataType: 'text',
                    async: false,
                    success: function (data) {
                        $('site-index').append(data);
                        loginDescargado = true;
                    },
                });
            }
            $("#myModal").modal();
        });
    });
}