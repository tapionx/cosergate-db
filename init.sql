DROP DATABASE cosergate;
CREATE DATABASE cosergate;
USE cosergate;
source db.sql
INSERT INTO utente (id_utente, nome, cognome, password, username) VALUES ('tapion@tapion.it', 'Riccardo', 'Serafini', '7815696ecbf1c96e6894b779456d330e', 'tapion');
INSERT INTO utente (id_utente, nome, cognome, password, username) VALUES ('daniele@sciuto.it', 'Daniele', 'Sciuto', '7815696ecbf1c96e6894b779456d330e', 'sciuto');
INSERT INTO utente (id_utente, nome, cognome, password, username) VALUES ('dario@serra.it', 'Dario', 'Serra', '7815696ecbf1c96e6894b779456d330e', 'daffo');
INSERT INTO utente (id_utente, nome, cognome, password, username) VALUES ('luca@regazzi.it', 'Luca', 'Regazzi', '7815696ecbf1c96e6894b779456d330e', 'okone');
INSERT INTO ambiente (nome) VALUES ('prova');
INSERT INTO appartenenza (id_ambiente, id_utente, saldo) VALUES (1, 'tapion@tapion.it', 0);
INSERT INTO appartenenza (id_ambiente, id_utente, saldo) VALUES (1, 'daniele@sciuto.it', 0);
INSERT INTO appartenenza (id_ambiente, id_utente, saldo) VALUES (1, 'dario@serra.it', 0);
INSERT INTO appartenenza (id_ambiente, id_utente, saldo) VALUES (1, 'luca@regazzi.it', 0);
