<?php
//namespace unitarias\tests\
include 'Operaciones.php';
include 'PersonasModelo.php';
include 'AgenciaModelo.php';
include 'ViajesModelo.php';
include 'VehiculosModelo.php';
include 'ChoferesModelo.php';
include 'TarifasModelo.php';


interface Registrable
{
    function registrar();
}

interface Modificable
{
    function modificar(); 
}

interface Eliminable
{
    function eliminar();
}	

interface Informable
{
    public function informar();
}

class PersonaABM implements Registrable, Modificable, Eliminable, Informable
{
	private $personaID;	
	private $nombre;
	private $apellido;
	private $usuario; 
	private $password;
	private $telefono;
	private $email;
	private $direccion;
	private $direccionCoordenadas;
	private $direccionDefault;
	private $direccionTipo;
	private $estado;
	private $rolID;
	private $documento;
	private $agenciaID;
	
	
	public function __construct($personaID, $nombre, $apellido, $usuario, $password, $telefono, $email, $direccion, $direccionCoordenadas, $direccionDefault, $direccionTipo, $estado, $rolID, $documento, $agenciaID)
	{
		$this->personaID 				= $personaID;	
		$this->nombre 					= $nombre;
		$this->apellido 				= $apellido;
		$this->usuario 					= $usuario;
		$this->password 				= $password;
		$this->telefono 				= $telefono;
		$this->email 					= $email;
		$this->direccion 				= $direccion;
		$this->direccionCoordenadas 	= $direccionCoordenadas;
		$this->direccionDefault 		= $direccionDefault;
		$this->direccionTipo			= $direccionTipo;		
		$this->estado 					= $estado;
		$this->rolID 					= $rolID;		
		$this->documento				= $documento;
		$this->agenciaID				= $agenciaID;	

	}
	
	
	public function registrar()
	{	
		//RegistrarPersona($Nombre, $Apellido, $Usuario, $Password, $Telefono, $Email, $Direccion, $DireccionCoordenadas, $DireccionDefault, $Estado, $RolID, $Documento, $AgenciaID)
		
		/*try {
			throw new Exception('Unexpected PHP Error');
		} 
		catch (Exception $e) {
			echo 'PERSONA YA REGISTRADA. ';
		}*/
		$personasModelo = new PersonasModelo();		
		$personasModelo->RegistrarPersona($this->nombre, $this->apellido, $this->usuario, $this->password, $this->telefono, $this->email, $this->direccion, $this->direccionCoordenadas, $this->direccionDefault, $this->estado, $this->rolID, $this->documento, $this->agenciaID);		
					
		
		echo " ", $this->nombre . " es la persona registrada. ";
		echo $this->documento . " es el DNI de la persona. ";			
	}	
	
	public function modificar()
	{
		//ModificarPersona($PersonaID, $Nombre, $Apellido, $Usuario, $Password, $Telefono, $Email, $Direccion, $DireccionCoordenadas, $DireccionDefault, $DireccionTipo, $Estado, $RolID, $Documento, $AgenciaID)
		$personasModelo = new PersonasModelo();	
		$personasModelo->ModificarPersona($this->personaID, $this->nombre, $this->apellido, $this->usuario,$this->password, $this->telefono, $this->email, $this->direccion, $this->direccionCoordenadas, $this->direccionDefault, $this->direccionTipo, $this->estado, $this->rolID, $this->documento, $this->agenciaID);
		echo " La persona con ID: ", $this->personaID . " es la persona actualizada";		
	}

	public function eliminar()
	{
		//EliminarPersona($PersonaID)
		$personasModelo = new PersonasModelo();	
		$personasModelo->EliminarPersona($this->personaID);
		echo " La persona con ID: ", $this->personaID . " ha sido eliminada.";
		//echo " Informacion eliminada: ";
		//print_r($personasModelo->GetInfoPersonas($this->personaID, $this->nombre, $this->apellido, $this->usuario, $this->telefono, $this->email, $this->direccion, $this->direccionCoordenadas, $this->estado, $this->rolID));		
	}	
	public function informar()
	{
		//GetInfoPersonas($PersonaID, $Nombre, $Apellido, $Usuario, $Telefono, $Email, $Direccion, $DireccionCoordenadas, $Estado, $RolID, $Documento, $AgenciaID)
		$personasModelo = new PersonasModelo();	
		echo " Informacion de persona solicitada: ";
		print_r($personasModelo->GetInfoPersonas($this->personaID, $this->nombre, $this->apellido, $this->usuario, $this->telefono, $this->email, $this->direccion, $this->direccionCoordenadas, $this->estado, $this->rolID, $this->documento, $this->agenciaID));
	}
}

class AgenciaABM implements Registrable, Modificable, Eliminable, Informable
{
	private $agenciaID;
	private $nombre;
	private $direccion;
	private $direccionCoordenadas;
	private $telefono;
	private $email;
	private $estado;

	
	public function __construct($agenciaID, $nombre, $direccion, $direccionCoordenadas, $telefono, $email, $estado)
	{
		$this->agenciaID 				= $agenciaID;		
		$this->nombre 					= $nombre;
		$this->direccion 				= $direccion;
		$this->direccionCoordenadas 	= $direccionCoordenadas;		
		$this->telefono 				= $telefono;
		$this->email 					= $email;
		$this->estado 					= $estado;
	}
	
	public function registrar()
	{
		//RegistrarAgencia($Nombre, $Direccion, $DireccionCoordenadas , $Telefono, $Email, $Estado)  
		/*try {
			throw new Exception('Unexpected PHP Error');
					
		} 
		catch (Exception $e) {
			echo 'AGENCIA YA REGISTRADA. ';
		}	*/	
		$agenciaModelo = new AgenciaModelo();		
		$agenciaModelo->RegistrarAgencia($this->nombre, $this->direccion, $this->direccionCoordenadas, $this->telefono, $this->email, $this->estado);			
		echo " ", $this->nombre . " es la agencia registrada. "; 
	}
	public function modificar()
	{
		//ModificarAgencia($AgenciaID, $Nombre,$Direccion, $DireccionCoordenadas,$Telefono, $Email,  $Estado )
		$agenciaModelo = new AgenciaModelo();
		$agenciaModelo->ModificarAgencia($this->agenciaID, $this->nombre, $this->direccion, $this->direccionCoordenadas, $this->telefono, $this->email, $this->estado);
		echo " La agencia con ID: ", $this->agenciaID . " ha sido actualizada. ";
	}

	public function eliminar()
	{
		//EliminarAgencia($AgenciaID)
		$agenciaModelo = new AgenciaModelo();	
		$agenciaModelo->EliminarAgencia($this->agenciaID);
		echo " La agencia con ID: ", $this->agenciaID . " ha sido eliminada. ";	
		//print_r(" Informacion solicitada: ", $agenciaModelo->GetInfoAgencia($this->agenciaID, $this->nombre, $this->direccion, $this->direccionCoordenadas, $this->telefono, $this->email, $this->estado));		
	}		
	public function informar()
	{
		//GetInfoAgencia($AgenciaID, $Nombre, $Direccion, $DireccionCoordenadas, $Telefono, $Email, $Estado)
		$agenciaModelo = new AgenciaModelo();	
		$agenciaModelo->GetInfoAgencia($this->agenciaID, $this->nombre, $this->direccion, $this->direccionCoordenadas, $this->telefono, $this->email, $this->estado);	
		echo " Informacion de agencia solicitada: ";
		print_r($agenciaModelo->GetInfoAgencia($this->agenciaID, $this->nombre, $this->direccion, $this->direccionCoordenadas, $this->telefono, $this->email, $this->estado));
	}
}

class ViajesABM implements Registrable, Modificable, Eliminable, Informable
{
	private $viajeID;
	private $choferID;
	private $vehiculoID;
	private $tarifaID;
	private $turnoID;
	private $agenciaID;
	private $personaID;
	private $fechaEmision;
	private $fechaSalida;
	private $fechaEmisionDesde;
	private $fechaEmisionHasta;
	private $fechaSalidaDesde;		
	private $fechaSalidaHasta;		
	private $viajeTipo;
	private $origenCoordenadas;
	private $destinoCoordenadas;
	private $origenDireccion;
	private $destinoDireccion;
	private $comentario;	
	private $importeTotal;
	private $distancia;
	private $estado;	
	
	public function __construct($viajeID, $choferID, $vehiculoID, $tarifaID, $turnoID, $agenciaID, $personaID, $fechaEmision, $fechaSalida, $fechaEmisionDesde, $fechaEmisionHasta, $fechaSalidaDesde, $fechaSalidaHasta, $viajeTipo, $origenCoordenadas, $destinoCoordenadas, $origenDireccion, $destinoDireccion, $comentario, $importeTotal, $distancia, $estado)
	{
		$this->viajeID					= $viajeID;
		$this->choferID					= $choferID;
		$this->vehiculoID 				= $vehiculoID;		
		$this->tarifaID					= $tarifaID;
		$this->turnoID					= $turnoID;
		$this->agenciaID				= $agenciaID;		
		$this->personaID				= $personaID;
		$this->fechaEmision				= $fechaEmision;
		$this->fechaSalida				= $fechaSalida;
		$this->fechaEmisionDesde		= $fechaEmisionDesde;
		$this->fechaEmisionHasta		= $fechaEmisionHasta;
		$this->fechaSalidaDesde			= $fechaSalidaDesde;		
		$this->fechaSalidaHasta			= $fechaSalidaHasta;		
		$this->viajeTipo 				= $viajeTipo;		
		$this->origenCoordenadas		= $origenCoordenadas;
		$this->destinoCoordenadas		= $destinoCoordenadas;
		$this->origenDireccion 			= $origenDireccion;		
		$this->destinoDireccion			= $destinoDireccion;
		$this->comentario				= $comentario;
		$this->importeTotal				= $importeTotal;
		$this->distancia				= $distancia;
		$this->estado 					= $estado;		
	}
	
	public function registrar()
	{
		//RegistrarViaje($ChoferID, $VehiculoID, $TarifaID, $TurnoID, $AgenciaID, $PersonaID, $FechaEmision, $FechaSalida, $ViajeTipo, $OrigenCoordenadas, $DestinoCoordenadas, $OrigenDireccion, $DestinoDireccion, $Comentario, $ImporteTotal, $Distancia, $Estado)  	
		/*try {
			throw new Exception('Unexpected PHP Error');
		} 
		catch (Exception $e) {
			echo 'VIAJE YA REGISTRADO. ';
		}	*/
		$viajeModelo = new ViajesModelo();	
		$viajeModelo->RegistrarViaje($this->choferID, $this->vehiculoID, $this->tarifaID, $this->turnoID, $this->agenciaID, $this->personaID , $this->fechaEmision , $this->fechaSalida , $this->viajeTipo , $this->origenCoordenadas , $this->destinoCoordenadas , $this->origenDireccion , $this->destinoDireccion, $this->comentario, $this->importeTotal, $this->distancia, $this->estado);		 
		echo " Se registro el viaje desde " . $this->origenDireccion . " hasta " . $this->destinoDireccion . ". ";
	}
	public function modificar()
	{
		//ModificarViaje($ViajeID, $ChoferID, $VehiculoID, $TarifaID, $TurnoID, $AgenciaID, $PersonaID, $FechaEmision, $FechaSalida, $ViajeTipo, $OrigenCoordenadas, $DestinoCoordenadas, $OrigenDireccion, $DestinoDireccion, $Comentario, $ImporteTotal, $Distancia, $Estado)
		$viajesModelo = new ViajesModelo();
		$viajesModelo->ModificarViaje($this->viajeID, $this->choferID, $this->vehiculoID, $this->tarifaID, $this->turnoID, $this->agenciaID, $this->personaID , $this->fechaEmision , $this->fechaSalida , $this->viajeTipo , $this->origenCoordenadas , $this->destinoCoordenadas , $this->origenDireccion , $this->destinoDireccion, $this->comentario, $this->importeTotal, $this->distancia, $this->estado);
		echo " El viaje con ID: ", $this->viajeID . " ha sido actualizado. ";
	}

	public function eliminar()
	{
		//EliminarViaje($ViajeID)
		$viajesModelo = new ViajesModelo();	
		$viajesModelo->EliminarViaje($this->viajeID);
		echo " El viaje con ID: ", $this->viajeID . " ha sido eliminado. ";	
		//print_r(" Informacion solicitada: ", $agenciaModelo->GetInfoAgencia($this->agenciaID, $this->nombre, $this->direccion, $this->direccionCoordenadas, $this->telefono, $this->email, $this->estado));		
	}		
	public function informar()
	{
		//GetInfoViajes($ViajeID, $ChoferID, $VehiculoID, $TarifaID, $TurnoID, $AgenciaID, $PersonaID, $FechaEmisionDesde, $FechaEmisionHasta, $FechaSalidaDesde, $FechaSalidaHasta, $ViajeTipo, $OrigenCoordenadas, $DestinoCoordenadas, $OrigenDireccion, $DestinoDireccion, $Comentario, $ImporteTotal, $Distancia, $Estado)
		$viajesModelo = new ViajesModelo();	
		echo " Informacion de viaje solicitado: ";
		print_r($viajesModelo->GetInfoViajes($this->viajeID, $this->choferID, $this->vehiculoID, $this->tarifaID, $this->turnoID, $this->agenciaID, $this->personaID , $this->fechaEmisionDesde , $this->fechaEmisionHasta , $this->fechaSalidaDesde , $this->fechaSalidaHasta ,$this->viajeTipo , $this->origenCoordenadas , $this->destinoCoordenadas , $this->origenDireccion , $this->destinoDireccion, $this->comentario, $this->importeTotal, $this->distancia, $this->estado));
	}	
	
}

class ChoferesABM implements Informable //Registrable, Modificable, Eliminable			SOLO PARA EL GETINFO, ya que los demas metodos se pueden hacer desde PersonasModelo
{
	private $personaID;
	private $nombre;
	private $apellido;		
	private $documento;
	private $usuario;
	private $password;		
	private $telefono;
	private $email;
	private $estado;
	private $agenciaID;
	private $soloDisponibles;
	
	public function __construct($personaID, $nombre, $apellido, $documento, $usuario, $password, $telefono, $email, $estado, $agenciaID, $soloDisponibles)
	{
		$this->personaID			= $personaID;
		$this->nombre				= $nombre;
		$this->apellido 			= $apellido;		
		$this->documento			= $documento;
		$this->usuario				= $usuario;
		$this->password				= $password;		
		$this->telefono				= $telefono;
		$this->email				= $email;
		$this->estado				= $estado;
		$this->agenciaID			= $agenciaID;
		$this->soloDisponibles		= $soloDisponibles;
	}
	
	public function registrar()
	{
		/*
		//RegistrarChofer($Nombre, $Apellido, $Documento, $Usuario, $Password, $Telefono, $Email, $Estado, $AgenciaID)		
		$choferModelo = new ChoferesModelo();		
		$choferModelo->RegistrarChofer($this->nombre, $this->apellido, $this->documento, $this->usuario, $this->password, $this->telefono, $this->email , $this->estado , $this->agenciaID);		 
		echo " Se registro el chofer " . $this->nombre . ". ";
		*/
	}
	public function modificar()
	{
		/*
		//ModificarChofer($PersonaID, $Nombre, $Apellido, $Documento, $Usuario, $Password, $Telefono, $Email, $Estado, $AgenciaID)		
		$choferModelo = new ChoferesModelo();
		$choferModelo->ModificarChofer($this->personaID, $this->nombre, $this->apellido, $this->documento, $this->usuario, $this->password, $this->telefono , $this->email , $this->estado , $this->agenciaID);
		echo " El chofer con ID: ", $this->personaID . " ha sido actualizado. ";
		*/
	}

	public function eliminar()
	{
		/*
		//EliminarChofer($PersonaID)
		$choferModelo = new ChoferesModelo();	
		$choferModelo->EliminarChofer($this->personaID);
		echo " El chofer con ID: ", $this->personaID . " ha sido eliminado. ";	
		*/
	}		
	public function informar()
	{
		//GetInfoChoferes($PersonaID, $Nombre, $Apellido, $Documento, $Usuario, $Telefono, $Email, $Estado, $AgenciaID/*, $VehiculoID*/, $SoloDisponibles)		
		$choferModelo = new ChoferesModelo();	
		echo " Informacion de chofer solicitado: ";
		print_r($choferModelo->GetInfoChoferes($this->personaID, $this->nombre, $this->apellido, $this->documento, $this->usuario, $this->telefono , $this->email , $this->estado , $this->agenciaID, $this->soloDisponibles));
	}		
}


class VehiculosABM implements Registrable, Modificable, Eliminable, Informable
{
	private $vehiculoID;
	private $matricula;
	private $modelo;
	private $marca;
	private $estado;		
	private $fechaAlta;
	private $fechaBaja;
	private $fechaAltaDesde;
	private $fechaAltaHasta;		
	private $agenciaID;
	private $soloDisponibles;
	
	public function __construct($vehiculoID, $matricula, $modelo, $marca, $estado, $fechaAlta, $fechaBaja, $fechaAltaDesde, $fechaAltaHasta, $agenciaID, $soloDisponibles)
	{
		$this->vehiculoID				= $vehiculoID;
		$this->matricula				= $matricula;
		$this->modelo 					= $modelo;		
		$this->marca					= $marca;
		$this->estado					= $estado;
		$this->fechaAlta				= $fechaAlta;		
		$this->fechaBaja				= $fechaBaja;
		$this->fechaAltaDesde			= $fechaAltaDesde;
		$this->fechaAltaHasta			= $fechaAltaHasta;
		$this->agenciaID				= $agenciaID;
		$this->soloDisponibles			= $soloDisponibles;
	}
	
	public function registrar()
	{
		//RegistrarVehiculo($Matricula, $Modelo, $Marca, $Estado, $FechaAlta, $FechaBaja, $AgenciaID)		
		/*try {
			throw new Exception('Unexpected PHP Error');				
		} 
		catch (Exception $e) {
			echo 'VEHICULO YA REGISTRADO. ';
		}		*/	
		$vehiculoModelo = new VehiculosModelo();
		$vehiculoModelo->RegistrarVehiculo($this->matricula, $this->modelo, $this->marca, $this->estado, $this->fechaAlta, $this->fechaBaja , $this->agenciaID);		
		echo " Vehiculo registrado con matricula " . $this->matricula . " y marca " . $this->marca . ". ";
	}
	public function modificar()
	{
		//ModificarVehiculo($VehiculoID, $Matricula, $Modelo, $Marca, $Estado, $FechaAlta, $FechaBaja, $AgenciaID)
		$vehiculoModelo = new VehiculosModelo();
		$vehiculoModelo->ModificarVehiculo($this->vehiculoID, $this->matricula, $this->modelo, $this->marca, $this->estado, $this->fechaAlta, $this->fechaBaja , $this->agenciaID);
		echo " El vehiculo con ID: ", $this->vehiculoID . " ha sido actualizado. ";
	}

	public function eliminar()
	{
		//EliminarVehiculo($VehiculoID)
		$vehiculoModelo = new VehiculosModelo();	
		$vehiculoModelo->EliminarVehiculo($this->vehiculoID);
		echo " El vehiculo con ID: ", $this->vehiculoID . " ha sido eliminado. ";	
		//print_r(" Informacion solicitada: ", $agenciaModelo->GetInfoAgencia($this->agenciaID, $this->nombre, $this->direccion, $this->direccionCoordenadas, $this->telefono, $this->email, $this->estado));		
	}		
	public function informar()
	{
		//GetInfoVehiculos($VehiculoID, $Matricula, $Modelo, $Marca, $Estado, $FechaAltaDesde, $FechaAltaHasta, $AgenciaID, $SoloDisponibles)
		$vehiculoModelo = new VehiculosModelo();	
		echo " Informacion de vehiculo solicitado: ";
		print_r($vehiculoModelo->GetInfoVehiculos($this->vehiculoID, $this->matricula, $this->modelo, $this->marca, $this->estado, $this->fechaAltaDesde, $this->fechaAltaHasta , $this->agenciaID, $this->soloDisponibles));
	}	
}	


class TarifasABM implements Registrable, Modificable, Eliminable, Informable
{
	private $tarifaID;
	private $comision;
	private $agenciaID;
	private $viajeMinimo;
	private $kmMinimo;
	private $precioKM;
	private $estado;
	
	
	public function __construct($tarifaID, $comision, $agenciaID, $viajeMinimo, $kmMinimo, $precioKM, $estado)
	{
		$this->tarifaID					= $tarifaID;
		$this->comision					= $comision;
		$this->agenciaID 				= $agenciaID;		
		$this->viajeMinimo				= $viajeMinimo;
		$this->kmMinimo					= $kmMinimo;
		$this->precioKM					= $precioKM;		
		$this->estado					= $estado;
	}
	
	public function registrar()
	{
		//RegistrarTarifa($Comision, $AgenciaID, $ViajeMinimo, $KmMinimo, $PrecioKM, $Estado)  
		/*try {
			throw new Exception('Unexpected PHP Error');				
		} 
		catch (Exception $e) {
			echo 'TARIFA YA REGISTRADA. ';
		}		*/		
		$tarifaModelo = new TarifasModelo();
		$tarifaModelo->RegistrarTarifa($this->comision, $this->agenciaID, $this->viajeMinimo, $this->kmMinimo, $this->precioKM, $this->estado);		
		echo " Tarifa registrada de agencia con ID " . $this->agenciaID . " de viaje minimo " . $this->viajeMinimo . ". ";
	}
	public function modificar()
	{
		//ModificarTarifa($TarifaID, $Comision, $AgenciaID, $ViajeMinimo, $KmMinimo, $PrecioKM, $Estado)
		$tarifaModelo = new TarifasModelo();
		$tarifaModelo->ModificarTarifa($this->tarifaID, $this->comision, $this->agenciaID, $this->viajeMinimo, $this->kmMinimo, $this->precioKM, $this->estado);
		echo " La tarifa con ID: ", $this->tarifaID . " ha sido actualizada. ";
	}

	public function eliminar()
	{
		//EliminarTarifa($TarifaID)
		$tarifaModelo = new TarifasModelo();	
		$tarifaModelo->EliminarTarifa($this->tarifaID);
		echo " La tarifa con ID: ", $this->tarifaID . " ha sido eliminada. ";	
		//print_r(" Informacion solicitada: ", $agenciaModelo->GetInfoAgencia($this->agenciaID, $this->nombre, $this->direccion, $this->direccionCoordenadas, $this->telefono, $this->email, $this->estado));		
	}		
	public function informar()
	{
		//GetInfoTarifas($TarifaID, $Comision, $AgenciaID,$ViajeMinimo, $KmMinimo, $PrecioKM, $Estado)
		$tarifaModelo = new TarifasModelo();	
		echo " Informacion de tarifa solicitada es: ";
		print_r($tarifaModelo->GetInfoTarifas($this->tarifaID, $this->comision, $this->agenciaID, $this->viajeMinimo, $this->kmMinimo, $this->precioKM, $this->estado));
	}		
}	

	

class EstrategiaABM
{
	private $registrable;
	private $modificable;
	private $eliminable;
	private $informable;

	
	public function setRegistrable(Registrable $registrable)
	{		
		$this->registrable = $registrable;
	}
	
	public function setModificable(Modificable $modificable)
	{		
		$this->modificable = $modificable;
	}
	
	public function setEliminable(Eliminable $eliminable)
	{		
		$this->eliminable = $eliminable;
	}	
	public function setInformable(Informable $informable)
	{		
		$this->informable = $informable;
	}	
	
	public function ejecutarRegistro()
	{
		$this->registrable->registrar();
	}
	
	public function ejecutarModificacion()
	{
		$this->modificable->modificar();
	}

	public function ejecutarEliminacion()
	{
		$this->eliminable->eliminar();
	}	
	public function ejecutarInformacion()
	{
		$this->informable->informar();
	}		

}

