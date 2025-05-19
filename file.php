<?php
    require_once 'bdd_pharmacol/config.php';


    // Récupération des données
    $prenom = htmlspecialchars(trim($_POST['prenom'] ?? ''));
    $nom = htmlspecialchars(trim($_POST['nom'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);

    if ($prenom && $nom && $email) {
        $stmt = $pdo->prepare("INSERT INTO newsletter (prenom, nom, mail) VALUES (?, ?, ?)");
        $stmt->execute([$prenom, $nom, $email]);

        echo "<script>alert('Merci pour votre inscription à notre newsletter !');</script>";
        echo "<script>window.location.href = 'blog.html';</script>";
    } else {
        echo "Veuillez remplir tous les champs correctement.";
    }
?>


