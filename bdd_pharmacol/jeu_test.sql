-- Création de la base
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
    date DATE NOT NULL,
    etat ENUM('brouillon', 'en ligne', 'newsletter', 'les 2') DEFAULT 'brouillon'
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


-- Insertion de test : postes
INSERT INTO postes (titre, descriptif, localisation) VALUES
('Délégué médical', 
'Vous serez chargé de la promotion des produits pharmaceutiques auprès des professionnels de santé. 
Missions principales :
- Présenter les produits aux médecins et pharmaciens
- Assurer un suivi régulier des clients
- Participer à des réunions scientifiques et formations
Profil recherché : Bac+3 minimum, expérience souhaitée dans le secteur médical, aisance relationnelle.', 
'Lomé, Togo'),

('Responsable qualité', 
'Assurer la conformité des processus de production et de distribution selon les normes en vigueur. 
Vous serez le garant du respect des procédures et de la traçabilité des produits. 
Expérience exigée : 2 ans minimum dans un poste similaire.', 
'Cotonou, Bénin'),

('Assistant administratif', 
'Poste polyvalent : gestion des appels, organisation des dossiers, suivi des commandes et facturation. 
Bonne maîtrise des outils bureautiques et sens de l’organisation requis.', 
'Niamey, Niger'),

('Chargé de communication', 
'Développer la visibilité de l’entreprise sur les réseaux sociaux et auprès des partenaires. 
Rédaction de contenus, gestion de la newsletter, organisation d’événements.', 
'Lomé, Togo'),

('Pharmacien conseil', 
'Conseil auprès des patients et validation des ordonnances. 
Participation à la gestion des stocks et à la formation de l’équipe officinale.', 
'Cotonou, Bénin'),

('Délégué Médical',
'Promotion des produits auprès des professionnels de santé.',
'Lomé, Togo'),

('Superviseur Terrain',
'Management des équipes et suivi opérationnel.',
'Cotonou, Bénin'),

('Directeur des Ventes',
'Stratégie commerciale et pilotage national.',
'Niamey, Niger'),

('Délégué médical – Zone Nord',
'Poste basé à Parakou – Candidatures ouvertes. Postuler maintenant.',
'Parakou, Bénin'),

('Responsable Réglementaire',
'Cotonou – Expérience requise. Voir les missions.',
'Cotonou, Bénin'),

('Assistant(e) administratif(ve)',
'Stage de 6 mois – Cotonou.',
'Cotonou, Bénin');

-- Insertion de test : utilisateur
INSERT INTO utilisateur (mail, mot_de_passe, role) VALUES 
('test@mail.com', '$2y$10$VscUIy.v0K0HNofz3ttTrOHbMNLXd8kQFEFfEC8KrKOEOGyFcUSqu', 'user'),
('admin@pharmacol.com', '$2y$10$VscUIy.v0K0HNofz3ttTrOHbMNLXd8kQFEFfEC8KrKOEOGyFcUSqu', 'admin'),
('user@example.com', '$2y$10$VscUIy.v0K0HNofz3ttTrOHbMNLXd8kQFEFfEC8KrKOEOGyFcUSqu', 'user');

-- Insertion de test : newsletter
INSERT INTO newsletter (mail, nom, prenom) VALUES
('alice@example.com', 'Dupont', 'Alice'),
('bob@example.com', 'Martin', 'Bob'),
('carla@example.com', 'Bernard', 'Carla');

-- Insertion de test : blog
INSERT INTO blog (image, titre, texte, date, etat) VALUES
('images/blog/1750150524_pharma-representation.jpg', 'Ouverture de notre nouvelle agence à Lomé',
'Nous sommes heureux d’annoncer l’ouverture de notre nouvelle agence à Lomé. Cette implantation nous permettra de mieux servir nos partenaires et de renforcer notre présence au Togo.',
'2025-05-10', 'en ligne'),

('images/blog/1750150524_pharma-representation.jpg', 'La traçabilité des médicaments : un enjeu majeur',
'La traçabilité des médicaments est essentielle pour garantir la sécurité des patients. Découvrez nos solutions innovantes pour un suivi optimal des lots et des stocks.',
'2025-05-20', 'en ligne'),

('images/blog/1750150556_autorisation-marche.jpg', 'Retour sur notre séminaire annuel',
'Notre séminaire annuel a réuni plus de 100 professionnels du secteur pharmaceutique venus du Togo, du Bénin et du Niger. 
Au programme : conférences, ateliers pratiques et échanges sur les bonnes pratiques.',
'2025-06-01', 'newsletter'),
('images/blog/test.jpg', 'Lancement de Pharmacol Niger', 'Nous avons lancé notre nouvelle plateforme au Niger.', '2025-04-01', 'en ligne'),
('images/blog/test.jpg', 'Les enjeux pharmaceutiques en Afrique', 'Analyse des besoins de santé et de la distribution en Afrique de l’Ouest.', '2025-04-15', 'newsletter'),
('images/blog/test.jpg', 'Partenariat avec les pharmacies locales', 'Nous avons signé un partenariat avec plusieurs pharmacies rurales.', '2025-05-01', 'les 2'),
('images/blog/test.jpg',
    'Un article de blog très long pour test',
    'Ce texte est volontairement très long afin de tester le comportement du bouton "Lire la suite" et de l affichage du blog. 
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque euismod, urna eu tincidunt consectetur, nisi nisl aliquam nunc, eget aliquam massa nisi nec erat. 
Suspendisse potenti. Etiam euismod, urna eu tincidunt consectetur, nisi nisl aliquam nunc, eget aliquam massa nisi nec erat. 
Curabitur euismod, urna eu tincidunt consectetur, nisi nisl aliquam nunc, eget aliquam massa nisi nec erat. 
Phasellus euismod, urna eu tincidunt consectetur, nisi nisl aliquam nunc, eget aliquam massa nisi nec erat. 
Mauris euismod, urna eu tincidunt consectetur, nisi nisl aliquam nunc, eget aliquam massa nisi nec erat. 
Sed euismod, urna eu tincidunt consectetur, nisi nisl aliquam nunc, eget aliquam massa nisi nec erat. 
Vivamus euismod, urna eu tincidunt consectetur, nisi nisl aliquam nunc, eget aliquam massa nisi nec erat. 
Aliquam euismod, urna eu tincidunt consectetur, nisi nisl aliquam nunc, eget aliquam massa nisi nec erat. 
Proin euismod, urna eu tincidunt consectetur, nisi nisl aliquam nunc, eget aliquam massa nisi nec erat. 
Nam euismod, urna eu tincidunt consectetur, nisi nisl aliquam nunc, eget aliquam massa nisi nec erat. 
Duis euismod, urna eu tincidunt consectetur, nisi nisl aliquam nunc, eget aliquam massa nisi nec erat. 
Morbi euismod, urna eu tincidunt consectetur, nisi nisl aliquam nunc, eget aliquam massa nisi nec erat. 
Aenean euismod, urna eu tincidunt consectetur, nisi nisl aliquam nunc, eget aliquam massa nisi nec erat. 
Fusce euismod, urna eu tincidunt consectetur, nisi nisl aliquam nunc, eget aliquam massa nisi nec erat. 
Fin du texte de test très long.',
    '2025-06-10',
    'en ligne'
);

-- Insertion de test : entreprise
INSERT INTO entreprise (longitude, latitude, nom, pays, ville) VALUES
(2.1157, 13.5128, 'Pharmacie Centrale de Niamey', 'Niger', 'Niamey'),
(1.5000, 14.0000, 'Pharmacie Santé Plus', 'Niger', 'Maradi'),
(3.8762, 10.3802, 'Centre Médical du Sud', 'Bénin', 'Cotonou');

-- Fin du script


