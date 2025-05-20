<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit();
}

require_once '../bdd_pharmacol/config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID de blog invalide.");
}

$id = $_GET['id'];

// Récupération des données du blog
$stmt = $pdo->prepare("SELECT * FROM blog WHERE id = :id");
$stmt->execute(['id' => $id]);
$blog = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$blog) {
    die("Article introuvable.");
}

// Si formulaire soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $texte = $_POST['texte'];
    $etat = $_POST['etat'];

    $stmt = $pdo->prepare("UPDATE blog SET titre = :titre, texte = :texte, etat = :etat WHERE id = :id");
    $stmt->execute([
        'titre' => $titre,
        'texte' => $texte,
        'etat' => $etat,
        'id' => $id
    ]);

    // Redirection vers la section blog après modification
    header("Location: home.php?section=blog");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un article</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-[#3C74A8]">Modifier l'article</h1>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block mb-1 font-medium">Titre :</label>
                <input type="text" name="titre" value="<?= htmlspecialchars($blog['titre']) ?>" class="w-full border border-gray-300 p-2 rounded" required>
            </div>

            <div>
                <label class="block mb-1 font-medium">Contenu :</label>
                <textarea name="texte" rows="6" class="w-full border border-gray-300 p-2 rounded" required><?= htmlspecialchars($blog['texte']) ?></textarea>
            </div>

            <div>
                <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded hover:bg-[#2b5e8c]">Terminer</button>
            </div>
        </form>
    </div>
</body>
</html>
