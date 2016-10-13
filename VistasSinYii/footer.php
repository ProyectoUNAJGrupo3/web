		<footer>
			<div class="footer">
				<hr style="border:1px solid gray;">
				<span id="footer-copy-right" style="text-align:center">Derechos Reservado &copy 2016</span>
			</div>
		</footer>

</div> 





<script>
/**Corresponder al Login de Menu*/
var loginDescargado = false;
$(document).ready(function(){
	$("#btn-login").click(function(){
		if (!loginDescargado){
			$.ajax({
			  url: 'popuplogin.html',
			  dataType: 'text',
			  async:false,
			  success: function(data) {
				$('body').append(data);
				loginDescargado = true;
			  },
			});
		}
		$("#myModal").modal();
	});
});
</script>
<script>
/**Corresponde al Home --> Boton SOLICITAR SERVICIO REMISERIA el cual abre el POPUP LOGIN*/
var loginDescargado = false;
$(document).ready(function(){
	$("#btn-solcitar-remis").click(function(){
		if (!loginDescargado){
			$.ajax({
			  url: 'popuplogin.html',
			  dataType: 'text',
			  async:false,
			  success: function(data) {
				$('body').append(data);
				loginDescargado = true;
			  },
			});
		}
		$("#myModal").modal();
	});
});
</script>

<!--<script>
Corresponde al Home -- Boton Menu QUIENES SOMOS 
var loginDescargado = false;
$(document).ready(function(){
	$("#quienes-somos").click(function(){
		if (!loginDescargado){
			$.ajax({
			  url: 'ventanaQuienesSomos.html',
			  dataType: 'text',
			  async:false,
			  success: function(data) {
				$('body').append(data);
				loginDescargado = true;
			  },
			});
		}
		/*$("#myModal").modal();*/
	});
});
</script>-->



<script>
/*CORRESPONDIENTE A LOGIN --> BOTON REGISTRARME QUE ABRE EL FORMULARIO Y LO COLOCA EN LA HOME*/
function abrirFormulario() {
	$('#myModal').modal('hide');
	$(function(){
      $("#contenedor-home").load("formularioUsuario.html"); 
    });

}
</script>
<script>
/*CORRESPONDIENTE A LOGIN --> BOTON REGISTRARME QUE ABRE EL FORMULARIO Y LO COLOCA EN LA HOME*/
function volverPantallaHome() {
	$(function(){
      $("#contenedor-home").load("home.php"); 
    });

}
</script>
<script>
function abrirQuienesSomos(){
$(function(){
      $("#contenedor-home").load("ventanaQuienesSomos.html"); 
    });
}
</script>
<script>
function abrirNuestrosClientes(){
$(function(){
      $("#contenedor-home").load("ventanaNuestrosClientes.html"); 
    });

}
</script>

<script>
/**MOSTRAR MAPA CON BOTON LOGIN*/
function mostrarMapa(){
	document.getElementById('dvMapGoogleHome').style.display = 'block'
}
</script>

<!--ABRIENDO EL MAPA-->
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFe54SLlmRo-9fKIQXhAuXhDTLoGRHFBw&callback=initMap">
</script>

<script type="text/javascript">
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (p) {
        var LatLng = new google.maps.LatLng(p.coords.latitude, p.coords.longitude);
        var mapOptions = {
            center: LatLng,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("dvMapHome"), mapOptions);
        var marker = new google.maps.Marker({
            position: LatLng,
            map: map,
            title: "<div style = 'height:60px;width:200px'><b>Your location:</b><br />Latitude: " + p.coords.latitude + "<br />Longitude: " + p.coords.longitude
        });
        google.maps.event.addListener(marker, "click", function (e) {
            var infoWindow = new google.maps.InfoWindow();
            infoWindow.setContent(marker.title);
            infoWindow.open(map, marker);
        });
    });
} else {
    alert('Geo Location feature is not supported in this browser.');
}
</script>

<script>

//Validaciones Campos Formulario
/*Validaciones de campos*/
function validarNombre(){
	var x = document.forms["contenido-form"]["nombreForm"].value;
	/*var x=document.contenido-form.nombreForm.value;*/
	 if (x==null || x=="" || /^[0-9]+$/.test(document.getElementById("nombre").value))
	{
		/*document.getElementById('errorInfoNom').innerHTML="Invalid input, it must not be empty";*/
		document.getElementById('nombre').style.borderColor = "red";
		return false;
	}else{
		document.getElementById('nombre').style.borderColor = "green"
		/*document.getElementById('errorInfoNom').innerHTML="";*/
			return true;
	}
}
function validarApellido(){
	var x = document.forms["contenido-form"]["apellidoForm"].value;
	/*var x=document.contenido-form.apellidoForm.value;*/
	 if (x==null || x=="" || /^[0-9]+$/.test(document.getElementById("apellido").value))
	{
		/*document.getElementById('errorInfoApel').innerHTML="Invalid input, it must not be empty";*/
		document.getElementById('apellido').style.borderColor = "red";
		return false;
	}else{
		document.getElementById('apellido').style.borderColor = "green"
		/*document.getElementById('errorInfoApel').innerHTML=" ";*/
			return true;
	}
}
function validarEmail(){
	var x = document.forms["contenido-form"]["correoElectronicoForm"].value;
	/*var x=document.contenido-form.correoElectronicoForm.value;*/
	var filtroNumero = /^[0-9]+$/
	var filterEmail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/
	var filterBisEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
	if (x==null || x=="")
	{/*	if(/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/.test(document.getElementById("correo-electronico").value)
		{*/
			/*document.getElementById('errorInfoEmail').innerHTML="Invalid input, it must not be empty";*/
			document.getElementById('correo-electronico').style.borderColor = "red";
			return false;
		/*}*/
		
	}else{
		document.getElementById('correo-electronico').style.borderColor = "green";
		/*document.getElementById('errorInfoEmail').innerHTML=" ";*/
			return true;
	}
}
function validarTelefono(){
	var x = document.forms["contenido-form"]["telefonoForm"].value;
	/*var x=document.contenido-form.telefonoForm.value;*/
	var filtroNumero = /^[0-9]+$/
	/*|| /^[0-9]+$/.test(document.getElementById("telefono").value)*/
	if (x==null || x=="")
	{
		/*document.getElementById('errorInfoTel').innerHTML="Invalid input, it must not be empty";*/
		document.getElementById('telefono').style.borderColor = "red";
		return false;
	}else{
		document.getElementById('telefono').style.borderColor = "green";
		/*document.getElementById('errorInfoTel').innerHTML=" ";*/
			return true;
	}
}
function validarDireccion(){
	var x = document.forms["contenido-form"]["direccionForm"].value;
	/*var x=document.contenido-form.telefonoForm.value;*/
	var filtroNumero = /^[0-9]+$/
	/*|| /^[0-9]+$/.test(document.getElementById("telefono").value)*/
	if (x==null || x=="")
	{
		document.getElementById('direccion-dir').style.borderColor = "red";
		document.getElementById('errorInfoTel').innerHTML="Address must not be empty";
		return false;
	}else{
		document.getElementById('direccion-dir').style.borderColor = "green";
		/*document.getElementById('errorInfoTel').innerHTML=" ";*/
			return true;
	}
}
</script>
<script>
function validarNombreUsuario(){
	var x = document.forms["contenido-form"]["nombreUsuario"].value;
	/*var x=document.contenido-form.nombreUsuario.value;*/
	var filtroNumero = /^[0-9]+$/
	/*|| /^[0-9]+$/.test(document.getElementById("telefono").value)*/
	if (x==null || x=="")
	{
		/*document.getElementById('errorInfUser').innerHTML="Invalid input, it must not be empty";*/
		document.getElementById('nombre-usuario-nu').style.borderColor = "red";
		return false;
	}else{
		document.getElementById('nombre-usuario-nu').style.borderColor = "green";
		/*document.getElementById('nombre-usuario').innerHTML=" ";*/
		return true;
	}
}
function validarContrasenia(){
	var x = document.forms["contenido-form"]["contraseniaForm"].value;
	/*var x=document.contenido-form.contraseniaForm.value;*/
	var filtroNumero = /^[0-9]+$/
	/*|| /^[0-9]+$/.test(document.getElementById("telefono").value)*/
	if (x==null || x=="")
	{
		/*document.getElementById('errorInfContrasenia').innerHTML="Invalid input, it must not be empty";*/
		document.getElementById('contrasenia-con').style.borderColor = "red";
		return false;
	}else{
		document.getElementById('contrasenia-con').style.borderColor = "green";
		/*document.getElementById('errorInfContrasenia').innerHTML=" ";*/
		return true;
	}
}
function validarConfirmacionContrasenia(){
	var x = document.forms["contenido-form"]["confirmarContraseniaForm"].value;
	/*var x=document.contenido-form.confirmarContraseniaForm.value;*/
	var filtroNumero = /^[0-9]+$/
	/*|| /^[0-9]+$/.test(document.getElementById("telefono").value)*/
	if (x==null || x=="")
	{
		/*document.getElementById('errorInfConfContrasenia').innerHTML="Invalid input, it must not be empty";*/
		document.getElementById('confirmar-contrasenia').style.borderColor = "red";
		return false;
	}else{
		document.getElementById('confirmar-contrasenia').style.borderColor = "green";
		/*document.getElementById('confirmar-contrasenia').innerHTML=" ";*/
		return true;
	}
}
</script>

<script>
//Validaciones Campos Login
function validarLoginNombre(){
	var x=document.formLogin.usarioForm.value;
	 if (x==null || x=="")
	{
		document.getElementById('errorInfUsuario').innerHTML="Invalid input, it must not be empty";
		document.getElementById('usrname').style.borderColor = "red";
		return false;
	}else{
		document.getElementById('usrname').style.borderColor = "green"
		document.getElementById('errorInfUsuario').innerHTML="";
			return true;
	}
}
function validarLoginContrasenia(){
	var x=document.formLogin.contraseniaForm.value;
	 if (x==null || x=="")
	{
		document.getElementById('errorInfContrasenia').innerHTML="Invalid input, it must not be empty";
		document.getElementById('psw').style.borderColor = "red";
		return false;
	}else{
		document.getElementById('psw').style.borderColor = "green"
		document.getElementById('errorInfContrasenia').innerHTML="";
		return true;
	}
}
</script>


<!--fondo mapas: background
mapa para ver posicion, buscar remiserias, saolicitar -->


</body>
</html>
