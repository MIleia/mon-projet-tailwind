<?php
// Connexion à la base de données
$host = 'localhost';
$db   = 'pharmacol_db'; // <-- Change avec le vrai nom de ta base
$user = 'root';
$pass = ''; // ou 'root' si tu as défini un mot de passe
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    $stmt = $pdo->query("SELECT id, titre, descriptif, localisation FROM postes");
    $postes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<div class='text-red-600 text-center p-4'>Erreur de connexion à la base de données : " . $e->getMessage() . "</div>";
    $postes = [];
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Recrutement</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="main.js"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700&display=swap');
                body {
                font-family: 'Lexend', sans-serif;
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
            }
        </style>
    </head>

    <button onclick="scrollToTop()" 
        class="fixed bottom-6 right-6 w-12 h-12 bg-[#06788f] text-white text-xl flex items-center justify-center rounded-full shadow-lg hover:bg-[#055c6e] transition z-50" aria-label="Remonter en haut">↑
    </button>
    
    <body>
        <header>
            <!-- Bandeau top -->
            <div class="bg-gray-100 text-sm border-b border-gray-300 py-2">
                <div class="max-w-7xl mx-auto px-4 flex flex-wrap justify-between text-gray-700">
                    <div class="flex gap-4">
                        <span><i class="fas fa-map-marker-alt text-green-700"></i> 184 rue agnan quartier djidjolé</span>
                        <span><i class="fas fa-envelope text-green-700"></i> contact@agence-pharmacol.com</span>
                    </div>
                    <div>
                        <span><i class="fas fa-clock text-green-700"></i> Lun-Ven: 7h30-12h 14h30-18h / Fermé les weekends et jours fériés</span>
                    </div>
                </div>
            </div>

            <!-- Header principal -->
            <div class="bg-[#3C74A8] border-b py-4">
                <div class="max-w-screen-xl mx-auto flex justify-between items-center px-6">
                    <div class="w-1/4"></div>
                    <div class="flex items-center space-x-4 text-white ml-4">
                        <div class="flex items-center justify-center w-10 h-10 bg-white rounded-full">
                            <i class="fas fa-phone text-[#3C74A8] text-lg font-bold"></i>
                        </div>
                        <div>
                            <p class="text-xs">Appeler à tout moment</p>
                            <strong class="text-sm font-bold">(+228) 22 50 75 10</strong>
                        </div>
                        <div class="w-px h-6 bg-white"></div>
                        <div class="relative flex items-center w-60 md:w-72">
                            <button onclick="toggleSearch()" class="absolute left-3">
                                <i class="fas fa-search text-[#3C74A8]"></i>
                            </button>
                            <input id="searchInput" type="text" placeholder="Rechercher une section..." class="w-full pl-10 pr-4 py-2 rounded-full text-black text-sm focus:outline-none focus:ring-2 focus:ring-green-500" oninput="updateSuggestions()" onkeydown="if(event.key === 'Enter') performSearch()">
                            <ul id="suggestions" class="absolute left-0 top-full w-full mt-1 bg-white text-black border border-gray-300 rounded shadow hidden z-50 text-sm max-h-60 overflow-y-auto"></ul>
                        </div>
                    </div>
                    <div class="flex space-x-5 text-white w-1/4 justify-end mr-4">
                        <a href="https://www.facebook.com"><i class="fab fa-facebook"></i></a>
                        <a href="https://www.twitter.com"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.pinterest.com"><i class="fab fa-pinterest"></i></a>
                        <a href="https://www.linkedin.com/company/agence-pharmacol/"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <!-- Bandeau Prestations & navbar -->
            <div class="relative z-0 qhero-prestations bg-cover bg-center h-48 md:h-72" style="background-image: url('images/Page contact/medicine-capsules-global-health-with-geometric-pattern-digital-remix.jpg');">
                <div class="bg-white bg-opacity-75 backdrop-blur-md w-[70%] mx-auto relative z-30">
                    <nav class="relative z-20">
                        <div class="qcontainer flex justify-center items-center px-4 py-3">
                            <ul class="qnav-links flex items-center space-x-8">
                                <li class="qlogo-nav">
                                    <a href="index.html" class="flex items-center space-x-2">
                                        <div class="qlogo">
                                            <img src="images/Page prestations 2/logo-350100.png" alt="Logo Pharmacol" class="h-16">
                                        </div>
                                    </a>
                                </li>
                                <li class="qdropdown relative group">
                                    <a class="text-gray-900 hover:text-green-600 flex items-center space-x-2">
                                        <span>Nos Implentations</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </a>
                                    <ul class="qdropdown-menu absolute left-0 hidden bg-white border border-gray-300 rounded shadow-md w-48 group-hover:block">
                                        <li>
                                            <a href="accueil togo.html" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:text-green-600">
                                                <img src="https://flagcdn.com/w40/tg.png" alt="Togo" class="w-5 h-auto"> Togo
                                            </a>
                                        </li>
                                        <li>
                                            <a href="accueil benin.html" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:text-green-600">
                                                <img src="https://flagcdn.com/w40/bj.png" alt="Benin" class="w-5 h-auto"> Benin
                                            </a>
                                        </li>
                                        <li>
                                            <a href="accueil niger.html" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:text-green-600">
                                                <img src="https://flagcdn.com/w40/ne.png" alt="Niger" class="w-5 h-auto"> Niger
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="prestation.html" class="text-gray-900 hover:text-green-600">Prestations</a></li>
                                <li><a href="recrutement.php" class="text-[#437305] hover:text-green-600 font-bold">Recrutement</a></li>
                                <li><a href="blog.html" class="text-gray-900 hover:text-green-600">Blog</a></li>
                                <li><a href="contact.html" class="text-gray-900 hover:text-green-600">Contact</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>

                <div class="absolute inset-0 flex items-center justify-center text-white">
                    <h1 class="text-4xl md:text-5xl font-bold">Recrutement</h1>
                </div>
            </div>
        </header>
        <div class="flex flex-col justify-center items-center">


            <?php foreach ($postes as $poste): ?>
                <a href="recrutement_formulaire.php?id=<?= $poste['id'] ?>" class="block w-[80%] bg-white shadow-md rounded-lg p-6 mb-6 hover:shadow-lg transition">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2"><?= htmlspecialchars($poste['titre']) ?></h3>
                    <p class="text-gray-700 mb-4"><?= nl2br(htmlspecialchars($poste['descriptif'])) ?></p>
                    <p class="text-sm text-gray-500">
                        <i class="fas fa-map-marker-alt mr-1 text-green-600"></i>
                        <?= htmlspecialchars($poste['localisation']) ?>
                    </p>
                </a>
            <?php endforeach; ?>

        </div>
     
        <!-- Footer -->
        <footer class="bg-[#3C74A8E8] text-gray-100 relative">
            <div class="max-w-7xl mx-auto py-12 px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="space-y-4 relative">
                    <div class="absolute top-2 left-[120px] -translate-x-1/2 w-44 h-16 bg-white rounded-full blur-md z-0"></div>
                    <img src="./images/Page contact/logo-350100.png" class="h-12 mb-4 mx-auto md:ml-10 relative z-10" />
                    <h2 class="text font-semibold relative z-10">Un réseau de délégués médicaux sur le Togo, le Bénin et le Niger</h2>
                    <div class="flex items-center">
                        <input type="text" placeholder="Email"
                            class="w-full px-3 py-2 bg-white text-black border border-gray-600 rounded-md" />
                        <button class="bg-[#437305] px-4 py-2 ml-2 border border-[#437305] rounded-md">
                            <i class="fas fa-arrow-up transform rotate-45 text-white"></i>
                        </button>
                    </div>
                </div>

                <div class="md:ml-8">
                    <h2 class="mb-4 font-semibold text-lg">Liens rapides</h2>
                    <ul class="space-y-2">
                        <li><a href="index.html" class="hover:underline">À propos</a></li>
                        <li><a href="prestation.html" class="hover:underline">Services</a></li>
                        <li><a href="blog.html" class="hover:underline">Blog</a></li>
                        <li><a href="recrutement.php" class="hover:underline">Recrutement</a></li>
                        <li><a href="contact.html" class="hover:underline">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h2 class="mb-4 font-semibold text-lg">Contact</h2>
                    <ul class="space-y-2">
                        <li>184 rue Agnan quartier djidjolé</li>
                        <li>derrière EPP Aflao gakli</li>
                        <li><i class="fas fa-phone-alt text-[#437305]"></i><a href="tel:+22890123456" target="_blank">+228 90 12 34 56</a></li>
                        <li><i class="fas fa-envelope text-[#437305]"></i><a href="mailto:contact@pharmacol.com" target="_blank">contact@pharmacol.com</a></li>
                        <li class="flex gap-5 mt-2">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-pinterest-p"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        </li>
                    </ul>
                </div>

                <div class="md:ml-8">
                    <h2 class="mb-4 font-semibold text-lg">Heures d’ouvertures</h2>
                    <ul class="space-y-1">
                        <li>Lundi : 7h30 - 18h</li>
                        <li>Mardi : 7h30 - 18h</li>
                        <li>Mercredi : 7h30 - 18h</li>
                        <li>Jeudi : 7h30 - 18h</li>
                        <li>Vendredi : 7h30 - 18h</li>
                    </ul>
                </div>
            </div>

            <div class="bg-[#3C74A8] text-center py-4 text-sm">
                <a href="https://www.neostart.tech/" target="_blank">Copyright © 2025 Neo Start Technology Tous droits réservés.</a>
            </div>
        </footer>
    </body>
</html>
