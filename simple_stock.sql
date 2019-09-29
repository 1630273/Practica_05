-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema simple_stock
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema simple_stock
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `simple_stock` DEFAULT CHARACTER SET latin1 ;
USE `simple_stock` ;

-- -----------------------------------------------------
-- Table `simple_stock`.`categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simple_stock`.`categorias` (
  `id_categoria` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre_categoria` VARCHAR(255) NOT NULL,
  `descripcion_categoria` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_categoria`))
ENGINE = MyISAM
AUTO_INCREMENT = 15
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `simple_stock`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simple_stock`.`products` (
  `id_producto` INT(11) NOT NULL AUTO_INCREMENT,
  `codigo_producto` CHAR(20) NOT NULL,
  `nombre_producto` CHAR(255) NOT NULL,
  `date_added` DATETIME NOT NULL,
  `precio_producto` DOUBLE NOT NULL,
  `stock` INT(11) NOT NULL,
  `id_categoria` INT(11) NOT NULL,
  PRIMARY KEY (`id_producto`),
  UNIQUE INDEX `codigo_producto` (`codigo_producto` ASC),
  INDEX `cate_idx` (`id_categoria` ASC),
  CONSTRAINT `cate`
    FOREIGN KEY (`id_categoria`)
    REFERENCES `simple_stock`.`categorias` (`id_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `simple_stock`.`historial`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simple_stock`.`historial` (
  `id_historial` INT(11) NOT NULL AUTO_INCREMENT,
  `id_producto` INT(11) NOT NULL,
  `user_id` INT(11) NOT NULL,
  `fecha` DATETIME NOT NULL,
  `nota` VARCHAR(255) NOT NULL,
  `referencia` VARCHAR(100) NOT NULL,
  `cantidad` INT(11) NOT NULL,
  PRIMARY KEY (`id_historial`),
  INDEX `id_producto` (`id_producto` ASC),
  CONSTRAINT `fk_id_producto`
    FOREIGN KEY (`id_producto`)
    REFERENCES `simple_stock`.`products` (`id_producto`)
    ON DELETE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `simple_stock`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simple_stock`.`users` (
  `user_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `firstname` VARCHAR(20) NOT NULL,
  `lastname` VARCHAR(20) NOT NULL,
  `user_name` VARCHAR(64) NOT NULL COMMENT 'user\'s name, unique',
  `user_password_hash` VARCHAR(255) NOT NULL COMMENT 'user\'s password in salted and hashed format',
  `user_email` VARCHAR(64) NOT NULL COMMENT 'user\'s email, unique',
  `date_added` DATETIME NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE INDEX `user_name` (`user_name` ASC),
  UNIQUE INDEX `user_email` (`user_email` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'user data';


-- -----------------------------------------------------
-- Table `simple_stock`.`detalle_venta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simple_stock`.`detalle_venta` (
  `id_detalle_venta` INT(11) NOT NULL AUTO_INCREMENT,
  `cantidad` INT(11) NOT NULL,
  `importe` DOUBLE NULL,
  `id_producto` INT(11) NOT NULL,
  PRIMARY KEY (`id_detalle_venta`),
  INDEX `id_producto` (`id_producto` ASC),
  CONSTRAINT `fk_id_producto0`
    FOREIGN KEY (`id_producto`)
    REFERENCES `simple_stock`.`products` (`id_producto`)
    ON DELETE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `simple_stock`.`ventas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simple_stock`.`ventas` (
  `id_venta` INT(11) NOT NULL AUTO_INCREMENT,
  `total` DOUBLE NULL,
  `fecha_venta` DATETIME NOT NULL,
  `id_detalle_venta` INT(11) NULL,
  PRIMARY KEY (`id_venta`),
  INDEX `detalle_idx` (`id_detalle_venta` ASC),
  CONSTRAINT `detalle`
    FOREIGN KEY (`id_detalle_venta`)
    REFERENCES `simple_stock`.`detalle_venta` (`id_detalle_venta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
