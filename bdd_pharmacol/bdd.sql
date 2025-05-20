CREATE DATABASE IF NOT EXISTS pharmacol_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE pharmacol_db;
DROP TABLE IF EXISTS newsletter;
DROP TABLE IF EXISTS blog;
DROP TABLE IF EXISTS utilisateur;
DROP TABLE IF EXISTS entreprise;
DROP TABLE IF EXISTS postes;


-- Table newsletters
CREATE TABLE IF NOT EXISTS newsletter (
    mail VARCHAR(100) PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL
);

-- Table blog
CREATE TABLE IF NOT EXISTS blog (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(255),
    titre VARCHAR(255) NOT NULL,
    texte TEXT NOT NULL,
    date DATE NOT NULL
);

-- Table utilisateur
CREATE TABLE IF NOT EXISTS utilisateur (
    mail VARCHAR(100) PRIMARY KEY,
    mot_de_passe VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL
);

-- Table entreprise
CREATE TABLE IF NOT EXISTS entreprise (
    id INT AUTO_INCREMENT PRIMARY KEY,
    longitude DOUBLE,
    latitude DOUBLE,
    nom VARCHAR(255),
    pays VARCHAR(100),
    ville VARCHAR(100)
);

-- Table postes
CREATE TABLE IF NOT EXISTS postes (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    descriptif TEXT NOT NULL,
    localisation VARCHAR(255) NOT NULL
);

INSERT INTO postes (titre, descriptif, localisation) VALUES ('titre1', 'ceci est un descriptif', 'localisation1');
INSERT INTO postes (titre, descriptif, localisation) VALUES ('titre2', 'ceci est un descriptif', 'localisation2');

INSERT INTO utilisateur (mail, mot_de_passe) VALUES ('test@mail.com', '123456');


