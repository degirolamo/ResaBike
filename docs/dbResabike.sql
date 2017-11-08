DROP DATABASE IF EXISTS dbResabike;
CREATE DATABASE dbResabike;
USE dbResabike;

CREATE TABLE role (
  id  INT         NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(30) NOT NULL
)
  ENGINE = InnoDB;

CREATE TABLE `utilisateur` (
  id     INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
  idRole INT          NOT NULL,
  idZone INT,
  pseudo VARCHAR(20)  NOT NULL,
  pass   TEXT         NOT NULL,
  email  VARCHAR(100) NOT NULL
)
  ENGINE = InnoDB;

CREATE TABLE zone (
  id  INT         NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(50) NOT NULL
)
  ENGINE = InnoDB;

CREATE TABLE arret (
  id     INT         NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nom    VARCHAR(50) NOT NULL,
  idZone INT         NOT NULL
)
  ENGINE = InnoDB;

CREATE TABLE remorque (
  id       INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  idZone   INT NOT NULL,
  nbPlaces INT NOT NULL,
  prise    TINYINT      DEFAULT 0
)
  ENGINE = InnoDB;

CREATE TABLE reservation (
  id           INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
  idStationDep INT          NOT NULL,
  idStationFin INT          NOT NULL,
  email        VARCHAR(100) NOT NULL,
  phone        VARCHAR(100) NOT NULL,
  nbVelos      INT          NOT NULL,
  dateDepart   DATETIME     NOT NULL,
  confirme     TINYINT      NOT NULL DEFAULT 0
)
  ENGINE = InnoDB;

INSERT INTO role VALUES (NULL, 'Conducteur'), (NULL, 'Administrateur de zone'), (NULL, 'Administrateur système');

INSERT INTO `utilisateur` VALUES
  (NULL, 3, NULL, 'sysadmin', 'pass', 'pedro.f_1870@hotmail.com'),
  (NULL, 1, 1, 'drianniviers', 'pass', 'kev.carneiro@gmail.com'),
  (NULL, 2, 1, 'zoneanniviers', 'pass', 'sylvie.pute@sucedesbites.com'),
  (NULL, 1, 2, 'driherens', 'pass', 'projetdemerde@cotting.com'),
  (NULL, 2, 2, 'zoneherens', 'pass', 'cest20HetJsuisTJSaLecole@hotmail.com');

INSERT INTO zone VALUES (NULL, 'Val d\'Anniviers'), (NULL, 'Val d\'Hérens');

 INSERT INTO arret VALUES
   (NULL, 'Sierre', 1), (NULL, 'Niouc', 1y),
   (NULL, 'Vissoie', 1), (NULL, 'Ayer', 1),
   (NULL, 'Zinal', 1);
#
# INSERT INTO remorque VALUES (NULL, 1, 20, 0), (NULL, 1, 20, 0), (NULL, 1, 20, 0), (NULL, 2, 20, 0), (NULL, 2, 20, 0),
#   (NULL, 2, 20, 0), (NULL, 2, 20, 0);