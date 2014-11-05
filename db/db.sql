SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `estimatech_db` DEFAULT CHARACTER SET utf8 ;
USE `estimatech_db` ;

-- -----------------------------------------------------
-- Table `estimatech_db`.`clientepf`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`clientepf` (
  `idCPF` INT(11) NOT NULL AUTO_INCREMENT,
  `Nome` VARCHAR(45) NOT NULL,
  `Sobrenome` VARCHAR(45) NOT NULL,
  `Telefone` INT(11) NOT NULL,
  `datNasc` DATE NOT NULL,
  `Sexo` CHAR(1) NOT NULL,
  `dataCadastro` DATETIME NOT NULL,
  PRIMARY KEY (`idCPF`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `estimatech_db`.`clientepj`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`clientepj` (
  `idCNPJ` INT(11) NOT NULL AUTO_INCREMENT,
  `NomeFantasia` VARCHAR(45) NOT NULL,
  `Telefone` INT(11) NOT NULL,
  `dataCadastro` DATETIME NOT NULL,
  PRIMARY KEY (`idCNPJ`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `estimatech_db`.`pacote`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`pacote` (
  `idPacote` INT(11) NOT NULL AUTO_INCREMENT,
  `Descricao` VARCHAR(45) NOT NULL,
  `LimiteProjetos` INT(11) NOT NULL,
  `Validate` DATETIME NOT NULL,
  `Valor` FLOAT NOT NULL,
  PRIMARY KEY (`idPacote`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `estimatech_db`.`compra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`compra` (
  `idCompra` INT(11) NOT NULL AUTO_INCREMENT,
  `DataCompra` DATE NOT NULL,
  `Validade` DATE NOT NULL,
  `Pacote_idPacote` INT(11) NOT NULL,
  PRIMARY KEY (`idCompra`),
  INDEX `fk_Compra_Pacote1` (`Pacote_idPacote` ASC),
  CONSTRAINT `fk_Compra_Pacote1`
    FOREIGN KEY (`Pacote_idPacote`)
    REFERENCES `estimatech_db`.`pacote` (`idPacote`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `estimatech_db`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`cliente` (
  `idCliente` INT(11) NOT NULL AUTO_INCREMENT,
  `Email` VARCHAR(45) NOT NULL,
  `Senha` VARCHAR(45) NOT NULL,
  `Compra_idCompra` INT(11) NOT NULL,
  `ClientePF_idCPF` INT(11) NULL DEFAULT NULL,
  `ClientePJ_idCNPJ` INT(11) NULL DEFAULT NULL,
  `EXCLUIDO` TINYINT(1) NOT NULL,
  `Cep` INT(11) NULL DEFAULT NULL,
  `Logradouro` VARCHAR(45) NULL DEFAULT NULL,
  `Bairro` VARCHAR(45) NULL DEFAULT NULL,
  `Numero` INT(11) NULL DEFAULT NULL,
  `Complemento` VARCHAR(45) NULL DEFAULT NULL,
  `Cidade` VARCHAR(45) NULL DEFAULT NULL,
  `UF` VARCHAR(2) NULL DEFAULT NULL,
  PRIMARY KEY (`idCliente`),
  UNIQUE INDEX `email_UNIQUE` (`Email` ASC),
  INDEX `fk_Cliente_ClientePF1` (`ClientePF_idCPF` ASC),
  INDEX `fk_Cliente_ClientePJ1` (`ClientePJ_idCNPJ` ASC),
  INDEX `fk_Cliente_Compra` (`Compra_idCompra` ASC),
  CONSTRAINT `fk_Cliente_ClientePF1`
    FOREIGN KEY (`ClientePF_idCPF`)
    REFERENCES `estimatech_db`.`clientepf` (`idCPF`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cliente_ClientePJ1`
    FOREIGN KEY (`ClientePJ_idCNPJ`)
    REFERENCES `estimatech_db`.`clientepj` (`idCNPJ`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cliente_Compra`
    FOREIGN KEY (`Compra_idCompra`)
    REFERENCES `estimatech_db`.`compra` (`idCompra`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `estimatech_db`.`projeto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`projeto` (
  `idProjeto` INT(11) NOT NULL AUTO_INCREMENT,
  `Titulo` VARCHAR(45) NOT NULL,
  `DataCriacao` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DataFininalizacao` DATETIME NOT NULL,
  `Categoria` VARCHAR(45) NOT NULL,
  `Situacao` CHAR(1) NOT NULL,
  `UltimaAtualizacao` DATETIME NOT NULL,
  `Cliente_idCliente` INT(11) NOT NULL,
  PRIMARY KEY (`idProjeto`),
  INDEX `fk_Projeto_Cliente1` (`Cliente_idCliente` ASC),
  CONSTRAINT `fk_Projeto_Cliente1`
    FOREIGN KEY (`Cliente_idCliente`)
    REFERENCES `estimatech_db`.`cliente` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `estimatech_db`.`recursos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`recursos` (
  `idRecursos` INT(11) NOT NULL AUTO_INCREMENT,
  `Descricao` VARCHAR(45) NOT NULL,
  `Carga_horaria` INT(11) NOT NULL,
  `Custo` DECIMAL(3,2) NOT NULL,
  PRIMARY KEY (`idRecursos`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `estimatech_db`.`equipe`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`equipe` (
  `Recursos_idRecursos` INT(11) NOT NULL AUTO_INCREMENT,
  `Projeto_idProjeto` INT(11) NOT NULL,
  `QtRecursos` INT(11) NOT NULL,
  PRIMARY KEY (`Recursos_idRecursos`, `Projeto_idProjeto`),
  INDEX `fk_Equipe_Recursos1_idx` (`Recursos_idRecursos` ASC),
  INDEX `fk_Equipe_Projeto1` (`Projeto_idProjeto` ASC),
  CONSTRAINT `fk_Equipe_Projeto1`
    FOREIGN KEY (`Projeto_idProjeto`)
    REFERENCES `estimatech_db`.`projeto` (`idProjeto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Equipe_Recursos1`
    FOREIGN KEY (`Recursos_idRecursos`)
    REFERENCES `estimatech_db`.`recursos` (`idRecursos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
