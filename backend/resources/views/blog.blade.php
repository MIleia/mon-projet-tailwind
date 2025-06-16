{{-- filepath: backend/resources/views/blog.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Blog</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="{{ asset('js/main.js') }}" defer></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700&display=swap');
            body { font-family: 'Lexend', 'Inter', sans-serif; }
            .accordion-content {
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease, padding 0.3s ease;
            }
            .accordion-content.open {
                padding-bottom: 0.75rem;
            }
            @keyframes fade-in-up {
                0% { opacity: 0; transform: translateY(20px);}
                100% { opacity: 1; transform: translateY(0);}
            }
            .animate-fade-in-up { animation: fade-in-up 0.6s ease-out forwards; }
            .animate-slide-up { opacity: 0; transform: translateY(30px); transition: all 0.5s ease-out; }
            .fade-bottom {
                -webkit-mask-image: linear-gradient(to bottom, black 80%, transparent 100%);
                mask-image: linear-gradient(to bottom, black 80%, transparent 100%);
            }
        </style>
    </head>
    <body class="bg-white text-gray-800">
        <button id="scrollToTopBtn" onclick="scrollToTop()" 
            class="fixed bottom-6 right-6 w-12 h-12 bg-[#06788f] text-white text-xl flex items-center justify-center rounded-full shadow-lg hover:bg-[#055c6e] transition z-50 hidden" aria-label="Remonter en haut">↑
        </button>

        <!-- HEADER -->
        <header>
            <!-- Bandeau top -->
            <div id="Blog" class="bg-gray-100 text-sm border-b border-gray-300 py-2">
                <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row flex-wrap sm:justify-between text-gray-700 gap-2 sm:gap-0">
                    <div class="flex flex-col sm:flex-row gap-2 sm:gap-4 items-center">
                        <span><i class="fas fa-map-marker-alt text-green-700"></i> 184 rue agnan quartier djidjolé</span>
                        <span><i class="fas fa-envelope text-green-700"></i> contact@agence-pharmacol.com</span>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center justify-center">
                        <span>
                            <i class="fas fa-clock text-green-700"></i>
                            Lun-Ven: 7h30-12h 14h30-18h
                            <span class="hidden sm:inline"> / </span>
                        </span>
                        <span class="sm:ml-1">
                            Fermé les weekends et jours fériés
                        </span>
                    </div>
                </div>
            </div>

            <!-- Header principal -->
            <div class="bg-[#3C74A8] border-b py-4">
                <div class="max-w-screen-xl mx-auto flex flex-col md:flex-row justify-between items-center px-6 gap-4">
                    <div class="hidden md:block w-1/4"></div>
                    <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 space-x-0 md:space-x-4 text-white w-full md:w-auto">
                        <div class="flex items-center justify-center w-10 h-10 bg-white rounded-full">
                            <i class="fas fa-phone text-[#3C74A8] text-lg font-bold"></i>
                        </div>
                        <div>
                            <p class="text-xs">Appeler à tout moment</p>
                            <strong class="text-sm font-bold">(+228) 22 50 75 10</strong>
                        </div>
                        <div class="hidden md:block w-px h-6 bg-white"></div>
                        <div class="relative flex items-center w-full md:w-60 lg:w-72">
                            <button onclick="toggleSearch()" class="absolute left-3">
                                <i class="fas fa-search text-[#3C74A8]"></i>
                            </button>
                            <input id="searchInput" type="text" placeholder="Rechercher..." class="w-full pl-10 pr-4 py-2 rounded-full text-black text-sm focus:outline-none focus:ring-2 focus:ring-green-500" oninput="updateSuggestions()" onkeydown="if(event.key === 'Enter') performSearch()">
                            <ul id="suggestions" class="absolute left-0 top-full w-full mt-1 bg-white text-black border border-gray-300 rounded shadow hidden z-50 text-sm max-h-60 overflow-y-auto"></ul>
                        </div>
                    </div>
                    <div class="flex space-x-5 text-white w-full md:w-1/4 justify-center md:justify-end mt-4 md:mt-0">
                        <a href="https://www.facebook.com"><i class="fab fa-facebook"></i></a>
                        <a href="https://www.twitter.com"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.pinterest.com"><i class="fab fa-pinterest"></i></a>
                        <a href="https://www.linkedin.com/company/agence-pharmacol/"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <!-- Bandeau Prestations & navbar responsive -->
            <div class="relative z-0 qhero-prestations bg-cover bg-center h-40 sm:h-56 md:h-72" style="background-image: url('{{ asset('images/Page contact/medicine-capsules-global-health-with-geometric-pattern-digital-remix.jpg') }}');">
                <div class="absolute inset-0 bg-black/40 z-0"></div>
                <div class="bg-white bg-opacity-100 backdrop-blur-md w-full md:w-[70%] mx-auto relative z-30">
                    <nav class="relative z-20">
                        <div class="qcontainer flex justify-center items-center px-4 py-3">
                            <ul class="qnav-links flex items-center space-x-8">
                                <li class="qlogo-nav">
                                    <a href="{{ route('accueil') }}" class="flex items-center space-x-2">
                                        <div class="qlogo">
                                            <img src="{{ asset('images/Page prestations 2/logo-350100.png') }}" alt="Logo Pharmacol" class="h-12 md:h-16">
                                        </div>
                                    </a>
                                </li>
                                <li class="qdropdown relative group">
                                    <a href="#" class="text-gray-900 hover:text-green-600 flex items-center space-x-2">
                                        <span>Nos Implentations</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </a>
                                    <ul class="qdropdown-menu absolute left-0 hidden bg-white border border-gray-300 rounded shadow-md w-48 group-hover:block">
                                        <li>
                                            <a href="{{ route('accueil.togo') }}" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:text-green-600">
                                                <img src="https://flagcdn.com/w40/tg.png" alt="Togo" class="w-5 h-auto"> Togo
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('accueil.benin') }}" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:text-green-600">
                                                <img src="https://flagcdn.com/w40/bj.png" alt="Benin" class="w-5 h-auto"> Benin
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('accueil.niger') }}" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:text-green-600">
                                                <img src="https://flagcdn.com/w40/ne.png" alt="Niger" class="w-5 h-auto"> Niger
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('prestation') }}" class="text-gray-900 hover:text-green-600">Prestations</a></li>
                                <li><a href="{{ route('recrutement') }}" class="text-gray-900 hover:text-green-600">Recrutement</a></li>
                                <li><a href="{{ route('blog') }}" class="text-[#437305] hover:text-green-600 font-bold">Blog</a></li>
                                <li><a href="{{ route('contact') }}" class="text-gray-900 hover:text-green-600">Contact</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="absolute inset-0 flex flex-col items-center justify-end pb-8 sm:justify-center sm:pb-0 text-white text-center">
                    <h1 class="text-2xl sm:text-4xl md:text-5xl font-bold w-full">Notre Blog</h1>
                </div>
            </div>
            <script>
                // Menu burger responsive
                const menuToggle = document.getElementById('menu-toggle');
                const mainMenu = document.getElementById('main-menu');
                menuToggle.addEventListener('click', () => {
                    mainMenu.classList.toggle('hidden');
                });

                // Dropdown mobile (ouvre/ferme au clic, referme si déjà ouvert)
                document.querySelectorAll('.qdropdown > a').forEach(drop => {
                    drop.addEventListener('click', function(e) {
                        if(window.innerWidth < 768) {
                            e.preventDefault();
                            const submenu = this.nextElementSibling;
                            // Ferme si déjà ouvert, sinon ouvre et ferme les autres
                            if (!submenu.classList.contains('hidden')) {
                                submenu.classList.add('hidden');
                            } else {
                                document.querySelectorAll('.qdropdown-menu').forEach(menu => {
                                    menu.classList.add('hidden');
                                });
                                submenu.classList.remove('hidden');
                            }
                        }
                    });
                });

                // Fermer le sous-menu si on clique ailleurs sur mobile
                document.addEventListener('click', function(e) {
                    if(window.innerWidth < 768) {
                        const isDropdown = e.target.closest('.qdropdown');
                        const isMenuToggle = e.target.closest('#menu-toggle');
                        if(!isDropdown && !isMenuToggle) {
                            document.querySelectorAll('.qdropdown-menu').forEach(menu => {
                                menu.classList.add('hidden');
                            });
                        }
                    }
                });
            </script>
        </header>

        <!-- Contenu de la page -->
        <section class="max-w-6xl mx-auto px-4 py-10 space-y-16" id="Articles">
            <h1 class="text-4xl md:text-5xl font-extrabold text-[#3C74A8] mb-12 text-center tracking-tight">Dernières nouvelles</h1>
            @if($articles->count())
                @php $first = $articles->first(); @endphp
                <div class="flex flex-col items-center mb-16">
                    <article class="relative w-full md:w-4/5 bg-white p-8 rounded-3xl shadow-2xl border-2 border-blue-100 transition hover:scale-[1.02] hover:shadow-2xl animate-slide-up overflow-hidden group">
                        <span class="absolute top-4 right-4 bg-gradient-to-r from-[#3C74A8] to-[#437305] text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg z-10">Nouveau</span>
                        <img src="{{ asset($first->image) }}" alt="Illustration de l'article" class="w-full h-80 object-cover rounded-2xl mb-6 shadow-md border border-blue-50">
                        <div>
                            <h2 class="text-3xl font-extrabold text-[#3C74A8] mb-3 group-hover:text-[#437305] transition">{{ $first->titre }}</h2>
                            <p class="text-base text-gray-500 mb-5">Publié le {{ \Carbon\Carbon::parse($first->date)->format('j F Y') }}</p>
                            <div class="relative min-h-[6rem]">
                                @php
                                    $texte_brut = strip_tags($first->texte);
                                    $is_long = mb_strlen($texte_brut) > 350;
                                    $texte_court = $is_long ? mb_substr($texte_brut, 0, 350) . '...' : $texte_brut;
                                    $texte_restant = $is_long ? mb_substr($texte_brut, 350) : '';
                                @endphp
                                <span class="texte-extrait block text-gray-800 leading-relaxed max-h-36 overflow-hidden pr-2 transition-all duration-300 fade-bottom" style="display: -webkit-box; -webkit-line-clamp: 7; -webkit-box-orient: vertical;">
                                    {{ $texte_court }}
                                </span>
                                @if($is_long)
                                    <span class="texte-complet hidden block text-gray-800 leading-relaxed transition-all duration-300">
                                        {!! nl2br(e($texte_restant)) !!}
                                    </span>
                                @endif
                            </div>
                        </div>
                        @if($is_long)
                            <div class="mt-6 text-right">
                                <button type="button" class="btn-lire-suite inline-flex items-center gap-2 bg-gradient-to-r from-blue-100 to-green-100 text-[#3C74A8] hover:bg-[#437305] hover:text-white px-6 py-2 rounded-xl text-base font-semibold shadow transition-all duration-300">
                                    <i class="fas fa-book-open"></i> <span>Lire la suite</span>
                                </button>
                            </div>
                        @endif
                    </article>
                </div>
                @if($articles->count() > 1)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        @foreach($articles->skip(1) as $article)
                            @php
                                $texte_brut = strip_tags($article->texte);
                                $is_long = mb_strlen($texte_brut) > 220;
                                $texte_court = $is_long ? mb_substr($texte_brut, 0, 220) . '...' : $texte_brut;
                            @endphp
                            <article class="group bg-white p-6 rounded-2xl shadow-xl border border-blue-100 transition hover:scale-105 hover:shadow-2xl animate-slide-up flex flex-col justify-between relative overflow-hidden">
                                <img src="{{ asset($article->image) }}" alt="Illustration de l'article" class="w-full h-52 object-cover rounded-xl mb-4 border border-blue-50">
                                <div>
                                    <h2 class="text-xl font-bold text-[#3C74A8] mb-2 group-hover:text-[#437305] transition">{{ $article->titre }}</h2>
                                    <p class="text-sm text-gray-500 mb-3">Publié le {{ \Carbon\Carbon::parse($article->date)->format('j F Y') }}</p>
                                    <div class="relative min-h-[4rem]">
                                        <span class="texte-extrait block text-gray-800 leading-relaxed max-h-20 overflow-hidden pr-2 transition-all duration-300 fade-bottom" style="display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical;">
                                            {{ $texte_court }}
                                        </span>
                                        @if($is_long)
                                            <span class="texte-complet hidden block text-gray-800 leading-relaxed transition-all duration-300">
                                                {!! nl2br(e(mb_substr($texte_brut, 220))) !!}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                @if($is_long)
                                    <div class="mt-4 text-right">
                                        <button type="button" class="btn-lire-suite inline-flex items-center gap-2 bg-blue-100 text-[#3C74A8] hover:bg-[#437305] hover:text-white px-4 py-2 rounded-lg text-sm font-semibold shadow transition-all duration-300">
                                            <i class="fas fa-book-open"></i> <span>Lire la suite</span>
                                        </button>
                                    </div>
                                @endif
                            </article>
                        @endforeach
                    </div>
                @endif
            @else
                <p class="text-gray-500">Aucun article trouvé.</p>
            @endif
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
                        btn.querySelector("span").textContent = "Lire moins";
                    } else {
                        complet.classList.add("hidden");
                        extrait.classList.remove("hidden");
                        btn.querySelector("span").textContent = "Lire la suite";
                    }
                });
            });
        });
        </script>

        <!-- FOOTER (adapte les liens avec route() comme vu précédemment) -->
        <!-- ... footer identique aux autres pages ... -->
    </body>
</html>