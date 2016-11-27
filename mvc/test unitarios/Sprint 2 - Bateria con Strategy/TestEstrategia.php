<?php

include 'C:/xampp/htdocs/simpletest/autorun.php';
include 'EstrategiaCompleta.php';
//include 'OperacionState.php';


//$a =  class_exists('UnitTestCase');
//echo $a;

//if(!class_exists('PersonasModelo'))
//if(!interface_exists('OperacionState'))
//{




class TestEstrategia1 extends UnitTestCase
{
	public function testPersonas() //si el arg es "null" se puede poner el dato, si es "NULL" no poner (debido al constructor)
	{		
		//constructor($personaID, $nombre, $apellido, $usuario, $password, $telefono, $email, $direccion, $direccionCoordenadas, $direccionDefault, $direccionTipo, $estado, $rolID, $documento, $agenciaID)
		//constructor($personaID, $nombre, $apellido, $usuario, $password, $telefono, $email, $direccion, $direccionCoordenadas, $direccionDefault, $direccionTipo, $estado, $rolID, $documento, $agenciaID)
		//RegistrarPersona($Nombre, $Apellido, $Usuario, $Password, $Telefono, $Email, $Direccion, $DireccionCoordenadas, $DireccionDefault, $Estado, $RolID, $Documento, $AgenciaID)
		//ModificarPersona($PersonaID, $Nombre, $Apellido, $Usuario, $Password, $Telefono, $Email, $Direccion, $DireccionCoordenadas, $DireccionDefault, $DireccionTipo, $Estado, $RolID, $Documento, $AgenciaID)
		//EliminarPersona($PersonaID)
		//GetInfoPersonas($PersonaID, $Nombre, $Apellido, $Usuario, $Telefono, $Email, $Direccion, $DireccionCoordenadas, $Estado, $RolID, $Documento, $AgenciaID)
		
		/*
		$persona1 = new EstrategiaABM();
		$persona1->setRegistrable(new PersonaABM(NULL, "'Fray'", "'El Colorado'", "'colo'", "'colo'", "'42105128'", "'elcolo@gmail.com'", "'casa'", "'88888578'", "'miauuu'", null, 0, 4, "'255555555'", ""));
		$persona1->ejecutarRegistro();
		$this->assertNotNull($persona1, "Registrar OK");	
		*/
		//$persona2 = new EstrategiaABM();
		//$persona2->setRegistrable(new PersonaABM(NULL, "'Guillermo'", "'guille'", "'Francella'", "'guille'", "'78787'", "'lanenaaaaaa@gmail.com'", "'Racing'", "'87915'", "'Capital Federal'", null, 0, 4));
		//$persona2->ejecutar();
		//$this->assertNotNull($persona2, 'registrar ok');			
		
		/*
		$persona1 = new EstrategiaABM();
		$persona1->setModificable(new PersonaABM(0, "'Fray'", "'El Colorado'", "'elcolo'", "'elcolo'", "'42105128'", "'elcolo@gmail.com'", "'casa'", "'88888578'", "'miauuuuuuuuuuuuuuuu'", null, 0, 4, "'255555555'", ""));
		$persona1->ejecutarModificacion();
		$this->assertNotNull($persona1, "Modificar OK");
		*/
		/*
		$persona1 = new EstrategiaABM();
		$persona1->setEliminable(new PersonaABM(254, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL));
		$persona1->ejecutarEliminacion();
		$this->assertNotNull($persona1, "Eliminar OK");	
		*/
		
		/*
		// GetInfoPersonas($PersonaID, $Nombre, $Apellido, $Usuario, $Telefono, $Email, $Direccion, $DireccionCoordenadas, $Estado, $RolID, $Documento, $AgenciaID)
		$persona1 = new EstrategiaABM();
		$persona1->setInformable(new PersonaABM(269, "", "", "", NULL, "", "", "", "", NULL, NULL, "", "", "", NULL)); //NULL1=password, NULL2=direccionDefault, NULL3=direccionTipo, NULL4=agenciaID
		$persona1->ejecutarInformacion();
		$this->assertNotNull($persona1, "Informar OK");		
		*/
	}
		
		public function testAgencias()
		{
			/*
			//function __construct($agenciaID, $nombre, $direccion, $direccionCoordenadas, $telefono, $email, $estado)
			//RegistrarAgencia($Nombre, $Direccion, $DireccionCoordenadas , $Telefono, $Email, $Estado)   
			//ModificarAgencia($AgenciaID, $Nombre,$Direccion, $DireccionCoordenadas,$Telefono, $Email,  $Estado )
			//EliminarAgencia($AgenciaID)
			//GetInfoAgencia($AgenciaID, $Nombre, $Direccion, $DireccionCoordenadas, $Telefono, $Email, $Estado)
			
			$agencia1 = new EstrategiaABM();
			$agencia1->setRegistrable(new AgenciaABM(NULL, "'Agencia 11'", "'Barracas'", "'23111115111'", "'0980007700000'", "'11@gmail.com'", 0));
			$agencia1->ejecutarRegistro();
			$this->assertNotNull($agencia1, "Registrar ok");					
			
			$agencia2 = new EstrategiaABM();
			$agencia2->setModificable(new AgenciaABM(45, "'Remis Quilmes'", "'Yrigoyen 455'", "'244445555'", "'42545443'", "'remisquilmes@gmail.com'", 0));
			$agencia2->ejecutarModificacion();
			$this->assertNotNull($agencia2, "Modificar ok");			
			
			$agencia3 = new EstrategiaABM();
			$agencia3->setEliminable(new AgenciaABM(42, NULL, NULL, NULL, NULL, NULL, NULL));
			$agencia3->ejecutarEliminacion();
			$this->assertNotNull($agencia3, "Eliminar ok");	
			
			$agencia4 = new EstrategiaABM();
			$agencia4->setInformable(new AgenciaABM(45, "", "", "", "", "", ""));
			$agencia4->ejecutarInformacion();
			$this->assertNotNull($agencia4, "Informar ok");		
			*/
		}
		
		public function testViajes()
		{
			//public function __construct($viajeID, $choferID, $vehiculoID, $tarifaID, $turnoID, $agenciaID, $personaID, $fechaEmision, $fechaSalida, 
			//$fechaEmisionDesde, $fechaEmisionHasta, $fechaSalidaDesde, $fechaSalidaHasta, $viajeTipo, $origenCoordenadas, $destinoCoordenadas, $origenDireccion, $destinoDireccion, $comentario, $importeTotal, $distancia, $estado)


			//RegistrarViaje($ChoferID, $VehiculoID, $TarifaID, $TurnoID, $AgenciaID, $PersonaID, $FechaEmision, $FechaSalida, $ViajeTipo, $OrigenCoordenadas, $DestinoCoordenadas, 
			//$OrigenDireccion, $DestinoDireccion, $Comentario, $ImporteTotal, $Distancia, $Estado)  

			/*
			$viaje1 = new EstrategiaABM();
			$viaje1->setRegistrable(new ViajesABM("", 3, 2, 1, 1, 11, 2, "'2016-09-11'", "'2016-09-11'", null, null, null, null, 0, "'{}'", "'{}'", "'Cancha de Boca'", "'Hotel Alvear'", "'tardo 2hs en un viaje corto'", 80, 3, 0));
			$viaje1->ejecutarRegistro();
			$this->assertNotNull($viaje1, "Registrar ok");		
			*/
			
			
			//ModificarViaje($ViajeID, $ChoferID, $VehiculoID, $TarifaID, $TurnoID, $AgenciaID, $PersonaID, $FechaEmision, $FechaSalida, $ViajeTipo, $OrigenCoordenadas, $DestinoCoordenadas, 
			//$OrigenDireccion, $DestinoDireccion, $Comentario, $ImporteTotal, $Distancia, $Estado)
			/*
			$viaje2 = new EstrategiaABM();
			$viaje2->setModificable(new ViajesABM(7, 3, 2, 1, 1, 11, 2, "'2016-09-11'", "'2016-09-11'", null, null, null, null, 0, "'{}'", "'{}'", "'Cancha de Boca'", "'Hotel Alvear'", "'me cobro demas'", 80, 3, 0));
			$viaje2->ejecutarModificacion();
			$this->assertNotNull($viaje2, "Modificar ok");			
			*/
			
			/*
			//EliminarViaje($ViajeID)
			$viaje1 = new EstrategiaABM();
			$viaje1->setEliminable(new ViajesABM(8, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null));
			$viaje1->ejecutarEliminacion();
			$this->assertNotNull($viaje1, "Eliminar ok");	
			*/
			
			/*
			//GetInfoViajes($ViajeID, $ChoferID, $VehiculoID, $TarifaID, $TurnoID, $AgenciaID, $PersonaID, $FechaEmisionDesde, $FechaEmisionHasta, $FechaSalidaDesde, $FechaSalidaHasta, $ViajeTipo, 
			//$OrigenCoordenadas, $DestinoCoordenadas, $OrigenDireccion, $DestinoDireccion, $Comentario, $ImporteTotal, $Distancia, $Estado)
			$viaje1 = new EstrategiaABM();
			//$viaje1->setInformable(new ViajesABM(1, 3, "", "", "", "", "", null, null, "", "", "", "", "", "", "", "", "", "", "", "", ""));
			$viaje1->setInformable(new ViajesABM(2, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null));
			$viaje1->ejecutarInformacion();
			$this->assertNotNull($viaje1, "Informar ok");				
			*/
		}
		public function testVehiculos()
		{
			//function __construct($vehiculoID, $matricula, $modelo, $marca, $estado, $fechaAlta, $fechaBaja, $fechaAltaDesde, $fechaAltaHasta, $agenciaID, $soloDisponibles)

			//RegistrarVehiculo($Matricula, $Modelo, $Marca, $Estado, $FechaAlta, $FechaBaja, $AgenciaID)
			
			/*
			$vehiculo1 = new EstrategiaABM();
			$vehiculo1->setRegistrable(new VehiculosABM(null, "'TRE000'", "'Gol Trend'", "'Volkswagen'", 0,  "'2014-09-11'", "'2015-09-16'", null, null, 60, ""));
			$vehiculo1->ejecutarRegistro();
			$this->assertNotNull($vehiculo1, "Registrar ok");		
			*/
			
			//ModificarVehiculo($VehiculoID, $Matricula, $Modelo, $Marca, $Estado, $FechaAlta, $FechaBaja, $AgenciaID)
			/*
			$vehiculo2 = new EstrategiaABM();
			$vehiculo2->setModificable(new VehiculosABM(18, "'BNV680'", "'Gol G1'", "'Volkswagen VW'", 0,  "'2016-09-11'", "'2016-09-14'", null, null, 60, ""));
			$vehiculo2->ejecutarModificacion();
			$this->assertNotNull($vehiculo2, "Modificar ok");			
			*/
			
			/*
			//EliminarVehiculo($VehiculoID)
			$vehiculo1 = new EstrategiaABM();
			$vehiculo1->setEliminable(new VehiculosABM(19, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null));
			$vehiculo1->ejecutarEliminacion();
			$this->assertNotNull($vehiculo1, "Eliminar ok");	
			*/
			
			/*
			//GetInfoVehiculos($VehiculoID, $Matricula, $Modelo, $Marca, $Estado, $FechaAltaDesde, $FechaAltaHasta, $AgenciaID, $SoloDisponibles)
			$vehiculo1 = new EstrategiaABM();
			$vehiculo1->setInformable(new VehiculosABM(18, "", "", "", "", null, null, "", "", "" , ""));
			$vehiculo1->ejecutarInformacion();
			$this->assertNotNull($vehiculo1, "Informar ok");				
			*/
		}		
		public function testChoferes()
		{
			/*
			//function __construct($personaID, $nombre, $apellido, $documento, $usuario, $password, $telefono, $email, $estado, $agenciaID, $soloDisponibles)
			//RegistrarChofer($Nombre, $Apellido, $Documento, $Usuario, $Password, $Telefono, $Email, $Estado, $AgenciaID)
			
			$chofer1 = new EstrategiaABM();
			$chofer1->setRegistrable(new ChoferesABM(null, "'Fernando'", "'Encina'", "'36757655'", "'ferencina'", "'ferencinas'", "'42505513'", "'ferencina@g.com'", 0, 60, ""));
			$chofer1->ejecutarRegistro();
			$this->assertNotNull($chofer1, "Registrar ok");
			
			//ModificarChofer($PersonaID, $Nombre, $Apellido, $Documento, $Usuario, $Password, $Telefono, $Email, $Estado, $AgenciaID);
			
			$chofer1 = new EstrategiaABM();
			$chofer1->setModificable(new ChoferesABM(30, "'Aldo'", "'Rodriguez'", "'36757656'", "'aldito'", "'aldito'", "'42505512'", "'aldoaldo@g.com'", 0, 60, ""));
			$chofer1->ejecutarModificacion();
			$this->assertNotNull($chofer1, "Modificar ok");			
			
			
			//EliminarChofer($PersonaID)
			$chofer1 = new EstrategiaABM();
			$chofer1->setEliminable(new ChoferesABM(274, null, null, null, null, null, null, null, null, null, null));
			$chofer1->ejecutarEliminacion();
			$this->assertNotNull($chofer1, "Eliminar ok");	
			*/
			
			/*
			//GetInfoChoferes($PersonaID, $Nombre, $Apellido, $Documento, $Usuario, $Telefono, $Email, $Estado, $AgenciaID, $SoloDisponibles)	
			$chofer1 = new EstrategiaABM();
			$chofer1->setInformable(new ChoferesABM(311, "", "", "", "", "", "", "", "", "", ""));
			$chofer1->ejecutarInformacion();
			$this->assertNotNull($chofer1, "Informar ok");				
			*/
		}		

		public function testTarifas()
		{
			//function __construct($tarifaID, $comision, $agenciaID, $viajeMinimo, $kmMinimo, $precioKM, $estado)
			//RegistrarTarifa($Comision, $AgenciaID, $ViajeMinimo, $KmMinimo, $PrecioKM, $Estado)  

			/*
			$tarifas1 = new EstrategiaABM();
			$tarifas1 ->setRegistrable(new TarifasABM(null, 42, 35, "'40'", "'4'", "'15'", 0));
			$tarifas1 ->ejecutarRegistro();
			$this->assertNotNull($tarifas1 , "Registrar ok");		
			*/
			
			/*
			//ModificarTarifa($TarifaID, $Comision, $AgenciaID, $ViajeMinimo, $KmMinimo, $PrecioKM, $Estado)
			
			$tarifas1  = new EstrategiaABM();
			$tarifas1 ->setModificable(new TarifasABM(6, 40, 60, "'50'", "'5'", "'15'", 0));
			$tarifas1 ->ejecutarModificacion();
			$this->assertNotNull($tarifas1 , "Modificar ok");			
			*/
			
			/*
			//EliminarTarifa($TarifaID)
			$tarifas1  = new EstrategiaABM();
			$tarifas1 ->setEliminable(new TarifasABM(8, null, null, null, null, null, null));
			$tarifas1 ->ejecutarEliminacion();
			$this->assertNotNull($tarifas1 , "Eliminar ok");	
			*/
			
			/*
			//GetInfoTarifas($TarifaID, $Comision, $AgenciaID,$ViajeMinimo, $KmMinimo, $PrecioKM, $Estado)
			$tarifas1  = new EstrategiaABM();
			$tarifas1 ->setInformable(new TarifasABM(9, null, null, null, null, null, null));
			$tarifas1 ->ejecutarInformacion();
			$this->assertNotNull($tarifas1 , "Informar ok");				
			*/
		}			
		
}
