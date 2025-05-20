<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit();
}

require_once '../bdd_pharmacol/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'] ?? '';
    $texte = $_POST['texte'] ?? '';
    $etat = $_POST['etat'] ?? 'brouillon';

    $imagePath = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = dirname(__DIR__) . '/images/blog/';
  
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $tmpName = $_FILES['image']['tmp_name'];
        $filename = basename($_FILES['image']['name']);
        $newFilename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);
        $targetFile = $uploadDir . $newFilename;

        if (move_uploaded_file($tmpName, $targetFile)) {
            $imagePath = 'images/blog/' . $newFilename;
        } else {
            $error = "Erreur lors de l'upload de l'image.";
        }
    } else {
        // Pas d'image uploadée ou erreur
        $imagePath = null;
    }


    if (empty($titre) || empty($texte)) {
        $error = "Le titre et le contenu sont obligatoires.";
    }

    if (!isset($error)) {
        // Insertion dans la base
        $stmt = $pdo->prepare("INSERT INTO blog (titre, texte, etat, image, date) VALUES (:titre, :texte, :etat, :image, NOW())");
        $stmt->execute([
            'titre' => $titre,
            'texte' => $texte,
            'etat' => $etat,
            'image' => $imagePath
        ]);

        header("Location: home.php?section=blog");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Ajouter un article</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 p-6">
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6 text-[#3C74A8]">Ajouter un nouvel article</h1>

    <?php if (isset($error)): ?>
        <div class="bg-red-200 text-red-700 p-3 mb-4 rounded"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="space-y-4">
        <div>
            <label class="block mb-1 font-medium">Titre :</label>
            <input type="text" name="titre" class="w-full border border-gray-300 p-2 rounded" required value="<?= isset($_POST['titre']) ? htmlspecialchars($_POST['titre']) : '' ?>">
        </div>

        <div>
            <label class="block mb-1 font-medium">Contenu :</label>
            <textarea name="texte" rows="6" class="w-full border border-gray-300 p-2 rounded" required><?= isset($_POST['texte']) ? htmlspecialchars($_POST['texte']) : '' ?></textarea>
        </div>

        <div>
            <label class="block mb-1 font-medium">État :</label>
            <select name="etat" class="w-full border border-gray-300 p-2 rounded" required>
                <option value="brouillon" <?= (isset($_POST['etat']) && $_POST['etat'] === 'brouillon') ? 'selected' : '' ?>>Brouillon</option>
                <option value="en_ligne" <?= (isset($_POST['etat']) && $_POST['etat'] === 'en_ligne') ? 'selected' : '' ?>>En ligne</option>
                <option value="newsletter" <?= (isset($_POST['etat']) && $_POST['etat'] === 'newsletter') ? 'selected' : '' ?>>Newsletter</option>
                <option value="les_deux" <?= (isset($_POST['etat']) && $_POST['etat'] === 'les_deux') ? 'selected' : '' ?>>Les deux</option>
            </select>
        </div>

        <div>
            <label class="block mb-1 font-medium">Image (optionnel) :</label>
            <input type="file" name="image" accept="image/*">
        </div>

        <div>
            <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded hover:bg-[#2b5e8c]">Ajouter</button>
        </div>
    </form>
</div>
</body>
</html>
