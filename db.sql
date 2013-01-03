SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`ambiente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`ambiente` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`ambiente` (
  `id_ambiente` INT NOT NULL AUTO_INCREMENT ,
  `citta` VARCHAR(45) NULL ,
  `via` VARCHAR(45) NULL ,
  `cap` VARCHAR(45) NULL ,
  `numero_civico` VARCHAR(45) NULL ,
  `nome` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_ambiente`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`utente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`utente` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`utente` (
  `email` VARCHAR(45) NOT NULL ,
  `nome` VARCHAR(45) NOT NULL ,
  `cognome` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  `username` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`email`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`appartenenza`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`appartenenza` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`appartenenza` (
  `id_ambiente` INT NOT NULL ,
  `id_utente` INT NOT NULL ,
  PRIMARY KEY (`id_ambiente`, `id_utente`) ,
  CONSTRAINT `idUtente`
    FOREIGN KEY ()
    REFERENCES `mydb`.`utente` ()
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idAmbiente`
    FOREIGN KEY ()
    REFERENCES `mydb`.`ambiente` ()
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `idUtente` ON `mydb`.`appartenenza` () ;

CREATE INDEX `idAmbiente` ON `mydb`.`appartenenza` () ;


-- -----------------------------------------------------
-- Table `mydb`.`spesa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`spesa` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`spesa` (
  `id_spesa` INT NOT NULL ,
  `negozio` VARCHAR(45) NULL ,
  `data` DATE NOT NULL ,
  `timestamp` DATE NOT NULL ,
  PRIMARY KEY (`id_spesa`) ,
  CONSTRAINT `ambiente`
    FOREIGN KEY ()
    REFERENCES `mydb`.`ambiente` ()
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `cliente`
    FOREIGN KEY ()
    REFERENCES `mydb`.`utente` ()
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`pagamento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`pagamento` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`pagamento` (
  `id_pagamento` INT NOT NULL ,
  `importo` INT NOT NULL ,
  `data` INT NOT NULL ,
  `timestamp` INT NOT NULL ,
  `id_pagante` INT NOT NULL ,
  `id_creditore` INT NOT NULL ,
  PRIMARY KEY (`id_pagamento`) ,
  CONSTRAINT `id_pagante`
    FOREIGN KEY ()
    REFERENCES `mydb`.`utente` ()
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_creditore`
    FOREIGN KEY ()
    REFERENCES `mydb`.`utente` ()
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `id_pagante` ON `mydb`.`pagamento` () ;

CREATE INDEX `id_creditore` ON `mydb`.`pagamento` () ;


-- -----------------------------------------------------
-- Table `mydb`.`prodotto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`prodotto` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`prodotto` (
  `id_prodotto` INT NOT NULL ,
  `nome` VARCHAR(45) NOT NULL ,
  `quantita` INT NOT NULL ,
  `costo` INT NOT NULL ,
  `descrizione` VARCHAR(45) NULL ,
  `codice_a_barre` INT NULL ,
  `spesa` INT NOT NULL ,
  PRIMARY KEY (`id_prodotto`) ,
  CONSTRAINT `spesa`
    FOREIGN KEY ()
    REFERENCES `mydb`.`spesa` ()
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `spesa` ON `mydb`.`prodotto` () ;


-- -----------------------------------------------------
-- Table `mydb`.`utilizzo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`utilizzo` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`utilizzo` (
  `prodotto` INT NOT NULL ,
  `utente` INT NOT NULL ,
  PRIMARY KEY (`prodotto`, `utente`) ,
  CONSTRAINT `prodotto`
    FOREIGN KEY ()
    REFERENCES `mydb`.`prodotto` ()
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `utente`
    FOREIGN KEY ()
    REFERENCES `mydb`.`utente` ()
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `prodotto` ON `mydb`.`utilizzo` () ;

CREATE INDEX `utente` ON `mydb`.`utilizzo` () ;


-- -----------------------------------------------------
-- Table `mydb`.`commento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`commento` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`commento` (
  `id_commento` INT NOT NULL AUTO_INCREMENT ,
  `testo` INT NOT NULL ,
  `timestamp` INT NOT NULL ,
  `id_prodotto` INT NOT NULL ,
  `id_utente` INT NOT NULL ,
  PRIMARY KEY (`id_commento`) ,
  CONSTRAINT `prodotto`
    FOREIGN KEY ()
    REFERENCES `mydb`.`prodotto` ()
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `utente`
    FOREIGN KEY ()
    REFERENCES `mydb`.`utente` ()
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `prodotto` ON `mydb`.`commento` () ;

CREATE INDEX `utente` ON `mydb`.`commento` () ;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
