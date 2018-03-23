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
  `Date` INT(11) NULL DEFAULT NULL,
  `Note` VARCHAR(80) NULL DEFAULT NULL,
  `From` TIME(6) NULL DEFAULT NULL,
  `To` TIME(6) NULL DEFAULT NULL,
  PRIMARY KEY (`Id`),
  INDEX `fk_Session_2_idx` (`Date` ASC),
  CONSTRAINT `fk_Session_2`
    FOREIGN KEY (`Date`)
    REFERENCES `skajular`.`Calendar` (`DateKey`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `skajular`.`Participate`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `skajular`.`Participate` (
  `Id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `UserId` INT(11) NULL DEFAULT NULL,
  `Role` VARCHAR(45) NULL DEFAULT NULL,
  `SessionId` BIGINT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`Id`),
  INDEX `fk_Participate_1_idx` (`UserId` ASC),
  INDEX `fk_Participate_2_idx` (`SessionId` ASC),
  CONSTRAINT `fk_Participate_1`
    FOREIGN KEY (`UserId`)
    REFERENCES `skajular`.`Users` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Participate_2`
    FOREIGN KEY (`SessionId`)
    REFERENCES `skajular`.`Session` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


/**********************************
PATCH 1
***********************************/


ALTER TABLE `skajular`.`Session` 
ADD COLUMN `EventId` INT NULL AFTER `To`,
ADD INDEX `fk_Session_1_idx` (`EventId` ASC);
ALTER TABLE `skajular`.`Session` 
ADD CONSTRAINT `fk_Session_1`
  FOREIGN KEY (`EventId`)
  REFERENCES `skajular`.`Events` (`Id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
