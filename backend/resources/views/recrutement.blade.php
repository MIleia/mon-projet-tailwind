{{-- filepath: backend/resources/views/recrutement.blade.php --}}
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
        <script src="{{ asset('js/main.js') }}" defer></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700&display=swap');
            body { font-family: 'Lexend', sans-serif; }
        </style>
    </head>
    <body class="bg-white text-gray-800">
        <button id="scrollToTopBtn" onclick="scrollToTop()" 
            class="fixed bottom-6 right-6 w-12 h-12 bg-[#06788f] text-white text-xl flex items-center justify-center rounded-full shadow-lg hover:bg-[#055c6e] transition z-50 hidden" aria-label="Remonter en haut">↑
        </button>

        <!-- HEADER -->
        <header>
            <!-- Bandeau top -->
            <div id="Recrutement" class="bg-gray-100 text-sm border-b border-gray-300 py-2">
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
                        <div class="qcontainer flex justify-around items-center px-4 py-3">
                            <!-- Logo -->
                            <a href="{{ route('accueil') }}" class="flex items-center space-x-2">
                                <div class="qlogo">
                                    <img src="images/Page prestations 2/logo-350100.png" alt="Logo Pharmacol" class="h-12 md:h-16">
                                </div>
                            </a>
                            <!-- Hamburger bouton mobile -->
                            <button id="menu-toggle" class="md:hidden text-[#3C74A8] text-3xl focus:outline-none">
                                <i class="fas fa-bars"></i>
                            </button>
                            <!-- Menu principal -->
                            <ul id="main-menu" class="hidden md:flex qnav-links flex-col md:flex-row flex md:items-center md:space-x-10 absolute md:static top-full left-0 w-full md:w-auto bg-white md:bg-transparent shadow md:shadow-none z-40 transition-all duration-300 ease-in-out">
                                <li class="qdropdown relative group">
                                    <a href="#" class="text hover:text-gray-900 flex items-center space-x-2 px-4 py-3 md:p-0">
                                        <span>Nos Implentations</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </a>
                                    <ul class="qdropdown-menu absolute left-0 hidden bg-white border border-gray-300 rounded shadow-md w-48 group-hover:block md:mt-0 z-50">
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
                                <li><a href="{{ route('prestation') }}" class="text-gray-900 hover:text-green-600 block px-4 py-3 md:p-0">Prestations</a></li>
                                <li><a href="{{ route('recrutement') }}" class="text-[#437305] hover:text-green-600 block px-4 py-3 md:p-0 font-bold">Recrutement</a></li>
                                <li><a href="{{ route('blog') }}" class="text-gray-900 hover:text-green-600 block px-4 py-3 md:p-0">Blog</a></li>
                                <li><a href="{{ route('contact') }}" class="text-gray-900 hover:text-green-600 block px-4 py-3 md:p-0">Contact</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="absolute inset-0 flex flex-col items-center justify-end pb-8 sm:justify-center sm:pb-0 text-white text-center">
                    <h1 class="text-2xl sm:text-4xl md:text-5xl font-bold w-full">Recrutement</h1>
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

                // Gestion du dropdown "Nos Implentations" sur desktop
                document.querySelectorAll('.qdropdown > a').forEach(drop => {
                    drop.addEventListener('click', function(e) {
                        if (window.innerWidth >= 768) {
                            e.preventDefault();
                            const submenu = this.nextElementSibling;
                            submenu.classList.toggle('hidden');
                        }
                    });
                });

                // Fermer le sous-menu si on clique ailleurs (desktop uniquement)
                document.addEventListener('click', function(e) {
                    if (window.innerWidth >= 768) {
                        const isDropdown = e.target.closest('.qdropdown');
                        if (!isDropdown) {
                            document.querySelectorAll('.qdropdown-menu').forEach(menu => {
                                menu.classList.add('hidden');
                            });
                        }
                    }
                });

                document.addEventListener('DOMContentLoaded', function () {
                    const menuToggle = document.getElementById('menu-toggle');
                    const mainMenu = document.getElementById('main-menu');

                    // Burger menu
                    if (menuToggle && mainMenu) {
                        menuToggle.addEventListener('click', function (e) {
                            e.stopPropagation();
                            mainMenu.classList.toggle('hidden');
                        });
                        mainMenu.addEventListener('click', function(e) {
                            e.stopPropagation();
                        });
                        document.body.addEventListener('click', function () {
                            if (window.innerWidth < 768) {
                                mainMenu.classList.add('hidden');
                                // Ferme aussi tous les sous-menus
                                document.querySelectorAll('.qdropdown-menu').forEach(menu => {
                                    menu.classList.add('hidden');
                                });
                            }
                        });
                    }

                    // Dropdown mobile
                    document.querySelectorAll('.qdropdown > a').forEach(drop => {
                        drop.addEventListener('click', function(e) {
                            if(window.innerWidth < 768) {
                                e.preventDefault();
                                const submenu = this.nextElementSibling;
                                // Toggle le sous-menu
                                submenu.classList.toggle('hidden');
                                // Ferme les autres sous-menus
                                document.querySelectorAll('.qdropdown-menu').forEach(menu => {
                                    if (menu !== submenu) menu.classList.add('hidden');
                                });
                            }
                        });
                    });

                    // Fermer le sous-menu mobile si on clique ailleurs
                    document.addEventListener('click', function(e) {
                        if(window.innerWidth < 768) {
                            const isDropdown = e.target.closest('.qdropdown');
                            if(!isDropdown) {
                                document.querySelectorAll('.qdropdown-menu').forEach(menu => {
                                    menu.classList.add('hidden');
                                });
                            }
                        }
                    });

                    // Dropdown desktop
                    document.querySelectorAll('.qdropdown > a').forEach(drop => {
                        drop.addEventListener('click', function(e) {
                            if (window.innerWidth >= 768) {
                                e.preventDefault();
                                const submenu = this.nextElementSibling;
                                submenu.classList.toggle('hidden');
                            }
                        });
                    });

                    // Fermer le sous-menu si on clique ailleurs (desktop)
                    document.addEventListener('click', function(e) {
                        if (window.innerWidth >= 768) {
                            const isDropdown = e.target.closest('.qdropdown');
                            if (!isDropdown) {
                                document.querySelectorAll('.qdropdown-menu').forEach(menu => {
                                    menu.classList.add('hidden');
                                });
                            }
                        }
                    });
                });
            </script>
        </header>

        <div id="Offres" class="flex flex-col justify-center items-center mt-8">
            @foreach ($postes as $poste)
                <a href="{{ route('recrutement.formulaire', $poste->id) }}" class="block w-[80%] bg-white shadow-md rounded-lg p-6 mb-6 hover:shadow-lg transition">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $poste->titre }}</h3>
                    <p class="text-gray-700 mb-4">{!! nl2br(e($poste->descriptif)) !!}</p>
                    <p class="text-sm text-gray-500">
                        <i class="fas fa-map-marker-alt mr-1 text-green-600"></i>
                        {{ $poste->localisation }}
                    </p>
                </a>
            @endforeach
        </div>

        <!-- Footer -->
        <footer class="bg-[#3C74A8E8] text-gray-100 relative">
            <div class="max-w-7xl mx-auto py-8 md:py-12 px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Bloc logo et newsletter -->
                <div class="space-y-4 relative flex flex-col items-center md:items-start">
                    <div class="absolute top-2 left-1/2 md:left-[120px] -translate-x-1/2 w-32 md:w-44 h-12 md:h-16 bg-white rounded-full blur-md z-0"></div>
                    <img src="./images/Page contact/logo-350100.png" class="h-10 md:h-12 mb-4 mx-auto md:ml-10 relative z-10" />
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