SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `sburb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `sburb` ;

-- -----------------------------------------------------
-- Table `sburb`.`bugreports`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sburb`.`bugreports` ;

CREATE  TABLE IF NOT EXISTS `sburb`.`bugreports` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `ip` CHAR(45) NOT NULL ,
  `referrer` VARCHAR(255) NOT NULL ,
  `canvas` MEDIUMTEXT NOT NULL ,
  `debugger` MEDIUMTEXT NOT NULL ,
  `save` MEDIUMTEXT NOT NULL ,
  `report` TEXT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
