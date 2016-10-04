<?php
include('header.php');
?>

<!--Probar con if de php para traer una pagina u otra (formulario o dejar la que estaba)-->

<div id="contenedor">
	<div id="bar-buttons">
		<div><h1 id="bienvenidos" size="50px">Bienvenidos</h1></div>
		<br>
		<div id="btn-bar">
			<button type="button" id="btn-solcitar-remis">Solicitar Servicio Remiseria</button>
			<button type="button" id="btn-ver-remiserias"><!-- onclick="drop()"-->Ver Remiserias alrededor</button>
		</div>
		
		<div id="map"></div>
	
		<div id="dvMap" style="width: 700px; height: 700px; width: 100%; boder:3px solid black; padding: 30px 30px; box-shadow: 15px 15px 10px #888888; margin-left:-15px;"></div>
		
	</div><!--End Bar Buttons-->
</div>


	
<?php
include('footer.php');
?>