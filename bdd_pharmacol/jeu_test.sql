-- Création de la base
CREATE DATABASE IF NOT EXISTS pharmacol_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE pharmacol_db;
DROP TABLE IF EXISTS newsletter;
DROP TABLE IF EXISTS blog;
DROP TABLE IF EXISTS utilisateur;
DROP TABLE IF EXISTS entreprise;


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

-- Insertion de test : utilisateur
INSERT INTO utilisateur (mail, mot_de_passe) VALUES 
('test@mail.com', '123456'),
('admin@pharmacol.com', 'adminpass'),
('user@example.com', 'password123');

-- Insertion de test : newsletter
INSERT INTO newsletter (mail, nom, prenom) VALUES
('alice@example.com', 'Dupont', 'Alice'),
('bob@example.com', 'Martin', 'Bob'),
('carla@example.com', 'Bernard', 'Carla');

-- Insertion de test : blog
INSERT INTO blog (image, titre, texte, date) VALUES
('image1.jpg', 'Lancement de Pharmacol Niger', 'Nous avons lancé notre nouvelle plateforme au Niger.', '2025-04-01'),
('image2.jpg', 'Les enjeux pharmaceutiques en Afrique', 'Analyse des besoins de santé et de la distribution en Afrique de l’Ouest.', '2025-04-15'),
('image3.jpg', 'Partenariat avec les pharmacies locales', 'Nous avons signé un partenariat avec plusieurs pharmacies rurales.', '2025-05-01');

-- Insertion de test : entreprise
INSERT INTO entreprise (longitude, latitude, nom, pays, ville) VALUES
(2.1157, 13.5128, 'Pharmacie Centrale de Niamey', 'Niger', 'Niamey'),
(1.5000, 14.0000, 'Pharmacie Santé Plus', 'Niger', 'Maradi'),
(3.8762, 10.3802, 'Centre Médical du Sud', 'Bénin', 'Cotonou');

-- Fin du script


