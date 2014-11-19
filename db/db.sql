SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

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
  `Telefone` VARCHAR(15) NULL DEFAULT NULL,
  `Celular` VARCHAR(15) NULL DEFAULT NULL,
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
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `estimatech_db`.`clientepj`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`clientepj` (
  `idCNPJ` INT(11) NOT NULL AUTO_INCREMENT,
  `NomeFantasia` VARCHAR(45) NOT NULL,
  `RazaoSocial` VARCHAR(45) NOT NULL,
  `Telefone` VARCHAR(15) NULL DEFAULT NULL,
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
-- Table `estimatech_db`.`colaboradores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`colaboradores` (
  `idColaboradores` INT(11) NOT NULL AUTO_INCREMENT,
  `quantcolabN5` INT(11) NULL DEFAULT NULL,
  `quantcolabN4` INT(11) NULL DEFAULT NULL,
  `quantcolabN3` INT(11) NULL DEFAULT NULL,
  `quantcolabN2` INT(11) NULL DEFAULT NULL,
  `quantcolabN1` INT(11) NULL DEFAULT NULL,
  `custoHoraN5` DECIMAL(3,0) NULL DEFAULT NULL,
  `custoHoraN4` DECIMAL(3,0) NULL DEFAULT NULL,
  `custoHoraN3` DECIMAL(3,0) NULL DEFAULT NULL,
  `custoHoraN2` DECIMAL(3,0) NULL DEFAULT NULL,
  `custoHoraN1` DECIMAL(3,0) NULL DEFAULT NULL,
  `quantHorasbN5` INT(11) NULL DEFAULT NULL,
  `quantHorasN4` INT(11) NULL DEFAULT NULL,
  `quantHorasN3` INT(11) NULL DEFAULT NULL,
  `quantHorasN2` INT(11) NULL DEFAULT NULL,
  `quantHorasN1` INT(11) NULL DEFAULT NULL,
  `idProjeto` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idColaboradores`),
  INDEX `fkidprojeto_idx` (`idProjeto` ASC),
  CONSTRAINT `fkidprojeto`
    FOREIGN KEY (`idProjeto`)
    REFERENCES `estimatech_db`.`projeto` (`idProjeto`)
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
  `ValorPrevisto` VARCHAR(15) NOT NULL,
  `ValorEfetivo` VARCHAR(15) NOT NULL,
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
-- Table `estimatech_db`.`recursos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`recursos` (
  `idRecursos` INT(11) NOT NULL AUTO_INCREMENT,
  `Descricao` VARCHAR(45) NOT NULL,
  `Carga_horaria` INT(11) NOT NULL,
  `Custo` VARCHAR(6) NOT NULL,
  `Nivel` INT(1) NOT NULL DEFAULT 0,
  `cliente_idCliente` INT(11) NOT NULL,
  PRIMARY KEY (`idRecursos`),
  INDEX `fk_recursos_cliente1_idx` USING BTREE (`cliente_idCliente` ASC),
  CONSTRAINT `recursos_ibfk_1`
    FOREIGN KEY (`cliente_idCliente`)
    REFERENCES `estimatech_db`.`cliente` (`idCliente`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


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
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `estimatech_db`.`funcaodados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`funcaodados` (
  `idFuncaoDados` INT(11) NOT NULL AUTO_INCREMENT,
  `Descricao` VARCHAR(45) NOT NULL,
  `Funcao` VARCHAR(3) NOT NULL,
  `qtdTiposRegistro` INT(11) NOT NULL,
  `qtdTiposDados` VARCHAR(45) NOT NULL,
  `PF` INT(11) NULL DEFAULT NULL,
  `Complexidade` VARCHAR(6) NULL DEFAULT NULL,
  `projeto_idProjeto` INT(11) NOT NULL,
  PRIMARY KEY (`idFuncaoDados`),
  INDEX `fk_funcaoDados_projeto1_idx` (`projeto_idProjeto` ASC),
  CONSTRAINT `fk_funcaoDados_projeto1`
    FOREIGN KEY (`projeto_idProjeto`)
    REFERENCES `estimatech_db`.`projeto` (`idProjeto`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `estimatech_db`.`funcaotransacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`funcaotransacao` (
  `idFuncaoTransacao` INT(11) NOT NULL AUTO_INCREMENT,
  `Descricao` VARCHAR(45) NOT NULL,
  `Funcao` VARCHAR(3) NOT NULL,
  `qtdArquivoRef` INT(11) NOT NULL,
  `qtdTipoDados` VARCHAR(45) NOT NULL,
  `PF` INT(11) NULL DEFAULT NULL,
  `Complexidade` VARCHAR(6) NULL DEFAULT NULL,
  `projeto_idProjeto` INT(11) NOT NULL,
  PRIMARY KEY (`idFuncaoTransacao`),
  INDEX `fk_funcaoTransacao_projeto1_idx` (`projeto_idProjeto` ASC),
  CONSTRAINT `fk_funcaoTransacao_projeto1`
    FOREIGN KEY (`projeto_idProjeto`)
    REFERENCES `estimatech_db`.`projeto` (`idProjeto`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `estimatech_db`.`funcdados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`funcdados` (
  `idfuncDados` INT(11) NOT NULL AUTO_INCREMENT,
  `funcDadoscol` VARCHAR(45) NULL DEFAULT NULL,
  `funcao` CHAR(3) NULL DEFAULT NULL,
  `descricao` VARCHAR(45) NULL DEFAULT NULL,
  `tiposRegistro` INT(11) NULL DEFAULT NULL,
  `tiposDados` INT(11) NULL DEFAULT NULL,
  `complexidade` VARCHAR(45) NULL DEFAULT NULL,
  `pontoFunc` INT(11) NULL DEFAULT NULL,
  `idProjeto` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idfuncDados`),
  INDEX `fkproj_idx` (`idProjeto` ASC),
  CONSTRAINT `fkproj`
    FOREIGN KEY (`idProjeto`)
    REFERENCES `estimatech_db`.`projeto` (`idProjeto`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `estimatech_db`.`itensinfluencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`itensinfluencia` (
  `idItensInfluencia` INT(11) NOT NULL AUTO_INCREMENT,
  `ComunicaoDados` INT(11) NOT NULL DEFAULT '0',
  `ProcDistribuido` INT(11) NOT NULL DEFAULT '0',
  `Performace` INT(11) NOT NULL DEFAULT '0',
  `ConfAltaUtil` INT(11) NOT NULL DEFAULT '0',
  `FaixaTransacoes` INT(11) NOT NULL DEFAULT '0',
  `EntradaDadosOnLine` INT(11) NOT NULL DEFAULT '0',
  `EficUserFinal` INT(11) NOT NULL DEFAULT '0',
  `AtualizacaoOnLine` INT(11) NOT NULL DEFAULT '0',
  `ComplexidadeProc` INT(11) NOT NULL DEFAULT '0',
  `Reutilizacao` INT(11) NOT NULL DEFAULT '0',
  `FacilidadeInstalacao` INT(11) NOT NULL DEFAULT '0',
  `FacilidadeOperacao` INT(11) NOT NULL DEFAULT '0',
  `MultiplasLocalidades` INT(11) NOT NULL DEFAULT '0',
  `FacilidadeMudancas` INT(11) NOT NULL DEFAULT '0',
  `projeto_idProjeto` INT(11) NOT NULL,
  `FatorAjuste` FLOAT(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idItensInfluencia`),
  INDEX `fk_itensInfluencia_projeto1_idx` (`projeto_idProjeto` ASC),
  CONSTRAINT `fk_itensInfluencia_projeto1`
    FOREIGN KEY (`projeto_idProjeto`)
    REFERENCES `estimatech_db`.`projeto` (`idProjeto`)
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

USE `estimatech_db` ;

-- -----------------------------------------------------
-- Placeholder table for view `estimatech_db`.`clienteFuncaoDados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`clienteFuncaoDados` (`idFuncaoDados` INT, `Descricao` INT, `Funcao` INT, `qtdTiposRegistro` INT, `qtdTiposDados` INT, `PF` INT, `Complexidade` INT, `projeto_idProjeto` INT, `Cliente_idCliente` INT);

-- -----------------------------------------------------
-- Placeholder table for view `estimatech_db`.`clienteEquipe`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`clienteEquipe` (`Cliente_idCliente` INT, `Recursos_idRecursos` INT, `Projeto_idProjeto` INT, `QtRecursos` INT);

-- -----------------------------------------------------
-- Placeholder table for view `estimatech_db`.`view_clienteCustoFase`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`view_clienteCustoFase` (`idCustoFase` INT, `descricaoCusto` INT, `ValorPrevisto` INT, `ValorEfetivo` INT, `descricaoFase` INT, `cliente_idCliente` INT);

-- -----------------------------------------------------
-- View `estimatech_db`.`clienteFuncaoDados`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estimatech_db`.`clienteFuncaoDados`;
USE `estimatech_db`;
CREATE  OR REPLACE VIEW `clienteFuncaoDados` AS
SELECT fd.*, p.Cliente_idCliente
FROM projeto AS p, cliente AS c, funcaodados AS fd
WHERE c.idCliente = p.Cliente_idCliente;

-- -----------------------------------------------------
-- View `estimatech_db`.`clienteEquipe`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estimatech_db`.`clienteEquipe`;
USE `estimatech_db`;
CREATE  OR REPLACE VIEW `clienteEquipe` AS
SELECT p.Cliente_idCliente, eq.*
FROM projeto AS p, equipe AS eq
WHERE eq.Projeto_idProjeto = p.idProjeto;

-- -----------------------------------------------------
-- View `estimatech_db`.`view_clienteCustoFase`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estimatech_db`.`view_clienteCustoFase`;
USE `estimatech_db`;
CREATE  OR REPLACE VIEW `view_clienteCustoFase` AS
SELECT cf.idCustoFase, cf.Descricao AS descricaoCusto, cf.ValorPrevisto, cf.ValorEfetivo, f.Descricao AS descricaoFase, f.cliente_idCliente
FROM custofase AS cf
INNER JOIN fase AS f
ON f.idFase = cf.fase_idFase;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
