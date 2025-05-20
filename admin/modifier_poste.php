<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header('Location: connexion.php');
    exit();
}

require_once '../bdd_pharmacol/config.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: home.php?section=recrutement');
    exit();
}

// Récupérer les données existantes
$stmt = $pdo->prepare("SELECT * FROM postes WHERE id = :id");
$stmt->execute(['id' => $id]);
$poste = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$poste) {
    echo "Poste non trouvé.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $descriptif = $_POST['descriptif'];
    $localisation = $_POST['localisation'];

    $stmt = $pdo->prepare("UPDATE postes SET titre = :titre, descriptif = :descriptif, localisation = :localisation WHERE id = :id");
    $stmt->execute([
        'titre' => $titre,
        'descriptif' => $descriptif,
        'localisation' => $localisation,
        'id' => $id
    ]);

    header('Location: home.php?section=recrutement');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un poste</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-8">
    <h1 class="text-2xl font-bold mb-6">Modifier le poste</h1>
    <form method="POST" class="space-y-4 max-w-lg">
        <div>
            <label class="block font-semibold">Titre</label>
            <input type="text" name="titre" value="<?= htmlspecialchars($poste['titre']) ?>" required class="w-full p-2 border rounded" />
        </div>

        <div>
            <label class="block font-semibold">Descriptif</label>
            <textarea name="descriptif" required class="w-full p-2 border rounded"><?= htmlspecialchars($poste['descriptif']) ?></textarea>
        </div>

        <div>
            <label class="block font-semibold">Localisation</label>
            <input type="text" name="localisation" value="<?= htmlspecialchars($poste['localisation']) ?>" required class="w-full p-2 border rounded" />
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Enregistrer</button>
    </form>
</body>
</html>
