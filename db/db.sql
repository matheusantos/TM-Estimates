
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Schema estimatech_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `estimatech_db` DEFAULT CHARACTER SET utf8 ;
USE `estimatech_db` ;

-- -----------------------------------------------------
-- Table `estimatech_db`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`cliente` (
  `idCliente` INT(11) NOT NULL AUTO_INCREMENT,
  `Email` VARCHAR(45) NOT NULL,
  `Senha` VARCHAR(64) NOT NULL,
  `EXCLUIDO` TINYINT(1) NOT NULL,
  `Cep` VARCHAR(10) NOT NULL,
  `Logradouro` VARCHAR(45) NOT NULL,
  `Bairro` VARCHAR(45) NOT NULL,
  `Numero` INT(11) NULL DEFAULT NULL,
  `Complemento` VARCHAR(45) NULL DEFAULT NULL,
  `Cidade` VARCHAR(45) NOT NULL,
  `UF` VARCHAR(2) NOT NULL,
  `DataCriacao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idCliente`),
  UNIQUE INDEX `email_UNIQUE` USING BTREE (`Email` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `estimatech_db`.`ambiente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`ambiente` (
  `idAmbiente` INT(11) NOT NULL AUTO_INCREMENT,
  `Linguagem` VARCHAR(45) NOT NULL,
  `Esforco` DECIMAL(10,0) NOT NULL,
  `Produtividade` DECIMAL(10,0) NOT NULL,
  `cliente_idCliente` INT(11) NOT NULL,
  PRIMARY KEY (`idAmbiente`),
  INDEX `fk_ambiente_cliente1_idx` USING BTREE (`cliente_idCliente` ASC),
  CONSTRAINT `ambiente_ibfk_1`
    FOREIGN KEY (`cliente_idCliente`)
    REFERENCES `estimatech_db`.`cliente` (`idCliente`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `estimatech_db`.`clientepf`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`clientepf` (
  `idCPF` INT(11) NOT NULL AUTO_INCREMENT,
  `Nome` VARCHAR(45) NOT NULL,
  `Sobrenome` VARCHAR(45) NOT NULL,
  `Telefone` VARCHAR(15) NOT NULL,
  `datNasc` DATE NOT NULL,
  `Sexo` CHAR(1) NOT NULL,
  `cliente_idCliente` INT(11) NOT NULL,
  `CPF` VARCHAR(14) NOT NULL,
  `RG` VARCHAR(13) NOT NULL,
  PRIMARY KEY (`idCPF`),
  INDEX `fk_clientepf_cliente1_idx` USING BTREE (`cliente_idCliente` ASC),
  CONSTRAINT `clientepf_ibfk_1`
    FOREIGN KEY (`cliente_idCliente`)
    REFERENCES `estimatech_db`.`cliente` (`idCliente`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `estimatech_db`.`clientepj`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`clientepj` (
  `idCNPJ` INT(11) NOT NULL AUTO_INCREMENT,
  `NomeFantasia` VARCHAR(45) NOT NULL,
  `Telefone` VARCHAR(15) NOT NULL,
  `cliente_idCliente` INT(11) NOT NULL,
  `CNPJ` VARCHAR(18) NOT NULL,
  PRIMARY KEY (`idCNPJ`),
  INDEX `fk_clientepj_cliente1_idx` USING BTREE (`cliente_idCliente` ASC),
  CONSTRAINT `clientepj_ibfk_1`
    FOREIGN KEY (`cliente_idCliente`)
    REFERENCES `estimatech_db`.`cliente` (`idCliente`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
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
  `cliente_idCliente` INT(11) NOT NULL,
  PRIMARY KEY (`idCompra`, `cliente_idCliente`),
  INDEX `fk_Compra_Pacote1` USING BTREE (`Pacote_idPacote` ASC),
  INDEX `fk_compra_cliente1_idx` USING BTREE (`cliente_idCliente` ASC),
  CONSTRAINT `compra_ibfk_1`
    FOREIGN KEY (`Pacote_idPacote`)
    REFERENCES `estimatech_db`.`pacote` (`idPacote`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `compra_ibfk_2`
    FOREIGN KEY (`cliente_idCliente`)
    REFERENCES `estimatech_db`.`cliente` (`idCliente`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `estimatech_db`.`fase`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`fase` (
  `idFase` INT(11) NOT NULL AUTO_INCREMENT,
  `Descricao` VARCHAR(45) NOT NULL,
  `Percentual` INT(11) NULL DEFAULT NULL,
  `datIniPrev` DATETIME NULL DEFAULT NULL,
  `datFinPrev` DATETIME NULL DEFAULT NULL,
  `datIniEfet` DATETIME NULL DEFAULT NULL,
  `datFinEfet` DATETIME NULL DEFAULT NULL,
  `cliente_idCliente` INT(11) NOT NULL,
  PRIMARY KEY (`idFase`),
  INDEX `fk_fase_cliente1_idx` USING BTREE (`cliente_idCliente` ASC),
  CONSTRAINT `fase_ibfk_1`
    FOREIGN KEY (`cliente_idCliente`)
    REFERENCES `estimatech_db`.`cliente` (`idCliente`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `estimatech_db`.`custofase`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`custofase` (
  `idCustoFase` INT(11) NOT NULL AUTO_INCREMENT,
  `Descricao` VARCHAR(45) NOT NULL,
  `ValorPrevisto` DECIMAL(10,0) NOT NULL,
  `ValorEfetivo` DECIMAL(10,0) NOT NULL,
  `fase_idFase` INT(11) NOT NULL,
  PRIMARY KEY (`idCustoFase`),
  INDEX `fk_custoFase_fase1_idx` USING BTREE (`fase_idFase` ASC),
  CONSTRAINT `custofase_ibfk_1`
    FOREIGN KEY (`fase_idFase`)
    REFERENCES `estimatech_db`.`fase` (`idFase`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `estimatech_db`.`projeto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`projeto` (
  `idProjeto` INT(11) NOT NULL AUTO_INCREMENT,
  `Titulo` VARCHAR(45) NOT NULL,
  `DataCriacao` DATE NOT NULL,
  `DataFininalizacao` DATE NULL DEFAULT NULL,
  `Categoria` VARCHAR(45) NOT NULL,
  `Situacao` CHAR(1) NOT NULL,
  `UltimaAtualizacao` DATETIME NOT NULL,
  `Cliente_idCliente` INT(11) NOT NULL,
  PRIMARY KEY (`idProjeto`),
  INDEX `fk_Projeto_Cliente1` USING BTREE (`Cliente_idCliente` ASC),
  CONSTRAINT `projeto_ibfk_1`
    FOREIGN KEY (`Cliente_idCliente`)
    REFERENCES `estimatech_db`.`cliente` (`idCliente`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `estimatech_db`.`recursos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`recursos` (
  `idRecursos` INT(11) NOT NULL AUTO_INCREMENT,
  `Descricao` VARCHAR(45) NOT NULL,
  `Carga_horaria` INT(11) NOT NULL,
  `Custo` VARCHAR(6) NOT NULL,
  `cliente_idCliente` INT(11) NOT NULL,
  PRIMARY KEY (`idRecursos`),
  INDEX `fk_recursos_cliente1_idx` USING BTREE (`cliente_idCliente` ASC),
  CONSTRAINT `recursos_ibfk_1`
    FOREIGN KEY (`cliente_idCliente`)
    REFERENCES `estimatech_db`.`cliente` (`idCliente`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `estimatech_db`.`equipe`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`equipe` (
  `Recursos_idRecursos` INT(11) NOT NULL AUTO_INCREMENT,
  `Projeto_idProjeto` INT(11) NOT NULL,
  `QtRecursos` INT(11) NOT NULL,
  PRIMARY KEY (`Recursos_idRecursos`, `Projeto_idProjeto`),
  INDEX `fk_Equipe_Recursos1_idx` USING BTREE (`Recursos_idRecursos` ASC),
  INDEX `fk_Equipe_Projeto1` USING BTREE (`Projeto_idProjeto` ASC),
  CONSTRAINT `equipe_ibfk_1`
    FOREIGN KEY (`Projeto_idProjeto`)
    REFERENCES `estimatech_db`.`projeto` (`idProjeto`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `equipe_ibfk_2`
    FOREIGN KEY (`Recursos_idRecursos`)
    REFERENCES `estimatech_db`.`recursos` (`idRecursos`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `estimatech_db`.`recuperarsenha`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`recuperarsenha` (
  `idRecuperar` INT(11) NOT NULL AUTO_INCREMENT,
  `Hash` VARCHAR(64) NOT NULL,
  `Data_hora` DATETIME NOT NULL,
  `Utilizada` TINYINT(1) NOT NULL,
  `cliente_idCliente` INT(11) NOT NULL,
  PRIMARY KEY (`idRecuperar`),
  UNIQUE INDEX `Hash_UNIQUE` (`Hash` ASC),
  INDEX `fk_recuperarsenha_cliente1_idx` (`cliente_idCliente` ASC),
  CONSTRAINT `fk_recuperarsenha_cliente1`
    FOREIGN KEY (`cliente_idCliente`)
    REFERENCES `estimatech_db`.`cliente` (`idCliente`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `estimatech_db`.`Colaboradores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`Colaboradores` (
  `idColaboradores` INT NOT NULL AUTO_INCREMENT,
  `quantcolabN5` INT NULL,
  `quantcolabN4` INT NULL,
  `quantcolabN3` INT NULL,
  `quantcolabN2` INT NULL,
  `quantcolabN1` INT NULL,
  `custoHoraN5` DECIMAL(3) NULL,
  `custoHoraN4` DECIMAL(3) NULL,
  `custoHoraN3` DECIMAL(3) NULL,
  `custoHoraN2` DECIMAL(3) NULL,
  `custoHoraN1` DECIMAL(3) NULL,
  `quantHorasbN5` INT NULL,
  `quantHorasN4` INT NULL,
  `quantHorasN3` INT NULL,
  `quantHorasN2` INT NULL,
  `quantHorasN1` INT NULL,
  `idProjeto` INT NULL,
  PRIMARY KEY (`idColaboradores`),
  INDEX `fkidprojeto_idx` (`idProjeto` ASC),
  CONSTRAINT `fkidprojeto`
    FOREIGN KEY (`idProjeto`)
    REFERENCES `estimatech_db`.`projeto` (`idProjeto`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `estimatech_db`.`funcDados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`funcDados` (
  `idfuncDados` INT NOT NULL AUTO_INCREMENT,
  `funcDadoscol` VARCHAR(45) NULL,
  `funcao` CHAR(3) NULL,
  `descricao` VARCHAR(45) NULL,
  `tiposRegistro` INT NULL,
  `tiposDados` INT NULL,
  `complexidade` VARCHAR(45) NULL,
  `pontoFunc` INT NULL,
  `idProjeto` INT NULL,
  PRIMARY KEY (`idfuncDados`),
  INDEX `fkproj_idx` (`idProjeto` ASC),
  CONSTRAINT `fkproj`
    FOREIGN KEY (`idProjeto`)
    REFERENCES `estimatech_db`.`projeto` (`idProjeto`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
