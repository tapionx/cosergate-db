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
  id_utente VARCHAR(45) NOT NULL ,
  PRIMARY KEY (id_ambiente, id_utente) ,
  FOREIGN KEY (id_ambiente) REFERENCES ambiente(id_ambiente),
  FOREIGN KEY (id_utente) REFERENCES utente(email)
);

CREATE TABLE IF NOT EXISTS spesa (
  id_spesa INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
  negozio VARCHAR(45) NULL ,
  data DATE NOT NULL ,
  timestamp DATE NOT NULL ,
  ambiente INTEGER NOT NULL,
  cliente VARCHAR(45) NOT NULL,
  FOREIGN KEY(ambiente) REFERENCES ambiente(id_ambiente),
  FOREIGN KEY(cliente) REFERENCES utente(email)
);

CREATE TABLE IF NOT EXISTS pagamento (
  id_pagamento INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
  importo INTEGER NOT NULL ,
  data INTEGER NOT NULL ,
  timestamp INTEGER NOT NULL ,
  id_pagante VARCHAR(45) NOT NULL ,
  id_creditore VARCHAR(45) NOT NULL ,
  FOREIGN KEY (id_pagante) REFERENCES utente(email),
  FOREIGN KEY (id_creditore) REFERENCES utente(email),
);

CREATE TABLE IF NOT EXISTS prodotto (
  id_prodotto INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(45) NOT NULL ,
  quantita INTEGER NOT NULL ,
  costo INTEGER NOT NULL ,
  descrizione VARCHAR(45) ,
  codice_a_barre INTEGER ,
  spesa INTEGER NOT NULL ,
  FOREIGN KEY (spesa) REFERENCES spesa(id_spesa)
);

CREATE TABLE IF NOT EXISTS utilizzo (
  prodotto INTEGER NOT NULL ,
  utente VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`prodotto`, `utente`) ,
  FOREIGN KEY (prodotto) REFERENCES prodotto(id_prodotto),
  FOREIGN KEY (utente) REFERENCES utente(email),
);

CREATE TABLE IF NOT EXISTS commento (
  id_commento INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  testo INTEGER NOT NULL ,
  timestamp INTEGER NOT NULL ,
  id_prodotto INTEGER NOT NULL ,
  id_utente INTEGER NOT NULL ,
  FOREIGN KEY (id_prodotto) REFERENCES prodotto(id_prodotto),
  FOREIGN KEY (id_utente) REFERENCES email(utente),
);
