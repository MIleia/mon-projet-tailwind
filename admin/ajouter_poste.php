<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header('Location: connexion.php');
    exit();
}

require_once '../bdd_pharmacol/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $descriptif = $_POST['descriptif'];
    $localisation = $_POST['localisation'];

    $stmt = $pdo->prepare("INSERT INTO postes (titre, descriptif, localisation) VALUES (:titre, :descriptif, :localisation)");
    $stmt->execute([
        'titre' => $titre,
        'descriptif' => $descriptif,
        'localisation' => $localisation
    ]);

    header('Location: home.php?section=recrutement');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un poste</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-8">
    <h1 class="text-2xl font-bold mb-6">Ajouter un poste</h1>
    <form method="POST" class="space-y-4 max-w-lg">
        <div>
            <label class="block font-semibold">Titre</label>
            <input type="text" name="titre" required class="w-full p-2 border rounded" />
        </div>

        <div>
            <label class="block font-semibold">Descriptif</label>
            <textarea name="descriptif" required class="w-full p-2 border rounded"></textarea>
        </div>

        <div>
            <label class="block font-semibold">Localisation</label>
            <input type="text" name="localisation" required class="w-full p-2 border rounded" />
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Ajouter</button>
    </form>
</body>
</html>
