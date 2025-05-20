<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: connexion.php');
        exit();
    }
    $user = $_SESSION['user'];
    $role = $_SESSION['role'];

    require_once '../bdd_pharmacol/config.php';
    require_once '../bdd_pharmacol/function.php';


    // Gestion des données

    // Récupération des données Blog
    $sql_blog = "SELECT * FROM blog";
    $res_blog = $pdo->query($sql_blog);
    $blogs = $res_blog->fetchAll(PDO::FETCH_ASSOC);

    $sql_postes = "SELECT * FROM postes";
    $res_postes = $pdo->query($sql_postes);
    $postes = $res_postes->fetchAll(PDO::FETCH_ASSOC);

    // Récupération des données Entreprise
    $sql_entreprise = "SELECT * FROM entreprise";
    $res_entreprise = $pdo->query($sql_entreprise);
    $entreprises = $res_entreprise->fetchAll(PDO::FETCH_ASSOC);

    // Récupération des données Newsletter
    $sql_newsletter = "SELECT * FROM newsletter";
    $res_newsletter = $pdo->query($sql_newsletter);
    $newsletters = $res_newsletter->fetchAll(PDO::FETCH_ASSOC);

    // Récupération des utilisateurs
    $sql_utilisateurs = "SELECT * FROM utilisateur";
    $res_utilisateurs = $pdo->query($sql_utilisateurs);
    $utilisateurs = $res_utilisateurs->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action']) && $_POST['action'] === 'update_user') {
    $old_mail = $_POST['old_mail'];
    $new_mail = $_POST['mail'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $role = $_POST['role'];

    if (!in_array($role, ['lecteur', 'redacteur', 'admin'])) {
        echo "<p class='text-red-600'>Rôle invalide.</p>";
    } else {
        $sql = "UPDATE utilisateur SET mail = :new_mail, role = :role" . 
               (!empty($mot_de_passe) ? ", mot_de_passe = :mot_de_passe" : "") . 
               " WHERE mail = :old_mail";

        $stmt = $pdo->prepare($sql);
        $params = [
            ':new_mail' => $new_mail,
            ':role' => $role,
            ':old_mail' => $old_mail
        ];
        if (!empty($mot_de_passe)) {
            $params[':mot_de_passe'] = password_hash($mot_de_passe, PASSWORD_DEFAULT);
        }
        $stmt->execute($params);
    }
}


        if (isset($_POST['action']) && $_POST['action'] === 'delete_user') {
            $mail = $_POST['mail'];
            $stmt = $pdo->prepare("DELETE FROM utilisateur WHERE mail = :mail");
            $stmt->execute([':mail' => $mail]);
        }

        if ($_POST['action'] === 'create_user') {
            $mail = $_POST['mail'];
            $password = $_POST['mot_de_passe'];
            $role = $_POST['role'];

            // Vérifie si le mail est déjà utilisé
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM utilisateur WHERE mail = :mail");
            $stmt->execute(['mail' => $mail]);
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                echo "<script>alert('L\'adresse email est déjà utilisée.');</script>";
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO utilisateur (mail, mot_de_passe, role) VALUES (:mail, :password, :role)");
                $stmt->execute([
                    'mail' => $mail,
                    'password' => $hash,
                    'role' => $role
                ]);
                header("Location: home.php#utilisateurs");
                exit;
            }
        }

        if (isset($_POST['action']) && $_POST['action'] === 'delete_newsletter') {
            $mail = $_POST['id'];
            $stmt = $pdo->prepare("DELETE FROM newsletter WHERE mail = :mail");
            $stmt->execute([':mail' => $mail]);
            header("Location: home.php#newsletter");
            exit();
        }

        // Supprimer un article de blog
        if (isset($_POST['action']) && $_POST['action'] === 'delete_blog') {
            $id = $_POST['id'];
            $stmt = $pdo->prepare("DELETE FROM blog WHERE id = :id");
            $stmt->execute([':id' => $id]);
            header("Location: home.php?section=blog");
            exit();
        }

        // Modifier l'état d'un blog
        if (isset($_POST['action']) && $_POST['action'] === 'update_blog_state') {
            $id = $_POST['id'];
            $etat = $_POST['etat'];
            if (in_array($etat, ['brouillon', 'en ligne', 'newsletter', 'les deux'])) {
                $stmt = $pdo->prepare("UPDATE blog SET etat = :etat WHERE id = :id");
                $stmt->execute([':etat' => $etat, ':id' => $id]);
                header("Location: home.php?section=blog");
                exit();
            }
        }

        if (isset($_POST['action']) && $_POST['action'] === 'delete_poste') {
            $id = $_POST['id'];
            $stmt = $pdo->prepare("DELETE FROM postes WHERE id = :id");
            $stmt->execute([':id' => $id]);
            header("Location: home.php?section=recrutement");
            exit();
        }


        $utilisateurs = $pdo->query("SELECT mail, role FROM utilisateur")->fetchAll(PDO::FETCH_ASSOC);
    }

    function ajouterEntreprise(PDO $pdo, array $data): bool {
    // Préparer la requête
    $sql = "INSERT INTO entreprise (nom, ville, latitude, longitude, pays) VALUES (:nom, :ville, :latitude, :longitude, :pays)";
    $stmt = $pdo->prepare($sql);

    // Bind des paramètres (assurez-vous que les colonnes existent en BDD)
    return $stmt->execute([
        ':nom' => $data['nom'],
        ':ville' => $data['ville'],
        ':latitude' => $data['latitude'],
        ':longitude' => $data['longitude'],
        ':pays' => $data['pays'],
    ]);
}

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'add_entreprise') {
        $nom = trim($_POST['nom'] ?? '');
        $ville = trim($_POST['ville'] ?? '');
        $latitude = trim($_POST['latitude'] ?? '');
        $longitude = trim($_POST['longitude'] ?? '');
        $pays = trim($_POST['pays'] ?? '');

        if ($nom && $ville && $latitude && $longitude && $pays) {
            $success = ajouterEntreprise($pdo, [
                'nom' => $nom,
                'ville' => $ville,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'pays' => $pays,
            ]);

            if ($success) {
                $sql_entreprise = "SELECT * FROM entreprise";
                $res_entreprise = $pdo->query($sql_entreprise);
                $entreprises = $res_entreprise->fetchAll(PDO::FETCH_ASSOC);
                header('Location: home.php#Entreprises');
                exit();
            } else {
                $error = "Erreur lors de l'ajout de l'entreprise.";
            }
        } else {
            $error = "Merci de remplir tous les champs.";
        }
    }
?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Accueil</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700&display=swap');
            body {
                font-family: 'Lexend', sans-serif;
            }
        </style>
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    </head>

    <body>
        <div class="flex">
            <!-- Sidebar -->
            <aside class="fixed top-0 left-0 h-screen w-[20rem] bg-white text-gray-700 p-4 z-50 flex flex-col border-r border-gray-200 shadow-r">
                <div class="mb-2 p-4">
                    <img src="../images/Page prestations 2/logo-350100.png" alt="Logo Pharmacol" class="h-16">
                </div>

                <nav class="flex flex-col gap-1 min-w-[240px] p-2 text-base text-gray-700">
                    
                    <!-- Blog -->
                    <button type="button" onclick="showSection('blog')" class="flex items-center w-full p-3 rounded-lg hover:bg-blue-50 hover:text-blue-900">
                        <div class="mr-4">
                            <!-- Icon -->
                        </div>
                        Blog
                        <div class="ml-auto">
                            <span class="bg-blue-500/20 text-blue-900 py-1 px-2 text-xs rounded-full">14</span>
                        </div>
                    </button>

                    <!-- Suivi Recrutement -->
                    <button type="button" onclick="showSection('recrutement')" class="flex items-center w-full p-3 rounded-lg hover:bg-blue-50 hover:text-blue-900">
                        <div class="mr-4">
                            <!-- Icon -->
                        </div>
                        Suivi recrutement
                    </button>

                    <!-- Newsletter -->
                    <button type="button" onclick="showSection('newsletter')" class="flex items-center w-full p-3 rounded-lg hover:bg-blue-50 hover:text-blue-900">
                        <div class="mr-4">
                            <!-- Icon -->
                        </div>
                        Newsletter
                    </button>

                    <!-- Partenaires -->
                    <button type="button" onclick="showSection('Entreprises')" class="flex items-center w-full p-3 rounded-lg hover:bg-blue-50 hover:text-blue-900">
                        <div class="mr-4">
                            <!-- Icon -->
                        </div>
                        Entreprises
                    </button>

                    <!-- Utilisateurs -->
                    <?php if (isset($role) && $role === 'admin'): ?>
                        <button type="button" onclick="showSection('utilisateurs')" class="flex items-center w-full p-3 rounded-lg hover:bg-blue-50 hover:text-blue-900">
                        <div class="mr-4">
                            <!-- Icon -->
                        </div>
                        Utilisateurs
                    </button>
                    <?php endif; ?>

                    <!-- Paramètres -->
                    <button type="button" onclick="showSection('settings')" class="flex items-center w-full p-3 rounded-lg hover:bg-blue-50 hover:text-blue-900">
                        <div class="mr-4">
                            <!-- Icon -->
                        </div>
                        Settings
                    </button>

                    <!-- Déconnexion -->
                    <button type="button" onclick="window.location.href='logout.php'" class="logout-btn mt-auto self-start mx-2 mb-2">Déconnexion</button>
                </nav>
            </aside>


            <!-- Contenu principal -->
            <main class="ml-[20rem] w-full p-8 flex flex-col">

                <!-- Section Newsletter -->
                <section id="newsletter" class="section-content hidden">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-800 text-gray-300">
                            <tr>
                                <th class="px-6 py-3 text-left">Email</th>
                                <th class="px-6 py-3 text-left">Nom</th>
                                <th class="px-6 py-3 text-left">Prénom</th>
                                <th class="px-6 py-3 text-center">Suppression</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-200">
                            <?php foreach ($newsletters as $newsletter): ?>
                                <tr class="bg-white border-b border-gray-300">
                                    <td class="px-6 py-3"><?= htmlspecialchars($newsletter['mail']) ?></td>
                                    <td class="px-6 py-3"><?= htmlspecialchars($newsletter['nom']) ?></td>
                                    <td class="px-6 py-3"><?= htmlspecialchars($newsletter['prenom']) ?></td>
                                    <td class="px-6 py-3 text-center">
                                        <form method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet abonné ?');">
                                            <input type="hidden" name="action" value="delete_newsletter">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($newsletter['mail']) ?>">
                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </section>
                
                <!-- Section Blog -->
                <section id="blog" class="section-content hidden px-4 py-6">

                    <!-- Bouton d'ajout -->
                    <div class="mb-4">
                        <a href="ajouter_blog.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            + Ajouter un article
                        </a>
                    </div>

                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-gray-800 text-gray-300">
                                <th class="px-4 py-2">Image</th>
                                <th class="px-4 py-2">Titre</th>
                                <th class="px-4 py-2">Contenu</th>
                                <th class="px-4 py-2">Date</th>
                                <th class="px-4 py-2">État</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($blogs as $blog): ?>
                            <tr class="bg-white border-b">
                                <td class="px-4 py-2">
                                    <img src="../<?= htmlspecialchars($blog['image']) ?>" alt="Image de l'article" class="w-16 h-16 object-cover">
                                </td>
                                <td class="px-4 py-2"><?= htmlspecialchars($blog['titre']) ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($blog['texte']) ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($blog['date']) ?></td>

                                <!-- Menu déroulant pour changer l'état -->
                                <td class="px-4 py-2">
                                    <form method="POST" action="">
                                        <input type="hidden" name="action" value="update_blog_state">
                                        <input type="hidden" name="id" value="<?= $blog['id'] ?>">
                                        <select name="etat" onchange="this.form.submit()" class="border border-gray-300 p-1 rounded">
                                            <option value="brouillon" <?= $blog['etat'] == 'brouillon' ? 'selected' : '' ?>>Brouillon</option>
                                            <option value="en ligne" <?= $blog['etat'] == 'en ligne' ? 'selected' : '' ?>>En ligne</option>
                                            <option value="newsletter" <?= $blog['etat'] == 'newsletter' ? 'selected' : '' ?>>Newsletter</option>
                                            <option value="les deux" <?= $blog['etat'] == 'les deux' ? 'selected' : '' ?>>Les deux</option>
                                        </select>
                                    </form>
                                </td>

                                <!-- Actions modifier / supprimer -->
                                <td class="px-4 py-2 space-x-2 flex gap-2">
                                    <a href="modifier_blog.php?id=<?= $blog['id'] ?>" class="text-blue-600 hover:underline">Modifier</a>

                                    <form method="POST" action="" onsubmit="return confirm('Supprimer cet article ?')">
                                        <input type="hidden" name="action" value="delete_blog">
                                        <input type="hidden" name="id" value="<?= $blog['id'] ?>">
                                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </section>

                <!-- Section Utilisateurs -->
                <section id="utilisateurs" class="section-content hidden">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-800 text-gray-300">
                            <tr>
                                <th class="px-6 py-3 text-left">Email</th>
                                <th class="px-6 py-3 text-left">Nouveau mot de passe</th>
                                <th class="px-6 py-3 text-left">Rôle</th>
                                <th class="px-6 py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-200">
                            <?php foreach ($utilisateurs as $utilisateur): ?>
                                <tr class="bg-white border-b border-gray-300">
                                    <form method="POST">
                                        <input type="hidden" name="action" value="update_user">
                                        <td class="px-6 py-3">
                                            <input type="hidden" name="old_mail" value="<?= htmlspecialchars($utilisateur['mail']) ?>">
                                            <input type="email" name="mail" value="<?= htmlspecialchars($utilisateur['mail']) ?>" class="w-full px-2 py-1 border rounded" required>
                                        </td>
                                        <td class="px-6 py-3">
                                            <input type="password" name="mot_de_passe" placeholder="Nouveau mot de passe" class="w-full px-2 py-1 border rounded">
                                        </td>
                                        <td class="px-6 py-3">
                                            <select name="role" class="w-full px-2 py-1 border rounded">
                                                <option value="lecteur" <?= $utilisateur['role'] === 'lecteur' ? 'selected' : '' ?>>lecteur</option>
                                                <option value="redacteur" <?= $utilisateur['role'] === 'redacteur' ? 'selected' : '' ?>>rédacteur</option>
                                                <option value="admin" <?= $utilisateur['role'] === 'admin' ? 'selected' : '' ?>>admin</option>
                                            </select>
                                        </td>
                                        <td class="px-6 py-3 text-center space-x-2">
                                            <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Modifier</button>
                                    </form>
                                    <form method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');" class="inline-block">
                                        <input type="hidden" name="action" value="delete_user">
                                        <input type="hidden" name="mail" value="<?= htmlspecialchars($utilisateur['mail']) ?>">
                                        <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition">Supprimer</button>
                                    </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <!-- Ligne pour créer un nouvel utilisateur -->
                            <tr class="bg-gray-100 border-t border-gray-300">
                                <form method="POST">
                                    <input type="hidden" name="action" value="create_user">
                                    <td class="px-6 py-3">
                                        <input type="email" name="mail" placeholder="Nouvel email" class="w-full px-2 py-1 border rounded" required>
                                    </td>
                                    <td class="px-6 py-3">
                                        <input type="password" name="mot_de_passe" placeholder="Mot de passe" class="w-full px-2 py-1 border rounded" required>
                                    </td>
                                    <td class="px-6 py-3">
                                        <select name="role" class="w-full px-2 py-1 border rounded" required>
                                            <option value="lecteur">lecteur</option>
                                            <option value="redacteur">rédacteur</option>
                                            <option value="admin">admin</option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-3 text-center">
                                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">Créer</button>
                                    </td>
                                </form>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <!-- Section Entreprises -->
                <section id="Entreprises" class="section-content hidden">
    <div class="max-w-[100rem] p-8">
        <h2 class="text-3xl font-bold mb-8 text-center">Implantation terrain</h2>

        <?php
        $grouped = [];
        foreach ($entreprises as $ent) {
            $pays = $ent['pays'] ?? 'Autres';
            $grouped[$pays][] = $ent;
        }

                        function countEntreprises($grouped, $pays) {
                            return isset($grouped[$pays]) ? count($grouped[$pays]) : 0;
                        }

        function safeId($str) {
            return preg_replace('/[^a-z0-9]+/i', '_', strtolower($str));
        }
        ?>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <?php foreach (['Togo', 'Bénin'] as $pays): $safeId = safeId($pays); ?>
                <div class="bg-white shadow-lg rounded-xl p-6">
                    <h3 class="text-xl font-bold mb-4">
                        <?= ['Togo' => '🇹🇬', 'Bénin' => '🇧🇯'][$pays] ?? '' ?> <?= htmlspecialchars($pays) ?>
                    </h3>
                    <p class="mb-4">🏢 Entreprises partenaires : <strong><?= countEntreprises($grouped, $pays) ?></strong></p>

                    <div class="overflow-y-auto max-h-60 mb-4">
                        <table class="w-full text-sm text-left border">
                            <thead class="bg-gray-100 sticky top-0 z-10">
                                <tr>
                                    <th class="p-2">Latitude</th>
                                    <th class="p-2">Longitude</th>
                                    <th class="p-2">Nom</th>
                                    <th class="p-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($grouped[$pays])): ?>
                                    <?php foreach ($grouped[$pays] as $ent): ?>
                                        <tr class="border-t">
                                            <td class="p-2"><?= htmlspecialchars($ent['latitude']) ?></td>
                                            <td class="p-2"><?= htmlspecialchars($ent['longitude']) ?></td>
                                            <td class="p-2"><?= htmlspecialchars($ent['nom']) ?></td>
                                            <td class="p-2"></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="4" class="p-2 text-center text-gray-500">Aucune entreprise enregistrée</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="bg-white shadow-lg rounded-xl p-6">
            <?php $pays = 'Niger'; $safeId = safeId($pays); ?>
            <h3 class="text-xl font-bold mb-4">🇳🇪 <?= htmlspecialchars($pays) ?></h3>
            <p class="mb-4">🏢 Entreprises partenaires : <strong><?= countEntreprises($grouped, $pays) ?></strong></p>

            <div class="overflow-y-auto max-h-48 mb-4">
                <table class="w-full text-sm text-left border">
                    <thead class="bg-gray-100 sticky top-0 z-10">
                        <tr>
                            <th class="p-2">Latitude</th>
                            <th class="p-2">Longitude</th>
                            <th class="p-2">Nom</th>
                            <th class="p-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($grouped[$pays])): ?>
                            <?php foreach ($grouped[$pays] as $ent): ?>
                                <tr class="border-t">
                                    <td class="p-2"><?= htmlspecialchars($ent['latitude']) ?></td>
                                    <td class="p-2"><?= htmlspecialchars($ent['longitude']) ?></td>
                                    <td class="p-2"><?= htmlspecialchars($ent['nom']) ?></td>
                                    <td class="p-2"></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="p-2 text-center text-gray-500">Aucune entreprise enregistrée</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="w-full h-[500px] mt-8 rounded shadow" id="map-global"></div>

        <div class="bg-white shadow-lg rounded-xl p-6 mt-8">
            <h3 class="text-xl font-bold mb-4">➕ Ajouter une nouvelle entreprise</h3>

            <?php if (!empty($error)): ?>
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>#Entreprises">
                <input type="hidden" name="action" value="add_entreprise">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <input type="text" name="nom" placeholder="Nom de l'entreprise" class="px-4 py-2 border rounded" required>
                    <input type="text" name="ville" placeholder="Ville" class="px-4 py-2 border rounded" required>
                    <input type="text" name="latitude" placeholder="Latitude" class="px-4 py-2 border rounded" required>
                    <input type="text" name="longitude" placeholder="Longitude" class="px-4 py-2 border rounded" required>
                    <select name="pays" class="px-4 py-2 border rounded" required>
                        <option value="">-- Pays --</option>
                        <option value="Togo">Togo</option>
                        <option value="Bénin">Bénin</option>
                        <option value="Niger">Niger</option>
                    </select>
                </div>
                <div class="text-right mt-4">
                    <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                        Ajouter l'entreprise
                    </button>
                </div>
            </form>
        </div>
    </div>

                    </div>
                </section>

                <!-- Section Recrutement -->
                <section id="recrutement" class="section-content hidden px-4 py-6">

                    <!-- Bouton d'ajout -->
                    <div class="mb-4">
                        <a href="ajouter_poste.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            + Ajouter un poste
                        </a>
                    </div>

                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-gray-800 text-gray-300">
                                <th class="px-4 py-2">Titre</th>
                                <th class="px-4 py-2">Descriptif</th>
                                <th class="px-4 py-2">Localisation</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($postes as $poste): ?>
                            <tr class="bg-white border-b">
                                <td class="px-4 py-2"><?= htmlspecialchars($poste['titre']) ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($poste['descriptif']) ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($poste['localisation']) ?></td>

                                <td class="px-4 py-2 space-x-2 flex gap-2">
                                    <a href="modifier_poste.php?id=<?= $poste['id'] ?>" class="text-blue-600 hover:underline">Modifier</a>

                                    <form method="POST" action="" onsubmit="return confirm('Supprimer ce poste ?')">
                                        <input type="hidden" name="action" value="delete_poste">
                                        <input type="hidden" name="id" value="<?= $poste['id'] ?>">
                                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </section>

            </section>


        </div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    <?php foreach (['Togo', 'Bénin', 'Niger'] as $pays):
        $safeId = preg_replace('/[^a-z0-9]+/i', '_', strtolower($pays));
        $ents = $grouped[$pays] ?? [];
        // Préparer les markers JS [lat, lng, nom, ville]
        $markersJS = [];
        foreach ($ents as $e) {
            $lat = $e['latitude'] ?? null;
            $lng = $e['longitude'] ?? null;
            $nom = addslashes($e['nom'] ?? '');
            $ville = addslashes($e['ville'] ?? $pays); // utiliser ville si dispo sinon pays
            if ($lat && $lng) {
                $markersJS[] = "[$lat, $lng, '$nom', '$ville']";
            }
        }
    ?>
    (function(){
        const map = L.map('map-<?= $safeId ?>');
        const markersData = [<?= implode(',', $markersJS) ?>];
        
        if (markersData.length === 0) {
            // Centrer sur pays avec zoom modéré par défaut
            const centerByPays = {
                'Togo': [8.6195, 0.8248],
                'Bénin': [9.3077, 2.3158],
                'Niger': [17.6078, 8.0817]
            };
            map.setView(centerByPays['<?= $pays ?>'] || [6, 1], 6);
        } else if (markersData.length === 1) {
            map.setView([markersData[0][0], markersData[0][1]], 12);
        } else {
            // Calcul bounds
            const latlngs = markersData.map(m => [m[0], m[1]]);
            const bounds = L.latLngBounds(latlngs);
            map.fitBounds(bounds.pad(0.5));
        }
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const map = L.map('map-global').setView([16.0, 8.0], 5);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: '&copy; OpenStreetMap'
            }).addTo(map);

        markersData.forEach(m => {
            const marker = L.marker([m[0], m[1]]).addTo(map);
            marker.bindTooltip(m[3], {direction: 'top', offset: [0, -10]});
        });
    })();
    <?php endforeach; ?>

    // Gestion du modal ajout entreprise
    const modal = document.getElementById('addCompanyModal');
    const openBtn = document.getElementById('openAddCompanyBtn');
    const closeBtn = document.getElementById('closeAddCompanyBtn');
    const form = document.getElementById('addCompanyForm');

    openBtn.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });
    closeBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    modal.addEventListener('click', e => {
        if (e.target === modal) modal.classList.add('hidden');
    });

    form.addEventListener('submit', e => {
        e.preventDefault();
        const formData = new FormData(form);
        // Exemple: afficher dans console (à adapter pour envoi en backend)
        console.log("Ajouter entreprise:", {
            latitude: formData.get('latitude'),
            longitude: formData.get('longitude'),
            nom: formData.get('nom'),
            pays: formData.get('pays'),
            ville: formData.get('ville'),
        });
        alert("Formulaire soumis (à gérer côté serveur)");
        modal.classList.add('hidden');
        form.reset();
    });
});
</script>



                <!-- Popup -->
                <div id="popup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                    <div class="bg-white rounded-xl shadow-lg p-6 w-96 relative">

                    <!-- Bouton de fermeture -->
                    <button onclick="closePopup()" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl">&times;</button>

                    <h2 class="text-lg font-semibold mb-4 text-center">Ajouter des informations</h2>

                    <form id="popupForm" class="space-y-4">
                        <div>
                        <label for="nom" class="block font-medium">Nom</label>
                        <input type="text" id="nom" name="nom" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div>
                        <label for="longitude" class="block font-medium">Longitude</label>
                        <input type="text" id="longitude" name="longitude" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div>
                        <label for="latitude" class="block font-medium">Latitude</label>
                        <input type="text" id="latitude" name="latitude" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div class="text-right">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Valider</button>
                        </div>
                    </form>
                    </div>
                </div>
            </main>
        </div>
        <script src="admin.js" defer></script>
    </body>
</html>


