CREATE TABLE IF NOT EXISTS ambiente (
  id_ambiente INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  citta VARCHAR(45),
  via VARCHAR(45),
  cap VARCHAR(45),
  numero_civico VARCHAR(45),
  nome VARCHAR(45) NOT NULL 
);

CREATE TABLE IF NOT EXISTS utente (
  email VARCHAR(45) NOT NULL PRIMARY KEY,
  nome VARCHAR(45) NOT NULL ,
  cognome VARCHAR(45) NOT NULL ,
  password VARCHAR(45) NOT NULL ,
  username VARCHAR(45) NOT NULL 
);

CREATE TABLE IF NOT EXISTS appartenenza (
  id_ambiente INTEGER NOT NULL ,
  id_utente INTEGER NOT NULL ,
  PRIMARY KEY (id_ambiente, id_utente) ,
  FOREIGN KEY (id_ambiente) REFERENCES ambiente(id_ambiente),
  FOREIGN KEY (id_utente) REFERENCES utente(email)
);

CREATE TABLE IF NOT EXISTS spesa (
  id_spesa INTEGER NOT NULL PRIMARY KEY,
  negozio VARCHAR(45) NULL ,
  data DATE NOT NULL ,
  timestamp DATE NOT NULL ,
  ambiente INTEGER NOT NULL,
  cliente INTEGER NOT NULL,
  FOREIGN KEY(ambiente) REFERENCES ambiente(id_ambiente),
  FOREIGN KEY(cliente) REFERENCES utente(email)
);

CREATE TABLE IF NOT EXISTS pagamento (
  id_pagamento INTEGER NOT NULL PRIMARY KEY,
  importo INTEGER NOT NULL ,
  data INTEGER NOT NULL ,
  timestamp INTEGER NOT NULL ,
  id_pagante INTEGER NOT NULL ,
  id_creditore INTEGER NOT NULL ,
  FOREIGN KEY (id_pagante) REFERENCES utente(email),
  FOREIGN KEY (id_creditore) REFERENCES utente(email),
  CONSTRAINT `id_pagante`
    FOREIGN KEY ()
    REFERENCES `utente` ()
  CONSTRAINT `id_creditore`
    FOREIGN KEY ()
    REFERENCES `utente` ()
);

CREATE TABLE IF NOT EXISTS `prodotto` (
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
    REFERENCES `spesa` ()
);

CREATE TABLE IF NOT EXISTS `utilizzo` (
  `prodotto` INT NOT NULL ,
  `utente` INT NOT NULL ,
  PRIMARY KEY (`prodotto`, `utente`) ,
  CONSTRAINT `prodotto`
    FOREIGN KEY ()
    REFERENCES `prodotto` ()
  CONSTRAINT `utente`
    FOREIGN KEY ()
    REFERENCES `utente` ()
);

CREATE TABLE IF NOT EXISTS `commento` (
  `id_commento` INT NOT NULL AUTO_INCREMENT ,
  `testo` INT NOT NULL ,
  `timestamp` INT NOT NULL ,
  `id_prodotto` INT NOT NULL ,
  `id_utente` INT NOT NULL ,
  PRIMARY KEY (`id_commento`) ,
  CONSTRAINT `prodotto`
    FOREIGN KEY ()
    REFERENCES `prodotto` ()
  CONSTRAINT `utente`
    FOREIGN KEY ()
    REFERENCES `utente` ()
);
