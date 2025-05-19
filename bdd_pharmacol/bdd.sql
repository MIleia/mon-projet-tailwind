CREATE DATABASE IF NOT EXISTS pharmacol_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE pharmacol_db;

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
    mot_de_passe VARCHAR(255) NOT NULL
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

INSERT INTO utilisateur (mail, mot_de_passe) VALUES ('test@mail.com', '123456');


