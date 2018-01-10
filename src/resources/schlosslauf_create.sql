-- MySQL Script generated by MySQL Workbench
-- 01/10/18 09:38:57
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
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `schlosslauf`.`Language`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `schlosslauf`.`Language` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `language` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `schlosslauf`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `schlosslauf`.`User` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `first name` VARCHAR(45) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `salt` VARCHAR(22) NOT NULL,
  `email` VARCHAR(80) NOT NULL,
  `country_fk` INT NOT NULL,
  `language_fk` INT NOT NULL,
  `street` VARCHAR(45) NOT NULL,
  `location` VARCHAR(45) NOT NULL,
  `area_code` VARCHAR(45) NOT NULL,
  `admin_code` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_User_Country1_idx` (`country_fk` ASC),
  INDEX `fk_User_Language1_idx` (`language_fk` ASC),
  CONSTRAINT `fk_User_Country1`
    FOREIGN KEY (`country_fk`)
    REFERENCES `schlosslauf`.`Country` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_Language1`
    FOREIGN KEY (`language_fk`)
    REFERENCES `schlosslauf`.`Language` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `schlosslauf`.`Group`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `schlosslauf`.`Group` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `group` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `schlosslauf`.`Registration`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `schlosslauf`.`Registration` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `group_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Registration_User_idx` (`user_id` ASC),
  INDEX `fk_Registration_Group1_idx` (`group_id` ASC),
  CONSTRAINT `fk_Registration_User`
    FOREIGN KEY (`user_id`)
    REFERENCES `schlosslauf`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Registration_Group1`
    FOREIGN KEY (`group_id`)
    REFERENCES `schlosslauf`.`Group` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
