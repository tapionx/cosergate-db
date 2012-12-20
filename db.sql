SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`ambiente`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`ambiente` (
  `idAmbiente` INT NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(45) NOT NULL ,
  `via` VARCHAR(45) NULL ,
  `numero_civico` VARCHAR(45) NULL ,
  `citta` VARCHAR(45) NULL ,
  `cap` VARCHAR(45) NULL ,
  PRIMARY KEY (`idAmbiente`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`utente`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`utente` (
  `email` VARCHAR(45) NOT NULL ,
  `nome` VARCHAR(45) NOT NULL ,
  `cognome` VARCHAR(45) NOT NULL ,
  `nickname` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`email`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`appartenenza`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`appartenenza` (
  `idAmbiente` INT NOT NULL ,
  `idUtente` INT NOT NULL ,
  PRIMARY KEY (`idAmbiente`, `idUtente`) ,
  INDEX `idUtente` () ,
  INDEX `idAmbiente` () ,
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


-- -----------------------------------------------------
-- Table `mydb`.`spesa`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`spesa` (
  `idSpesa` INT NOT NULL ,
  `data` DATE NOT NULL ,
  `timestamp` DATE NOT NULL ,
  `negozio` VARCHAR(45) NULL ,
  PRIMARY KEY (`idSpesa`) ,
  INDEX `ambiente` () ,
  INDEX `cliente` () ,
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
CREATE  TABLE IF NOT EXISTS `mydb`.`pagamento` (
  `id` INT NOT NULL ,
  `pagante` INT NOT NULL ,
  `creditore` INT NOT NULL ,
  `importo` INT NOT NULL ,
  `data` INT NOT NULL ,
  `timestamp` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `pagante` () ,
  INDEX `creditore` () ,
  CONSTRAINT `pagante`
    FOREIGN KEY ()
    REFERENCES `mydb`.`utente` ()
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `creditore`
    FOREIGN KEY ()
    REFERENCES `mydb`.`utente` ()
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`prodotto`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`prodotto` (
  `id` INT NOT NULL ,
  `costo` INT NOT NULL ,
  `quantita` INT NOT NULL ,
  `descrizione` VARCHAR(45) NULL ,
  `nome` VARCHAR(45) NOT NULL ,
  `codice_barre` INT NULL ,
  `spesa` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `spesa` () ,
  CONSTRAINT `spesa`
    FOREIGN KEY ()
    REFERENCES `mydb`.`spesa` ()
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`utilizzo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`utilizzo` (
  `prodotto` INT NOT NULL ,
  `utente` INT NOT NULL ,
  PRIMARY KEY (`prodotto`, `utente`) ,
  INDEX `prodotto` () ,
  INDEX `utente` () ,
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


-- -----------------------------------------------------
-- Table `mydb`.`commento`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`commento` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `prodotto` INT NOT NULL ,
  `utente` INT NOT NULL ,
  `timestamp` INT NOT NULL ,
  `testo` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `prodotto` () ,
  INDEX `utente` () ,
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



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
