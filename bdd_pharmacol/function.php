<?php
    require_once 'config.php';


    function insertNewsletter($mail, $nom, $prenom) {
        global $pdo;
        $sql = "INSERT INTO newsletter (mail, nom, prenom) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$mail, $nom, $prenom]);
    }

    function insertBlog($image, $titre, $texte, $date) {
        global $pdo;
        $sql = "INSERT INTO blog (image, titre, texte, date) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$image, $titre, $texte, $date]);
    }

    function insertUtilisateur($nom, $motDePasse) {
        global $pdo;
        $hashed = password_hash($motDePasse, PASSWORD_BCRYPT);
        $sql = "INSERT INTO utilisateur (nom, mot_de_passe) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$nom, $hashed]);
    }

    function insertEntreprise($longitude, $latitude, $nom, $pays, $ville) {
        global $pdo;
        $sql = "INSERT INTO entreprise (longitude, latitude, nom, pays, ville) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$longitude, $latitude, $nom, $pays, $ville]);
    }

    function getNewsletters() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM newsletter");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getBlogs() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM blog ORDER BY date DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getUtilisateurs() {
        global $pdo;
        $stmt = $pdo->query("SELECT id, nom FROM utilisateur"); // pas de mot de passe
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getEntreprises() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM entreprise");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
?>


