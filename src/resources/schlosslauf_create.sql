-- MySQL Script generated by MySQL Workbench
-- 01/17/18 09:42:37
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema schlosslauf
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema schlosslauf
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `schlosslauf` DEFAULT CHARACTER SET utf8 ;
USE `schlosslauf` ;

-- -----------------------------------------------------
-- Table `schlosslauf`.`Country`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `schlosslauf`.`Country` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `country` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `country_UNIQUE` (`country` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `schlosslauf`.`Language`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `schlosslauf`.`Language` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `language` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `language_UNIQUE` (`language` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `schlosslauf`.`Group`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `schlosslauf`.`Group` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `group` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `group_UNIQUE` (`group` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `schlosslauf`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `schlosslauf`.`User` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `salt` VARCHAR(22) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `first name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(80) NOT NULL,
  `street` VARCHAR(45) NOT NULL,
  `location` VARCHAR(45) NOT NULL,
  `area_code` VARCHAR(45) NOT NULL,
  `country_fk` INT NOT NULL,
  `language_fk` INT NOT NULL,
  `admin_code` TINYINT(1) NOT NULL DEFAULT 0,
  `group_fk` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_User_Country1_idx` (`country_fk` ASC),
  INDEX `fk_User_Language1_idx` (`language_fk` ASC),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  INDEX `fk_User_Group1_idx` (`group_fk` ASC),
  CONSTRAINT `fk_User_Country1`
    FOREIGN KEY (`country_fk`)
    REFERENCES `schlosslauf`.`Country` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_Language1`
    FOREIGN KEY (`language_fk`)
    REFERENCES `schlosslauf`.`Language` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_Group1`
    FOREIGN KEY (`group_fk`)
    REFERENCES `schlosslauf`.`Group` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `schlosslauf`.`Error`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `schlosslauf`.`Error` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `error_msg` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
