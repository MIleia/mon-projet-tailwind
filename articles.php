<?php
require_once 'bdd_pharmacol/config.php';

function getArticlesHTML() {
    global $pdo;

    try {
        $stmt = $pdo->query("SELECT * FROM blog ORDER BY date DESC");
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $html = '';
        if (count($articles) > 0) {
            $first = array_shift($articles);
            $texte_complet = htmlspecialchars($first['texte']);
            $texte_court = strlen($texte_complet) > 150 ? substr($texte_complet, 0, 150) . '...' : $texte_complet;

            $html .= '
            <section id="articles">
                <h1 class="text-3xl font-bold text-[#3C74A8] mb-6">Dernières nouvelles</h1>
                <article class="bg-white shadow-lg rounded-2xl overflow-hidden">
                    <img src="' . htmlspecialchars($first['image']) . '" alt="Illustration de l\'article" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-[#3C74A8] mb-2">' . htmlspecialchars($first['titre']) . '</h2>
                        <p class="text-sm text-gray-500 mb-4">Publié le ' . date('j F Y', strtotime($first['date'])) . '</p>
                        <p class="text-gray-800 mb-4">
                            <span class="texte-extrait">' . $texte_court . '</span>
                            <span class="texte-complet hidden">' . $texte_complet . '</span>
                        </p>
                        <a href="#" class="text-[#437305] font-semibold hover:underline btn-lire-suite">Lire la suite</a>
                    </div>
                </article>
            </section>
            ';
        }

        if (count($articles) > 0) {
            $html .= '
            <section class="space-y-12 mt-10">
                <h2 class="text-2xl font-semibold text-[#3C74A8] mb-4">Autres articles</h2>
                <div class="grid md:grid-cols-2 gap-10">
            ';

            foreach ($articles as $article) {
                $texte_complet = htmlspecialchars($article['texte']);
                $texte_court = strlen($texte_complet) > 150 ? substr($texte_complet, 0, 150) . '...' : $texte_complet;

                $html .= '
                <article class="bg-white shadow-lg rounded-2xl overflow-hidden">
                    <img src="' . htmlspecialchars($article['image']) . '" alt="Illustration de l\'article" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-[#3C74A8] mb-2">' . htmlspecialchars($article['titre']) . '</h2>
                        <p class="text-sm text-gray-500 mb-4">Publié le ' . date('j F Y', strtotime($article['date'])) . '</p>
                        <p class="text-gray-800 mb-4">
                            <span class="texte-extrait">' . $texte_court . '</span>
                            <span class="texte-complet hidden">' . $texte_complet . '</span>
                        </p>
                        <a href="#" class="text-[#437305] font-semibold hover:underline btn-lire-suite">Lire la suite</a>
                    </div>
                </article>
                ';
            }

            $html .= '</div></section>';
        }

        // Ajouter le script JS pour toggle texte "Lire la suite"
        $html .= '
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".btn-lire-suite").forEach(function(btn) {
                btn.addEventListener("click", function(e) {
                    e.preventDefault();
                    const container = btn.closest("article");
                    const extrait = container.querySelector(".texte-extrait");
                    const complet = container.querySelector(".texte-complet");

                    if (complet.classList.contains("hidden")) {
                        complet.classList.remove("hidden");
                        extrait.classList.add("hidden");
                        btn.textContent = "Lire moins";
                    } else {
                        complet.classList.add("hidden");
                        extrait.classList.remove("hidden");
                        btn.textContent = "Lire la suite";
                    }
                });
            });
        });
        </script>
        ';

        return $html;

    } catch (PDOException $e) {
        return '<p class="text-red-500">Erreur lors de la récupération des articles : ' . $e->getMessage() . '</p>';
    }
}

echo getArticlesHTML();
?>
