-- MySQL Script generated by MySQL Workbench
-- 09/01/16 09:26:14
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Roles` (
  `RolID` INT NOT NULL,
  `Descripcion` VARCHAR(45) NULL,
  PRIMARY KEY (`RolID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Personas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Personas` (
  `PersonaID` INT NOT NULL,
  `Usuario` VARCHAR(45) NULL,
  `Contraseña` VARCHAR(45) NULL,
  `Nombre` VARCHAR(45) NULL,
  `Direccion` VARCHAR(200) NULL,
  `DireccionCoordenada` VARCHAR(200) NULL,
  `Telefono` VARCHAR(45) NULL,
  `Email` VARCHAR(45) NULL,
  `RolID` INT NOT NULL,
  PRIMARY KEY (`PersonaID`),
  CONSTRAINT `fk_Personas_Roles`
    FOREIGN KEY (`RolID`)
    REFERENCES `mydb`.`Roles` (`RolID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Personas_Roles_idx` ON `mydb`.`Personas` (`RolID` ASC);


-- -----------------------------------------------------
-- Table `mydb`.`Vehiculos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Vehiculos` (
  `VehiculoID` INT NOT NULL,
  `Matricula` VARCHAR(45) NULL,
  `Modelo` VARCHAR(45) NULL,
  `Marca` VARCHAR(45) NULL,
  `Estado` TINYINT NOT NULL,
  `FechaAlta` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FechaBaja` DATETIME NULL,
  PRIMARY KEY (`VehiculoID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Agencias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Agencias` (
  `AgenciaID` INT NOT NULL,
  `Nombre` VARCHAR(45) NOT NULL,
  `Telefono` VARCHAR(45) NULL,
  `Email` VARCHAR(45) NULL,
  `Direccion` VARCHAR(200) NOT NULL,
  `DireccionCoordenadas` VARCHAR(200) NOT NULL,
  `Estado` TINYINT NOT NULL,
  PRIMARY KEY (`AgenciaID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Turnos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Turnos` (
  `TurnoID` INT NOT NULL,
  `PersonaID` INT NOT NULL,
  `FechaApertura` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FechaCierre` DATETIME NULL,
  `Estado` TINYINT NOT NULL COMMENT '0 - Abierta\n1 - Cerrada',
  PRIMARY KEY (`TurnoID`),
  CONSTRAINT `fk_Turnos_Personas`
    FOREIGN KEY (`PersonaID`)
    REFERENCES `mydb`.`Personas` (`PersonaID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Turnos_Personas1_idx` ON `mydb`.`Turnos` (`PersonaID` ASC);


-- -----------------------------------------------------
-- Table `mydb`.`Tarifas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Tarifas` (
  `TarifaID` INT NOT NULL,
  `Comision` DOUBLE NULL,
  `AgenciaID` INT NOT NULL,
  `ViajeMinimo` DOUBLE NULL,
  `KmMinimo` DOUBLE NULL,
  `PrecioKM` DOUBLE NOT NULL,
  `Estado` TINYINT NOT NULL,
  PRIMARY KEY (`TarifaID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Viajes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Viajes` (
  `ViajeID` INT NOT NULL,
  `ChoferID` INT NULL,
  `VehiculoID` INT NULL,
  `TarifaID` INT NOT NULL,
  `TurnoID` INT NOT NULL,
  `AgenciaID` INT NOT NULL,
  `PersonaID` INT NULL COMMENT 'Si el viaje solicitado es manualmente (Personal o por Telefono) el usuario puede ser NULL ya que no se tiene registro en ese momento.',
  `FechaEmision` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `FechaSalida` DATETIME NULL,
  `ViajeTipo` TINYINT NOT NULL COMMENT 'Viajes solicitados con la siguiente modalidad:\n\n0 - Web\n1 - Personal\n2 - Telefonico',
  `OrigenCoordenadas` VARCHAR(200) NULL,
  `DestinoCoordenadas` VARCHAR(200) NULL,
  `OrigenDireccion` VARCHAR(200) NULL,
  `DestinoDireccion` VARCHAR(200) NULL,
  `Comentario` VARCHAR(200) NULL,
  `ImporteTotal` DOUBLE NOT NULL DEFAULT 0,
  `Distancia` DOUBLE NULL,
  `Estado` TINYINT NOT NULL COMMENT '0 - Pagado (En viaje)\n1 - Reservado\n2 - Cancelado\n3 - Finalizado (Cierre de circuito)\n',
  PRIMARY KEY (`ViajeID`),
  CONSTRAINT `fk_Viajes_Personas`
    FOREIGN KEY (`PersonaID`)
    REFERENCES `mydb`.`Personas` (`PersonaID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Viajes_Vehiculos`
    FOREIGN KEY (`VehiculoID`)
    REFERENCES `mydb`.`Vehiculos` (`VehiculoID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Viajes_Agencias`
    FOREIGN KEY (`AgenciaID`)
    REFERENCES `mydb`.`Agencias` (`AgenciaID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Viajes_Turnos`
    FOREIGN KEY (`TurnoID`)
    REFERENCES `mydb`.`Turnos` (`TurnoID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Viajes_Tarifas1`
    FOREIGN KEY (`TarifaID`)
    REFERENCES `mydb`.`Tarifas` (`TarifaID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Viajes_Choferes`
    FOREIGN KEY (`ChoferID`)
    REFERENCES `mydb`.`Personas` (`PersonaID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Viajes_Vehiculos1_idx` ON `mydb`.`Viajes` (`VehiculoID` ASC);

CREATE INDEX `fk_Viajes_Agencias1_idx` ON `mydb`.`Viajes` (`AgenciaID` ASC);

CREATE INDEX `fk_Viajes_Choferes1_idx` ON `mydb`.`Viajes` (`ChoferID` ASC);

CREATE INDEX `fk_Viajes_Turnos1_idx` ON `mydb`.`Viajes` (`TurnoID` ASC);

CREATE INDEX `fk_Viajes_Tarifas1_idx` ON `mydb`.`Viajes` (`TarifaID` ASC);

CREATE INDEX `fk_Viajes_Personas_idx` ON `mydb`.`Viajes` (`PersonaID` ASC);


-- -----------------------------------------------------
-- Table `mydb`.`Calificaciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Calificaciones` (
  `CalificacionID` INT NOT NULL,
  `ViajeID` INT NOT NULL,
  `Quien` INT NOT NULL,
  `ParaQuien` INT NOT NULL,
  `Puntaje` INT NOT NULL,
  `Fecha` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `Comentario` VARCHAR(200) NULL,
  PRIMARY KEY (`CalificacionID`),
  CONSTRAINT `fk_Calificaciones_PersonasQuien`
    FOREIGN KEY (`Quien`)
    REFERENCES `mydb`.`Personas` (`PersonaID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Calificaciones_Viajes`
    FOREIGN KEY (`ViajeID`)
    REFERENCES `mydb`.`Viajes` (`ViajeID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Calificaciones_PersonasParaQuien`
    FOREIGN KEY (`ParaQuien`)
    REFERENCES `mydb`.`Personas` (`PersonaID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Calificaciones_Viajes1_idx` ON `mydb`.`Calificaciones` (`ViajeID` ASC);

CREATE INDEX `fk_Calificaciones_PersonasQuien_idx` ON `mydb`.`Calificaciones` (`Quien` ASC);

CREATE INDEX `afds_idx` ON `mydb`.`Calificaciones` (`ParaQuien` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `mydb`.`Roles`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`Roles` (`RolID`, `Descripcion`) VALUES (1, 'Administrador');
INSERT INTO `mydb`.`Roles` (`RolID`, `Descripcion`) VALUES (2, 'Recepcionista');
INSERT INTO `mydb`.`Roles` (`RolID`, `Descripcion`) VALUES (3, 'Chofer');
INSERT INTO `mydb`.`Roles` (`RolID`, `Descripcion`) VALUES (4, 'Cliente');

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`Personas`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`Personas` (`PersonaID`, `Usuario`, `Contraseña`, `Nombre`, `Direccion`, `DireccionCoordenada`, `Telefono`, `Email`, `RolID`) VALUES (1, 'emendez', 'emendez', 'Mendez Alejandro Ezequiel', 'Barrio Parana 1111', '{Lat: 1564.81, Lon:1513.35}', '42744254', 'mendezalejandro.e@gmail.com', 1);
INSERT INTO `mydb`.`Personas` (`PersonaID`, `Usuario`, `Contraseña`, `Nombre`, `Direccion`, `DireccionCoordenada`, `Telefono`, `Email`, `RolID`) VALUES (2, 'lsilva', 'lsilva', 'Lilian Silva', 'Av Mayo 2222', '{Lat: 1564.31, Lon:31543.354}', '42744466', 'lilian@gmail.com', 2);
INSERT INTO `mydb`.`Personas` (`PersonaID`, `Usuario`, `Contraseña`, `Nombre`, `Direccion`, `DireccionCoordenada`, `Telefono`, `Email`, `RolID`) VALUES (3, 'arodriguez', 'arodriguez', 'Aldo Rodriguez', 'Calle Falasa1435', '', NULL, NULL, 3);
INSERT INTO `mydb`.`Personas` (`PersonaID`, `Usuario`, `Contraseña`, `Nombre`, `Direccion`, `DireccionCoordenada`, `Telefono`, `Email`, `RolID`) VALUES (4, 'imorales', 'imorales', 'Ignacio Morales', 'Calle Cavegol', NULL, NULL, NULL, 4);
INSERT INTO `mydb`.`Personas` (`PersonaID`, `Usuario`, `Contraseña`, `Nombre`, `Direccion`, `DireccionCoordenada`, `Telefono`, `Email`, `RolID`) VALUES (5, 'bvitucci', 'bvitucci', 'Bruno Vitucci', 'Calle El ramirazo 465', '{Lat: 458343.456, Lon: 45435}', NULL, NULL, 4);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`Vehiculos`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`Vehiculos` (`VehiculoID`, `Matricula`, `Modelo`, `Marca`, `Estado`, `FechaAlta`, `FechaBaja`) VALUES (1, 'GIM268', '2016', 'Renault', 0, '2016-08-31 23:00:00', NULL);
INSERT INTO `mydb`.`Vehiculos` (`VehiculoID`, `Matricula`, `Modelo`, `Marca`, `Estado`, `FechaAlta`, `FechaBaja`) VALUES (2, 'TOR345', '2015', 'Fiat Punto', 0, '2016-08-31 23:00:00', NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`Agencias`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`Agencias` (`AgenciaID`, `Nombre`, `Telefono`, `Email`, `Direccion`, `DireccionCoordenadas`, `Estado`) VALUES (1, 'Remiseria LA ESTRELLA', '011 4237-1280', 'remiamigos@remis.com.ar', 'Dr. Salvador Sallares 114, 1888 Dr Sallares 114, Buenos Aires', '{Lat:18446,165, Lon:1354,16}', 0);
INSERT INTO `mydb`.`Agencias` (`AgenciaID`, `Nombre`, `Telefono`, `Email`, `Direccion`, `DireccionCoordenadas`, `Estado`) VALUES (2, 'O\'Clock Remis', '011 4287-7331', 'oclock@remisys.com.ar', 'Bernardo de Monteagudo 2981, B1888ENQ Florencio Varela, Buenos Aires', '{Lat:1564.564 , Long:1354.32 }', 0);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`Turnos`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`Turnos` (`TurnoID`, `PersonaID`, `FechaApertura`, `FechaCierre`, `Estado`) VALUES (1, 2, '2016-08-25 23:00:00', NULL, 0);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`Tarifas`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`Tarifas` (`TarifaID`, `Comision`, `AgenciaID`, `ViajeMinimo`, `KmMinimo`, `PrecioKM`, `Estado`) VALUES (1, 20, 1, 100, 5, 10.50, 0);
INSERT INTO `mydb`.`Tarifas` (`TarifaID`, `Comision`, `AgenciaID`, `ViajeMinimo`, `KmMinimo`, `PrecioKM`, `Estado`) VALUES (2, 35, 2, 80, 4, 8, 0);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`Viajes`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`Viajes` (`ViajeID`, `ChoferID`, `VehiculoID`, `TarifaID`, `TurnoID`, `AgenciaID`, `PersonaID`, `FechaEmision`, `FechaSalida`, `ViajeTipo`, `OrigenCoordenadas`, `DestinoCoordenadas`, `OrigenDireccion`, `DestinoDireccion`, `Comentario`, `ImporteTotal`, `Distancia`, `Estado`) VALUES (1, 1, 1, 1, 1, 1, 4, '2016-08-31 23:00:00', '2016-08-31 23:00:00', 0, '{Lat: 1351.153, Lon:1564.2354}', '{Lat:357438.54, Lon:3431.35}', 'Barrio Parana', 'Estacion Florencio Varela', '', 150, 20, 0);
INSERT INTO `mydb`.`Viajes` (`ViajeID`, `ChoferID`, `VehiculoID`, `TarifaID`, `TurnoID`, `AgenciaID`, `PersonaID`, `FechaEmision`, `FechaSalida`, `ViajeTipo`, `OrigenCoordenadas`, `DestinoCoordenadas`, `OrigenDireccion`, `DestinoDireccion`, `Comentario`, `ImporteTotal`, `Distancia`, `Estado`) VALUES (2, 2, 2, 1, 1, 1, 5, '2016-08-31 23:00:00', '2016-08-31 23:00:00', 0, '{Lat: 1354.654, Lon: 4583.58}', '{Lat:3164.54, Lon:4345.87}', 'Barrio Parana', 'Estacion Quilmes', 'Carga gas en durante el viaje.', 250, 35, 3);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`Calificaciones`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`Calificaciones` (`CalificacionID`, `ViajeID`, `Quien`, `ParaQuien`, `Puntaje`, `Fecha`, `Comentario`) VALUES (1, 2, 5, 2, 10, '2016-08-31 23:00:00', 'El chofer me toco la jalea pero todo bien igual. Recomendado');
INSERT INTO `mydb`.`Calificaciones` (`CalificacionID`, `ViajeID`, `Quien`, `ParaQuien`, `Puntaje`, `Fecha`, `Comentario`) VALUES (DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT, NULL, '');

COMMIT;
