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
            .animate-fade-in-up { animation: fade-in-up 0.6s ease-out forwards; }
            @keyframes fade-in-up {
                0% { opacity: 0; transform: translateY(20px);}
                100% { opacity: 1; transform: translateY(0);}
            }
            .dernier-article-badge {
                position: absolute;
                top: -0.5rem;
                right: 1rem;
                left: auto;
                background: #437305;
                color: #fff;
                padding: 0.4rem 1rem;
                border-radius: 9999px;
                font-size: 0.95rem;
                font-weight: 600;
                z-index: 10;
                box-shadow: 0 2px 8px 0 rgba(67,115,5,0.12);
                letter-spacing: 0.5px;
            }
            .blog-card {
                transition: transform 0.2s, box-shadow 0.2s;
            }
            .blog-card:hover {
                transform: translateY(-6px) scale(1.02);
                box-shadow: 0 8px 32px 0 rgba(60,116,168,0.13);
            }
            .blog-img {
                transition: filter 0.3s;
            }
            .blog-card:hover .blog-img {
                filter: brightness(0.93);
            }
            .btn-lire-suite {
                transition: color 0.2s;
            }
            .btn-lire-suite:hover {
                color: #3C74A8;
            }
        </style>
    </head>
    <body class="bg-[#f7fafc] text-gray-800">
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
            <h1 class="text-4xl md:text-5xl font-extrabold text-[#3C74A8] mb-12 text-center tracking-tight drop-shadow-lg">Dernières nouvelles</h1>
            
            @php
                $dernier = $articles->first();
                $autres = $articles->slice(1)->values();
            @endphp

            @if($dernier)
            <!-- Dernier article en grand -->
            <article class="relative bg-gradient-to-br from-[#eaf6ff] via-white to-[#f0f7fa] rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row animate-fade-in-up mb-16 blog-card border border-[#d1e3f8] hover:shadow-2xl transition-all duration-300">
                @if($dernier->image)
                    <div class="md:w-1/2 w-full h-80 md:h-auto overflow-hidden">
                        <img src="{{ asset($dernier->image) }}" alt="Image de l'article" class="w-full h-full object-cover blog-img scale-105 hover:scale-100 transition-transform duration-300">
                    </div>
                @endif
                <div class="flex-1 p-10 flex flex-col justify-center relative">
                    <span class="dernier-article-badge shadow-lg">Dernier article</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold mb-4 text-[#2a527a] leading-tight drop-shadow-sm">{{ $dernier->titre }}</h2>
                    <div class="mb-4 text-lg text-gray-700 leading-relaxed texte-extrait">
                        {{ \Illuminate\Support\Str::limit(strip_tags($dernier->texte), 300) }}
                    </div>
                    <button class="btn-lire-suite text-[#437305] hover:underline flex items-center gap-1 font-semibold transition-colors duration-200">
                        <span>Lire la suite</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div class="texte-complet hidden mt-4 text-gray-700 leading-relaxed bg-white/80 p-4 rounded-xl shadow-inner">
                        {!! $dernier->texte !!}
                    </div>
                </div>
            </article>
            @endif

            <!-- Les autres articles, 2 par ligne, sans bug d'affichage -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                @foreach($autres as $i => $article)
                    <article class="relative bg-gradient-to-br from-[#f7fafc] via-white to-[#eaf6ff] rounded-2xl shadow-lg overflow-hidden flex flex-col animate-fade-in-up blog-card border border-[#e0e7ef] hover:shadow-2xl transition-all duration-300 group">
                        @if($article->image)
                            <div class="overflow-hidden h-56">
                                <img src="{{ asset($article->image) }}" alt="Image de l'article" class="w-full h-full object-cover blog-img group-hover:scale-105 transition-transform duration-300">
                            </div>
                        @endif
                        <div class="p-7 flex flex-col flex-1">
                            <h2 class="text-2xl font-bold mb-2 text-[#3C74A8] leading-tight group-hover:text-[#437305] transition-colors duration-200">{{ $article->titre }}</h2>
                            <div class="flex-1">
                                <div class="texte-extrait text-gray-700 leading-relaxed text-base">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($article->texte), 180) }}
                                </div>
                                <div class="texte-complet hidden text-gray-700 leading-relaxed bg-white/80 p-3 rounded-xl shadow-inner mt-2">
                                    {!! $article->texte !!}
                                </div>
                            </div>
                            <button class="btn-lire-suite mt-4 text-[#437305] hover:underline flex items-center gap-1 font-semibold transition-colors duration-200">
                                <span>Lire la suite</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                        </div>
                        <div class="absolute top-4 right-4 bg-[#3C74A8] text-white text-xs px-3 py-1 rounded-full shadow-md opacity-80">
                            {{ \Carbon\Carbon::parse($article->date)->translatedFormat('d M Y') }}
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".btn-lire-suite").forEach(function(btn) {
                btn.addEventListener("click", function(e) {
                    e.preventDefault();
                    const container = btn.closest("article");
                    const extrait = container.querySelector(".texte-extrait");
                    const complet = container.querySelector(".texte-complet");

                    if (complet && complet.classList.contains("hidden")) {
                        complet.classList.remove("hidden");
                        if (extrait) extrait.classList.add("hidden");
                        btn.querySelector("span").textContent = "Lire moins";
                    } else if (complet) {
                        complet.classList.add("hidden");
                        if (extrait) extrait.classList.remove("hidden");
                        btn.querySelector("span").textContent = "Lire la suite";
                    }
                });
            });
        });
        </script>

        <!-- Footer -->
        <footer class="bg-[#3C74A8E8] text-gray-100 relative">
            <div class="max-w-7xl mx-auto py-8 md:py-12 px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Bloc logo et newsletter -->
                <div class="space-y-4 relative flex flex-col items-center md:items-start">
                    <div class="absolute top-2 left-1/2 md:left-[120px] -translate-x-1/2 w-32 md:w-44 h-12 md:h-16 bg-white rounded-full blur-md z-0"></div>
                    <img src="{{ asset('images/Page contact/logo-350100.png') }}" class="h-10 md:h-12 mb-4 mx-auto md:ml-10 relative z-10" />
                    <h2 class="text font-semibold relative z-10 text-center md:text-left text-base md:text-lg">Un réseau de délégués médicaux sur le Togo, le Bénin et le Niger</h2>
                    <div class="flex w-full max-w-xs">
                        <input type="text" placeholder="Email"
                            class="w-full px-3 py-2 bg-white text-black border border-gray-600 rounded-l-md focus:outline-none" />
                        <button class="bg-[#437305] px-4 py-2 border border-[#437305] rounded-r-md">
                            <i class="fas fa-arrow-up transform rotate-45 text-white"></i>
                        </button>
                    </div>
                </div>
                <!-- Liens rapides -->
                <div class="md:ml-8 flex flex-col items-center md:items-start">
                    <h2 class="mb-4 font-semibold text-lg">Liens rapides</h2>
                    <ul class="space-y-2 text-center md:text-left">
                        <li><a href="{{ route('accueil') }}" class="hover:underline">À propos</a></li>
                        <li><a href="{{ route('prestation') }}" class="hover:underline">Services</a></li>
                        <li><a href="{{ route('blog') }}" class="hover:underline">Blog</a></li>
                        <li><a href="{{ route('recrutement') }}" class="hover:underline">Recrutement</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:underline">Contact</a></li>
                    </ul>
                </div>
                <!-- Contact -->
                <div class="flex flex-col items-center md:items-start">
                    <h2 class="mb-4 font-semibold text-lg">Contact</h2>
                    <ul class="space-y-2 text-center md:text-left">
                        <li>184 rue Agnan quartier djidjolé</li>
                        <li>derrière EPP Aflao gakli</li>
                        <li>
                            <i class="fas fa-phone-alt text-[#437305]"></i>
                            <a href="tel:+22890123456" target="_blank" class="ml-1">+228 90 12 34 56</a>
                        </li>
                        <li>
                            <i class="fas fa-envelope text-[#437305]"></i>
                            <a href="mailto:contact@pharmacol.com" target="_blank" class="ml-1">contact@pharmacol.com</a>
                        </li>
                        <li class="flex gap-5 mt-2 justify-center md:justify-start">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-pinterest-p"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </li>
                    </ul>
                </div>
                <!-- Horaires -->
                <div class="md:ml-8 flex flex-col items-center md:items-start">
                    <h2 class="mb-4 font-semibold text-lg">Heures d’ouvertures</h2>
                    <ul class="space-y-1 text-center md:text-left">
                        <li>Lundi : 7h30 - 18h</li>
                        <li>Mardi : 7h30 - 18h</li>
                        <li>Mercredi : 7h30 - 18h</li>
                        <li>Jeudi : 7h30 - 18h</li>
                        <li>Vendredi : 7h30 - 18h</li>
                    </ul>
                </div>
            </div>
            <div class="bg-[#3C74A8] text-center py-4 text-xs md:text-sm">
                <a href="https://www.neostart.tech/" target="_blank">Copyright © 2025 Neo Start Technology Tous droits réservés.</a>
            </div>
        </footer>
    </body>
</html>