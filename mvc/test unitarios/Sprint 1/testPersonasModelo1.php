<?php

include 'C:/xampp/htdocs/simpletest/autorun.php';
include 'C:/xampp/htdocs/web/mvc/models/PersonasModelo.php';


class testPersonasModelo1 extends UnitTestCase{
	
	function testRegistrarPersona(){
		print_r("Prueba RegistrarPersona\n-------------------------\n");
		$test = new PersonasModelo();
		//if($test->RegistrarPersona("'Alf'","'ET'","'gatos'", "'gatos'","'123'", "'alf@tierra.com'", "'otro planeta'","'{fjdsi}'",0,0,4)!=null) echo 'Cliente registrado correctamente!';

		$Registro = $test->RegistrarPersona("'kun'","'kun'","'aguero'", "'kun'","'31213132'", "'ANDATE2@DELASELECCION.com'", "'subcampeon'","'{fjdsi}'",0,0,4);
		$this->assertNotNull($Registro, 'registrar ok');
	}
	/*
	function testModificarPersona(){
		print_r("Prueba ModificarPersona ---------------------------- ");	
		$test = new PersonasModelo();
		//if($test->ModificarPersona(71,"'Santino Alejandro'", "'Mendez'", "'pempin'", "'pempin'","'2543654'", "'prueba@pepe.com'", "'Calle appsp'","'{fjdsi}'",null,0,0,4)!=null) echo 'Cliente modificado correctamente!';

		$info = $test->GetInfoPersonas(145,"","","","","","","","","");
		//print_r($info);
		$Modificacion = $test->ModificarPersona(145,"'Homero'","'Simpsons'","'HOMER'","'HOMER'","'87654'", "'elhomo@g.com'", "'sherviville :O'","'{kjaksh}'",null,0,0,4);
		$this->assertNotNull($Modificacion, 'modificacion ok');
		//print_r($info);
	}

	function testEliminarPersona(){
		print_r("Prueba EliminarPersona\n---------------------------------\n");
		$test = new PersonasModelo();
		//if($test->EliminarPersona(72)!=null) echo 'Cliente eliminado correctamente!';
		$info = $test->GetInfoPersonas(155,"","","","","","","","","");
		//print_r($info);
		$Eliminacion = $test->EliminarPersona(177);
		$this->assertNotNull($Eliminacion, 'eliminacion ok');
		print_r($info); //si el ID eliminado no existe, no imprime nada por pantalla, si existe, con el getInfo lo muestra por pantalla.
	}	

	function testGetInfoPersona(){
		print_r("Prueba GetInfoPersonas ------------------ \n");
		
		$test = new PersonasModelo();

		$GetInfo = $test->GetInfoPersonas(5,"","","","","","","","","");
		$this->assertNotNull($GetInfo, 'info test ok');
		print_r($GetInfo);
	}
		*/
}