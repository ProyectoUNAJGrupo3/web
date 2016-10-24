<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="./bootstrap-3.3.7/dist/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src= "./bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
		<script src= "./validacioFormulario.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="./bootstrap-3.3.7/dist/css/bootstrap.min.css">

		<link rel="stylesheet" href="css/styleFormularioUsuario.css">
		<link rel="stylesheet" href="css/styleHeader.css">
		<link rel="stylesheet" href="css/styleLoginPopup.css">
		<link rel="stylesheet" href="css/styleFooter.css">
		<link rel="stylesheet" href="css/styleContentMap.css">
		<link rel="stylesheet" href="css/styleHome.css">
		
		
		<script async defer
			src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMVbdR-TGis783bW9rB9tZUJXVXsIRzkQ&libraries=places">
		</script>
		<script src="mapas.js"></script>
		
	</head>
	<body>
		<div class="container">
			<header class="header-head" itf-shared-header="">
				<div class="header ng-isolate.scope" off-set="250" sticky="" style="position:static;">
					
					<div class="header-top">
						<div class="header-top-inner">
							
							<div class="header-top-inner-left">
					
								<a class="navbar-brand " href="#"><img src="logo.jpg" height="90px" width="90px" alt="Logo P&aacute;gina" align="left-top" title="Logo Service Remis"></a>
							</div>
							
							<div class="header-top-inner-right">
								<span class="name-company">Service Remis</span>
							</div>
							
						</div>
					</div>
					
					
					<div class="header-nav">
						
						<div class="header-nav-inner">
								
								<ul style="width:100%">
									<li class="nav-button nav-0"><a href="#">Home</a></li><!--onclick="volverPantallaHome()"-->
									<li class="nav-button nav-1"><a href="#" onclick="abrirQuienesSomos()">Qui&eacute;nes somos</a></li>
									<li class="nav-button nav-2"><a href="#" onclick="abrirNuestrosClientes()">Nuestro Clientes</a></li>
									<li class="nav-button nav-4"><a href="#">Nuestra Historia</a></li>
									<li class="nav-button nav-5"><a href="#">Contacto</a></li>
									<li class="nav-button nav-6"><button type="button" class="btn-login" id="btn-login" data-dismiss="modal" data-toggle="modal"><a href="#">Login</a></button></li>
								</ul>
						</div>
						
					</div>
					
				</div>
			</header>