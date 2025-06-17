<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Pharmacol - Benin</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700&display=swap');
            body {
                font-family: 'Lexend', sans-serif;
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
            }
            .accordion-content {
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease, padding 0.3s ease;
            }
            .accordion-content.open {
                padding-bottom: 0.75rem;
            }
        </style>
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    </head>
    <body class="bg-white text-gray-800" id="Bénin">
        <button id="scrollToTopBtn" onclick="scrollToTop()" 
            class="fixed bottom-6 right-6 w-12 h-12 bg-[#06788f] text-white text-xl flex items-center justify-center rounded-full shadow-lg hover:bg-[#055c6e] transition z-50 hidden" aria-label="Remonter en haut">↑
        </button>

        <header>
                <!-- Bandeau top -->
            <div class="bg-gray-100 text-sm border-b border-gray-300 py-2">
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

                <!-- Bandeau Prestations & navbar -->
                <div class="relative z-0 qhero-prestations bg-cover bg-center h-[500px]" style="background-image: url('images/Page accueil togo/header.png');">
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
                            <ul id="main-menu" class="hidden md:flex qnav-links flex-col md:flex-row flex md:items-center md:space-x-8 absolute md:static top-full left-0 w-full md:w-auto bg-white md:bg-transparent shadow md:shadow-none z-40 transition-all duration-300 ease-in-out">
                                <li class="qdropdown relative group">
                                    <a href="#" class="text-[#437305] hover:text-green-600 flex items-center space-x-2 px-4 py-3 md:p-0">
                                        <span>Nos Implentations</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </a>
                                    <ul class="qdropdown-menu absolute left-0 hidden bg-white border border-gray-300 rounded shadow-md w-48 group-hover:block md:mt-2 z-50">
                                        <li>
                                            <a href="{{ route('accueil.togo') }}" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:text-green-600">
                                                <img src="https://flagcdn.com/w40/tg.png" alt="Togo" class="w-5 h-auto"> Togo
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('accueil.benin') }}" class="flex items-center gap-2 px-4 py-2 text-[#437305] hover:text-green-600 font-bold">
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
                                <li><a href="{{ route('recrutement') }}" class="text-gray-900 hover:text-green-600 block px-4 py-3 md:p-0">Recrutement</a></li>
                                <li><a href="{{ route('blog') }}" class="text-gray-900 hover:text-green-600 block px-4 py-3 md:p-0">Blog</a></li>
                                <li><a href="{{ route('contact') }}" class="text-gray-900 hover:text-green-600 block px-4 py-3 md:p-0">Contact</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>

                    <div class="absolute inset-0 flex items-center justify-start text-white px-6">
                        <div class="w-1/2 max-w-xl text-center ml-12">
                            <h1 class="text-4xl md:text-5xl font-bold mb-4">PHARMACOL BENIN</h1>
                            <h2 class="text-2xl md:text-3xl font-semibold mb-4">Vous accompagne</h2><br>
                            <a href="#contact" class="inline-block bg-[#437305] hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-lg shadow">Évaluer la faisabilité de votre projet</a>
                        </div>
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

        <!-- Contenu de la page -->
        <!-- HERO SECTION -->
        <section class="bg-gradient-to-r from-[#3C74A8] to-[#14b8a6] text-white pt-20 pb-12 px-6 relative overflow-hidden">
            <div class="absolute inset-0 bg-opacity-10 bg-white rounded-full blur-3xl w-[400px] h-[400px] top-[-100px] right-[-100px]"></div>
            <div class="max-w-4xl mx-auto text-center relative z-10">
                <h2 class="text-4xl md:text-5xl font-extrabold mb-3">Pharmacol Bénin : votre relais local</h2>
                <p class="text-lg md:text-xl mb-6">
                Une présence engagée au Bénin pour accompagner les laboratoires dans une expansion maîtrisée, ancrée sur plus de deux décennies de terrain.
                </p>
                <a href="#À propos de Pharmacol Bénin" class="inline-block bg-white text-[#06788f] font-semibold px-8 py-3 rounded-full shadow-md hover:bg-gray-100 transition duration-300">
                En savoir plus
                </a>
            </div>
        </section>

        <!-- CHIFFRES CLÉS -->
        <section class="py-20 px-4 sm:px-6 bg-gray-50" id="Chiffres Bénin">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12 text-center">
            <div class="transform hover:scale-105 transition">
                <p class="text-6xl font-extrabold text-[#14b8a6]">2</p>
                <p class="mt-3 text-gray-700">Bureaux principaux à Cotonou et Parakou</p>
            </div>
            <div class="transform hover:scale-105 transition">
                <p class="text-6xl font-extrabold text-[#14b8a6]">12</p>
                <p class="mt-3 text-gray-700">Laboratoires pharmaceutiques représentés</p>
            </div>
            <div class="transform hover:scale-105 transition">
                <p class="text-6xl font-extrabold text-[#14b8a6]">45</p>
                <p class="mt-3 text-gray-700">Collaborateurs terrain mobilisés</p>
            </div>
        </div>
    </section>

    <!-- À PROPOS -->
    <section class="py-20 px-4 sm:px-6 bg-white" id="À propos de Pharmacol Bénin">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-8 md:gap-12">
            <div class="w-full md:w-1/2 mb-8 md:mb-0">
                <img src="{{ asset('images/Page accueil benin/dg-benin.png') }}" alt="Directeur / équipe Pharmacol Bénin" class="rounded-lg shadow-lg w-full max-w-xs md:max-w-full mx-auto" />
            </div>
            <div class="w-full md:w-1/2">
                <h2 class="text-2xl font-bold text-[#06788f] mb-6">Une équipe dédiée au service de la santé au Bénin</h2>
                <p class="text-base mb-4 text-justify leading-relaxed">Depuis Cotonou, Pharmacol Bénin opère avec rigueur pour représenter les laboratoires internationaux auprès des professionnels de santé béninois. Grâce à une parfaite connaissance du terrain, notre équipe adapte chaque stratégie aux réalités locales.</p>
                <p class="text-base text-justify leading-relaxed">Que ce soit pour la mise sur le marché, la promotion médicale ou la veille réglementaire, nous accompagnons chaque étape avec transparence et efficacité, toujours en lien avec les autorités de santé locales.</p>
            </div>
        </div>
    </section>

    <!-- CONTEXTE DU BÉNIN -->
    <section class="py-20 px-4 sm:px-6 bg-gray-100">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-10 items-start">
            <!-- Texte -->
            <div class="md:col-span-2 w-full mb-8 md:mb-0">
                <h2 class="text-2xl font-bold text-[#06788f] mb-6">Pourquoi le Bénin est stratégique ?</h2>
                <p class="text-base text-gray-800 mb-4 text-justify">Le Bénin est un pays dynamique d'Afrique de l'Ouest, frontalier du Togo, du Nigeria, du Niger et du Burkina Faso. Sa capitale économique, Cotonou, est un pôle logistique régional majeur. Le pays dispose d’un système de santé en amélioration continue, et présente un fort potentiel de croissance dans le secteur pharmaceutique.</p>
                <p class="text-base text-gray-800 mb-4 text-justify">Avec une population de plus de 13 millions d’habitants et une volonté politique de renforcer l'accès aux soins, le Bénin constitue un marché prometteur pour les laboratoires souhaitant développer une présence durable et éthique.</p>
                <ul class="list-disc list-inside text-base text-gray-700 space-y-2">
                    <li>Superficie : 114 763 km² – 12 départements sanitaires</li>
                    <li>Près de 1600 structures de santé réparties sur le territoire</li>
                    <li>Accès croissant aux médicaments essentiels grâce aux réformes</li>
                </ul>
            </div>

            <!-- Carte du Bénin -->
            <div class="w-full" id="Carte Bénin">
                <div class="bg-white border rounded-xl shadow-lg p-4 h-96 flex flex-col" >
                    <div id="map-benin" class="rounded w-full h-64 sm:h-80 md:h-96"></div>
                    <p class="mt-2 text-center text-sm text-gray-500 italic">Carte interactive du Bénin</p>
                </div>
            </div>
        </div>
        <script>
            var mapBenin = L.map('map-benin').setView([9.0, 2.0], 6);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
            }).addTo(mapBenin);

            function loadMarkersBenin() {
                fetch('/api/entreprises?benin=1')
                    .then(response => {
                        if (!response.ok) throw new Error("Erreur réseau");
                        return response.json();
                    })
                    .then(data => {
                        data.forEach(marker => {
                            const lat = parseFloat(marker.latitude);
                            const lng = parseFloat(marker.longitude);
                            const nom = marker.nom;
                            const ville = marker.ville;

                            if (!isNaN(lat) && !isNaN(lng)) {
                                L.marker([lat, lng])
                                    .addTo(mapBenin)
                                    .bindTooltip(`<div class="font-bold">${nom}</div><div class="text-xs">${ville}</div>`, {
                                        direction: 'top',
                                        offset: [-15, -10],
                                        permanent: true,
                                        className: 'leaflet-tooltip-custom'
                                    });
                            }
                        });
                    })
                    .catch(error => {
                        console.error("Erreur lors du chargement des marqueurs Bénin :", error);
                    });
            }

            document.addEventListener("DOMContentLoaded", function () {
                loadMarkersBenin();
            });
        </script>
    </section>

    <!-- NOS SERVICES -->
    <section class="py-20 px-4 sm:px-6 bg-white">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-2xl font-bold text-[#06788f] mb-12">Notre accompagnement au Bénin</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-[#14b8a6]/10 p-6 rounded-xl shadow-md hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold text-[#14b8a6] mb-4">Implantation & AMM</h3>
                    <ul class="text-left list-disc list-inside text-gray-700">
                        <li>Constitution des dossiers</li>
                        <li>Suivi avec les autorités locales</li>
                        <li>Obtention des autorisations</li>
                    </ul>
                </div>
                <div class="bg-[#14b8a6]/10 p-6 rounded-xl shadow-md hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold text-[#14b8a6] mb-4">Promotion médicale</h3>
                    <ul class="text-left list-disc list-inside text-gray-700">
                        <li>Visites auprès des prescripteurs</li>
                        <li>Formation continue</li>
                        <li>Événements scientifiques</li>
                    </ul>
                </div>
                <div class="bg-[#14b8a6]/10 p-6 rounded-xl shadow-md hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold text-[#14b8a6] mb-4">Logistique & Reporting</h3>
                    <ul class="text-left list-disc list-inside text-gray-700">
                        <li>Distribution sécurisée</li>
                        <li>Suivi terrain & reporting</li>
                        <li>Tableaux de bord décisionnels</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- POURQUOI PHARMACOL BÉNIN -->
    <section class="py-20 px-4 sm:px-6 bg-[#3C74A8] text-white text-center">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-2xl font-bold mb-4">Pourquoi faire confiance à Pharmacol Bénin ?</h2>
            <p class="text-base mb-6 leading-relaxed">Parce que nous allions la connaissance du terrain à une approche stratégique rigoureuse. Parce que notre objectif est commun : la santé des populations et la croissance durable des laboratoires partenaires.</p>
            <a href="#contact" class="inline-block mt-4 bg-white text-[#3C74A8] font-semibold px-8 py-3 rounded-full hover:bg-gray-100 transition">Parlons de votre projet</a>
        </div>
    </section>

    <!-- RECRUTEMENT -->
    <section class="py-20 px-4 sm:px-6 bg-white" id="recrutement">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-3xl font-extrabold text-[#06788f] mb-4">Rejoignez l’équipe Pharmacol Bénin</h2>
            <p class="text-lg text-gray-700 mb-12">
            Passion, Excellence, Impact.<br class="hidden md:inline" />
            Si ces mots vous parlent, nous serions ravis de vous rencontrer.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12 text-left">
                <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 shadow-md hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold text-[#14b8a6] mb-2">Délégué médical – Zone Nord</h3>
                    <p class="text-gray-700 mb-4 text-sm">Poste basé à Parakou – Candidatures ouvertes</p>
                    <a href="#contact" class="text-[#3C74A8E8] font-medium hover:underline">Postuler maintenant</a>
                </div>
                <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 shadow-md hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold text-[#14b8a6] mb-2">Responsable Réglementaire</h3>
                    <p class="text-gray-700 mb-4 text-sm">Cotonou – Expérience requise</p>
                    <a href="#contact" class="text-[#3C74A8E8] font-medium hover:underline">Voir les missions</a>
                </div>
                <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 shadow-md hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold text-[#14b8a6] mb-2">Assistant(e) administratif(ve)</h3>
                    <p class="text-gray-700 mb-4 text-sm">Stage de 6 mois – Cotonou</p>
                    <a href="#contact" class="text-[#3C74A8E8] font-medium hover:underline">Envoyer une candidature</a>
                </div>
            </div>
            <a href="{{ route('recrutement') }}" class="inline-block px-6 py-3 bg-[#3C74A8E8] text-white font-semibold rounded-full shadow-md hover:bg-[#3C74A8] transition">Voir toutes nos offres</a>
        </div>
    </section>

    <!-- CONTACT -->
    <section class="py-20 px-4 sm:px-6 bg-gray-100" id="contact">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-[#3C74A8E8] mb-4">Contactez-nous</h2>
            <p class="text-lg mb-6">Intéressé par notre accompagnement ? Échangeons sur la faisabilité de votre projet au Togo.</p>
            <a href="/contact.html" class="inline-block bg-[#14b8a6] text-white px-10 py-4 rounded-full hover:bg-[#0f827d] transition">Contactez-nous</a>
        </div>
    </section>


        <!-- Footer -->
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


