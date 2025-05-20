<?php
$host = 'localhost';
$db   = 'pharmacol_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

$titre = $descriptif = '';

if (isset($_GET['id'])) {
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        $stmt = $pdo->prepare("SELECT titre, descriptif FROM postes WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $poste = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($poste) {
            $titre = $poste['titre'];
            $descriptif = $poste['descriptif'];
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Candidature à : <?= htmlspecialchars($titre) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4 text-[#3C74A8]">Postuler à : <?= htmlspecialchars($titre) ?></h1>
        <p class="text-gray-700 mb-6"><?= nl2br(htmlspecialchars($descriptif)) ?></p>

        <form action="envoyer_candidature.php" method="POST" enctype="multipart/form-data" class="space-y-4">
            <input type="hidden" name="poste_id" value="<?= htmlspecialchars($_GET['id']) ?>">
            <div>
                <label class="block mb-1">Nom :</label>
                <input type="text" name="nom" class="w-full border border-gray-300 p-2 rounded" required>
            </div>
            <div>
                <label class="block mb-1">Email :</label>
                <input type="email" name="email" class="w-full border border-gray-300 p-2 rounded" required>
            </div>
            <div>
                <label class="block mb-1">Message :</label>
                <textarea name="message" rows="4" class="w-full border border-gray-300 p-2 rounded"></textarea>
            </div>
            <div>
                <label class="block mb-1">CV (PDF uniquement) :</label>
                <input type="file" name="cv" accept="application/pdf" required>
            </div>
            <button type="submit" class="bg-[#3C74A8] text-white px-6 py-2 rounded hover:bg-[#2b5e8c]">Envoyer</button>
        </form>
    </div>
</body>
</html>
