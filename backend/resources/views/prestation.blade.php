<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Prestations</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
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
        </style>
    </head>

    <body class="bg-white text-gray-800">
        <button onclick="scrollToTop()" 
            class="fixed bottom-6 right-6 w-12 h-12 bg-[#06788f] text-white text-xl flex items-center justify-center rounded-full shadow-lg hover:bg-[#055c6e] transition z-50" aria-label="Remonter en haut">↑
        </button>

        <!-- HEADER -->
        <header>
            <!-- Bandeau top -->
            <div id="Prestations" class="bg-gray-100 text-sm border-b border-gray-300 py-2">
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
                            <input id="searchInput" type="text" placeholder="Rechercher..." class="w-full pl-10 pr-4 py-2 rounded-full text-black text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
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
                            <ul id="main-menu" class="hidden md:flex qnav-links flex-col md:flex-row flex md:items-center md:space-x-8 absolute md:static top-full left-0 w-full md:w-auto bg-white md:bg-transparent shadow md:shadow-none z-40 transition-all duration-300 ease-in-out">
                                <li class="qdropdown relative group">
                                    <a href="#" class="text hover:text-gray-900 flex items-center space-x-2 px-4 py-3 md:p-0">
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
                                <li><a href="{{ route('prestation') }}" class="text-[#437305] hover:text-green-600 block px-4 py-3 md:p-0 font-bold">Prestations</a></li>
                                <li><a href="{{ route('recrutement') }}" class="text-gray-900 hover:text-green-600 block px-4 py-3 md:p-0">Recrutement</a></li>
                                <li><a href="{{ route('blog') }}" class="text-gray-900 hover:text-green-600 block px-4 py-3 md:p-0">Blog</a></li>
                                <li><a href="{{ route('contact') }}" class="text-gray-900 hover:text-green-600 block px-4 py-3 md:p-0">Contact</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="absolute inset-0 flex flex-col items-center justify-end pb-8 sm:justify-center sm:pb-0 text-white text-center">
                    <h1 class="text-2xl sm:text-4xl md:text-5xl font-bold w-full">Prestations</h1>
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
    <section class="py-10 sm:py-16 px-2 sm:px-4">
        <div class="max-w-screen-xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-10 items-stretch">
            <aside class="flex flex-col justify-between overflow-hidden shadow-lg bg-white mb-6 md:mb-0 rounded-xl">
                <div class="bg-[#3f73a3] text-white text-center py-4 font-semibold text-lg sm:text-xl">Tous les services</div>
                    <div class="bg-[#437305] p-4 sm:p-6 flex-grow flex flex-col justify-between">
                        <ul class="space-y-2 sm:space-y-4">
                            <li>
                            <button onclick="showContent('promotion')" data-key="promotion"
                                class="service-btn group w-full text-left flex justify-between items-center bg-white px-4 sm:px-5 py-3 sm:py-4 text-[#3f73a3] font-semibold hover:bg-[#3f73a3] hover:text-white shadow transition rounded">
                                Promotion médicale
                                <span class="text-[#437305] group-hover:text-blue-200 transition">&rarr;</span>
                            </button>
                            </li>
                            <li>
                            <button onclick="showContent('encadrement')" data-key="encadrement"
                                class="service-btn group w-full text-left flex justify-between items-center bg-white px-4 sm:px-5 py-3 sm:py-4 text-[#3f73a3] font-semibold hover:bg-[#3f73a3] hover:text-white shadow transition rounded">
                                Encadrement force de vente
                                <span class="text-[#437305] group-hover:text-blue-200 transition">&rarr;</span>
                            </button>
                            </li>
                            <li>
                            <button onclick="showContent('representation')" data-key="representation"
                                class="service-btn group w-full text-left flex justify-between items-center bg-white px-4 sm:px-5 py-3 sm:py-4 text-[#3f73a3] font-semibold hover:bg-[#3f73a3] hover:text-white shadow transition rounded">
                                Représentation pharmaceutique
                                <span class="text-[#437305] group-hover:text-blue-200 transition">&rarr;</span>
                            </button>
                            </li>
                            <li>
                            <button onclick="showContent('autorisation')" data-key="autorisation"
                                class="service-btn group w-full text-left flex justify-between items-center bg-white px-4 sm:px-5 py-3 sm:py-4 text-[#3f73a3] font-semibold hover:bg-[#3f73a3] hover:text-white shadow transition rounded">
                                Autorisation sur le marché
                                <span class="text-[#437305] group-hover:text-blue-200 transition">&rarr;</span>
                            </button>
                            </li>
                            <li>
                            <button onclick="showContent('marketing')" data-key="marketing"
                                class="service-btn group w-full text-left flex justify-between items-center bg-white px-4 sm:px-5 py-3 sm:py-4 text-[#3f73a3] font-semibold hover:bg-[#3f73a3] hover:text-white shadow transition rounded">
                                Marketing & Communication
                                <span class="text-[#437305] group-hover:text-blue-200 transition">&rarr;</span>
                            </button>
                            </li>
                            <li>
                            <button onclick="showContent('consulting')" data-key="consulting"
                                class="service-btn group w-full text-left flex justify-between items-center bg-white px-4 sm:px-5 py-3 sm:py-4 text-[#3f73a3] font-semibold hover:bg-[#3f73a3] hover:text-white shadow transition rounded">
                                Consulting
                                <span class="text-[#437305] group-hover:text-blue-200 transition">&rarr;</span>
                            </button>
                            </li>
                        </ul>
                    </div>
                </aside>

                <div class="md:col-span-2 flex items-center justify-center">
                    <img id="service-image" src="{{ asset('images/Page prestations 2/medical-doctor-girl-working-with-microscope-young-female-scientist-doing-vaccine-research.jpg') }}"
                        alt="Recherche médicale"
                        class="rounded-2xl shadow-xl w-full max-w-3xl object-cover transition-all duration-500" />
                </div>
            </div>
        </section>

        <section class="bg-gray-50 px-2 sm:px-4 py-10 sm:py-20">
            <div class="max-w-screen-xl mx-auto md:col-span-2 p-4 sm:p-10 md:p-20" id="content-area">
                <!-- Le contenu dynamique s'affichera ici -->
            </div>
        </section>
        <script>
            // Contenus HTML pour chaque service (textes enrichis et icônes)
            const servicesContent = {
                promotion: `
                    <div class="space-y-4">
                        <h2 class="text-2xl font-bold text-[#3f73a3] mb-4 flex items-center gap-2">
                            <i class="fas fa-bullhorn text-[#437305]"></i>
                            Promotion médicale
                        </h2>
                        <p class="mb-2 text-gray-700 text-lg">
                            Notre service de <strong>promotion médicale</strong> s’appuie sur une équipe de délégués médicaux hautement qualifiés, formés aux dernières innovations thérapeutiques et aux techniques de communication scientifique. Nous développons des stratégies personnalisées pour valoriser vos produits auprès des professionnels de santé, en tenant compte des spécificités locales et des exigences réglementaires.
                        </p>
                        <ul class="list-disc ml-6 text-gray-700 space-y-2">
                            <li>
                                <i class="fas fa-user-md text-[#3f73a3] mr-2"></i>
                                <strong>Visites médicales ciblées :</strong> Présentation de vos produits auprès des médecins, pharmaciens et établissements de santé, avec un argumentaire scientifique rigoureux et adapté à chaque interlocuteur.
                            </li>
                            <li>
                                <i class="fas fa-chalkboard-teacher text-[#3f73a3] mr-2"></i>
                                <strong>Organisation de réunions scientifiques :</strong> Mise en place de conférences, ateliers et webinaires animés par des experts, favorisant l’échange et la formation continue des professionnels de santé.
                            </li>
                            <li>
                                <i class="fas fa-file-medical-alt text-[#3f73a3] mr-2"></i>
                                <strong>Distribution de documentation :</strong> Élaboration et diffusion de supports pédagogiques, fiches produits et études cliniques pour renforcer la notoriété et la crédibilité de vos solutions thérapeutiques.
                            </li>
                        </ul>
                        <div class="mt-6 bg-blue-50 border-l-4 border-[#3f73a3] p-4 rounded">
                            <i class="fas fa-info-circle text-[#3f73a3] mr-2"></i>
                            <span class="text-gray-700">Notre approche repose sur l’éthique, la transparence et le respect des bonnes pratiques de promotion du médicament.</span>
                        </div>
                    </div>
                `,
                encadrement: `
                    <div class="space-y-4">
                        <h2 class="text-2xl font-bold text-[#3f73a3] mb-4 flex items-center gap-2">
                            <i class="fas fa-users-cog text-[#437305]"></i>
                            Encadrement force de vente
                        </h2>
                        <p class="mb-2 text-gray-700 text-lg">
                            L’<strong>encadrement de la force de vente</strong> est un levier essentiel pour garantir la performance commerciale et la cohésion de vos équipes sur le terrain. Nous proposons un accompagnement sur-mesure, de la formation initiale au suivi opérationnel, afin de maximiser l’impact de vos actions commerciales.
                        </p>
                        <ul class="list-disc ml-6 text-gray-700 space-y-2">
                            <li>
                                <i class="fas fa-chalkboard text-[#3f73a3] mr-2"></i>
                                <strong>Coaching personnalisé :</strong> Sessions individuelles ou collectives pour développer les compétences en négociation, gestion de portefeuille clients et argumentation scientifique.
                            </li>
                            <li>
                                <i class="fas fa-chart-line text-[#3f73a3] mr-2"></i>
                                <strong>Suivi des performances :</strong> Mise en place d’indicateurs de suivi, reporting régulier et analyse des résultats pour ajuster les stratégies en temps réel.
                            </li>
                            <li>
                                <i class="fas fa-graduation-cap text-[#3f73a3] mr-2"></i>
                                <strong>Formation continue :</strong> Programmes de formation adaptés aux évolutions du marché, aux nouvelles réglementations et aux innovations produits.
                            </li>
                        </ul>
                        <div class="mt-6 bg-green-50 border-l-4 border-[#437305] p-4 rounded">
                            <i class="fas fa-hands-helping text-[#437305] mr-2"></i>
                            <span class="text-gray-700">Nous croyons en la valorisation des talents et en la création d’un esprit d’équipe fort pour atteindre vos objectifs commerciaux.</span>
                        </div>
                    </div>
                `,
                representation: `
                    <div class="space-y-4">
                        <h2 class="text-2xl font-bold text-[#3f73a3] mb-4 flex items-center gap-2">
                            <i class="fas fa-handshake text-[#437305]"></i>
                            Représentation pharmaceutique
                        </h2>
                        <p class="mb-2 text-gray-700 text-lg">
                            Notre service de <strong>représentation pharmaceutique</strong> vous permet de bénéficier d’un relais local fiable et expérimenté pour défendre vos intérêts auprès des autorités sanitaires, des partenaires institutionnels et des acteurs du secteur de la santé.
                        </p>
                        <ul class="list-disc ml-6 text-gray-700 space-y-2">
                            <li>
                                <i class="fas fa-file-signature text-[#3f73a3] mr-2"></i>
                                <strong>Gestion administrative :</strong> Prise en charge des démarches administratives, dépôt de dossiers et suivi des autorisations nécessaires à la commercialisation de vos produits.
                            </li>
                            <li>
                                <i class="fas fa-balance-scale text-[#3f73a3] mr-2"></i>
                                <strong>Suivi réglementaire :</strong> Veille active sur les évolutions législatives et réglementaires, conseil sur la conformité et anticipation des changements de cadre.
                            </li>
                            <li>
                                <i class="fas fa-network-wired text-[#3f73a3] mr-2"></i>
                                <strong>Développement de partenariats :</strong> Mise en relation avec des distributeurs, établissements de santé et réseaux professionnels pour renforcer votre présence sur le marché.
                            </li>
                        </ul>
                        <div class="mt-6 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
                            <i class="fas fa-user-shield text-yellow-600 mr-2"></i>
                            <span class="text-gray-700">Nous sommes votre interlocuteur privilégié pour garantir la conformité et la visibilité de vos produits sur le territoire.</span>
                        </div>
                    </div>
                `,
                autorisation: `
                    <div class="space-y-4">
                        <h2 class="text-2xl font-bold text-[#3f73a3] mb-4 flex items-center gap-2">
                            <i class="fas fa-certificate text-[#437305]"></i>
                            Autorisation sur le marché
                        </h2>
                        <p class="mb-2 text-gray-700 text-lg">
                            L’<strong>obtention de l’autorisation de mise sur le marché (AMM)</strong> est une étape cruciale pour la commercialisation de vos produits pharmaceutiques. Notre équipe vous accompagne à chaque phase du processus, de la constitution du dossier à la validation finale par les autorités compétentes.
                        </p>
                        <ul class="list-disc ml-6 text-gray-700 space-y-2">
                            <li>
                                <i class="fas fa-folder-open text-[#3f73a3] mr-2"></i>
                                <strong>Dossier d’enregistrement :</strong> Rédaction, compilation et vérification des documents scientifiques, techniques et administratifs requis.
                            </li>
                            <li>
                                <i class="fas fa-tasks text-[#3f73a3] mr-2"></i>
                                <strong>Suivi des procédures :</strong> Interface avec les agences de régulation, gestion des échanges et réponses aux demandes de compléments.
                            </li>
                            <li>
                                <i class="fas fa-search text-[#3f73a3] mr-2"></i>
                                <strong>Veille réglementaire :</strong> Surveillance continue des évolutions réglementaires pour anticiper les exigences et garantir la conformité de vos produits.
                            </li>
                        </ul>
                        <div class="mt-6 bg-red-50 border-l-4 border-red-400 p-4 rounded">
                            <i class="fas fa-exclamation-circle text-red-600 mr-2"></i>
                            <span class="text-gray-700">Notre expertise vous assure un dépôt de dossier optimisé et un suivi rigoureux jusqu’à l’obtention de l’AMM.</span>
                        </div>
                    </div>
                `,
                marketing: `
                    <div class="space-y-4">
                        <h2 class="text-2xl font-bold text-[#3f73a3] mb-4 flex items-center gap-2">
                            <i class="fas fa-bullseye text-[#437305]"></i>
                            Marketing & Communication
                        </h2>
                        <p class="mb-2 text-gray-700 text-lg">
                            Nous concevons et déployons des <strong>stratégies marketing innovantes</strong> et des campagnes de communication sur-mesure pour valoriser vos produits et renforcer votre image de marque dans le secteur de la santé.
                        </p>
                        <ul class="list-disc ml-6 text-gray-700 space-y-2">
                            <li>
                                <i class="fas fa-broadcast-tower text-[#3f73a3] mr-2"></i>
                                <strong>Campagnes promotionnelles :</strong> Création de plans médias, gestion des relations presse et animation des réseaux sociaux pour accroître votre visibilité.
                            </li>
                            <li>
                                <i class="fas fa-paint-brush text-[#3f73a3] mr-2"></i>
                                <strong>Supports de communication :</strong> Conception de brochures, affiches, vidéos et contenus digitaux adaptés à vos cibles et à vos objectifs.
                            </li>
                            <li>
                                <i class="fas fa-calendar-check text-[#3f73a3] mr-2"></i>
                                <strong>Événements professionnels :</strong> Organisation de salons, congrès, ateliers et rencontres B2B pour favoriser les échanges et développer votre réseau.
                            </li>
                        </ul>
                        <div class="mt-6 bg-indigo-50 border-l-4 border-indigo-400 p-4 rounded">
                            <i class="fas fa-lightbulb text-indigo-600 mr-2"></i>
                            <span class="text-gray-700">Notre équipe créative et expérimentée vous accompagne pour faire rayonner vos innovations.</span>
                        </div>
                    </div>
                `,
                consulting: `
                    <div class="space-y-4">
                        <h2 class="text-2xl font-bold text-[#3f73a3] mb-4 flex items-center gap-2">
                            <i class="fas fa-user-tie text-[#437305]"></i>
                            Consulting
                        </h2>
                        <p class="mb-2 text-gray-700 text-lg">
                            Notre pôle <strong>consulting</strong> met à votre disposition une expertise pluridisciplinaire pour accompagner le développement de vos activités, optimiser vos processus et relever les défis du secteur pharmaceutique.
                        </p>
                        <ul class="list-disc ml-6 text-gray-700 space-y-2">
                            <li>
                                <i class="fas fa-search-dollar text-[#3f73a3] mr-2"></i>
                                <strong>Audit organisationnel :</strong> Analyse approfondie de vos structures, identification des axes d’amélioration et recommandations personnalisées.
                            </li>
                            <li>
                                <i class="fas fa-lightbulb text-[#3f73a3] mr-2"></i>
                                <strong>Stratégie de développement :</strong> Élaboration de plans d’action pour conquérir de nouveaux marchés, diversifier votre offre et renforcer votre compétitivité.
                            </li>
                            <li>
                                <i class="fas fa-hands-holding text-[#3f73a3] mr-2"></i>
                                <strong>Accompagnement personnalisé :</strong> Suivi régulier, conseils sur la gestion du changement et formation des équipes pour garantir la réussite de vos projets.
                            </li>
                        </ul>
                        <div class="mt-6 bg-gray-100 border-l-4 border-[#3f73a3] p-4 rounded">
                            <i class="fas fa-star text-[#3f73a3] mr-2"></i>
                            <span class="text-gray-700">Faites confiance à notre savoir-faire pour transformer vos ambitions en succès durables.</span>
                        </div>
                    </div>
                `
            };

            // Images associées à chaque service
            const servicesImages = {
                promotion: "{{ asset('images/Page prestations 2/medical-doctor-girl-working-with-microscope-young-female-scientist-doing-vaccine-research.jpg') }}",
                encadrement: "{{ asset('images/Page prestations 2/team-meeting-pharma.jpg') }}",
                representation: "{{ asset('images/Page prestations 2/pharma-representation.jpg') }}",
                autorisation: "{{ asset('images/Page prestations 2/autorisation-marche.jpg') }}",
                marketing: "{{ asset('images/Page prestations 2/marketing-communication.jpg') }}",
                consulting: "{{ asset('images/Page prestations 2/consulting-pharma.jpg') }}"
            };

            // Fonction pour afficher le contenu selon le service choisi
            function showContent(key) {
                const area = document.getElementById('content-area');
                area.innerHTML = servicesContent[key] || '';
                // Mettre à jour l'image
                const img = document.getElementById('service-image');
                if (img && servicesImages[key]) {
                    img.src = servicesImages[key];
                    img.alt = document.querySelector(`button[data-key="${key}"]`)?.innerText || '';
                }
                // Optionnel : mettre à jour le style du bouton actif
                document.querySelectorAll('.service-btn').forEach(btn => {
                    btn.classList.remove('bg-[#3f73a3]', 'text-white');
                    btn.classList.add('bg-white', 'text-[#3f73a3]');
                    if (btn.getAttribute('data-key') === key) {
                        btn.classList.remove('bg-white', 'text-[#3f73a3]');
                        btn.classList.add('bg-[#3f73a3]', 'text-white');
                    }
                });
            }

            // Afficher le contenu par défaut au chargement
            document.addEventListener('DOMContentLoaded', function() {
                showContent('promotion');
            });
        </script>
        
        <section class="bg-gradient-to-br from-[#fafbfc] to-[#eff6fd] px-2 sm:px-4 pb-16 sm:pb-24">
            <div class="max-w-screen-xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12 items-start">
                <!-- Bloc aide rapide -->
                <div class="flex flex-col justify-between space-y-8 self-start h-auto">
                    <div class="bg-white/90 border border-[#d1e7ef] rounded-2xl shadow-lg p-8 flex flex-col items-center justify-center text-center">
                        <svg class="w-14 h-14 mb-5 text-[#3C74A8] drop-shadow" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="9" stroke="#3C74A8" stroke-width="2" fill="#e6f2ff"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16h6" stroke="#437305" stroke-width="2"/>
                        </svg>
                        <h2 class="text-2xl sm:text-3xl font-extrabold mb-2 tracking-tight text-[#3C74A8]">Besoin d'une aide rapide ?</h2>
                        <p class="mb-6 text-base sm:text-lg text-[#437305] opacity-90">Notre équipe médicale vous répond gratuitement et en toute confidentialité.</p>
                        <a href="{{ route('contact') }}" class="inline-block bg-[#3C74A8] text-white font-semibold px-6 py-3 rounded-full shadow hover:bg-[#437305] transition-all duration-200">Contactez-nous</a>
                    </div>
                </div>

                <!-- Bloc central : valeurs, avantages, pourquoi nous choisir -->
                <div class="md:col-span-2 flex flex-col space-y-10 sm:space-y-14">
                    <!-- Bloc Intro -->
                    <div class="space-y-3 sm:space-y-6">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#3C74A8] text-center sm:text-left flex items-center gap-3">
                            <svg class="w-8 h-8 text-[#437305]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <circle cx="12" cy="12" r="8" stroke="#3C74A8" stroke-width="2" fill="#e6f2ff"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01" stroke="#437305"/>
                            </svg>
                            Pourquoi choisir notre expertise ?
                        </h2>
                        <p class="text-gray-700 text-base sm:text-lg leading-relaxed">
                            Notre engagement : offrir à chaque patient et partenaire un accompagnement humain, une expertise de pointe et une réactivité sans faille. Nous croyons que la santé est un droit fondamental et que chaque projet mérite une attention personnalisée, du conseil à la réalisation.
                        </p>
                    </div>

                    <!-- Valeurs -->
                    <div class="space-y-2 sm:space-y-4">
                        <h3 class="text-lg sm:text-xl md:text-2xl font-semibold text-[#437305] flex items-center gap-2">
                            <i class="fas fa-heartbeat text-[#3C74A8]"></i>
                            Nos valeurs
                        </h3>
                        <ul class="flex flex-wrap gap-4 sm:gap-6">
                            <li class="flex items-center bg-white border border-[#d1e7ef] rounded-lg shadow px-4 py-2 text-[#3C74A8] font-semibold text-sm sm:text-base">
                                <i class="fas fa-bolt text-[#437305] mr-2"></i> Réactivité
                            </li>
                            <li class="flex items-center bg-white border border-[#d1e7ef] rounded-lg shadow px-4 py-2 text-[#3C74A8] font-semibold text-sm sm:text-base">
                                <i class="fas fa-sync-alt text-[#437305] mr-2"></i> Adaptabilité
                            </li>
                            <li class="flex items-center bg-white border border-[#d1e7ef] rounded-lg shadow px-4 py-2 text-[#3C74A8] font-semibold text-sm sm:text-base">
                                <i class="fas fa-balance-scale text-[#437305] mr-2"></i> Rigueur
                            </li>
                            <li class="flex items-center bg-white border border-[#d1e7ef] rounded-lg shadow px-4 py-2 text-[#3C74A8] font-semibold text-sm sm:text-base">
                                <i class="fas fa-eye text-[#437305] mr-2"></i> Transparence
                            </li>
                        </ul>
                    </div>

                    <!-- Avantages -->
                    <div>
                        <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-[#3C74A8] mb-2 flex items-center gap-2">
                            <i class="fas fa-star text-[#437305]"></i>
                            Nos avantages
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex bg-white border border-[#d1e7ef] shadow rounded-xl overflow-hidden">
                                <div class="flex items-center justify-center bg-[#e6f2ff] w-20">
                                    <i class="fas fa-microscope text-[#3C74A8] text-2xl"></i>
                                </div>
                                <div class="p-4 flex flex-col justify-center">
                                    <h4 class="text-lg font-bold text-[#3C74A8]">Technologie de pointe</h4>
                                    <p class="text-sm text-[#6A6A6A]">Des équipements récents pour des diagnostics fiables et rapides.</p>
                                </div>
                            </div>
                            <div class="flex bg-white border border-[#d1e7ef] shadow rounded-xl overflow-hidden">
                                <div class="flex items-center justify-center bg-[#e6f2ff] w-20">
                                    <i class="fas fa-user-shield text-[#3C74A8] text-2xl"></i>
                                </div>
                                <div class="p-4 flex flex-col justify-center">
                                    <h4 class="text-lg font-bold text-[#3C74A8]">Fiabilité & sécurité</h4>
                                    <p class="text-sm text-[#6A6A6A]">Des procédures certifiées et une confidentialité totale de vos données.</p>
                                </div>
                            </div>
                            <div class="flex bg-white border border-[#d1e7ef] shadow rounded-xl overflow-hidden">
                                <div class="flex items-center justify-center bg-[#e6f2ff] w-20">
                                    <i class="fas fa-users text-[#3C74A8] text-2xl"></i>
                                </div>
                                <div class="p-4 flex flex-col justify-center">
                                    <h4 class="text-lg font-bold text-[#3C74A8]">Équipe pluridisciplinaire</h4>
                                    <p class="text-sm text-[#6A6A6A]">Des experts passionnés à votre écoute, pour chaque étape de votre projet.</p>
                                </div>
                            </div>
                            <div class="flex bg-white border border-[#d1e7ef] shadow rounded-xl overflow-hidden">
                                <div class="flex items-center justify-center bg-[#e6f2ff] w-20">
                                    <i class="fas fa-hand-holding-heart text-[#3C74A8] text-2xl"></i>
                                </div>
                                <div class="p-4 flex flex-col justify-center">
                                    <h4 class="text-lg font-bold text-[#3C74A8]">Accompagnement humain</h4>
                                    <p class="text-sm text-[#6A6A6A]">Un suivi personnalisé et bienveillant, centré sur vos besoins réels.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Engagements -->
                    <div>
                        <h3 class="text-lg sm:text-xl md:text-2xl text-[#437305] mt-4 mb-4 sm:mb-6 font-semibold flex items-center gap-2">
                            <i class="fas fa-handshake-angle text-[#3C74A8]"></i>
                            Nos engagements pour votre santé
                        </h3>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3">
                                <span class="bg-[#e6f2ff] p-2 rounded-full">
                                    <svg class="h-5 w-5 text-[#3C74A8]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </span>
                                <span class="text-base font-semibold text-[#3C74A8]">Conseils personnalisés et orientation claire</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="bg-[#e6f2ff] p-2 rounded-full">
                                    <svg class="h-5 w-5 text-[#3C74A8]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </span>
                                <span class="text-base font-semibold text-[#3C74A8]">Respect strict des normes internationales</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="bg-[#e6f2ff] p-2 rounded-full">
                                    <svg class="h-5 w-5 text-[#3C74A8]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </span>
                                <span class="text-base font-semibold text-[#3C74A8]">Transparence sur les tarifs et les délais</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="bg-[#e6f2ff] p-2 rounded-full">
                                    <svg class="h-5 w-5 text-[#3C74A8]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </span>
                                <span class="text-base font-semibold text-[#3C74A8]">Suivi continu et disponibilité 7j/7</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- FOOTER -->
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


