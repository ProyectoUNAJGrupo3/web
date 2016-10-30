<?php
//namespace unitarias\tests\
include 'Operaciones.php';
include 'PersonasModelo.php';
include 'AgenciaModelo.php';


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
    public function informar(); //implementa solo en persona
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
	
	
	public function __construct($personaID, $nombre, $apellido, $usuario, $password, $telefono, $email, $direccion, $direccionCoordenadas, $direccionDefault, $direccionTipo, $estado, $rolID)
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

	}
	
	
	public function registrar()
	{	
		$personasModelo = new PersonasModelo();	
		$personasModelo->RegistrarPersona($this->nombre, $this->apellido, $this->usuario, $this->password, $this->telefono, $this->email, $this->direccion, $this->direccionCoordenadas, $this->direccionDefault, $this->estado, $this->rolID);
		echo $this->nombre . " es la nueva persona registrada. ";
	}	
	
	public function modificar()
	{
		
		$personasModelo = new PersonasModelo();	
		$personasModelo->ModificarPersona($this->personaID, $this->nombre, $this->apellido, $this->usuario,$this->password, $this->telefono, $this->email, $this->direccion, $this->direccionCoordenadas, $this->direccionDefault, $this->direccionTipo, $this->estado, $this->rolID);
		echo " La persona con ID: ", $this->personaID . " es la persona actualizada";		
	}

	public function eliminar()
	{
		$personasModelo = new PersonasModelo();	
		$personasModelo->EliminarPersona($this->personaID);
		echo "La persona con ID: ", $this->personaID . " ha sido eliminada.";
		//echo " Informacion eliminada: ";
		//print_r($personasModelo->GetInfoPersonas($this->personaID, $this->nombre, $this->apellido, $this->usuario, $this->telefono, $this->email, $this->direccion, $this->direccionCoordenadas, $this->estado, $this->rolID));		
	}	
	public function informar()
	{
		$personasModelo = new PersonasModelo();	
		echo " Informacion de persona solicitada: ";
		print_r($personasModelo->GetInfoPersonas($this->personaID, $this->nombre, $this->apellido, $this->usuario, $this->telefono, $this->email, $this->direccion, $this->direccionCoordenadas, $this->estado, $this->rolID));
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
		$agenciaModelo = new AgenciaModelo();		
		$agenciaModelo->RegistrarAgencia($this->nombre, $this->direccion, $this->direccionCoordenadas, $this->telefono, $this->email, $this->estado);		 
		echo $this->nombre . " es la nueva agencia registrada. "; 
	}
	public function modificar()
	{
		$agenciaModelo = new AgenciaModelo();
		$agenciaModelo->ModificarAgencia($this->agenciaID, $this->nombre, $this->direccion, $this->direccionCoordenadas, $this->telefono, $this->email, $this->estado);
		echo " La agencia con ID: ", $this->agenciaID . " ha sido actualizada. ";
	}

	public function eliminar()
	{
		$agenciaModelo = new AgenciaModelo();	
		$agenciaModelo->EliminarAgencia($this->agenciaID);
		echo " La agencia con ID: ", $this->agenciaID . " ha sido eliminada. ";	
		//print_r(" Informacion solicitada: ", $agenciaModelo->GetInfoAgencia($this->agenciaID, $this->nombre, $this->direccion, $this->direccionCoordenadas, $this->telefono, $this->email, $this->estado));		
	}		
	public function informar()
	{
		$agenciaModelo = new AgenciaModelo();	
		$agenciaModelo->GetInfoAgencia($this->agenciaID, $this->nombre, $this->direccion, $this->direccionCoordenadas, $this->telefono, $this->email, $this->estado);	
		echo " Informacion de agencia solicitada: ";
		print_r($agenciaModelo->GetInfoAgencia($this->agenciaID, $this->nombre, $this->direccion, $this->direccionCoordenadas, $this->telefono, $this->email, $this->estado));
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

