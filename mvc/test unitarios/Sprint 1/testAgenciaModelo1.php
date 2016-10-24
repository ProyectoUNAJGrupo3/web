<?php

include 'C:/xampp/htdocs/simpletest/autorun.php';
include 'C:/xampp/htdocs/web/mvc/models/AgenciaModelo.php';

class testAgenciaModelo extends UnitTestCase{
	function testRegistrarAgencia(){
		print_r("Prueba RegistrarAgencia\n-------------------------\n");
		$test = new AgenciaModelo();
		//if($test->RegistrarAgencia("'LilianSilva'","'25 de mayo'", "'{101}'", "'42870730'","'lili@silva.com'", 0)!=null) echo "Agencia registrada correctamente!\n";
		//$this->assertTrue('AgenciaModelo.php');
		//$this->assertEqual($test->RegistrarAgencia("'LilianSilva'","'25 de mayo'", "'{101}'", "'42870730'","'lili@silva.com'", 0));
		
		$Registro = $test->RegistrarAgencia("'Agenciaaaa'","'quilmes'", "'{208}'", "'421111551'","'ag@g.com'", 0);
		$this->assertNotNull($Registro, 'registrar ok');
	}
	/*
	function testModificarAgencia(){
		print_r("Prueba ModificarAgencia\n-------------------------\n");		
		$test = new AgenciaModelo();
		//if($test->ModificarAgencia(14,"'LilianLeonorSilva'","'25 de mayo'", "'{101}'", "'42870730'","'lilian@silva.com'", 0)!=null) echo "\nAgencia modificada correctamente!";
		
		//$info = $test->GetInfoAgencia(19,"","","","","","");
		$Modificacion = $test->ModificarAgencia(50,"'Agencias'","'Miguel cane'", "'{111}'", "'1142870730'","'cane@g.com'", 0);
		$this->assertNotNull($Modificacion, 'modificacion ok');
		//print_r($info);
	}

	function testEliminarAgencia(){
		print_r("Prueba EliminarAgencia\n-------------------------\n");		
		$test = new AgenciaModelo();
		//if($test->EliminarAgencia(14)!=null) echo "\nAgencia eliminada correctamente!";
		$info = $test->GetInfoAgencia(49,"","","","","","");

		$Eliminacion = $test->EliminarAgencia(49);
		$this->assertNotNull($Eliminacion, 'eliminacion ok');
		print_r($info); //si el ID eliminado no existe, no imprime nada por pantalla, si existe, con el getInfo lo muestra por pantalla.
	}	
	function testGetInfoAgencia(){
		print_r("Prueba GetInfoAgencia\n-------------------------\n");		
		$test = new AgenciaModelo();
		//print_r($test->GetInfoAgencia(-1,"","","","","",""));
		
		$GetInfo = $test->GetInfoAgencia(52,"","","","","","");
		$this->assertNotNull($GetInfo, 'info test ok');
		print_r($GetInfo);
	}	
	*/
}