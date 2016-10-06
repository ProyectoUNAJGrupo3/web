			
<!--		<footer>
			<div class="footer">
				<hr id="gray" style="border:1px solid gray;">
				<span id="footer-copy-right" style="text-align:center">Derechos Reservado &copy 2016</span>
			</div>
		</footer> 

<<<<<<< HEAD
</div> --> 

<!--End Container--> 

<div class="contenedor">
    <div class="principal">
        <!--Contenido-->
        <!--Contenido-->
        <!--Contenido-->
        <!--Contenido-->
        <!--Contenido-->    
    </div>
    <footer>
	<div class="footer">
				<hr id="gray" style="border:1px solid gray;">
				<span id="footer-copy-right" style="text-align:center">Derechos Reservados &copy 2016</span>
			</div></footer>
</div>
=======
</div> 
>>>>>>> repocentral/master

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

<<<<<<< HEAD
<script>
function mostrarMapa(){
	//$('body').css('display','block');
	
	document.getElementById('main').style.display = 'none';
	document.getElementById('dvMap').style.display = 'block';
	document.getElementById('bar-buttons').style.display = 'block';
	document.getElementById('footer-copy-right').style.display = 'block';
	document.getElementById('gray').style.display = 'block';
	}
	//if (formularioDescargado = true){
	//	document.getElementById('main').style.display = 'none';

	//}

</script>

=======
>>>>>>> repocentral/master
<script>
/*CORRESPONDIENTE A LOGIN --> BOTON REGISTRARME QUE ABRE EL FORMULARIO Y LO COLOCA EN LA HOME*/
function abrirFormulario() {
	$('#myModal').modal('hide');
<<<<<<< HEAD
	if (!formularioDescargado){
			$.ajax({
			  url: 'formularioUsuario.html',
			  dataType: 'text',
			  async:false,
			  success: function(data) { 
				$('body').append(data);
				//$('body').append(footer);
				formularioDescargado = true;
				document.getElementById('dvMap').style.display = 'none';
				document.getElementById('bar-buttons').style.display = 'none';
				//document.getElementById('footer-copy-right').style.display = 'none';
				//document.getElementById('gray').style.display = 'none';
			  },
			  
			});
		}
	 	
}
</script>



=======
	$(function(){
      $("#contenedor").load("formularioUsuario.html"); 
    });

}
</script>

<script>
/**MOSTRAR MAPA CON BOTON LOGIN*/
function mostrarMapa(){
	document.getElementById('dvMap').style.display = 'block'
}
</script>
>>>>>>> repocentral/master
<!--<script>
/*MOSTRAR MAPA CON BOTON LOGIN*/
function mostrarMapa(){
	document.getElementById('dvMap').style.display = 'block'
}
</script>-->

<script><!--Validaciones Campos Formulario-->
/*Validaciones de campos*/
function validarNombre(){
	var x=document.formUser.nombreForm.value;
	 if (x==null || x=="" || /^[0-9]+$/.test(document.getElementById("nombre").value))
	{
		document.getElementById('errorInfoNom').innerHTML="this is invalid name";
		document.getElementById('nombre').style.borderColor = "red";
		return false;
	}else{
		document.getElementById('nombre').style.borderColor = "green"
		document.getElementById('errorInfoNom').innerHTML="";
			return true;
	}
}
function validarApellido(){
	var x=document.formUser.apellidoForm.value;
	 if (x==null || x=="" || /^[0-9]+$/.test(document.getElementById("apellido").value))
	{
		document.getElementById('errorInfoApel').innerHTML="this is invalid surname";
		document.getElementById('apellido').style.borderColor = "red";
		return false;
	}else{
		document.getElementById('apellido').style.borderColor = "green"
		document.getElementById('errorInfoApel').innerHTML=" ";
			return true;
	}
}
function validarEmail(){
	var x=document.formUser.correoElectronicoForm.value;
	var filtroNumero = /^[0-9]+$/
	var filterEmail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/
	var filterBisEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
	if (x==null || x=="")
	{/*	if(/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/.test(document.getElementById("correo-electronico").value)
		{*/
			document.getElementById('errorInfoEmail').innerHTML="this is invalid email";
			document.getElementById('correo-electronico').style.borderColor = "red";
			return false;
		/*}*/
		
	}else{
		document.getElementById('correo-electronico').style.borderColor = "green";
		document.getElementById('errorInfoEmail').innerHTML=" ";
			return true;
	}
}
function validarTelefono(){
	var x=document.formUser.telefonoForm.value;
	var filtroNumero = /^[0-9]+$/
	/*|| /^[0-9]+$/.test(document.getElementById("telefono").value)*/
	if (x==null || x=="")
	{
		document.getElementById('errorInfoTel').innerHTML="this is invalid number phone";
		document.getElementById('telefono').style.borderColor = "red";
		return false;
	}else{
		document.getElementById('telefono').style.borderColor = "green";
		document.getElementById('errorInfoTel').innerHTML=" ";
			return true;
	}
}
function validarNombreUsuario(){
	var x=document.formUser.nombreUsuario.value;
	var filtroNumero = /^[0-9]+$/
	/*|| /^[0-9]+$/.test(document.getElementById("telefono").value)*/
	if (x==null || x=="")
	{
		document.getElementById('errorInfUser').innerHTML="this is invalid user name";
		document.getElementById('nombreUsuario').style.borderColor = "red";
		return false;
	}else{
		document.getElementById('nombreUsuario').style.borderColor = "green";
		document.getElementById('errorInfUser').innerHTML=" ";
		return true;
	}
}
function validarContrasenia(){
	var x=document.formUser.contraseniaForm.value;
	var filtroNumero = /^[0-9]+$/
	/*|| /^[0-9]+$/.test(document.getElementById("telefono").value)*/
	if (x==null || x=="")
	{
		document.getElementById('errorInfContrasenia').innerHTML="this is invalid password";
		document.getElementById('contrasenia').style.borderColor = "red";
		return false;
	}else{
		document.getElementById('contrasenia').style.borderColor = "green";
		document.getElementById('errorInfContrasenia').innerHTML=" ";
		return true;
	}
}
function validarConfirmacionContrasenia(){
	var x=document.formUser.confirmarContraseniaForm.value;
	var filtroNumero = /^[0-9]+$/
	/*|| /^[0-9]+$/.test(document.getElementById("telefono").value)*/
	if (x==null || x=="")
	{
		document.getElementById('errorInfConfContrasenia').innerHTML="this is invalid password";
		document.getElementById('confirmarContrasenia').style.borderColor = "red";
		return false;
	}else{
		document.getElementById('confirmarContrasenia').style.borderColor = "green";
		document.getElementById('errorInfConfContrasenia').innerHTML=" ";
		return true;
	}
}
</script>

<script><!--Validaciones Campos Login-->
function validarLoginNombre(){
	var x=document.formLogin.usarioForm.value;
	 if (x==null || x=="")
	{
		document.getElementById('errorInfUsuario').innerHTML="this is invalid username";
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
		document.getElementById('errorInfContrasenia').innerHTML="this is invalid password";
		document.getElementById('psw').style.borderColor = "red";
		return false;
	}else{
		document.getElementById('psw').style.borderColor = "green"
		document.getElementById('errorInfContrasenia').innerHTML="";
		return true;
	}
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
        var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
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
</body>
</html>

<!--fondo mapas: background
mapa para ver posicion, buscar remiserias, saolicitar -->