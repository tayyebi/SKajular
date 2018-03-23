$sqlite3

/**************************************************************************/

$.databases
$.quit
$.schema skajular
$.tables

/**************************************************************************/

CREATE TABLE Event (
 Id INTEGER PRIMARY KEY AUTOINCREMENT,
 Title TEXT NOT NULL,
 Type TEXT NOT NULL
);

INSERT INTO Event (Title, Type) VALUES ('test', 'Course');
INSERT INTO Event (Title, Type) VALUES ('test2', 'Off');
INSERT INTO Event (Title, Type) VALUES ('test', 'Warning');
INSERT INTO Event (Title, Type) VALUES ('test', 'Festival');

SELECT * FROM Event;

/**************************************************************************/

CREATE TABLE Users (
 Id INTEGER PRIMARY KEY AUTOINCREMENT,
 Username TEXT NOT NULL,
 [Password] TEXT NOT NULL,
 [Image] BLOB NULL
);

insert into users (username, password) values ('admin', 'admin');

/**************************************************************************/


/*


*
*
*
*
*



MYSQL SERVER 5



*
*
*
*
*


*/


-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema skajular
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema skajular
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `skajular` DEFAULT CHARACTER SET latin1 ;
USE `skajular` ;

-- -----------------------------------------------------
-- Table `skajular`.`Calendar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `skajular`.`Calendar` (
  `DateKey` INT(11) NOT NULL,
  `Jalali` VARCHAR(45) NULL DEFAULT NULL,
  `Gregorian` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`DateKey`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `skajular`.`Events`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `skajular`.`Events` (
  `Id` INT(11) NOT NULL AUTO_INCREMENT,
  `Type` VARCHAR(45) NULL DEFAULT NULL,
  `Title` VARCHAR(80) NULL DEFAULT NULL,
  PRIMARY KEY (`Id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `skajular`.`Users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `skajular`.`Users` (

  `Id` INT(11) NOT NULL AUTO_INCREMENT,
  `Username` VARCHAR(45) NOT NULL,
  `Password` VARCHAR(45) NOT NULL,
  `Image` LONGBLOB NULL DEFAULT NULL,
  PRIMARY KEY (`Id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `skajular`.`Session`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `skajular`.`Session` (
  `Id` BIGINT(11) NOT NULL AUTO_INCREMENT,
  `FirstPersonId` INT(11) NULL DEFAULT NULL,
  `Date` INT(11) NULL DEFAULT NULL,
  `Note` VARCHAR(80) NULL DEFAULT NULL,
  `From` TIME(6) NULL DEFAULT NULL,
  `To` TIME(6) NULL DEFAULT NULL,
  PRIMARY KEY (`Id`),
  INDEX `fk_Session_1_idx` (`FirstPersonId` ASC),
  CONSTRAINT `fk_Session_1`
    FOREIGN KEY (`FirstPersonId`)
    REFERENCES `skajular`.`Users` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB$sqlite3

/**************************************************************************/

$.databases
$.quit
$.schema skajular
$.tables

/**************************************************************************/

CREATE TABLE Event (
 Id INTEGER PRIMARY KEY AUTOINCREMENT,
 Title TEXT NOT NULL,
 Type TEXT NOT NULL
);

INSERT INTO Event (Title, Type) VALUES ('test', 'Course');
INSERT INTO Event (Title, Type) VALUES ('test2', 'Off');
INSERT INTO Event (Title, Type) VALUES ('test', 'Warning');
INSERT INTO Event (Title, Type) VALUES ('test', 'Festival');

SELECT * FROM Event;

/**************************************************************************/

CREATE TABLE Users (
 Id INTEGER PRIMARY KEY AUTOINCREMENT,
 Username TEXT NOT NULL,
 [Password] TEXT NOT NULL,
 [Image] BLOB NULL
);

insert into users (username, password) values ('admin', 'admin');

/**************************************************************************/

DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
