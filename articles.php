<?php
    require_once 'bdd_pharmacol/config.php';

    function getArticlesHTML() {
        global $pdo;

        try {
            $stmt = $pdo->query("SELECT * FROM blog WHERE etat IN ('en ligne', 'les 2') ORDER BY date DESC");
            $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $html = '';
            if (count($articles) > 0) {
                $first = array_shift($articles);
                $texte_brut = strip_tags($first['texte']);
                $is_long = mb_strlen($texte_brut) > 350;
                $texte_court = $is_long ? mb_substr($texte_brut, 0, 350) . '...' : $texte_brut;

                // Pour le texte complet, on enlève la partie déjà affichée dans l'extrait
                if ($is_long) {
                    $texte_restant = mb_substr($texte_brut, 350);
                    $texte_complet = nl2br(htmlspecialchars($texte_restant));
                } else {
                    $texte_complet = nl2br(htmlspecialchars($texte_brut));
                }

                $html .= '
                <section id="articles" class="max-w-6xl mx-auto px-2 sm:px-6 lg:px-8 py-10">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-[#3C74A8] mb-12 text-center tracking-tight">Dernières nouvelles</h1>
                    <div class="flex flex-col items-center mb-16">
                        <article class="relative w-full md:w-4/5 bg-white p-8 rounded-3xl shadow-2xl border-2 border-blue-100 transition hover:scale-[1.02] hover:shadow-2xl animate-slide-up overflow-hidden group">
                            <span class="absolute top-4 right-4 bg-gradient-to-r from-[#3C74A8] to-[#437305] text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg z-10">Nouveau</span>
                            <img src="' . htmlspecialchars($first['image']) . '" alt="Illustration de l\'article" class="w-full h-80 object-cover rounded-2xl mb-6 shadow-md border border-blue-50">
                            <div>
                                <h2 class="text-3xl font-extrabold text-[#3C74A8] mb-3 group-hover:text-[#437305] transition">' . htmlspecialchars($first['titre']) . '</h2>
                                <p class="text-base text-gray-500 mb-5">Publié le ' . date('j F Y', strtotime($first['date'])) . '</p>
                                <div class="relative min-h-[6rem]">';
                if ($is_long) {
                    $html .= '
                                    <span class="texte-extrait block text-gray-800 leading-relaxed max-h-36 overflow-hidden pr-2 transition-all duration-300 fade-bottom" style="display: -webkit-box; -webkit-line-clamp: 7; -webkit-box-orient: vertical;">
                                        ' . htmlspecialchars($texte_court) . '
                                    </span>
                                    <span class="texte-complet hidden block text-gray-800 leading-relaxed transition-all duration-300">'
                                        . $texte_complet . '
                                    </span>';
                } else {
                    $html .= '
                                    <span class="block text-gray-800 leading-relaxed">' . $texte_complet . '</span>';
                }
                $html .= '
                                </div>
                            </div>';
                if ($is_long) {
                    $html .= '
                            <div class="mt-6 text-right">
                                <button type="button" class="btn-lire-suite inline-flex items-center gap-2 bg-gradient-to-r from-blue-100 to-green-100 text-[#3C74A8] hover:bg-[#437305] hover:text-white px-6 py-2 rounded-xl text-base font-semibold shadow transition-all duration-300">
                                    <i class="fas fa-book-open"></i> <span>Lire la suite</span>
                                </button>
                            </div>';
                }
                $html .= '
                        </article>
                    </div>
                ';
            }

            if (count($articles) > 0) {
                $html .= '
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                ';

                foreach ($articles as $article) {
                    $texte_brut = strip_tags($article['texte']);
                    $texte_complet = nl2br(htmlspecialchars($article['texte']));
                    $is_long = mb_strlen($texte_brut) > 220;
                    $texte_court = $is_long ? mb_substr($texte_brut, 0, 220) . '...' : $texte_brut;

                    $html .= '
                        <article class="group bg-white p-6 rounded-2xl shadow-xl border border-blue-100 transition hover:scale-105 hover:shadow-2xl animate-slide-up flex flex-col justify-between relative overflow-hidden">
                            <img src="' . htmlspecialchars($article['image']) . '" alt="Illustration de l\'article" class="w-full h-52 object-cover rounded-xl mb-4 border border-blue-50">
                            <div>
                                <h2 class="text-xl font-bold text-[#3C74A8] mb-2 group-hover:text-[#437305] transition">' . htmlspecialchars($article['titre']) . '</h2>
                                <p class="text-sm text-gray-500 mb-3">Publié le ' . date('j F Y', strtotime($article['date'])) . '</p>
                                <div class="relative min-h-[4rem]">';
                    if ($is_long) {
                        $html .= '
                                    <span class="texte-extrait block text-gray-800 leading-relaxed max-h-20 overflow-hidden pr-2 transition-all duration-300 fade-bottom" style="display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical;">
                                        ' . htmlspecialchars($texte_court) . '
                                    </span>
                                    <span class="texte-complet hidden block text-gray-800 leading-relaxed transition-all duration-300">' . $texte_complet . '</span>';
                    } else {
                        $html .= '
                                    <span class="block text-gray-800 leading-relaxed">' . $texte_complet . '</span>';
                    }
                    $html .= '
                                </div>
                            </div>';
                    if ($is_long) {
                        $html .= '
                            <div class="mt-4 text-right">
                                <button type="button" class="btn-lire-suite inline-flex items-center gap-2 bg-blue-100 text-[#3C74A8] hover:bg-[#437305] hover:text-white px-4 py-2 rounded-lg text-sm font-semibold shadow transition-all duration-300">
                                    <i class="fas fa-book-open"></i> <span>Lire la suite</span>
                                </button>
                            </div>';
                    }
                    $html .= '
                        </article>
                    ';
                }

                $html .= '</div>';
            }

            $html .= '</section>';

            return $html;

        } catch (PDOException $e) {
            return '<p class="text-red-500">Erreur lors de la récupération des articles : ' . $e->getMessage() . '</p>';
        }
    }

function getLastArticleHTML() {
    global $pdo;

    try {
        $stmt = $pdo->query("SELECT * FROM blog WHERE etat IN ('en ligne', 'les 2') ORDER BY date DESC LIMIT 1");
        $article = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($article) {
            $texte_complet = htmlspecialchars($article['texte']);
            $texte_court = strlen($texte_complet) > 150 ? substr($texte_complet, 0, 150) . '...' : $texte_complet;

            $html = '
            <section id="articles" class="px-2 sm:px-4 py-10 flex flex-col items-center">
                <h1 class="text-2xl md:text-3xl font-bold text-[#3C74A8] mb-6 text-center">Dernières nouvelles</h1>
                <article class="bg-white shadow-lg rounded-2xl overflow-hidden w-full max-w-xl flex flex-col">
                    <img src="' . htmlspecialchars($article['image']) . '" alt="Illustration de l\'article" class="w-full h-48 md:h-64 object-cover">
                    <div class="p-4 md:p-6 flex flex-col flex-1">
                        <h2 class="text-xl md:text-2xl font-bold text-[#3C74A8] mb-2">' . htmlspecialchars($article['titre']) . '</h2>
                        <p class="text-xs md:text-sm text-gray-500 mb-4">Publié le ' . date('j F Y', strtotime($article['date'])) . '</p>
                        <p class="text-gray-800 mb-4">
                            <span class="texte-extrait">' . $texte_court . '</span>
                            <span class="texte-complet hidden">' . $texte_complet . '</span>
                        </p>
                        <a href="#" class="text-[#437305] font-semibold hover:underline btn-lire-suite">Lire la suite</a>
                    </div>
                </article>
            </section>
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
        } else {
            return '<p class="text-gray-500">Aucun article trouvé.</p>';
        }
    } catch (PDOException $e) {
        return '<p class="text-red-500">Erreur lors de la récupération des articles : ' . $e->getMessage() . '</p>';
    }
}

if (isset($_GET['last'])) {
    echo getLastArticleHTML();
    exit;
} else {
    echo getArticlesHTML();
}
?>
