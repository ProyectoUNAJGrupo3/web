CREATE DATABASE  IF NOT EXISTS `unaj_proyecto` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `unaj_proyecto`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win32 (AMD64)
--
-- Host: 192.99.203.134    Database: unaj_proyecto
-- ------------------------------------------------------
-- Server version	5.5.50-cll

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Agencias`
--

DROP TABLE IF EXISTS `Agencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agencias` (
  `AgenciaID` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) CHARACTER SET utf8 NOT NULL,
  `Telefono` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `Email` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `Estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`AgenciaID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_bin DELAY_KEY_WRITE=1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Agencias`
--

LOCK TABLES `Agencias` WRITE;
/*!40000 ALTER TABLE `Agencias` DISABLE KEYS */;
INSERT INTO `Agencias` VALUES (1,'51834','553153','pipi@remis.com',0),(2,'O\'Clock Remis','011 4287-7331','oclock@remisys.com.ar',0),(10,'Prueba',NULL,'prueba@unaj.com',0),(11,'taREmis','45411266','TAREmis@gmail.com',0);
/*!40000 ALTER TABLE `Agencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Calificaciones`
--

DROP TABLE IF EXISTS `Calificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Calificaciones` (
  `CalificacionID` int(11) NOT NULL AUTO_INCREMENT,
  `ViajeID` int(11) NOT NULL,
  `Quien` int(11) NOT NULL,
  `ParaQuien` int(11) NOT NULL,
  `Puntaje` int(11) NOT NULL,
  `Fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Comentario` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`CalificacionID`),
  KEY `fk_Calificaciones_Viajes1_idx` (`ViajeID`),
  KEY `fk_Calificaciones_PersonasQuien_idx` (`Quien`),
  KEY `afds_idx` (`ParaQuien`),
  CONSTRAINT `fk_Calificaciones_PersonasParaQuien` FOREIGN KEY (`ParaQuien`) REFERENCES `Personas` (`PersonaID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Calificaciones_PersonasQuien` FOREIGN KEY (`Quien`) REFERENCES `Personas` (`PersonaID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Calificaciones_Viajes` FOREIGN KEY (`ViajeID`) REFERENCES `Viajes` (`ViajeID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Calificaciones`
--

LOCK TABLES `Calificaciones` WRITE;
/*!40000 ALTER TABLE `Calificaciones` DISABLE KEYS */;
INSERT INTO `Calificaciones` VALUES (2,1,1,1,5,NULL,'PPEPEPEPPEPE');
/*!40000 ALTER TABLE `Calificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Direcciones`
--

DROP TABLE IF EXISTS `Direcciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Direcciones` (
  `DireccionID` int(11) NOT NULL AUTO_INCREMENT,
  `Direccion` varchar(200) NOT NULL,
  `DireccionCoordenada` varchar(200) NOT NULL,
  `DireccionDefault` tinyint(4) NOT NULL COMMENT '1 - Es la direccion por defecto.\n0 - Es una de las direcciones del Cliente/Agencia.',
  `DireccionTipo` tinyint(4) NOT NULL COMMENT '0 - Direccion de Cliente.\n1 - Direccion de Agencia.',
  `AplicacionID` int(11) NOT NULL COMMENT 'Corresponde al ID del registro segun el DireccionTipo.\n\nEj: \nSi DireccionTipo= 0 entonces AplicacionID contiene el ID de una Persona.\nSi DireccionTipo = 1 entonces AplicacionID contiene el ID de una Agencia.',
  PRIMARY KEY (`DireccionID`),
  KEY `fk_Direcciones_Agecias_idx` (`AplicacionID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 KEY_BLOCK_SIZE=8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Direcciones`
--

LOCK TABLES `Direcciones` WRITE;
/*!40000 ALTER TABLE `Direcciones` DISABLE KEYS */;
INSERT INTO `Direcciones` VALUES (1,'Calle Lopez 1444','[{Latitud:25165.1651651, Longitud:34611.354}]',1,0,1),(2,'Calle Perez 1555','[{Latitud:252435.1651651, Longitud:67511.354}]',1,1,1);
/*!40000 ALTER TABLE `Direcciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Personas`
--

DROP TABLE IF EXISTS `Personas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Personas` (
  `PersonaID` int(11) NOT NULL,
  `Usuario` varchar(45) DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Telefono` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `RolID` int(11) NOT NULL,
  PRIMARY KEY (`PersonaID`),
  KEY `fk_Personas_Roles_idx` (`RolID`),
  CONSTRAINT `fk_Personas_Roles` FOREIGN KEY (`RolID`) REFERENCES `Roles` (`RolID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Personas`
--

LOCK TABLES `Personas` WRITE;
/*!40000 ALTER TABLE `Personas` DISABLE KEYS */;
INSERT INTO `Personas` VALUES (1,'emendez','emendez','Mendez Alejandro Ezequiel','42744254','mendezalejandro.e@gmail.com',1),(2,'lsilva','lsilva','Lilian Silva','42744466','lilian@gmail.com',2),(3,'arodriguez','arodriguez','Aldo Rodriguez',NULL,NULL,3),(4,'imorales','imorales','Ignacio Morales',NULL,NULL,4),(5,'bvitucci','bvitucci','Bruno Vitucci',NULL,NULL,4);
/*!40000 ALTER TABLE `Personas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Roles`
--

DROP TABLE IF EXISTS `Roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Roles` (
  `RolID` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`RolID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Roles`
--

LOCK TABLES `Roles` WRITE;
/*!40000 ALTER TABLE `Roles` DISABLE KEYS */;
INSERT INTO `Roles` VALUES (1,'Administrador'),(2,'Recepcionista'),(3,'Chofer'),(4,'Cliente');
/*!40000 ALTER TABLE `Roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Tarifas`
--

DROP TABLE IF EXISTS `Tarifas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Tarifas` (
  `TarifaID` int(11) NOT NULL AUTO_INCREMENT,
  `Comision` double DEFAULT NULL,
  `AgenciaID` int(11) NOT NULL,
  `ViajeMinimo` double DEFAULT NULL,
  `KmMinimo` double DEFAULT NULL,
  `PrecioKM` double NOT NULL,
  `Estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`TarifaID`),
  KEY `fk_Tarifas_Agencias_idx` (`AgenciaID`),
  CONSTRAINT `fk_Tarifas_Agencias` FOREIGN KEY (`AgenciaID`) REFERENCES `Agencias` (`AgenciaID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tarifas`
--

LOCK TABLES `Tarifas` WRITE;
/*!40000 ALTER TABLE `Tarifas` DISABLE KEYS */;
INSERT INTO `Tarifas` VALUES (1,20,1,100,5,10.5,0),(2,35,2,80,4,8,0),(3,15,1,90,10,14,0);
/*!40000 ALTER TABLE `Tarifas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Turnos`
--

DROP TABLE IF EXISTS `Turnos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Turnos` (
  `TurnoID` int(11) NOT NULL AUTO_INCREMENT,
  `PersonaID` int(11) NOT NULL,
  `FechaApertura` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FechaCierre` datetime DEFAULT NULL,
  `Estado` tinyint(4) NOT NULL COMMENT '0 - Abierta\n1 - Cerrada',
  PRIMARY KEY (`TurnoID`),
  KEY `fk_Turnos_Personas1_idx` (`PersonaID`),
  CONSTRAINT `fk_Turnos_Personas` FOREIGN KEY (`PersonaID`) REFERENCES `Personas` (`PersonaID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Turnos`
--

LOCK TABLES `Turnos` WRITE;
/*!40000 ALTER TABLE `Turnos` DISABLE KEYS */;
INSERT INTO `Turnos` VALUES (1,2,'2016-08-26 02:00:00','2016-09-11 16:56:00',0),(2,2,'2016-09-11 23:00:00',NULL,0);
/*!40000 ALTER TABLE `Turnos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Vehiculos`
--

DROP TABLE IF EXISTS `Vehiculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Vehiculos` (
  `VehiculoID` int(11) NOT NULL AUTO_INCREMENT,
  `Matricula` varchar(45) DEFAULT NULL,
  `Modelo` varchar(45) DEFAULT NULL,
  `Marca` varchar(45) DEFAULT NULL,
  `Estado` tinyint(4) NOT NULL,
  `FechaAlta` datetime NOT NULL,
  `FechaBaja` datetime DEFAULT NULL,
  PRIMARY KEY (`VehiculoID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Vehiculos`
--

LOCK TABLES `Vehiculos` WRITE;
/*!40000 ALTER TABLE `Vehiculos` DISABLE KEYS */;
INSERT INTO `Vehiculos` VALUES (1,'GIM268','2016','Renault',0,'2016-08-31 23:00:00',NULL),(2,'TOR345','2015','Fiat Punto',0,'2016-08-31 23:00:00',NULL);
/*!40000 ALTER TABLE `Vehiculos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Viajes`
--

DROP TABLE IF EXISTS `Viajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Viajes` (
  `ViajeID` int(11) NOT NULL AUTO_INCREMENT,
  `ChoferID` int(11) DEFAULT NULL,
  `VehiculoID` int(11) DEFAULT NULL,
  `TarifaID` int(11) NOT NULL,
  `TurnoID` int(11) NOT NULL,
  `AgenciaID` int(11) NOT NULL,
  `PersonaID` int(11) DEFAULT NULL COMMENT 'Si el viaje solicitado es manualmente (Personal o por Telefono) el usuario puede ser NULL ya que no se tiene registro en ese momento.',
  `FechaEmision` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `FechaSalida` datetime DEFAULT NULL,
  `ViajeTipo` tinyint(4) NOT NULL COMMENT 'Viajes solicitados con la siguiente modalidad:\n\n0 - Web\n1 - Personal\n2 - Telefonico',
  `OrigenCoordenadas` varchar(200) DEFAULT NULL,
  `DestinoCoordenadas` varchar(200) DEFAULT NULL,
  `OrigenDireccion` varchar(200) DEFAULT NULL,
  `DestinoDireccion` varchar(200) DEFAULT NULL,
  `Comentario` varchar(200) DEFAULT NULL,
  `ImporteTotal` double NOT NULL DEFAULT '0',
  `Distancia` double DEFAULT NULL,
  `Estado` tinyint(4) NOT NULL COMMENT '0 - Pagado (En viaje)\n1 - Reservado\n2 - Cancelado\n3 - Finalizado (Cierre de circuito)\n',
  PRIMARY KEY (`ViajeID`),
  KEY `fk_Viajes_Vehiculos1_idx` (`VehiculoID`),
  KEY `fk_Viajes_Agencias1_idx` (`AgenciaID`),
  KEY `fk_Viajes_Choferes1_idx` (`ChoferID`),
  KEY `fk_Viajes_Turnos1_idx` (`TurnoID`),
  KEY `fk_Viajes_Tarifas1_idx` (`TarifaID`),
  KEY `fk_Viajes_Personas_idx` (`PersonaID`),
  CONSTRAINT `fk_Viajes_Agencias` FOREIGN KEY (`AgenciaID`) REFERENCES `Agencias` (`AgenciaID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Viajes_Choferes` FOREIGN KEY (`ChoferID`) REFERENCES `Personas` (`PersonaID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Viajes_Personas` FOREIGN KEY (`PersonaID`) REFERENCES `Personas` (`PersonaID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Viajes_Tarifas1` FOREIGN KEY (`TarifaID`) REFERENCES `Tarifas` (`TarifaID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Viajes_Turnos` FOREIGN KEY (`TurnoID`) REFERENCES `Turnos` (`TurnoID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Viajes_Vehiculos` FOREIGN KEY (`VehiculoID`) REFERENCES `Vehiculos` (`VehiculoID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Viajes`
--

LOCK TABLES `Viajes` WRITE;
/*!40000 ALTER TABLE `Viajes` DISABLE KEYS */;
INSERT INTO `Viajes` VALUES (1,1,1,1,1,1,4,'2016-09-01 02:00:00','2016-08-31 23:00:00',0,'{Lat: 1351.153, Lon:1564.2354}','{Lat:357438.54, Lon:3431.35}','Barrio Parana','Estacion Florencio Varela','',150,20,0),(2,2,2,1,1,1,5,'2016-09-01 02:00:00','2016-08-31 23:00:00',0,'{Lat: 1354.654, Lon: 4583.58}','{Lat:3164.54, Lon:4345.87}','Barrio Parana','Estacion Quilmes','Carga gas en durante el viaje.',250,35,3),(3,2,1,1,1,1,1,'2016-01-01 03:00:00','2016-01-01 00:00:00',0,'{}','{}','{}','{}','Sale a horario',175,20,0);
/*!40000 ALTER TABLE `Viajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'unaj_proyecto'
--
/*!50003 DROP PROCEDURE IF EXISTS `Agencia_ABM` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`unaj_proyecto`@`%` PROCEDURE `Agencia_ABM`(
IN _Operacion INT, 
IN _AgenciaID INT, 
IN _Nombre VARCHAR(45), 
IN _Direccion VARCHAR(200), 
IN _DireccionCoordenada VARCHAR(200), 
/*IN _DireccionDefault tinyint(4),
IN _DireccionTipo tinyint(4),
IN _AplicacionID INT (11),*/
IN _Telefono VARCHAR(45), 
IN _Email VARCHAR(45), 
IN _Estado tinyint(4), 
OUT _Result INT)
BEGIN

    SET @Operacion = _Operacion;
    SET @AgenciaID = _AgenciaID;
    SET @Nombre = _Nombre; 
	SET @Direccion = _Direccion;
    SET @DireccionCoordenada = _DireccionCoordenada;
    SET @Telefono = _Telefono;
    SET @Email = _Email;
    SET @Estado = _Estado;
	SET @ALTA=0, @MODIFICACION=1, @BAJA=2;
    
    
IF (@Operacion = @ALTA)
THEN 
	INSERT INTO Agencias(Nombre,Telefono, Email, Estado) VALUES (@Nombre, @Telefono, @Email, @Estado); 
	SET _Result = LAST_INSERT_ID();
    SELECT _Result;
    
    INSERT INTO Direcciones(Direccion, DireccionCoordenada,DireccionDefault, DireccionTipo,AplicacionID) VALUES (@Direccion, @DireccionCoordenada, 1,1, _Result);
    
ELSEIF (@Operacion = @MODIFICACION)
THEN 
	UPDATE Agencias SET Nombre = @Nombre, Telefono=@Telefono, Email=@Email, Estado=@Estado WHERE AgenciaID = @AgenciaID;
    SET _Result = @AgenciaID;
    SELECT _Result;
    
ELSEIF (@Operacion = @BAJA)
THEN 
	DELETE FROM Direcciones WHERE DireccionTipo = 1 AND AplicacionID=@AgenciaID;
	DELETE FROM Agencias WHERE AgenciaID = @AgenciaID;
    SET _Result = @AgenciaID;
    SELECT _Result;

END IF;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Agencia_GetInfo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`unaj_proyecto`@`%` PROCEDURE `Agencia_GetInfo`(IN _AgenciaID INT, IN _Nombre VARCHAR(45), IN _Direccion VARCHAR(200), IN _DireccionCoordenada VARCHAR(200), IN _Telefono VARCHAR(45), IN _Email VARCHAR(45), IN _Estado tinyint(4))
BEGIN

    SET @AgenciaID = NULLIF(_AgenciaID,-1);
    SET @Nombre = NULLIF(_Nombre,''); /* NULLIF() recibe dos parámetros, si el resultado del primer parámetro es igual al resultado del segundo, devuelve un valor NULO de lo contrario devuelve valor del primer parámetro*/
    SET @Telefono = NULLIF(_Telefono,'');
    SET @Email = NULLIF(_Email,'');
    SET @Estado = NULLIF(_Estado,'');
    
SELECT 
    AgenciaID,
    Nombre,
    (SELECT Direccion FROM Direcciones D WHERE D.DireccionTipo=1 AND D.DireccionDefault=1 AND D.AplicacionID=Agencias.AgenciaID) as Direccion,
    (SELECT DireccionCoordenada FROM Direcciones D WHERE D.DireccionTipo=1 AND D.DireccionDefault=1 AND D.AplicacionID=Agencias.AgenciaID) as DireccionCoordenada,
    Telefono,
    Email,
    Estado
FROM
    Agencias
WHERE
    AgenciaID = IFNULL(@AgenciaID,AgenciaID) AND 
    Nombre LIKE CONCAT('%',IFNULL(@Nombre,''),'%') AND /*IFNULL()verifica si el primer parámetro devuelve como resultado de la consulta un valor nulo entonces dará como resultado el valor del segundo parámetro */
    Telefono = IFNULL(@Telefono, Telefono) AND
    /*Direccion = IFNULL(@Direccion, Direccion) AND
    DireccionCoordenada= IFNULL(@DireccionCoordenada, DireccionCoordenada) AND*/
    Email = IFNULL(@Email,Email) AND
    Estado = IFNULL(@Estado,Estado);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Calificaciones_ABM` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`unaj_proyecto`@`%` PROCEDURE `Calificaciones_ABM`(
IN _Operacion INT, 
IN _CalificacionID INT, 
IN _ViajeID INT, 
IN _Quien INT, 
IN _ParaQuien INT, 
IN _Puntaje INT, 
IN _Fecha DATETIME, 
IN _Comentario VARCHAR(200), 
OUT _Result INT
)
BEGIN
    SET @Operacion = _Operacion;
    SET @CalificacionID = _CalificacionID;
    SET @ViajeID = _ViajeID;
    SET @Quien = _Quien;
	SET @ParaQuien = _ParaQuien;
    SET @Puntaje = _Puntaje;
    SET @Fecha = _Fecha;
    SET @Comentario = _Comentario;
	SET @ALTA=0, @MODIFICACION=1, @BAJA=2;
    
IF (@Operacion = @ALTA)
THEN 
	INSERT INTO Calificaciones(ViajeID,Quien,ParaQuien, Puntaje, Fecha, Comentario) VALUES (@ViajeID,@Quien,@ParaQuien, @Puntaje, @Fecha, @Comentario); 
	SET _Result = LAST_INSERT_ID();
    SELECT _Result;
    
ELSEIF (@Operacion = @MODIFICACION)
THEN 
	UPDATE Calificaciones SET ViajeID = @ViajeID, Quien=@Quien, ParaQuien=@ParaQuien, Puntaje=@Puntaje, Fecha=@Fecha, Comentario=@Comentario WHERE CalificacionID = @CalificacionID;
    SET _Result = @CalificacionID;
    SELECT _Result;
    
ELSEIF (@Operacion = @BAJA)
THEN 
	DELETE FROM Calificaciones WHERE CalificacionID = @CalificacionID;
    SET _Result = @CalificacionID;
    SELECT _Result;

END IF;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Calificaciones_GetInfo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`unaj_proyecto`@`%` PROCEDURE `Calificaciones_GetInfo`(
IN CalificacionID INT,
IN _ViajeID INT,
IN _Quien INT,
IN _ParaQuien INT,
IN _Puntaje INT
)
BEGIN
    SET @CalificacionID = NULLIF(CalificacionID,-1);
    SET @ViajeID = NULLIF(_ViajeID,-1);
    SET @Quien = NULLIF(_Quien,-1);
	SET @ParaQuien = NULLIF(_ParaQuien,-1);
    SET @Puntaje = NULLIF(_Puntaje,-1);
    
SELECT
	C.CalificacionID,
    C.ViajeID,
    C.Quien,
    C.ParaQuien,
    (SELECT Nombre FROM Personas P WHERE P.PersonaID = C.Quien) as Calificante,
    (SELECT Nombre FROM Personas P WHERE P.PersonaID = C.ParaQuien) as Calificado,
    C.Puntaje,
    C.Fecha,
    C.Comentario
FROM Calificaciones C
WHERE 
	C.CalificacionID = IFNULL(@CalificacionID, C.CalificacionID)
    AND C.ViajeID = IFNULL(@ViajeID, C.ViajeID)
    AND C.Quien = IFNULL(@Quien, C.Quien)
    AND C.ParaQuien = IFNULL(@ParaQuien, C.ParaQuien)
    AND C.Puntaje = IFNULL(@Puntaje, C.Puntaje)
    ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Chofer_ABM` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`unaj_proyecto`@`%` PROCEDURE `Chofer_ABM`(
IN _Operacion INT, 
IN _PersonaID INT, 
IN _Nombre VARCHAR(45),
IN _Usuario VARCHAR(200), 
IN _Telefono VARCHAR(45), 
IN _Email VARCHAR(45), 
IN _Estado  tinyint(4),
OUT _Result INT)
BEGIN

    SET @Operacion = _Operacion;
    SET @PersonaID = _PersonaID;
    SET @Nombre = _Nombre; 
	SET @Usuario = _Usuario;
    SET @Telefono = _Telefono;
    SET @Email = _Email;
	SET @ALTA=0, @MODIFICACION=1, @BAJA=2;
    
IF (@Operacion = @ALTA) 
THEN 
	INSERT INTO Personas(Nombre,Telefono,Email, Estado) VALUES (@Nombre, @Telefono, @Email, @Estado); 
	SET _Result = LAST_INSERT_ID();
    SELECT _Result;
    
ELSEIF (@Operacion = @MODIFICACION)
THEN 
	UPDATE Personas SET Nombre = @Nombre, Telefono=@Telefono, Email=@Email, Estado=@Estado  WHERE PersonaID = @PersonaID;
    SET _Result = @PersonaID;
    SELECT _Result;
    
ELSEIF (@Operacion = @BAJA)
THEN 
	DELETE FROM Personas WHERE PersonaID = @PersonaID;
    SET _Result = @PersonaID;
    SELECT _Result;

END IF;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Chofer_GetInfo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`unaj_proyecto`@`%` PROCEDURE `Chofer_GetInfo`(
IN _PersonaID INT, 
IN _Nombre VARCHAR(45),
IN _Usuario VARCHAR(45), 
IN _Telefono VARCHAR(45), 
IN _Email VARCHAR(45))
BEGIN

    SET @PersonaID = NULLIF(_PersonaID,-1); 
    SET @Nombre = NULLIF(_Nombre,''); /* NULLIF() recibe dos parámetros, si el resultado del primer parámetro es igual al resultado del segundo, devuelve un valor NULO de lo contrario devuelve valor del primer parámetro*/ 
    SET @Telefono = NULLIF(_Telefono,'');
    SET @Email = NULLIF(_Email,'');

SELECT 

	P.PersonaID,
    P.Nombre,
    P.Usuario, 
    P.Telefono, 
    P.Email
    
FROM Personas P 

WHERE  /*aplica condiciones a las seleciones, a los siguientes campos: */

    P.PersonaID = IFNULL(@ChoferID,P.PersonaID) AND 
    P.Nombre LIKE CONCAT('%',IFNULL(@Nombre,''),'%') AND /*IFNULL()verifica si el primer parámetro devuelve como resultado de la consulta un valor nulo entonces dará como resultado el valor del segundo parámetro */
    P.Usuario = IFNULL(@Usuario, P.Usuario) AND
    P.Telefono = IFNULL(@Telefono, P.Telefono) AND
    P.Email = IFNULL(@Email,P.Email) AND
    P.RolID= 3;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Cliente_ABM` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`unaj_proyecto`@`%` PROCEDURE `Cliente_ABM`(
IN _Operacion INT, 
IN _PersonaID INT, 
IN _Nombre VARCHAR(45),
IN _Usuario VARCHAR(200), 
IN _Telefono VARCHAR(45), 
IN _Email VARCHAR(45), 
IN _Direccion VArCHAR(500),
IN _DireccionCoordenadas VARCHAR(500),
IN _Estado  tinyint(4),
OUT _Result INT)
BEGIN

    SET @Operacion = _Operacion;
    SET @PersonaID = _PersonaID;
    SET @Nombre = _Nombre; 
	SET @Usuario = _Usuario;
    SET @Direccion= _Direccion;
    SET @DireccionCoordenada = _DireccionCoordenada;
    SET @Telefono = _Telefono;
    SET @Email = _Email;
    SET @Estado = _Estado;
	SET @ALTA=0, @MODIFICACION=1, @BAJA=2;
    
IF (@Operacion = @ALTA) 
THEN 
	INSERT INTO Personas(Nombre,Telefono,Email, Estado) VALUES (@Nombre, @Telefono, @Email, @Estado); 
	SET _Result = LAST_INSERT_ID();
    SELECT _Result;
    
ELSEIF (@Operacion = @MODIFICACION)
THEN 
	UPDATE Personas SET Nombre = @Nombre, Telefono=@Telefono, Email=@Email, Estado=@Estado WHERE PersonaID = @PersonaID;
    SET _Result = @PersonaID;
    SELECT _Result;
    
ELSEIF (@Operacion = @BAJA)
THEN 
	DELETE FROM Personas WHERE PersonaID = @PersonaID;
    SET _Result = @PersonaID;
    SELECT _Result;

END IF;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Cliente_GetInfo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`unaj_proyecto`@`%` PROCEDURE `Cliente_GetInfo`(
IN _PersonaID INT, 
IN _Nombre VARCHAR(45),
IN _Usuario VARCHAR(45), 
IN _Telefono VARCHAR(45), 
IN _Email VARCHAR(45),
IN _Direccion VArCHAR(500),
IN _DireccionCoordenadas VARCHAR(500))
BEGIN

    SET @PersonaID = NULLIF(_PersonaID,-1);
    SET @Nombre = NULLIF(_Nombre,''); 
	SET @Usuario = NULLIF(_Usuario,'');
    SET @Telefono = NULLIF(_Telefono,'');
    SET @Email = NULLIF(_Email,'');
    SET @Direccion= NULLIF(_Direccion,'');
    SET @DireccionCoordenadas= NULLIF(_DireccionCoordenadas,'');

SELECT 

	P.PersonaID,
    P.Nombre,
    P.Usuario, 
    P.Password,
    P.Telefono, 
    P.Email,
	(SELECT Direccion FROM Direcciones D WHERE D.DireccionTipo=0 AND D.DireccionDefault=1 AND D.AplicacionID=P.PersonaID) as Direccion,
    (SELECT DireccionCoordenada FROM Direcciones D WHERE D.DireccionTipo=0 AND D.DireccionDefault=1 AND D.AplicacionID=P.PersonaID) as DireccionCoordenada
    
FROM Personas P

WHERE  /*aplica condiciones a las seleciones, a los siguientes campos: */

    P.PersonaID = IFNULL(@PersonaID,P.PersonaID) AND 
    P.Nombre LIKE CONCAT('%',IFNULL(@Nombre,''),'%') AND
    P.Usuario = IFNULL(@Usuario, P.Usuario) AND
    (CASE WHEN @Telefono IS NULL THEN (P.Telefono IS NULL OR P.Telefono IS NOT NULL) ELSE P.Telefono=@Telefono END) AND
    (CASE WHEN @Email IS NULL THEN (P.Email IS NULL OR P.Email IS NOT NULL) ELSE P.Email=@Email END) AND
    P.RolID= 4;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Direcciones_ABM` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`unaj_proyecto`@`%` PROCEDURE `Direcciones_ABM`(
IN _Operacion INT, 
IN _DireccionID INT, 
IN _Direccion VARCHAR(500), 
IN _DireccionCoordenada VARCHAR(500), 
IN _DireccionDefault TINYINT,
IN _DireccionTipo TINYINT,  
IN _AplicacionID INT,  
OUT _Result INT
)
BEGIN
    SET @Operacion = _Operacion;
    SET @DireccionID = _DireccionID;
    SET @Direccion = _Direccion;
    SET @DireccionCoordenada = _DireccionCoordenada;
    SET @DireccionDefault = _DireccionDefault;
    SET @DireccionTipo = _DireccionTipo;
	SET @AplicacionID = _AplicacionID;
	SET @ALTA=0, @MODIFICACION=1, @BAJA=2;
    
IF (@Operacion = @ALTA)
THEN 
	INSERT INTO Direcciones(Direccion,DireccionCoordenada,DireccionDefault, DireccionTipo, AplicacionID) 
    VALUES (@Direccion,@DireccionCoordenada, @DireccionDefault, @DireccionTipo, @AplicacionID); 
	SET _Result = LAST_INSERT_ID();
    SELECT _Result;
    
ELSEIF (@Operacion = @MODIFICACION)
THEN 
	UPDATE Direcciones SET Direccion = @Direccion, DireccionCoordenada=@DireccionCoordenada, DireccionDefault=@DireccionDefault, DireccionTipo=@DireccionTipo, AplicacionID=@AplicacionID WHERE DireccionID = @DireccionID;
    SET _Result = @DireccionID;
    SELECT _Result;
    
ELSEIF (@Operacion = @BAJA)
THEN 
	DELETE FROM Direcciones WHERE DireccionID = @DireccionID;
    SET _Result = @DireccionID;
    SELECT _Result;

END IF;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Direcciones_GetInfo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`unaj_proyecto`@`%` PROCEDURE `Direcciones_GetInfo`(
IN _DireccionID INT, 
IN _Direccion VARCHAR(500), 
IN _DireccionCoordenada VARCHAR(500), 
IN _DireccionDefault TINYINT,
IN _DireccionTipo TINYINT,  
IN _AplicacionID INT
)
BEGIN
    SET @DireccionID = NULLIF(_DireccionID,-1);
    SET @Direccion = NULLIF(_Direccion,'');
    SET @DireccionCoordenada = NULLIF(_DireccionCoordenada,'');
    SET @DireccionDefault = NULLIF(_DireccionDefault,-1);
    SET @DireccionTipo = NULLIF(_DireccionTipo,-1);
	SET @AplicacionID = NULLIF(_AplicacionID,-1);
    
SELECT
	D.DireccionID,
    D.Direccion,
    D.DireccionCoordenada,
    D.DireccionDefault,
    D.DireccionTipo,
    D.AplicacionID
FROM Direcciones D
WHERE 
	D.DireccionID = IFNULL(@DireccionID, D.DireccionID)
    AND D.DireccionCoordenada = IFNULL(@DireccionCoordenada, D.DireccionCoordenada)
    AND D.DireccionDefault = IFNULL(@DireccionDefault, D.DireccionDefault)
    AND D.DireccionTipo = IFNULL(@DireccionTipo, D.DireccionTipo)
    AND D.AplicacionID = IFNULL(@AplicacionID, D.AplicacionID)
    ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Roles_ABM` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`unaj_proyecto`@`%` PROCEDURE `Roles_ABM`(
IN _Operacion INT, 
IN _RolID INT, 
IN _Descripcion VARCHAR(45), 
OUT _Result INT)
BEGIN

    SET @Operacion = _Operacion;
    SET @RolID = _RolID;
    SET @Descripcion = _Descripcion; 
	SET @ALTA=0, @MODIFICACION=1, @BAJA=2;
    
    
IF (@Operacion = @ALTA)
THEN 
	INSERT INTO Roles(Descripcion) VALUES (@Descripcion); 
	SET _Result = LAST_INSERT_ID();
    SELECT _Result;
    
ELSEIF (@Operacion = @MODIFICACION)
THEN 
	UPDATE Roles SET Descripcion= @Descripcion WHERE RolID = @RolID;
    SET _Result = @RolID;
    SELECT _Result;
    
ELSEIF (@Operacion = @BAJA)
THEN 
	DELETE FROM Roles WHERE RolID = @RolID;
    SET _Result = @RolID;
    SELECT _Result;

END IF;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Roles_GetInfo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`unaj_proyecto`@`%` PROCEDURE `Roles_GetInfo`(IN _RolID INT, IN _Descripcion VARCHAR(45))
BEGIN

    SET @RolID = NULLIF(_RolID,-1);
    SET @Descripcion = NULLIF(_Descripcion,''); 
	
    
SELECT 
    R.RolID,
    R.Descripcion
    
FROM
    Roles R
    INNER JOIN Personas P ON P.RolID = R.RolID
    
WHERE
    R.RolID = IFNULL(@RolID,R.RolID) AND 
    R.Descripcion = IFNULL(@Descripcion, R.Descripcion);
   
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Tarifas_ABM` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`unaj_proyecto`@`%` PROCEDURE `Tarifas_ABM`(
IN _Operacion INT, 
IN _TarifaID INT, 
IN _Comision DOUBLE, 
IN _AgenciaID INT, 
IN _ViajeMinimo DOUBLE,
IN _KmMinimo DOUBLE,  
IN _PrecioKM DOUBLE,  
IN _Estado TINYINT,  
OUT _Result INT
)
BEGIN
    SET @Operacion = _Operacion;
    SET @TarifaID = _TarifaID;
    SET @Comision = _Comision;
    SET @AgenciaID = _AgenciaID;
    SET @ViajeMinimo = _ViajeMinimo;
    SET @KmMinimo = _KmMinimo;
	SET @PrecioKM = _PrecioKM;
    SET @Estado = _Estado;
	SET @ALTA=0, @MODIFICACION=1, @BAJA=2;
    
IF (@Operacion = @ALTA)
THEN 
	INSERT INTO Tarifas(Comision,AgenciaID, ViajeMinimo, KmMinimo,PrecioKM,Estado) 
    VALUES (@Comision, @AgenciaID, @ViajeMinimo, @KmMinimo, @PrecioKM, @Estado); 
	SET _Result = LAST_INSERT_ID();
    SELECT _Result;
    
ELSEIF (@Operacion = @MODIFICACION)
THEN 
	UPDATE Tarifas SET Comision=@Comision, AgenciaID=@AgenciaID, ViajeMinimo=@ViajeMinimo, KmMinimo=@KmMinimo, PrecioKM=@PrecioKM, Estado=@Estado WHERE TarifaID = @TarifaID;
    SET _Result = @TarifaID;
    SELECT _Result;
    
ELSEIF (@Operacion = @BAJA)
THEN 
	DELETE FROM Tarifas WHERE TarifaID = @TarifaID;
    SET _Result = @TarifaID;
    SELECT _Result;

END IF;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Tarifas_GetInfo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`unaj_proyecto`@`%` PROCEDURE `Tarifas_GetInfo`( 
IN _TarifaID INT, 
IN _Comision DOUBLE, 
IN _AgenciaID INT, 
IN _ViajeMinimo DOUBLE,
IN _KmMinimo DOUBLE,  
IN _PrecioKM DOUBLE,  
IN _Estado TINYINT
)
BEGIN
    SET @TarifaID = NULLIF(_TarifaID,-1);
    SET @AgenciaID = NULLIF(_AgenciaID,-1);
    SET @ViajeMinimo = NULLIF(_ViajeMinimo,-1);
    SET @KmMinimo = NULLIF(_KmMinimo,-1);
	SET @PrecioKM = NULLIF(_PrecioKM,-1);
    SET @Estado = NULLIF(_Estado,-1);
    
SELECT
	T.TarifaID,
    T.AgenciaID,
    T.Comision,
    A.Nombre,
    T.KmMinimo,
    T.PrecioKM,
    T.PrecioKM,
    T.Estado
FROM Tarifas T
	INNER JOIN Agencias A ON A.AgenciaID = T.AgenciaID
WHERE
		T.TarifaID = IFNULL(@TarifaID, T.TarifaID)
    AND T.AgenciaID = IFNULL(@AgenciaID, T.AgenciaID)
    AND T.ViajeMinimo = IFNULL(@ViajeMinimo, T.ViajeMinimo)
    AND T.KmMinimo = IFNULL(@KmMinimo, T.KmMinimo)
    AND T.PrecioKM = IFNULL(@PrecioKM, T.PrecioKM)
    AND T.Estado = IFNULL(@Estado, T.Estado)
;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Turno_ABM` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`unaj_proyecto`@`%` PROCEDURE `Turno_ABM`(

IN _Operacion INT,
IN _TurnoID INT(11), 
IN _PersonaID INT(11), 
IN _FechaApertura timestamp, 
IN _FechaCierre datetime, 
IN _Estado tinyint,
OUT _Result INT)
BEGIN
	
    SET @Operacion = _Operacion;
    SET @TurnoID = _TurnoID;
    SET @PersonaID = _PersonaID;
    SET @FechaApertura = _FechaApertura;
    SET @FechaCierre = _FechaCierre;
    SET @Estado = _Estado;
    SET @ALTA=0, @MODIFICACION=1, @BAJA=2;
    
    IF (@Operacion = @ALTA)
THEN 
	INSERT INTO Turnos(PersonaID,FechaApertura,FechaCierre, Estado) 
    VALUES (@PersonaID, @FechaApertura, @FechaCierre, @Estado); 
	SET _Result = LAST_INSERT_ID();
    SELECT _Result;
    
ELSEIF (@Operacion = @MODIFICACION)
THEN 
	UPDATE Turnos SET PersonaID = @PersonaID, FechaApertura=@FechaApertura, FechaCierre=@FechaCierre, Estado=@Estado WHERE TurnoID = @TurnoID;
    SET _Result = @TurnoID;
    SELECT _Result;
    
ELSEIF (@Operacion = @BAJA)
THEN 
	DELETE FROM Turnos WHERE TurnoID = @TurnoID;
    SET _Result = @TurnoID;
    SELECT _Result;


END IF;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Turno_GetInfo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`unaj_proyecto`@`%` PROCEDURE `Turno_GetInfo`(

IN _TurnoID INT(11), 
IN _PersonaID INT(11), 
IN _FechaAperturaDesde datetime, 
IN _FechaAperturaHasta datetime, 
IN _FechaCierreDesde datetime, 
IN _FechaCierreHasta datetime, 
IN _Estado tinyint)
BEGIN
    SET @TurnoID = NULLIF(_TurnoID,-1);
    SET @PersonaID = NULLIF(_PersonaID,-1);
    SET @FechaAperturaDesde = (SELECT IF(_FechaAperturaDesde is null OR _FechaAperturaDesde='','2010-01-01 00:00:00',_FechaAperturaDesde));
    SET @FechaAperturaHasta = (SELECT IF(_FechaAperturaHasta is null OR _FechaAperturaHasta='','2050-01-01 00:00:00',_FechaAperturaHasta)); 
	SET @FechaCierreDesde = (SELECT IF(_FechaCierreDesde is null OR _FechaCierreDesde='','2010-01-01 00:00:00',_FechaCierreDesde)); 
    SET @FechaCierreHasta = (SELECT IF(_FechaCierreHasta is null OR _FechaCierreHasta='','2050-01-01 00:00:00',_FechaCierreHasta));
    SET @Estado = NULLIF(_Estado,-1);

SELECT 
    T.TurnoID, 
    T.PersonaID, 
    T.FechaApertura, 
    T.FechaCierre,
    T.Estado
    
FROM
    Turnos T
    /*INNER JOIN Personas P ON P.PersonaID = T.PersonaID*/
    
WHERE	
    T.FechaApertura	BETWEEN (@FechaAperturaDesde AND @FechaAperturaHasta) AND
    T.Estado = IFNULL(@Estado,T.Estado) AND
    T.TurnoID = IFNULL(@TurnoID,T.TurnoID) AND 
    T.PersonaID =IFNULL(@PersonaID,T.PersonaID) AND 
    T.FechaCierre between coalesce(@FechaCierreDesde,T.FechaCierre) and coalesce(@FechaCierreHasta,T.FechaCierre)
    ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Vehiculo_ABM` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`unaj_proyecto`@`%` PROCEDURE `Vehiculo_ABM`(
IN _Operacion INT, 
IN _VehiculoID INT(11), 
IN _Matricula VARCHAR(45),
IN _Modelo VARCHAR(45), 
IN _Marca VARCHAR(45), 
IN _Estado tinyint(4), 
IN _FechaAlta timestamp, 
IN _FechaBaja datetime,
OUT _Result INT)
BEGIN

    SET @Operacion = _Operacion;
    SET @VehiculoID = _VehiculoID;
    SET @Matricula = _Matricula; 
	SET @Modelo = _Modelo;
    SET @Marca= _Marca;
    SET @Estado= _Estado;
    SET @FechaAlta= _FechaAlta;
    SET @FechaBaja= _FechaBaja;
	SET @ALTA=0, @MODIFICACION=1, @BAJA=2;
    
    
IF (@Operacion = @ALTA)
THEN 
	INSERT INTO Vehiculo (Matricula, Modelo, Marca, Estado, FechaAlta, FechaBaja) VALUES (@Matricula, @Modelo, @Marca, @Estado, @FechaAlta, @FechaBaja); 
	SET _Result = LAST_INSERT_ID();
    SELECT _Result;
    
ELSEIF (@Operacion = @MODIFICACION)
THEN 
	UPDATE Vehiculo SET Matricula = @Matricula, Modelo=@Modelo, Marca=@Marca, Estado=@Estado , FechaAlta= @FechaAlta, FechaBaja=@FechaBaja WHERE VehiculoID = @VehiculoID;
    SET _Result = @VehiculoID;
    SELECT _Result;
    
ELSEIF (@Operacion = @BAJA)
THEN 
	DELETE FROM Vehiculo WHERE VehiculoID = @VehiculoID;
    SET _Result = @VehiculoID;
    SELECT _Result;

END IF;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Vehiculo_GetInfo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`unaj_proyecto`@`%` PROCEDURE `Vehiculo_GetInfo`(
IN _VehiculoID INT(11), 
IN _Matricula VARCHAR(45),
IN _Modelo VARCHAR(45), 
IN _Marca VARCHAR(45), 
IN _Estado tinyint(4), 
IN _FechaAltaDesde varchar(17), 
IN _FechaAltaHasta varchar(17)/*,
IN _FechaBajaDesde varchar(17), 
IN _FechaBajaHasta varchar(17)*/
)
BEGIN
	SET @VehicluoID = NULLIF(_VehiculoID,-1);
    SET @Matricula = NULLIF(_Matricula,''); 
	SET @Modelo = NULLIF(_Modelo,'');/* NULLIF() recibe dos parámetros, si el resultado del primer parámetro es igual al resultado del segundo, devuelve un valor NULO de lo contrario devuelve valor del primer parámetro*/
    SET @Marca = NULLIF(_Marca,'');
    SET @Estado = NULLIF(_Estado,-1);
    SET @FechaAltaDesde = (SELECT IF(_FechaAltaDesde is null OR _FechaAltaDesde = '','2010-01-01 00:00:00',_FechaAltaDesde));
    SET @FechaAltaHasta = (SELECT IF(_FechaAltaHasta is null OR _FechaAltaHasta = '' ,'2050-01-01 00:00:00',_FechaAltaHasta)); 
	/*SET @FechaBajaDesde = (SELECT IF(_FechaBajaDesde is null OR _FechaBajaDesde='','2010-01-01 00:00:00',_FechaBajaDesde)); 
    SET @FechaBajaHasta = (SELECT IF(_FechaBajaHasta is null OR _FechaBajaHasta='','2050-01-01 00:00:00',_FechaBajaHasta));*/

SELECT 

	V.VehiculoID,
    V.Matricula,
    V.Modelo, 
    V.Marca, 
    V.Estado,
    V.FechaAlta,
    V.FechaBaja
    
FROM Vehiculos V 

WHERE  /*aplica condiciones a las seleciones, a los siguientes campos: */
	(V.FechaAlta	BETWEEN @FechaAltaDesde AND @FechaAltaHasta) AND
	V.VehiculoID = IFNULL(@VehiculoID,V.VehiculoID) AND 
    V.Matricula  LIKE CONCAT('%',IFNULL(@Matricula,''),'%') AND /*IFNULL()verifica si el primer parámetro devuelve como resultado de la consulta un valor nulo entonces dará como resultado el valor del segundo parámetro */
    V.Modelo  LIKE CONCAT('%',IFNULL(@Modelo,''),'%') AND
    V.Marca  LIKE CONCAT('%',IFNULL(@Marca,''),'%') AND
    V.Estado = IFNULL(@Estado,V.Estado)/* AND
    V.FechaBaja between coalesce(@FechaBajaDesde,V.FechaBaja) and coalesce(@FechaBajaHasta,V.FechaBaja)*/
    ;
   END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Viaje_ABM` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`unaj_proyecto`@`%` PROCEDURE `Viaje_ABM`(
IN _Operacion INT, 
IN _ViajeID INT, 
IN _ChoferID INT,
IN _VehiculoID INT, 
IN _TarifaID INT,
IN _TurnoID INT, 
IN _AgenciaID INT,
IN _PersonaID INT,
IN _FechaEmision DATETIME, 
IN _FechaSalida DATETIME,
IN _ViajeTipo INT,
IN _OrigenCoordenadas VARCHAR(500),
IN _DestinoCoordenadas VARCHAR(500),
IN _OrigenDireccion VARCHAR(500),
IN _DestinoDireccion VARCHAR(500),
IN _Comentario VARCHAR(500),
IN _ImporteTotal DOUBLE,
IN _Distancia DOUBLE,
IN _Estado TINYINT,
OUT _Result INT)
BEGIN
    SET @Operacion = _Operacion;
	SET @ViajeID = _ViajeID; 
	SET @ChoferID = _ChoferID;
	SET @VehiculoID = _VehiculoID;
	SET @TarifaID = _TarifaID;
	SET @TurnoID = _TurnoID; 
	SET @AgenciaID = _AgenciaID;
	SET @PersonaID = _PersonaID;
	SET @FechaEmision = _FechaEmision; 
	SET @FechaSalida = _FechaSalida;
	SET @ViajeTipo = _ViajeTipo;
	SET @OrigenCoordenadas = _OrigenCoordenadas;
	SET @DestinoCoordenadas = _DestinoCoordenadas;
	SET @OrigenDireccion = _OrigenDireccion;
	SET @DestinoDireccion = _DestinoDireccion;
	SET @Comentario = _Comentario;
	SET @ImporteTotal = _ImporteTotal;
	SET @Distancia = _Distancia;
	SET @Estado = _Estado;
	SET @ALTA=0, @MODIFICACION=1, @BAJA=2;
	
IF (@Operacion = @ALTA)
THEN 
	INSERT INTO Viajes(ChoferID,VehiculoID,TarifaID,TurnoID,AgenciaID,PersonaID,FechaEmision,FechaSalida,ViajeTipo,OrigenCoordenadas,DestinoCoordenadas,OrigenDireccion,DestinoDireccion,Comentario,ImporteTotal ,Distancia,Estado) 
    VALUES (@ChoferID,@VehiculoID,@TarifaID,@TurnoID,@AgenciaID,@PersonaID,@FechaEmision,@FechaSalida,@ViajeTipo,@OrigenCoordenadas,@DestinoCoordenadas,@OrigenDireccion,@DestinoDireccion,@Comentario,@ImporteTotal ,@Distancia,@Estado); 
	SET _Result = LAST_INSERT_ID();
    SELECT _Result;
    
ELSEIF (@Operacion = @MODIFICACION)
THEN 
	UPDATE Viajes SET ChoferID=@ChoferID,VehiculoID=@VehiculoID,TarifaID=@TarifaID,TurnoID=@TurnoID,AgenciaID=@AgenciaID,PersonaID=@PersonaID,FechaEmision=@FechaEmision,FechaSalida=@FechaSalida,ViajeTipo=@ViajeTipo,OrigenCoordenadas=@OrigenCoordenadas,DestinoCoordenadas=@DestinoCoordenadas,OrigenDireccion=@OrigenDireccion,DestinoDireccion=@DestinoDireccion,Comentario=@Comentario,ImporteTotal =@ImporteTotal ,Distancia=@Distancia,Estado=@Estado 
    WHERE ViajeID = @ViajeID;
    SET _Result = @ViajeID;
    SELECT _Result;
    
ELSEIF (@Operacion = @BAJA)
THEN 
	DELETE FROM Viajes WHERE ViajeID = @ViajeID;
    SET _Result = @ViajeID;
    SELECT _Result;
END IF;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Viaje_GetInfo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`unaj_proyecto`@`%` PROCEDURE `Viaje_GetInfo`(
IN _ViajeID INT, 
IN _ChoferID INT,
IN _VehiculoID INT, 
IN _TarifaID INT,
IN _TurnoID INT, 
IN _AgenciaID INT,
IN _PersonaID INT,
IN _FechaEmisionDesde VARCHAR(17), 
IN _FechaEmisionHasta VARCHAR(17), 
IN _FechaSalidaDesde VARCHAR(17),
IN _FechaSalidaHasta VARCHAR(17),
IN _ViajeTipo INT,
IN _OrigenCoordenadas VARCHAR(500),
IN _DestinoCoordenadas VARCHAR(500),
IN _OrigenDireccion VARCHAR(500),
IN _DestinoDireccion VARCHAR(500),
IN _Comentario VARCHAR(500),
IN _ImporteTotal DOUBLE,
IN _Distancia DOUBLE,
IN _Estado TINYINT)
BEGIN
	SET @ViajeID = NULLIF(_ViajeID,-1); 
	SET @ChoferID = NULLIF(_ChoferID,-1);
	SET @VehiculoID = NULLIF(_VehiculoID,-1);
	SET @TarifaID = NULLIF(_TarifaID,-1);
	SET @TurnoID = NULLIF(_TurnoID,-1); 
	SET @AgenciaID = NULLIF(_AgenciaID,-1);
	SET @PersonaID = NULLIF(_PersonaID,-1);
	SET @FechaEmisionDesde = (SELECT IF(_FechaEmisionDesde is null or _FechaEmisionDesde='','2010-01-01 00:00:00',_FechaEmisionDesde));
    SET @FechaEmisionHasta = (SELECT IF(_FechaEmisionHasta is null or _FechaEmisionHasta='','2050-01-01 00:00:00',_FechaEmisionHasta)); 
	SET @FechaSalidaDesde = (SELECT IF(_FechaSalidaDesde is null or _FechaSalidaDesde='','2010-01-01 00:00:00',_FechaSalidaDesde)); 
    SET @FechaSalidaHasta = (SELECT IF(_FechaSalidaHasta is null or _FechaSalidaHasta='','2050-01-01 00:00:00',_FechaSalidaHasta)); 
	SET @ViajeTipo = NULLIF(_ViajeTipo,-1);
	SET @OrigenCoordenadas = NULLIF(_OrigenCoordenadas,'');
	SET @DestinoCoordenadas = NULLIF(_DestinoCoordenadas,'');
	SET @OrigenDireccion = NULLIF(_OrigenDireccion,'');
	SET @DestinoDireccion = NULLIF(_DestinoDireccion,'');
	SET @Comentario = NULLIF(_Comentario,'');
	SET @ImporteTotal = NULLIF(_ImporteTotal,-1);
	SET @Distancia = NULLIF(_Distancia,-1);
	SET @Estado = NULLIF(_Estado,-1);
		
    SELECT
		V.ViajeID,
        V.ChoferID,
        CH.Nombre as ChoferNombre,
        V.VehiculoID,
        VE.Matricula as VehiculoMatricula,
        VE.Modelo as VehiculoModelo,
        VE.Marca as VehiculoMarca,
        V.TarifaID,
        T.Comision,
        T.PrecioKM,
        T.ViajeMinimo,
        T.KmMinimo,
        A.Nombre as AgenciaNombre,
        P.PersonaID as ClienteID,
        P.Nombre as ClienteNombre,
        V.OrigenDireccion,
        V.DestinoDireccion,
        V.OrigenCoordenadas,
        V.DestinoCoordenadas,
        V.FechaEmision,
        V.FechaSalida,
        V.ViajeTipo,
        V.Comentario,
        V.ImporteTotal,
        V.Distancia,
        V.Estado
        
    FROM Viajes V
    INNER JOIN Personas CH ON CH.PersonaID = V.ChoferID
    INNER JOIN Vehiculos VE ON VE.VehiculoID = V.VehiculoID
    INNER JOIN Tarifas T ON T.TarifaID = V.TarifaID
    INNER JOIN Agencias A ON A.AgenciaID = V.AgenciaID
    INNER JOIN Personas P ON P.PersonaID = V.PersonaID
    WHERE 
			V.ViajeID			= IFNULL(@ViajeID			,V.ViajeID			)
		AND V.ChoferID			= IFNULL(@ChoferID			,V.ChoferID			)
		AND V.VehiculoID		= IFNULL(@VehiculoID		,V.VehiculoID		)
		AND V.TarifaID			= IFNULL(@TarifaID			,V.TarifaID			)
		AND V.TurnoID			= IFNULL(@TurnoID			,V.TurnoID			)
		AND V.AgenciaID			= IFNULL(@AgenciaID			,V.AgenciaID		)
		AND V.PersonaID			= IFNULL(@PersonaID			,V.PersonaID		)
		AND V.FechaEmision		BETWEEN @FechaEmisionDesde AND @FechaEmisionHasta
		AND V.FechaSalida		BETWEEN @FechaSalidaDesde AND @FechaSalidaHasta
		AND V.ViajeTipo			= IFNULL(@ViajeTipo			,V.ViajeTipo		)
		AND V.OrigenCoordenadas	= IFNULL(@OrigenCoordenadas	,V.OrigenCoordenadas)
		AND V.DestinoCoordenadas= IFNULL(@DestinoCoordenadas,V.DestinoCoordenadas)
		AND V.OrigenDireccion	= IFNULL(@OrigenDireccion	,V.OrigenDireccion	)
		AND V.DestinoDireccion	= IFNULL(@DestinoDireccion	,V.DestinoDireccion	)
		AND V.Comentario		= IFNULL(@Comentario		,V.Comentario		)
		AND V.ImporteTotal 		= IFNULL(@ImporteTotal 		,V.ImporteTotal 	)
		AND V.Distancia			= IFNULL(@Distancia			,V.Distancia		)
		AND V.Estado			= IFNULL(@Estado			,V.Estado			);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-18 13:23:59
