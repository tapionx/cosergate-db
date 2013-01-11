DROP DATABASE cosergate;
CREATE DATABASE cosergate;
USE cosergate;
source /home/tapion/SparkleShare/cosergate-db/db.sql
INSERT INTO utente (id_utente, nome, cognome, password, username) VALUES ('tapion@tapion.it', 'Riccardo', 'Serafini', 'e07910a06a086c83ba41827aa00b26ed', 'tapion');
INSERT INTO utente (id_utente, nome, cognome, password, username) VALUES ('daniele@sciuto.it', 'Daniele', 'Sciuto', 'e07910a06a086c83ba41827aa00b26ed', 'sciuto');
INSERT INTO utente (id_utente, nome, cognome, password, username) VALUES ('dario@serra.it', 'Dario', 'Serra', 'e07910a06a086c83ba41827aa00b26ed', 'daffo');
INSERT INTO utente (id_utente, nome, cognome, password, username) VALUES ('luca@regazzi.it', 'Luca', 'Regazzi', 'e07910a06a086c83ba41827aa00b26ed', 'okone');
INSERT INTO ambiente (nome) VALUES ('prova');
INSERT INTO appartenenza (id_ambiente, id_utente, saldo) VALUES (1, 'tapion@tapion.it', 0);
INSERT INTO appartenenza (id_ambiente, id_utente, saldo) VALUES (1, 'daniele@sciuto.it', 0);
INSERT INTO appartenenza (id_ambiente, id_utente, saldo) VALUES (1, 'dario@serra.it', 0);
INSERT INTO appartenenza (id_ambiente, id_utente, saldo) VALUES (1, 'luca@regazzi.it', 0);
