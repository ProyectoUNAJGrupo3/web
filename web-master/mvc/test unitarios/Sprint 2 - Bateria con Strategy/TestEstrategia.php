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
	public function testFinal1() //si el arg es "null" se puede poner el dato, si es "NULL" no poner (debido al constructor)
	{		
		//$a =  class_exists('TestEstrategia2');
		//echo $a;
		//echo 'a';
		
		//PersonaABM($personaID, $nombre, $apellido, $usuario, $password, $telefono, $email, $direccion, $direccionCoordenadas, $direccionDefault, $direccionTipo, $estado, $rolID)
		
		/*$persona1 = new EstrategiaABM();
		$persona1->setRegistrable(new PersonaABM(NULL, "'Beto'", "'betito'", "'Tete'", "'betito'", "'445457555'", "'betito@gmail.com'", "'patio'", "'878918957'", "'guau'", null, 0, 4));
		$persona1->ejecutarRegistro();
		$this->assertNotNull($persona1, "Registrar OK");	

		//$persona2 = new EstrategiaABM();
		//$persona2->setRegistrable(new PersonaABM(NULL, "'Guillermo'", "'guille'", "'Francella'", "'guille'", "'78787'", "'lanenaaaaaa@gmail.com'", "'Racing'", "'87915'", "'Capital Federal'", null, 0, 4));
		//$persona2->ejecutar();
		//$this->assertNotNull($persona2, 'registrar ok');			
		
		$persona1 = new EstrategiaABM();
		$persona1->setModificable(new PersonaABM(235, "'Beto'", "'tete'", "'Tete'", "'tete'", "'445457555'", "'betito@gmail.com'", "'patio'", "'878918957'", "'guau'", null, 0, 4));
		$persona1->ejecutarModificacion();
		$this->assertNotNull($persona1, "Modificar OK"); */	
		
		/*
		$persona1 = new EstrategiaABM();
		$persona1->setEliminable(new PersonaABM(225, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL));
		$persona1->ejecutarEliminacion();
		$this->assertNotNull($persona1, "Eliminar OK");	
		
		
		$persona1 = new EstrategiaABM();
		$persona1->setInformable(new PersonaABM(225, "", "", "", NULL, "", "", "", "", NULL, NULL, "", ""));
		$persona1->ejecutarInformacion();
		$this->assertNotNull($persona1, "Informar OK");		
		*/
		
		
		//AgenciaABM($agenciaID, $nombre, $direccion, $direccionCoordenadas, $telefono, $email, $estado)
		
		/*
		$agencia1 = new EstrategiaABM();
		$agencia1->setRegistrable(new AgenciaABM(NULL, "'Agencia 10'", "'Barracas'", "'2311111511'", "'0980007700000'", "'10@gmail.com'", 0));
		$agencia1->ejecutarRegistro();
		$this->assertNotNull($agencia1, "Registrar ok");		
		
		*/
		$agencia2 = new EstrategiaABM();
		$agencia2->setModificable(new AgenciaABM(45, "'Remis Quilmes'", "'Yrigoyen 455'", "'244445555'", "'42545443'", "'remisquilmes@gmail.com'", 0));
		$agencia2->ejecutarModificacion();
		$this->assertNotNull($agencia2, "Modificar ok");			
		/*
		$agencia3 = new EstrategiaABM();
		$agencia3->setEliminable(new AgenciaABM(42, NULL, NULL, NULL, NULL, NULL, NULL));
		$agencia3->ejecutarEliminacion();
		$this->assertNotNull($agencia3, "Eliminar ok");	
		*/
		$agencia4 = new EstrategiaABM();
		$agencia4->setInformable(new AgenciaABM(45, "", "", "", "", "", ""));
		$agencia4->ejecutarInformacion();
		$this->assertNotNull($agencia4, "Informar ok");		
		
	}
}

class TestEstrategia2 extends UnitTestCase
{	
		public function testFinal2()
	{

	}
	
	
}
   
//}
