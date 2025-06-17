<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Accueil</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        <script src="{{ asset('js/main.js') }}"></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700&display=swap');
            body {
                font-family: 'Lexend', sans-serif;
            }
        </style>
    </head>

    <button id="scrollToTopBtn" onclick="scrollToTop()" 
        class="fixed bottom-6 right-6 w-12 h-12 bg-[#06788f] text-white text-xl flex items-center justify-center rounded-full shadow-lg hover:bg-[#055c6e] transition z-50 hidden" aria-label="Remonter en haut">↑
    </button>

    <body class="bg-white text-gray-800">
        <a href="connexion.php"></a>
        <header>
            <!-- Bandeau top -->
            <div id="Accueil" class="bg-gray-100 text-sm border-b border-gray-300 py-2">
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
                    <!-- Espace gauche vide sur desktop -->
                    <div class="hidden md:block w-1/4"></div>
                    <!-- Bloc central : téléphone + recherche -->
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
                    <!-- Réseaux sociaux : en dessous sur mobile, à droite sur desktop -->
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
            <!-- Bandeau Prestations & navbar -->
                <div class="relative z-0 qhero-prestations bg-cover bg-center h-[700px]" style="background-image: url('images/Page index/side-view-researcher-biotechnology-laboratory-with-plant-test-tube.jpg');">
                   
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

                <div class="absolute inset-0 flex flex-col gap-20 items-center justify-center text-white">
                    <h1 class="text-4xl md:text-5xl font-bold text-center">PHARMACOL, un réseau de <br> délégués médicaux sur le Togo, <br> le Bénin , le Niger</h1>
                    <a href="" class="bg-[#437305] p-4">Parlons de votre projet</a>
                </div>
            </div>
        </header>


        <!-- Contenu page index -->
        <section id ="À propos de nous" class="flex items-center justify-center relative mb-40">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-6xl mx-auto relative md:absolute md:top-[-100px] left-0 right-0">
                <div class="w-full md:w-[400px] h-[200px] bg-white flex flex-row py-8 px-6 md:px-10 gap-5 border-solid border-[1px] border-gray-200 mx-auto">
                    <img src="images/Page index/chemistry1.png" class="w-14 h-14" />
                    <div class="flex flex-col gap-5">
                        <div class="font-bold text-base md:text-[20px]">Derniers équipements</div>
                        <div class="font-extralight text-xs md:text-[14px]">There are inmny variations free passages of Lorem Ip available <br>inmny variations free </div>
                    </div>
                </div>

                <div class="w-full md:w-[400px] h-[200px] bg-[#437305] flex flex-row py-8 px-6 md:px-10 gap-5 text-white mx-auto">
                    <img src="images/Page index/research1.png" class="w-14 h-14" />
                    <div class="flex flex-col gap-5">
                        <div class="font-bold text-base md:text-[20px]">Recrutement des forces de ventes</div>
                        <div class="font-extralight text-xs md:text-[14px]">Le pilier de la stratégie d’implantation : une équipe professionnelle</div>
                    </div>
                </div>

                <div class="w-full md:w-[400px] h-[200px] bg-white flex flex-row py-8 px-6 md:px-10 gap-5 border-solid border-[1px] border-gray-200 mx-auto">
                    <img src="images/Page index/safe.png" class="w-14 h-14" />
                    <div class="flex flex-col gap-5">
                        <div class="font-bold text-base md:text-[20px]">Promotion Médicale</div>
                        <div class="font-extralight text-xs md:text-[14px]">Le merchandising et la formation des équipes officinales</div>
                    </div>
                </div>
            </div>

        </section>

        <!-- Section À propos -->
        <section class="flex flex-col lg:flex-row justify-center items-center gap-10 px-4 py-10 mb-16">
        
            <!-- Texte -->
            <div class="flex flex-col justify-start items-center w-full lg:w-[700px] gap-4 text-center">
                <div class="text-sm font-medium text-[#437305]">A PROPOS DE NOUS</div>
                <div class="text-3xl sm:text-4xl font-bold leading-snug">
                    Promotion de vos produits pharmaceutiques en Afrique de l'Ouest
                </div>
                <div class="text-base font-medium text-[#6A6A6A]">
                    Notre expertise au service de votre succès au Togo, Bénin et Niger
                </div>
                <div class=" px-2 text-sm sm:text-base text-justify sm:text-center text-[#6A6A6A]">
                    Créée en 1996, par Abel ACOLATSE, PHARMACOL est spécialisée dans la représentation pharmaceutique et la promotion médicale. Présente en Afrique de l'ouest : Togo, Bénin, Niger. Son siège est basé à Lomé au Togo.
                    <br><br>
                    PHARMACOL, votre levier de croissance : Obtention d'autorisation de mise sur le marché, Mise en place, Commercialisation, Développement de votre présence locale au Togo, au Bénin et au Niger.
                </div>
        
            <!-- Bloc satisfaction -->
            <div class="flex flex-row items-start gap-4 mt-4">
                <img src="images/Page index/vector.png" alt="" class="w-14 h-14">
                <div class="flex flex-col gap-1">
                <div class="text-lg font-bold">Satisfaction à 100 % Précision</div>
                <div class="text-sm text-[#6A6A6A] font-medium">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                </div>
                </div>
            </div>
        
            <!-- Bouton -->
            <a href="#" class="bg-[#437305] hover:bg-[#365c04] transition px-8 py-3 text-white text-sm w-fit mt-6">
                Télécharger notre plaquette
            </a>
            </div>
        
            <!-- Image et encarts -->
            <div class="relative w-full lg:w-auto">
            <!-- Image principale -->
            <img src="images/Page index/image3.png" class="w-full max-w-[650px] h-auto object-cover" alt="À propos">
        
            <!-- Encart vert - Années d'expérience -->
            <div class="absolute bottom-0 right-4 sm:right-20 bg-[#437305] w-[180px] h-[100px] sm:w-[250px] sm:h-[250px] text-white flex flex-col items-center justify-center px-4 sm:px-6 gap-2 sm:gap-4 overflow-hidden shadow-lg">
                <img src="images/Page index/vector2.png" alt="" class="absolute w-full h-full object-cover opacity-20">
                <div class="relative z-10 text-2xl sm:text-5xl font-bold">+25</div>
                <div class="relative z-10 text-xs sm:text-lg font-bold text-center">Années d’Expérience</div>
            </div>
        
            <!-- Encart contact -->
            <div class="absolute -bottom-16 left-1/2 -translate-x-[105%] -translate-y-[130%] sm:translate-x-0 sm:translate-y-0 sm:bottom-0 sm:left-[10px] bg-[#437305] w-[180px] h-[50px] sm:w-[310px] sm:h-[80px] text-white flex items-center gap-2 sm:gap-4 px-3 sm:px-6 shadow-lg">
                <img src="images/Page index/chat.png" alt="Chat" class="w-7 h-7 sm:w-10 sm:h-10">
                <div>
                    <div class="text-xs sm:text-sm font-medium">Appel aux questions</div>
                    <div class="text-base sm:text-xl font-bold">+92 3800 8060</div>
                </div>
            </div>
            </div>
        
        </section>

        <div class="flex flex-col justify-center text-center gap-8">
            <div class="flex flex-row justify-center gap-2 items-center">
                <img src="images/Page prestations 1/adn.png" alt="adn" class="w-10 h-10 md:w-12 md:h-12">
                <div class="text-green-600 uppercase tracking-widest text-lg sm:text-xl md:text-2xl lg:text-[32px] font-medium">
                    Nos services
                </div>
            </div>
            <div class="text-2xl sm:text-3xl md:text-4xl lg:text-[40px] font-bold text-[#3C74A8]">
                Notre expertise et savoir- <br> faire a votre disposition
            </div>
        </div>

        <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 py-8 px-4 md:px-[10%] gap-6">

            <a href="" class="flex flex-col gap-4 bg-white rounded-lg shadow-md p-5 hover:bg-[#437305] hover:cursor-pointer hover:text-white transition-all duration-500">
                <img src="images/Page index/1v.png" alt="img" class="w-20 h-20 md:w-24 md:h-24 mx-auto">
                <div class="font-bold text-lg md:text-2xl text-center">Promotion médicale Parapharmaceutique</div>
                <div class="font-normal text-sm md:text-base text-center">Phasellus neque nibh, cursus<br>ullamcorper at.</div>
            </a>
            <a href="" class="flex flex-col gap-4 bg-white rounded-lg shadow-md p-5 hover:bg-[#437305] hover:cursor-pointer hover:text-white transition-all duration-500">
                <img src="images/Page index/2b.png" alt="img" class="w-20 h-20 md:w-24 md:h-24 mx-auto">
                <div class="font-bold text-lg md:text-2xl text-center">Recrutement Encadrement de la force de vente</div>
                <div class="font-normal text-sm md:text-base text-center">Phasellus neque nibh, cursus<br>ullamcorper at.</div>
            </a>
            <a href="" class="flex flex-col gap-4 bg-white rounded-lg shadow-md p-5 hover:bg-[#437305] hover:cursor-pointer hover:text-white transition-all duration-500">
                <img src="images/Page index/3v.png" alt="img" class="w-20 h-20 md:w-24 md:h-24 mx-auto">
                <div class="font-bold text-lg md:text-2xl text-center">Représentation pharmaceutique</div>
                <div class="font-normal text-sm md:text-base text-center">Phasellus neque nibh, cursus<br>ullamcorper at.</div>
            </a>
            <a href="" class="flex flex-col gap-4 bg-white rounded-lg shadow-md p-5 hover:bg-[#437305] hover:cursor-pointer hover:text-white transition-all duration-500">
                <img src="images/Page index/4v.png" alt="img" class="w-20 h-20 md:w-24 md:h-24 mx-auto">
                <div class="font-bold text-lg md:text-2xl text-center">Règlementation, autorisation de mise sur le marché</div>
                <div class="font-normal text-sm md:text-base text-center">Phasellus neque nibh, cursus<br>ullamcorper at.</div>
            </a>
            <a href="" class="flex flex-col gap-4 bg-white rounded-lg shadow-md p-5 hover:bg-[#437305] hover:cursor-pointer hover:text-white transition-all duration-500">
                <img src="images/Page index/5v.png" alt="img" class="w-20 h-20 md:w-24 md:h-24 mx-auto">
                <div class="font-bold text-lg md:text-2xl text-center">Marketing Communication</div>
                <div class="font-normal text-sm md:text-base text-center">Phasellus neque nibh, cursus<br>ullamcorper at.</div>
            </a>
            <a href="" class="flex flex-col gap-4 bg-white rounded-lg shadow-md p-5 hover:bg-[#437305] hover:cursor-pointer hover:text-white transition-all duration-500">
                <img src="images/Page index/6v.png" alt="img" class="w-20 h-20 md:w-24 md:h-24 mx-auto">
                <div class="font-bold text-lg md:text-2xl text-center">Etude de faisabilité Consulting</div>
                <div class="font-normal text-sm md:text-base text-center">Phasellus neque nibh, cursus<br>ullamcorper at.</div>
            </a>
            <a href="" class="flex flex-col gap-4 bg-white rounded-lg shadow-md p-5 hover:bg-[#437305] hover:cursor-pointer hover:text-white transition-all duration-500">
                <img src="images/Page index/7v.png" alt="img" class="w-20 h-20 md:w-24 md:h-24 mx-auto">
                <div class="font-bold text-lg md:text-2xl text-center">Reporting Pharmacovigilance</div>
                <div class="font-normal text-sm md:text-base text-center">Phasellus neque nibh, cursus<br>ullamcorper at.</div>
            </a>
            <a href="" class="flex flex-col gap-4 bg-white rounded-lg shadow-md p-5 hover:bg-[#437305] hover:cursor-pointer hover:text-white transition-all duration-500">
                <img src="images/Page index/8v.png" alt="img" class="w-20 h-20 md:w-24 md:h-24 mx-auto">
                <div class="font-bold text-lg md:text-2xl text-center">Veille concurentielle</div>
                <div class="font-normal text-sm md:text-base text-center">Phasellus neque nibh, cursus<br>ullamcorper at.</div>
            </a>
        </div>

        <div class="flex flex-col justify-center text-center gap-10 mt-10">
            <div class="flex flex-row justify-center gap-2 items-center">
                <img src="images/Page prestations 1/adn.png" alt="adn" class="w-10 h-10 md:w-12 md:h-12">
                <div class="text-green-600 uppercase tracking-widest text-lg sm:text-xl md:text-2xl lg:text-[32px] font-medium">
                    Notre processus de travail
                </div>
            </div>
            <div class="text-2xl sm:text-3xl md:text-4xl lg:text-[40px] font-bold text-[#3C74A8]">
                Une approche structurée pour des <br> résultats optimaux
            </div>
        </div>

        <!-- Processus de travail -->
        <div class="relative flex flex-col md:flex-row justify-center mb-20 md:mb-40 gap-6 md:gap-3 mt-10 md:mt-16 px-4">
            <!-- Traits horizontaux entre les étapes (uniquement sur desktop) -->
            <div class="hidden md:block absolute left-0 top-[15%] w-full h-0 pointer-events-none z-0">
                <div class="flex w-full h-0">
                    <div class="flex-1"></div>
                    <div class="flex-1 border-t-2 border-[#DBDBDB]"></div>
                    <div class="flex-1 border-t-2 border-[#DBDBDB]"></div>
                    <div class="flex-1 border-t-2 border-[#DBDBDB]"></div>
                    <div class="flex-1"></div>
                </div>
            </div>
            <!-- Étape 1 -->
            <div class="flex flex-col gap-4 md:gap-6 w-full md:w-[20%] z-10">
                <div class="relative self-center mb-2 bg-white rounded-full">
                    <img src="images/hexagon.png" alt="Étape 1" class="w-20 h-20 md:w-24 md:h-24 mb-2 md:mb-4" />
                    <div class="text-white absolute top-[22px] md:top-[30px] left-[28px] md:left-[35px] font-bold text-lg md:text-[24px]">01</div>
                </div>
                <div class="flex flex-col gap-4 md:gap-16 pb-4 md:pb-10 p-4 md:p-5 md:pl-16 border-l border-gray-200 bg-white rounded-lg shadow-sm">
                    <h4 class="font-bold text-base md:text-[20px]">Brief et Projet Clients</h4>
                    <p class="text-sm text-gray-600">Analyse approfondie des besoins pour une stratégie personnalisée</p>
                </div>
            </div>
            <!-- Étape 2 -->
            <div class="flex flex-col gap-4 md:gap-6 w-full md:w-[20%] z-10">
                <div class="relative self-center mb-2 bg-white rounded-full">
                    <img src="images/hexagon.png" alt="Étape 2" class="w-20 h-20 md:w-24 md:h-24 mb-2 md:mb-4" />
                    <div class="text-white absolute top-[22px] md:top-[30px] left-[28px] md:left-[35px] font-bold text-lg md:text-[24px]">02</div>
                </div>
                <div class="flex flex-col gap-4 md:gap-16 pb-4 md:pb-10 p-4 md:p-5 md:pl-16 border-l border-gray-200 bg-white rounded-lg shadow-sm">
                    <h4 class="font-bold text-base md:text-[20px]">Le laboratoire élabore une proposition</h4>
                    <p class="text-sm text-gray-600">Conception de solutions innovantes adaptées à vos objectifs spécifiques</p>
                </div>
            </div>
            <!-- Étape 3 -->
            <div class="flex flex-col gap-4 md:gap-6 w-full md:w-[20%] z-10">
                <div class="relative self-center mb-2 bg-white rounded-full">
                    <img src="images/hexagon.png" alt="Étape 3" class="w-20 h-20 md:w-24 md:h-24 mb-2 md:mb-4" />
                    <div class="text-white absolute top-[22px] md:top-[30px] left-[28px] md:left-[35px] font-bold text-lg md:text-[24px]">03</div>
                </div>
                <div class="flex flex-col gap-4 md:gap-16 pb-4 md:pb-10 p-4 md:p-5 md:pl-16 border-l border-gray-200 bg-white rounded-lg shadow-sm">
                    <h4 class="font-bold text-base md:text-[20px]">Tests Début des tests</h4>
                    <p class="text-sm text-gray-600">Lancement et évaluation pour garantir la performance optimale</p>
                </div>
            </div>
            <!-- Étape 4 -->
            <div class="flex flex-col gap-4 md:gap-6 w-full md:w-[20%] z-10">
                <div class="relative self-center mb-2 bg-white rounded-full">
                    <img src="images/hexagon.png" alt="Étape 4" class="w-20 h-20 md:w-24 md:h-24 mb-2 md:mb-4" />
                    <div class="text-white absolute top-[22px] md:top-[30px] left-[28px] md:left-[35px] font-bold text-lg md:text-[24px]">04</div>
                </div>
                <div class="flex flex-col gap-4 md:gap-16 pb-4 md:pb-10 p-4 md:p-5 md:pl-16 border-l border-gray-200 bg-white rounded-lg shadow-sm">
                    <h4 class="font-bold text-base md:text-[20px]">Rapports livrés</h4>
                    <p class="text-sm text-gray-600">Présentation de résultats détaillés pour une prise de décision éclairée</p>
                </div>
            </div>
        </div>


        <!-- Section avec fond image et grid centrée -->
        <section class="w-full h-screen bg-cover bg-center relative" style="background-image: url('images/Page index/portrait-female-pharmacist-working-drugstore.jpg');">
        
            <!-- Overlay (optionnel pour foncer un peu l’image de fond) -->
            <div class="absolute inset-0 bg-black/40"></div>
        
            <!-- Contenu centré -->
            <div class="relative z-10 flex items-center justify-center h-full">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-10">
                    <!-- Élément 1 -->
                    <div class="flex flex-col items-center justify-center text-white gap-2">
                        <img src="images/Page index/10.png" class="w-16 h-16 mb-4" alt="Icone 1">
                        <div class="text-3xl font-bold">3</div>
                        <div class="text-sm text-center">Pays</div>
                    </div>
            
                    <!-- Élément 2 -->
                    <div class="flex flex-col items-center justify-center text-white gap-2">
                        <img src="images/Page index/11.png" class="w-16 h-16 mb-4" alt="Icone 2">
                        <div class="text-3xl font-bold">64</div>
                        <div class="text-sm text-center">Délégués terrains</div>
                    </div>
            
                    <!-- Élément 3 -->
                    <div class="flex flex-col items-center justify-center text-white gap-2">
                        <img src="images/Page index/12.png" class="w-16 h-16 mb-4" alt="Icone 3">
                        <div class="text-3xl font-bold">14</div>
                        <div class="text-sm text-center">Laboratoires partenaires</div>
                    </div>
            
                    <!-- Élément 4 -->
                    <div class="flex flex-col items-center justify-center text-white gap-2">
                        <img src="images/Page index/13.png" class="w-16 h-16 mb-4" alt="Icone 4">
                        <div class="text-3xl font-bold">+25</div>
                        <div class="text-sm text-center">Années d’expérience</div>
                    </div>
                </div>
            </div>
        
        </section>

        <!-- Section Pourquoi nous choisir -->
        <section class="flex flex-col md:flex-row items-center justify-center px-4 md:px-10 py-10 md:py-20 gap-6 md:gap-10 bg-white">
            <img class="w-full max-w-xs md:max-w-none md:w-1/3 h-48 md:h-auto rounded-xl object-cover mb-6 md:mb-0" src="images/Page index/medical-doctor-girl-working-with-microscope-young-female-scientist-doing-vaccine-research.jpg" alt="Pourquoi nous choisir" />

            <!-- Colonne droite -->
            <div class="w-full md:w-1/2 grid grid-rows-[auto_auto_auto_auto_auto_auto_auto_auto] gap-4">
                <!-- Ligne 1 : Titre -->
                <div class="text-[#437305] font-semibold uppercase text-xs md:text-sm tracking-wide">Pourquoi nous choisir</div>
                <!-- Ligne 2 : Sous-titre -->
                <div class="text-[#6A6A6A] text-xs md:text-[14px]">une maîtrise parfaite de l’écosystème sanitaire et de la réglementation pharmaceutique au Togo, Bénin, Niger</div>
                <!-- Colonne gauche : Icône + "Nos valeurs" -->
                <div class="bg-[#437305] text-white flex flex-row gap-4 md:gap-6 justify-center items-center p-4 md:p-8 rounded">
                    <img src="images/Page index/14.png" alt="Valeurs" class="w-10 h-10 md:w-16 md:h-16">
                    <div class="flex flex-col gap-2 md:gap-4 p-2 md:p-4">
                        <div class="text-lg md:text-xl font-bold">Nos valeurs</div>
                        <div class="text-xs md:text-[14px]">réactivité, adaptabilité, rigueur et transparence font partie intégrantes de notre leitmotiv</div>
                    </div>
                </div>
                <!-- Ligne 1 -->
                <div class="flex items-start gap-2">
                    <img src="images/Page index/tick.png" alt="Check" class="w-4 h-4 md:w-5 md:h-5 mt-1">
                    <div class="text-xs md:text-[14px] text-[#6A6A6A]">La pérennité de Pharmacol 25 ans d’expertise et de présence terrain</div>
                </div>
                <!-- Ligne 2 -->
                <div class="flex items-start gap-2">
                    <img src="images/Page index/tick.png" alt="Check" class="w-4 h-4 md:w-5 md:h-5 mt-1">
                    <div class="text-xs md:text-[14px] text-[#6A6A6A]">Une force de vente composée de 64 délégués médicaux compétents et expérimentés</div>
                </div>
                <!-- Ligne 4 -->
                <div class="flex items-start gap-2">
                    <img src="images/Page index/tick.png" alt="Check" class="w-4 h-4 md:w-5 md:h-5 mt-1">
                    <div class="text-xs md:text-[14px] text-[#6A6A6A]">Des moyens et outils d’aide à la vente de dernière génération</div>
                </div>
                <!-- Ligne 5 -->
                <div class="flex items-start gap-2">
                    <img src="images/Page index/tick.png" alt="Check" class="w-4 h-4 md:w-5 md:h-5 mt-1">
                    <div class="text-xs md:text-[14px] text-[#6A6A6A]">Une maîtrise parfaite du réseau des structures sanitaires et pharmaceutiques sur chaque zone géographique en charge</div>
                </div>
                <!-- Ligne 8 : 3 boutons côte à côte -->
                <div class="flex flex-col sm:flex-row gap-2 md:gap-4 mt-4">
                    <a href="{{ route('accueil.togo') }}" class="bg-[#437305] text-white px-6 py-2 md:px-10 md:py-4 text-xs md:text-sm font-semibold rounded text-center">Togo</a>
                    <a href="{{ route('accueil.benin') }}" class="bg-[#437305] text-white px-6 py-2 md:px-10 md:py-4 text-xs md:text-sm font-semibold rounded text-center">Bénin</a>
                    <a href="{{ route('accueil.niger') }}" class="bg-[#437305] text-white px-6 py-2 md:px-10 md:py-4 text-xs md:text-sm font-semibold rounded text-center">Niger</a>
                </div>
            </div>
        </section>
          
  

        <!-- Section bleue principale -->
        <section class="bg-[#31689B] text-white py-10 md:py-16 px-4 md:px-8 ">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center flex-wrap gap-6">
                <!-- Texte principal -->
                <div class="max-w-4xl mb-6 md:mb-0">
                    <div class="text-xs md:text-sm tracking-widest uppercase mb-2 md:mb-4">Intégrer Pharmacol</div>
                    <h2 class="text-xl md:text-3xl lg:text-4xl font-bold leading-snug">
                        Vous souhaitez assurer l’information médicale et promouvoir les produits pharmaceutiques et leur bon usage dans le respect de l’éthique auprès des professionnels de santé de votre zone géographique
                    </h2>
                </div>
                <!-- Bouton -->
                <div class="self-start">
                    <a href="{{ route('recrutement') }}" class="bg-white text-[#31689B] px-4 py-2 md:px-6 md:py-3 font-semibold shadow-md hover:bg-gray-100 transition rounded">
                        Nous rejoindre
                    </a>
                </div>
            </div>
        </section>

        <!-- Section des cartes (non verticales ici) -->
        <div class="bg-white py-12 px-4 md:px-8">
            <div class="w-full max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 relative">
                <!-- Card 1 -->
                <a href="{{ route('recrutement') }}" class="bg-white shadow-md p-6 flex-1 border border-gray-200 relative w-full mb-8 md:mb-0">
                    <div class="w-16 h-16 md:w-20 md:h-20 absolute -top-8 left-6">
                        <img src="images/Page index/icon1.png" alt="Délégués" class="w-full h-full object-contain" />
                    </div>
                    <h3 class="text-lg md:text-xl font-semibold mb-2 text-[#31689B] pt-10 md:pt-12">Des délégués de terrains</h3>
                    <p class="text-gray-600 text-xs md:text-sm">
                        There are many variations of passages of lorem ipsum available, but the majority have suffered alteration some form, by injected humour, or randomised
                    </p>
                </a>
                <!-- Card 2 -->
                <a href="{{ route('recrutement') }}" class="bg-white shadow-md p-6 flex-1 border border-gray-200 relative w-full">
                    <div class="w-16 h-16 md:w-20 md:h-20 absolute -top-8 left-6">
                        <img src="images/Page index/icon2.png" alt="Assistants" class="w-full h-full object-contain" />
                    </div>
                    <h3 class="text-lg md:text-xl font-semibold mb-2 text-[#31689B] pt-10 md:pt-12">Des assistants médicaux</h3>
                    <p class="text-gray-600 text-xs md:text-sm">
                        There are many variations of passages of lorem ipsum available, but the majority have suffered alteration some form, by injected humour, or randomised
                    </p>
                </a>
            </div>
        </div>




        <!-- Section blog -->
        <section class="py-20 flex flex-col items-center" id="blog-home">


        </section>



        <!-- partenaire -->
        <section class="bg-white py-20 px-4">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-2xl md:text-4xl font-bold text-center text-blue-400 mb-8 md:mb-12">Nos partenaires</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 mt-10 mb-20 md:mb-40 place-items-center">
                    <img src="images/Page index/Crosspharm_logo.png" alt="Crosspharm" class="h-20 md:h-32 w-auto" />
                    <img src="images/Page index/ferrer_logo.png" alt="Ferrer" class="h-20 md:h-32 w-auto" />
                    <img src="images/Page index/salvat_logo.png" alt="Salvat" class="h-20 md:h-32 w-auto" />
                </div>
            </div>
        </section>


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


