SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `Estimatech_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `Estimatech_db` ;

-- -----------------------------------------------------
-- Table `Estimatech_db`.`Pacote`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Estimatech_db`.`Pacote` (
  `idPacote` INT NOT NULL,
  `Descricao` VARCHAR(45) NOT NULL,
  `LimiteProjetos` INT NOT NULL,
  `Validate` DATETIME NOT NULL,
  `Valor` FLOAT NOT NULL,
  PRIMARY KEY (`idPacote`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Estimatech_db`.`Compra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Estimatech_db`.`Compra` (
  `idCompra` INT NOT NULL,
  `DataCompra` DATE NOT NULL,
  `Validade` DATE NOT NULL,
  `Pacote_idPacote` INT NOT NULL,
  PRIMARY KEY (`idCompra`),
  INDEX `fk_Compra_Pacote1_idx` (`Pacote_idPacote` ASC),
  CONSTRAINT `fk_Compra_Pacote1`
    FOREIGN KEY (`Pacote_idPacote`)
    REFERENCES `Estimatech_db`.`Pacote` (`idPacote`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Estimatech_db`.`ClientePF`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Estimatech_db`.`ClientePF` (
  `idCPF` INT NOT NULL,
  `Nome` VARCHAR(45) NOT NULL,
  `Sobrenome` VARCHAR(45) NOT NULL,
  `Telefone` INT NOT NULL,
  `datNasc` DATE NOT NULL,
  `Sexo` CHAR NOT NULL,
  `dataCadastro` DATETIME NOT NULL,
  PRIMARY KEY (`idCPF`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Estimatech_db`.`ClientePJ`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Estimatech_db`.`ClientePJ` (
  `idCNPJ` INT NOT NULL,
  `NomeFantasia` VARCHAR(45) NOT NULL,
  `Telefone` INT NOT NULL,
  `dataCadastro` DATETIME NOT NULL,
  PRIMARY KEY (`idCNPJ`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Estimatech_db`.`Cidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Estimatech_db`.`Cidade` (
  `idCidade` INT NOT NULL,
  `Nome` VARCHAR(45) NOT NULL,
  `UF` VARCHAR(2) NOT NULL,
  PRIMARY KEY (`idCidade`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Estimatech_db`.`Endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Estimatech_db`.`Endereco` (
  `idEndereco` INT NOT NULL,
  `Cep` INT NOT NULL,
  `Logradouro` VARCHAR(45) NOT NULL,
  `Bairro` VARCHAR(45) NOT NULL,
  `Numero` INT NOT NULL,
  `Complemento` VARCHAR(45) NULL,
  `Cidade_idCidade` INT NOT NULL,
  PRIMARY KEY (`idEndereco`),
  INDEX `fk_Endereco_Cidade1_idx` (`Cidade_idCidade` ASC),
  CONSTRAINT `fk_Endereco_Cidade1`
    FOREIGN KEY (`Cidade_idCidade`)
    REFERENCES `Estimatech_db`.`Cidade` (`idCidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Estimatech_db`.`Cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Estimatech_db`.`Cliente` (
  `idCliente` INT NOT NULL,
  `Email` VARCHAR(45) NOT NULL,
  `Senha` VARCHAR(45) NOT NULL,
  `Endereco_idEndereco` INT NOT NULL,
  `Compra_idCompra` INT NOT NULL,
  `ClientePF_idCPF` INT NULL,
  `ClientePJ_idCNPJ` INT NULL,
  `EXCLUIDO` TINYINT(1) NOT NULL,
  PRIMARY KEY (`idCliente`),
  UNIQUE INDEX `email_UNIQUE` (`Email` ASC),
  INDEX `fk_Cliente_Compra_idx` (`Compra_idCompra` ASC),
  INDEX `fk_Cliente_ClientePF1_idx` (`ClientePF_idCPF` ASC),
  INDEX `fk_Cliente_ClientePJ1_idx` (`ClientePJ_idCNPJ` ASC),
  INDEX `fk_Cliente_Endereco1_idx` (`Endereco_idEndereco` ASC),
  CONSTRAINT `fk_Cliente_Compra`
    FOREIGN KEY (`Compra_idCompra`)
    REFERENCES `Estimatech_db`.`Compra` (`idCompra`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cliente_ClientePF1`
    FOREIGN KEY (`ClientePF_idCPF`)
    REFERENCES `Estimatech_db`.`ClientePF` (`idCPF`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cliente_ClientePJ1`
    FOREIGN KEY (`ClientePJ_idCNPJ`)
    REFERENCES `Estimatech_db`.`ClientePJ` (`idCNPJ`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cliente_Endereco1`
    FOREIGN KEY (`Endereco_idEndereco`)
    REFERENCES `Estimatech_db`.`Endereco` (`idEndereco`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Estimatech_db`.`Projeto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Estimatech_db`.`Projeto` (
  `idProjeto` INT NOT NULL,
  `Titulo` VARCHAR(45) NOT NULL,
  `DataCriacao` DATETIME NOT NULL,
  `DataFininalizacao` DATETIME NOT NULL,
  `Categoria` VARCHAR(45) NOT NULL,
  `Status` VARCHAR(45) NULL,
  `GerenciaProjeto_Cliente_idCliente` INT NOT NULL,
  `UltimaAtualizacao` DATETIME NOT NULL,
  `Cliente_idCliente` INT NOT NULL,
  PRIMARY KEY (`idProjeto`),
  INDEX `fk_Projeto_Cliente1_idx` (`Cliente_idCliente` ASC),
  CONSTRAINT `fk_Projeto_Cliente1`
    FOREIGN KEY (`Cliente_idCliente`)
    REFERENCES `Estimatech_db`.`Cliente` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Estimatech_db`.`Recursos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Estimatech_db`.`Recursos` (
  `idRecursos` INT NOT NULL,
  `Descricao` VARCHAR(45) NOT NULL,
  `Carga_horaria` INT NOT NULL,
  `Custo` DECIMAL(3,2) NOT NULL,
  PRIMARY KEY (`idRecursos`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Estimatech_db`.`Equipe`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Estimatech_db`.`Equipe` (
  `Recursos_idRecursos` INT NOT NULL,
  `Projeto_idProjeto` INT NOT NULL,
  `QtRecursos` INT NOT NULL,
  PRIMARY KEY (`Recursos_idRecursos`, `Projeto_idProjeto`),
  INDEX `fk_Equipe_Recursos1_idx` (`Recursos_idRecursos` ASC),
  INDEX `fk_Equipe_Projeto1_idx` (`Projeto_idProjeto` ASC),
  CONSTRAINT `fk_Equipe_Recursos1`
    FOREIGN KEY (`Recursos_idRecursos`)
    REFERENCES `Estimatech_db`.`Recursos` (`idRecursos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Equipe_Projeto1`
    FOREIGN KEY (`Projeto_idProjeto`)
    REFERENCES `Estimatech_db`.`Projeto` (`idProjeto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
