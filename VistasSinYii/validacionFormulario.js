function validarCamposVacio(){
	
}


//Validaciones Campos Formulario
/*Validaciones de campos*/
function validarNombre(){
	var x=document.formUser.formNombre.value;
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
	var x=document.formUser.formApellido.value;
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
	var x=document.formUser.formCorreo.value;
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
	var x=document.formUser.formTelefono.value;
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
	var x=document.formUser.formNombreUsuario.value;
	var filtroNumero = /^[0-9]+$/
	/*|| /^[0-9]+$/.test(document.getElementById("telefono").value)*/
	if (x==null || x=="")
	{
		document.getElementById('errorInfoUser').innerHTML="this is invalid user name";
		document.getElementById('nombreUsuario').style.borderColor = "red";
		return false;
	}else{
		document.getElementById('nombreUsuario').style.borderColor = "green";
		document.getElementById('errorInfUser').innerHTML=" ";
		return true;
	}
}
function validarContrasenia(){
	var x=document.formUser.formContrasenia.value;
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
	var x=document.formUser.formConfirmarContraseniaForm.value;
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

//Validaciones Campos Login
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