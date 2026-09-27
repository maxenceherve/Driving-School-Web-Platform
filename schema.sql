-- Reconstructed schema (structure only, no data).
-- Rebuilt from the SQL queries used throughout the PHP scripts, since the
-- original schema.sql was not part of the delivered project files.
-- Column names, types and constraints follow how each field is used in the code.

CREATE TABLE eleves (
    id_eleve INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    date_naissance DATE NOT NULL,
    date_inscription DATE NOT NULL
);

CREATE TABLE themes (
    Idtheme INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    supprime TINYINT(1) NOT NULL DEFAULT 0,
    descriptif TEXT
);

CREATE TABLE seances (
    idseance INT AUTO_INCREMENT PRIMARY KEY,
    DateSeance DATE NOT NULL,
    EffMax INT NOT NULL,
    Idtheme INT NOT NULL,
    FOREIGN KEY (Idtheme) REFERENCES themes(Idtheme)
);

CREATE TABLE inscriptions (
    idseance INT NOT NULL,
    id_eleve INT NOT NULL,
    note INT NOT NULL DEFAULT -1,
    PRIMARY KEY (idseance, id_eleve),
    FOREIGN KEY (idseance) REFERENCES seances(idseance),
    FOREIGN KEY (id_eleve) REFERENCES eleves(id_eleve)
);
