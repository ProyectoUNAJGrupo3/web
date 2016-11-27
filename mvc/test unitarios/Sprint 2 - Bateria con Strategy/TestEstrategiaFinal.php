<?php

include 'C:/xampp/htdocs/simpletest/autorun.php';
include 'EstrategiaCompleta.php';

class TestEstrategiaFinal extends UnitTestCase
{
	public function testFinal() //si el arg es "null" se puede poner el dato, si es "NULL" no poner (debido al constructor)
	{	
		$persona1 = new EstrategiaABM();
		$agencia1 = new EstrategiaABM();
		$agencia2 = new EstrategiaABM();
		$viaje1 = new EstrategiaABM();
		$vehiculo1 = new EstrategiaABM();
		$tarifa1 = new EstrategiaABM();
		$chofer1 = new EstrategiaABM();
		
		$persona1->setRegistrable(new PersonaABM(NULL, "'Persona5'", "'Prueba5'", "'pers5'", "'pers5'", "'42545454'", "'persona5@g.com'", "'Florida 1195'", "", "", "", 0, 2, "'33000045'", 61));
		$persona1->ejecutarRegistro();
		$this->assertNotNull($persona1, "Registrar OK");
		
		$agencia1->setRegistrable(new AgenciaABM(NULL, "'Remis Acha1'", "'Acha 501'", "'{}'", "'42101111'", "'remisacha1@g.com'", 0));
		$agencia1->ejecutarRegistro();
		$this->assertNotNull($agencia1, "Registrar OK");		
		
		$agencia2->setRegistrable(new AgenciaABM(NULL, "'Remis Colombia1'", "'Colombia 5061'", "'{}'", "'42102222'", "'remiscolombia1@g.com'", 0));
		$agencia2->ejecutarRegistro();
		$this->assertNotNull($agencia2, "Registrar OK");		
	
		$viaje1->setRegistrable(new ViajesABM(NULL, 310, 20, 7, 2, 61, 307, "'2016-04-05'", "'2016-04-05'", "", "", "", "", 0, "'{}'", "'{}'", "'casa cliente1'", "'cancha de racing1'", "'chofer muy recomendable1'", 200, 250, 0));
		$viaje1->ejecutarRegistro();
		$this->assertNotNull($viaje1, "Registrar OK");

		$vehiculo1->setRegistrable(new VehiculosABM(NULL, "'ABC124'", "'Uno'", "'Fiat'", "'usado'", "'2010-01-31'", "'2015-02-29'", "", "", 57, ""));
		$vehiculo1->ejecutarRegistro();
		$this->assertNotNull($vehiculo1, "Registrar OK");

		$tarifa1->setRegistrable(new TarifasABM(NULL, 31, 59, "'55'", "'2'", "'12'", 0));
		$tarifa1->ejecutarRegistro();
		$this->assertNotNull($tarifa1, "Registrar OK");		
		
		$chofer1->setInformable(new ChoferesABM(310, "", "", "", "", "", "", "", "", "", ""));
		$chofer1->ejecutarInformacion();
		$this->assertNotNull($chofer1, "Registrar OK");		
		
	
	
		/*PERSONAS
		constructor($personaID, $nombre, $apellido, $usuario, $password, $telefono, $email, $direccion, $direccionCoordenadas, $direccionDefault, $direccionTipo, $estado, $rolID, $documento, $agenciaID)
		RegistrarPersona($Nombre, $Apellido, $Usuario, $Password, $Telefono, $Email, $Direccion, $DireccionCoordenadas, $DireccionDefault, $Estado, $RolID, $Documento, $AgenciaID)
		ModificarPersona($PersonaID, $Nombre, $Apellido, $Usuario, $Password, $Telefono, $Email, $Direccion, $DireccionCoordenadas, $DireccionDefault, $DireccionTipo, $Estado, $RolID, $Documento, $AgenciaID)
		EliminarPersona($PersonaID)
		GetInfoPersonas($PersonaID, $Nombre, $Apellido, $Usuario, $Telefono, $Email, $Direccion, $DireccionCoordenadas, $Estado, $RolID, $Documento, $AgenciaID)*/
		
		/*AGENCIAS
		function __construct($agenciaID, $nombre, $direccion, $direccionCoordenadas, $telefono, $email, $estado)
		RegistrarAgencia($Nombre, $Direccion, $DireccionCoordenadas , $Telefono, $Email, $Estado)   
		ModificarAgencia($AgenciaID, $Nombre,$Direccion, $DireccionCoordenadas,$Telefono, $Email,  $Estado )
		EliminarAgencia($AgenciaID)
		GetInfoAgencia($AgenciaID, $Nombre, $Direccion, $DireccionCoordenadas, $Telefono, $Email, $Estado)*/
		
		/*VIAJES
		function __construct($viajeID, $choferID, $vehiculoID, $tarifaID, $turnoID, $agenciaID, $personaID, $fechaEmision, $fechaSalida, $fechaEmisionDesde, $fechaEmisionHasta, $fechaSalidaDesde, 
		$fechaSalidaHasta, $viajeTipo, $origenCoordenadas, $destinoCoordenadas, $origenDireccion, $destinoDireccion, $comentario, $importeTotal, $distancia, $estado)
		RegistrarViaje($ChoferID, $VehiculoID, $TarifaID, $TurnoID, $AgenciaID, $PersonaID, $FechaEmision, $FechaSalida, $ViajeTipo, $OrigenCoordenadas, $DestinoCoordenadas, 
		$OrigenDireccion, $DestinoDireccion, $Comentario, $ImporteTotal, $Distancia, $Estado)  		
		ModificarViaje($ViajeID, $ChoferID, $VehiculoID, $TarifaID, $TurnoID, $AgenciaID, $PersonaID, $FechaEmision, $FechaSalida, $ViajeTipo, $OrigenCoordenadas, $DestinoCoordenadas, 
		$OrigenDireccion, $DestinoDireccion, $Comentario, $ImporteTotal, $Distancia, $Estado)		
		EliminarViaje($ViajeID)
		GetInfoViajes($ViajeID, $ChoferID, $VehiculoID, $TarifaID, $TurnoID, $AgenciaID, $PersonaID, $FechaEmisionDesde, $FechaEmisionHasta, $FechaSalidaDesde, $FechaSalidaHasta, $ViajeTipo, 
		$OrigenCoordenadas, $DestinoCoordenadas, $OrigenDireccion, $DestinoDireccion, $Comentario, $ImporteTotal, $Distancia, $Estado)*/
		
		/*VEHICULOS
		function __construct($vehiculoID, $matricula, $modelo, $marca, $estado, $fechaAlta, $fechaBaja, $fechaAltaDesde, $fechaAltaHasta, $agenciaID, $soloDisponibles)
		RegistrarVehiculo($Matricula, $Modelo, $Marca, $Estado, $FechaAlta, $FechaBaja, $AgenciaID)	
		ModificarVehiculo($VehiculoID, $Matricula, $Modelo, $Marca, $Estado, $FechaAlta, $FechaBaja, $AgenciaID)
		EliminarVehiculo($VehiculoID)
		GetInfoVehiculos($VehiculoID, $Matricula, $Modelo, $Marca, $Estado, $FechaAltaDesde, $FechaAltaHasta, $AgenciaID, $SoloDisponibles)*/
		
		/*CHOFERES
		function __construct($personaID, $nombre, $apellido, $documento, $usuario, $password, $telefono, $email, $estado, $agenciaID, $soloDisponibles)
		GetInfoChoferes($PersonaID, $Nombre, $Apellido, $Documento, $Usuario, $Telefono, $Email, $Estado, $AgenciaID, $SoloDisponibles)*/
		
		/*TARIFAS
		function __construct($tarifaID, $comision, $agenciaID, $viajeMinimo, $kmMinimo, $precioKM, $estado)
		RegistrarTarifa($Comision, $AgenciaID, $ViajeMinimo, $KmMinimo, $PrecioKM, $Estado)  		
		ModificarTarifa($TarifaID, $Comision, $AgenciaID, $ViajeMinimo, $KmMinimo, $PrecioKM, $Estado)
		EliminarTarifa($TarifaID)
		GetInfoTarifas($TarifaID, $Comision, $AgenciaID,$ViajeMinimo, $KmMinimo, $PrecioKM, $Estado)*/
		
	}
	/*EJEMPLOS:
		$persona1 = new EstrategiaABM();
		
		$persona1->setRegistrable(new PersonaABM(NULL, "'Fray'", "'El Colorado'", "'colo'", "'colo'", "'42105128'", "'elcolo@gmail.com'", "'casa'", "'88888578'", "'miauuu'", null, 0, 4, "'255555555'", ""));
		$persona1->ejecutarRegistro();
		$this->assertNotNull($persona1, "Registrar OK");	

		$persona1->setModificable(new PersonaABM(0, "'Fray'", "'El Colorado'", "'elcolo'", "'elcolo'", "'42105128'", "'elcolo@gmail.com'", "'casa'", "'88888578'", "'miauuuuuuuuuuuuuuuu'", null, 0, 4, "'255555555'", ""));
		$persona1->ejecutarModificacion();
		$this->assertNotNull($persona1, "Modificar OK");
		
		$persona1->setEliminable(new PersonaABM(254, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL));
		$persona1->ejecutarEliminacion();
		$this->assertNotNull($persona1, "Eliminar OK");	

		$persona1->setInformable(new PersonaABM(269, "", "", "", NULL, "", "", "", "", NULL, NULL, "", "", "", NULL)); //NULL1=password, NULL2=direccionDefault, NULL3=direccionTipo, NULL4=agenciaID
		$persona1->ejecutarInformacion();
		$this->assertNotNull($persona1, "Informar OK");			
	*/
}