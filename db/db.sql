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
  `Nome` VARCHAR(45) NOT NULL,
  `Email` VARCHAR(45) NOT NULL,
  `idProjeto` INT(11) NOT NULL,
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
  `Nivel` INT(1) NOT NULL DEFAULT '0',
  `projeto_idProjeto` INT(11) NOT NULL,
  PRIMARY KEY (`idRecursos`),
  INDEX `fk_recursos_projeto1_idx` (`projeto_idProjeto` ASC),
  CONSTRAINT `fk_recursos_projeto1`
    FOREIGN KEY (`projeto_idProjeto`)
    REFERENCES `estimatech_db`.`projeto` (`idProjeto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
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
-- Table `estimatech_db`.`estimativascusto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`estimativascusto` (
  `idestimativasCusto` INT(11) NOT NULL AUTO_INCREMENT,
  `Data` DATE NOT NULL,
  `Estimativa` INT(11) NOT NULL,
  `projeto_idProjeto` INT(11) NOT NULL,
  PRIMARY KEY (`idestimativasCusto`),
  INDEX `fk_estimativasCusto_projeto1_idx` (`projeto_idProjeto` ASC),
  CONSTRAINT `fk_estimativasCusto_projeto1`
    FOREIGN KEY (`projeto_idProjeto`)
    REFERENCES `estimatech_db`.`projeto` (`idProjeto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `estimatech_db`.`estimativasesforco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`estimativasesforco` (
  `idEstimativasEsforco` INT(11) NOT NULL AUTO_INCREMENT,
  `Data` DATE NOT NULL,
  `Estimativa` INT(11) NOT NULL,
  `projeto_idProjeto` INT(11) NOT NULL,
  PRIMARY KEY (`idEstimativasEsforco`),
  INDEX `fk_estimativasEsforco_projeto1_idx` (`projeto_idProjeto` ASC),
  CONSTRAINT `fk_estimativasEsforco_projeto1`
    FOREIGN KEY (`projeto_idProjeto`)
    REFERENCES `estimatech_db`.`projeto` (`idProjeto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `estimatech_db`.`estimativasprazo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`estimativasprazo` (
  `idEstimativasPrazo` INT(11) NOT NULL AUTO_INCREMENT,
  `Data` DATE NOT NULL,
  `Estimativa` INT(11) NOT NULL,
  `projeto_idProjeto` INT(11) NOT NULL,
  PRIMARY KEY (`idEstimativasPrazo`),
  INDEX `fk_estimativasPrazo_projeto1_idx` (`projeto_idProjeto` ASC),
  CONSTRAINT `fk_estimativasPrazo_projeto1`
    FOREIGN KEY (`projeto_idProjeto`)
    REFERENCES `estimatech_db`.`projeto` (`idProjeto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `estimatech_db`.`estimativasprodutividade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`estimativasprodutividade` (
  `idEstimativasProdutividade` INT(11) NOT NULL AUTO_INCREMENT,
  `Data` DATE NOT NULL,
  `Estimativa` INT(11) NOT NULL,
  `projeto_idProjeto` INT(11) NOT NULL,
  PRIMARY KEY (`idEstimativasProdutividade`),
  INDEX `fk_estimativasProdutividade_projeto1_idx` (`projeto_idProjeto` ASC),
  CONSTRAINT `fk_estimativasProdutividade_projeto1`
    FOREIGN KEY (`projeto_idProjeto`)
    REFERENCES `estimatech_db`.`projeto` (`idProjeto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


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
  `FatorAjuste` FLOAT NOT NULL DEFAULT '0',
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
-- Table `estimatech_db`.`pontosfuncao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`pontosfuncao` (
  `idPontosfuncao` INT(11) NOT NULL AUTO_INCREMENT,
  `Data` DATE NOT NULL,
  `Estimativa` INT(11) NOT NULL,
  `projeto_idProjeto` INT(11) NOT NULL,
  PRIMARY KEY (`idPontosfuncao`),
  INDEX `fk_pontosfuncao_projeto1_idx` (`projeto_idProjeto` ASC),
  CONSTRAINT `fk_pontosfuncao_projeto1`
    FOREIGN KEY (`projeto_idProjeto`)
    REFERENCES `estimatech_db`.`projeto` (`idProjeto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
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
-- Placeholder table for view `estimatech_db`.`clienteequipe`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`clienteequipe` (`Recursos_idRecursos` INT, `Projeto_idProjeto` INT, `QtRecursos` INT, `Descricao` INT, `Titulo` INT, `Cliente_idCliente` INT);

-- -----------------------------------------------------
-- Placeholder table for view `estimatech_db`.`clientefuncaodados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`clientefuncaodados` (`idFuncaoDados` INT, `Descricao` INT, `Funcao` INT, `qtdTiposRegistro` INT, `qtdTiposDados` INT, `PF` INT, `Complexidade` INT, `projeto_idProjeto` INT, `Cliente_idCliente` INT);

-- -----------------------------------------------------
-- Placeholder table for view `estimatech_db`.`view_clientecustofase`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`view_clientecustofase` (`idCustoFase` INT, `descricaoCusto` INT, `ValorPrevisto` INT, `ValorEfetivo` INT, `descricaoFase` INT, `cliente_idCliente` INT);

-- -----------------------------------------------------
-- Placeholder table for view `estimatech_db`.`view_estimativascusto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`view_estimativascusto` (`idestimativasCusto` INT, `Data` INT, `Estimativa` INT, `projeto_idProjeto` INT, `Titulo` INT, `Cliente_idCliente` INT);

-- -----------------------------------------------------
-- Placeholder table for view `estimatech_db`.`view_estimativasesforco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`view_estimativasesforco` (`idEstimativasEsforco` INT, `Data` INT, `Estimativa` INT, `projeto_idProjeto` INT, `Titulo` INT, `Cliente_idCliente` INT);

-- -----------------------------------------------------
-- Placeholder table for view `estimatech_db`.`view_estimativasprazo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`view_estimativasprazo` (`idEstimativasPrazo` INT, `Data` INT, `Estimativa` INT, `projeto_idProjeto` INT, `Titulo` INT, `Cliente_idCliente` INT);

-- -----------------------------------------------------
-- Placeholder table for view `estimatech_db`.`view_estimativasprodutividade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`view_estimativasprodutividade` (`idEstimativasProdutividade` INT, `Data` INT, `Estimativa` INT, `projeto_idProjeto` INT, `Titulo` INT, `Cliente_idCliente` INT);

-- -----------------------------------------------------
-- Placeholder table for view `estimatech_db`.`view_pontosfuncao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`view_pontosfuncao` (`idPontosfuncao` INT, `Data` INT, `Estimativa` INT, `projeto_idProjeto` INT, `Titulo` INT);

-- -----------------------------------------------------
-- Placeholder table for view `estimatech_db`.`view_recurso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`view_recurso` (`idRecursos` INT, `Descricao` INT, `Carga_horaria` INT, `Custo` INT, `Nivel` INT, `projeto_idProjeto` INT, `Titulo` INT, `Cliente_idCliente` INT);

-- -----------------------------------------------------
-- Placeholder table for view `estimatech_db`.`view_relatorio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estimatech_db`.`view_relatorio` (`idProjeto` INT, `Titulo` INT, `Custo` INT, `Prazo` INT, `Esforco` INT, `Produtividade` INT);

-- -----------------------------------------------------
-- View `estimatech_db`.`clienteequipe`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estimatech_db`.`clienteequipe`;
USE `estimatech_db`;
CREATE  OR REPLACE VIEW `clienteequipe` AS
SELECT eq.*, r.Descricao, p.Titulo, p.Cliente_idCliente
FROM equipe AS eq
INNER JOIN projeto AS p
ON p.idProjeto = eq.Projeto_idProjeto
INNER JOIN recursos AS r
ON r.idRecursos = eq.Recursos_idRecursos;

-- -----------------------------------------------------
-- View `estimatech_db`.`clientefuncaodados`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estimatech_db`.`clientefuncaodados`;
USE `estimatech_db`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `estimatech_db`.`clientefuncaodados` AS select `fd`.`idFuncaoDados` AS `idFuncaoDados`,`fd`.`Descricao` AS `Descricao`,`fd`.`Funcao` AS `Funcao`,`fd`.`qtdTiposRegistro` AS `qtdTiposRegistro`,`fd`.`qtdTiposDados` AS `qtdTiposDados`,`fd`.`PF` AS `PF`,`fd`.`Complexidade` AS `Complexidade`,`fd`.`projeto_idProjeto` AS `projeto_idProjeto`,`p`.`Cliente_idCliente` AS `Cliente_idCliente` from ((`estimatech_db`.`projeto` `p` join `estimatech_db`.`cliente` `c`) join `estimatech_db`.`funcaodados` `fd`) where (`c`.`idCliente` = `p`.`Cliente_idCliente`);

-- -----------------------------------------------------
-- View `estimatech_db`.`view_clientecustofase`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estimatech_db`.`view_clientecustofase`;
USE `estimatech_db`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `estimatech_db`.`view_clientecustofase` AS select `cf`.`idCustoFase` AS `idCustoFase`,`cf`.`Descricao` AS `descricaoCusto`,`cf`.`ValorPrevisto` AS `ValorPrevisto`,`cf`.`ValorEfetivo` AS `ValorEfetivo`,`f`.`Descricao` AS `descricaoFase`,`f`.`cliente_idCliente` AS `cliente_idCliente` from (`estimatech_db`.`custofase` `cf` join `estimatech_db`.`fase` `f` on((`f`.`idFase` = `cf`.`fase_idFase`)));

-- -----------------------------------------------------
-- View `estimatech_db`.`view_estimativascusto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estimatech_db`.`view_estimativascusto`;
USE `estimatech_db`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `estimatech_db`.`view_estimativascusto` AS select `ec`.`idestimativasCusto` AS `idestimativasCusto`,`ec`.`Data` AS `Data`,`ec`.`Estimativa` AS `Estimativa`,`ec`.`projeto_idProjeto` AS `projeto_idProjeto`,`p`.`Titulo` AS `Titulo`,`p`.`Cliente_idCliente` AS `Cliente_idCliente` from (`estimatech_db`.`estimativascusto` `ec` join `estimatech_db`.`projeto` `p` on((`p`.`idProjeto` = `ec`.`projeto_idProjeto`)));

-- -----------------------------------------------------
-- View `estimatech_db`.`view_estimativasesforco`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estimatech_db`.`view_estimativasesforco`;
USE `estimatech_db`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `estimatech_db`.`view_estimativasesforco` AS select `ec`.`idEstimativasEsforco` AS `idEstimativasEsforco`,`ec`.`Data` AS `Data`,`ec`.`Estimativa` AS `Estimativa`,`ec`.`projeto_idProjeto` AS `projeto_idProjeto`,`p`.`Titulo` AS `Titulo`,`p`.`Cliente_idCliente` AS `Cliente_idCliente` from (`estimatech_db`.`estimativasesforco` `ec` join `estimatech_db`.`projeto` `p` on((`p`.`idProjeto` = `ec`.`projeto_idProjeto`)));

-- -----------------------------------------------------
-- View `estimatech_db`.`view_estimativasprazo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estimatech_db`.`view_estimativasprazo`;
USE `estimatech_db`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `estimatech_db`.`view_estimativasprazo` AS select `ec`.`idEstimativasPrazo` AS `idEstimativasPrazo`,`ec`.`Data` AS `Data`,`ec`.`Estimativa` AS `Estimativa`,`ec`.`projeto_idProjeto` AS `projeto_idProjeto`,`p`.`Titulo` AS `Titulo`,`p`.`Cliente_idCliente` AS `Cliente_idCliente` from (`estimatech_db`.`estimativasprazo` `ec` join `estimatech_db`.`projeto` `p` on((`p`.`idProjeto` = `ec`.`projeto_idProjeto`)));

-- -----------------------------------------------------
-- View `estimatech_db`.`view_estimativasprodutividade`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estimatech_db`.`view_estimativasprodutividade`;
USE `estimatech_db`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `estimatech_db`.`view_estimativasprodutividade` AS select `ec`.`idEstimativasProdutividade` AS `idEstimativasProdutividade`,`ec`.`Data` AS `Data`,`ec`.`Estimativa` AS `Estimativa`,`ec`.`projeto_idProjeto` AS `projeto_idProjeto`,`p`.`Titulo` AS `Titulo`,`p`.`Cliente_idCliente` AS `Cliente_idCliente` from (`estimatech_db`.`estimativasprodutividade` `ec` join `estimatech_db`.`projeto` `p` on((`p`.`idProjeto` = `ec`.`projeto_idProjeto`)));

-- -----------------------------------------------------
-- View `estimatech_db`.`view_pontosfuncao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estimatech_db`.`view_pontosfuncao`;
USE `estimatech_db`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `estimatech_db`.`view_pontosfuncao` AS select `pf`.`idPontosfuncao` AS `idPontosfuncao`,`pf`.`Data` AS `Data`,`pf`.`Estimativa` AS `Estimativa`,`pf`.`projeto_idProjeto` AS `projeto_idProjeto`,`p`.`Titulo` AS `Titulo` from (`estimatech_db`.`pontosfuncao` `pf` join `estimatech_db`.`projeto` `p` on((`pf`.`projeto_idProjeto` = `p`.`idProjeto`)));

-- -----------------------------------------------------
-- View `estimatech_db`.`view_recurso`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estimatech_db`.`view_recurso`;
USE `estimatech_db`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `estimatech_db`.`view_recurso` AS select `r`.`idRecursos` AS `idRecursos`,`r`.`Descricao` AS `Descricao`,`r`.`Carga_horaria` AS `Carga_horaria`,`r`.`Custo` AS `Custo`,`r`.`Nivel` AS `Nivel`,`r`.`projeto_idProjeto` AS `projeto_idProjeto`,`p`.`Titulo` AS `Titulo`,`p`.`Cliente_idCliente` AS `Cliente_idCliente` from (`estimatech_db`.`recursos` `r` join `estimatech_db`.`projeto` `p` on((`p`.`idProjeto` = `r`.`projeto_idProjeto`)));

-- -----------------------------------------------------
-- View `estimatech_db`.`view_relatorio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estimatech_db`.`view_relatorio`;
USE `estimatech_db`;
CREATE  OR REPLACE VIEW `view_relatorio` AS
select p.idProjeto, p.Titulo, ec.Estimativa as Custo, epra.Estimativa as Prazo, ee.Estimativa as Esforco, epro.Estimativa as Produtividade
from projeto as p
inner join estimativascusto as ec
on p.idProjeto = ec.projeto_idProjeto
inner join estimativasprazo as epra
on p.idProjeto = epra.projeto_idProjeto
inner join estimativasesforco as ee
on p.idProjeto = ee.projeto_idProjeto
inner join estimativasprodutividade as epro
on p.idProjeto = epro.projeto_idProjeto;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
