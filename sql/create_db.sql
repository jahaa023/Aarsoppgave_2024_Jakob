-- SQL fil for å lage de nødvendige databasene og tabellene.
CREATE DATABASE IF NOT EXISTS reserver_kunder;

USE reserver_kunder;

CREATE TABLE reserver_info (
    id int NOT NULL AUTO_INCREMENT,
    fornavn varchar(64),
    etternavn varchar(64),
    dato varchar(64),
    klokkeslett varchar(64),
    telefonnummer varchar(64),
    epost varchar(64),
    antall_personer varchar(64),
    notater varchar(64),
    bord varchar(64),
    PRIMARY KEY (id)
); 

CREATE TABLE brukere (
    brukernavn varchar(64),
    passord varchar(64)
);

INSERT INTO `brukere`(`brukernavn`, `passord`) VALUES ('admin','passord123');