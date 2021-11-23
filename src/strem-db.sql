-- MySQL Script generated by MySQL Workbench
-- ter 23 nov 2021 00:37:54
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema nada
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema strem
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `strem` ;

-- -----------------------------------------------------
-- Schema strem
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `strem` DEFAULT CHARACTER SET utf8 ;
USE `strem` ;

-- -----------------------------------------------------
-- Table `strem`.`administracao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `strem`.`administracao` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(145) NOT NULL,
  `sobrenome` VARCHAR(245) NOT NULL,
  `email` VARCHAR(145) NOT NULL,
  `senha` VARCHAR(100) NOT NULL,
  `status` TINYINT(1) NOT NULL DEFAULT '0',
  `cadastrado_em` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `salt` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `Email_Unico` (`email` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `strem`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `strem`.`categoria` (
  `id_categoria` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(255) NOT NULL,
  `descricao` TEXT NOT NULL,
  PRIMARY KEY (`id_categoria`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `strem`.`ci_sessions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `strem`.`ci_sessions` (
  `id` VARCHAR(40) NOT NULL,
  `ip_address` VARCHAR(45) NOT NULL,
  `timestamp` INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` BLOB NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `ci_sessions_timestamp` (`timestamp` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `strem`.`clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `strem`.`clientes` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(145) NOT NULL,
  `sobrenome` VARCHAR(245) NOT NULL,
  `data_nascimento` DATE NOT NULL,
  `email` VARCHAR(145) NOT NULL,
  `senha` VARCHAR(75) NOT NULL,
  `status` TINYINT(1) NOT NULL DEFAULT '0',
  `cadastrado_em` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `salt` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `Email_Unico` (`email` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `strem`.`console`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `strem`.`console` (
  `id_console` INT(10) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `descricao` TEXT NOT NULL,
  PRIMARY KEY (`id_console`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `strem`.`jogo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `strem`.`jogo` (
  `id_jogo` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Console_id_console` INT(10) NOT NULL,
  `codigo` VARCHAR(45) NOT NULL,
  `titulo` VARCHAR(255) NOT NULL,
  `descricao` TEXT NOT NULL,
  `preco` DECIMAL(10,2) NOT NULL,
  `desconto` INT(3) NOT NULL DEFAULT 0,
  `data_adicionado` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ativo` TINYINT(1) NOT NULL DEFAULT '1',
  `imagem` VARCHAR(256) NOT NULL,
  PRIMARY KEY (`id_jogo`, `Console_id_console`),
  UNIQUE INDEX `codigo_unico` (`codigo` ASC) VISIBLE,
  INDEX `fk_jogo_Console1_idx` (`Console_id_console` ASC) VISIBLE,
  CONSTRAINT `fk_jogo_Console1`
    FOREIGN KEY (`Console_id_console`)
    REFERENCES `strem`.`console` (`id_console`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `strem`.`desenvolvedora`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `strem`.`desenvolvedora` (
  `id_desenvolvedora` INT(10) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `descricao` TEXT NOT NULL,
  PRIMARY KEY (`id_desenvolvedora`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `strem`.`jogo_a_pagar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `strem`.`jogo_a_pagar` (
  `jogo_id_jogo` INT(10) UNSIGNED NOT NULL,
  `jogo_Console_id_console` INT(10) NOT NULL,
  `clientes_id` INT(10) UNSIGNED NOT NULL,
  `data_compra` DATETIME NOT NULL,
  PRIMARY KEY (`jogo_id_jogo`, `jogo_Console_id_console`, `clientes_id`),
  INDEX `fk_jogo_has_clientes_clientes1_idx` (`clientes_id` ASC) VISIBLE,
  INDEX `fk_jogo_has_clientes_jogo1_idx` (`jogo_id_jogo` ASC, `jogo_Console_id_console` ASC) VISIBLE,
  CONSTRAINT `fk_jogo_has_clientes_jogo1`
    FOREIGN KEY (`jogo_id_jogo` , `jogo_Console_id_console`)
    REFERENCES `strem`.`jogo` (`id_jogo` , `Console_id_console`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_jogo_has_clientes_clientes1`
    FOREIGN KEY (`clientes_id`)
    REFERENCES `strem`.`clientes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `strem`.`jogo_has_desenvolvedora`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `strem`.`jogo_has_desenvolvedora` (
  `jogo_id_jogo` INT(10) UNSIGNED NOT NULL,
  `jogo_Console_id_console` INT(10) NOT NULL,
  `desenvolvedora_id_desenvolvedora` INT(10) NOT NULL,
  PRIMARY KEY (`jogo_id_jogo`, `jogo_Console_id_console`, `desenvolvedora_id_desenvolvedora`),
  INDEX `fk_jogo_has_desenvolvedora_desenvolvedora1_idx` (`desenvolvedora_id_desenvolvedora` ASC) VISIBLE,
  INDEX `fk_jogo_has_desenvolvedora_jogo1_idx` (`jogo_id_jogo` ASC, `jogo_Console_id_console` ASC) VISIBLE,
  CONSTRAINT `fk_jogo_has_desenvolvedora_jogo1`
    FOREIGN KEY (`jogo_id_jogo` , `jogo_Console_id_console`)
    REFERENCES `strem`.`jogo` (`id_jogo` , `Console_id_console`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_jogo_has_desenvolvedora_desenvolvedora1`
    FOREIGN KEY (`desenvolvedora_id_desenvolvedora`)
    REFERENCES `strem`.`desenvolvedora` (`id_desenvolvedora`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `strem`.`jogo_has_categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `strem`.`jogo_has_categoria` (
  `jogo_id_jogo` INT(10) UNSIGNED NOT NULL,
  `jogo_Console_id_console` INT(10) NOT NULL,
  `categoria_id_categoria` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`jogo_id_jogo`, `jogo_Console_id_console`, `categoria_id_categoria`),
  INDEX `fk_jogo_has_categoria_categoria1_idx` (`categoria_id_categoria` ASC) VISIBLE,
  INDEX `fk_jogo_has_categoria_jogo1_idx` (`jogo_id_jogo` ASC, `jogo_Console_id_console` ASC) VISIBLE,
  CONSTRAINT `fk_jogo_has_categoria_jogo1`
    FOREIGN KEY (`jogo_id_jogo` , `jogo_Console_id_console`)
    REFERENCES `strem`.`jogo` (`id_jogo` , `Console_id_console`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_jogo_has_categoria_categoria1`
    FOREIGN KEY (`categoria_id_categoria`)
    REFERENCES `strem`.`categoria` (`id_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `strem`.`biblioteca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `strem`.`biblioteca` (
  `clientes_id` INT(10) UNSIGNED NOT NULL,
  `jogo_id_jogo` INT(10) UNSIGNED NOT NULL,
  `jogo_Console_id_console` INT(10) NOT NULL,
  `data_compra` DATETIME NOT NULL,
  PRIMARY KEY (`clientes_id`, `jogo_id_jogo`, `jogo_Console_id_console`),
  INDEX `fk_clientes_has_jogo_jogo1_idx` (`jogo_id_jogo` ASC, `jogo_Console_id_console` ASC) VISIBLE,
  INDEX `fk_clientes_has_jogo_clientes1_idx` (`clientes_id` ASC) VISIBLE,
  CONSTRAINT `fk_clientes_has_jogo_clientes1`
    FOREIGN KEY (`clientes_id`)
    REFERENCES `strem`.`clientes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_clientes_has_jogo_jogo1`
    FOREIGN KEY (`jogo_id_jogo` , `jogo_Console_id_console`)
    REFERENCES `strem`.`jogo` (`id_jogo` , `Console_id_console`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
