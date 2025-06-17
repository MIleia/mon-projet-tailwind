{{-- filepath: backend/resources/views/admin/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Dashboard Admin</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700&display=swap');
            body { font-family: 'Lexend', sans-serif; }
            .selected-section { background: linear-gradient(90deg, #e0e7ff 80%, #fff 100%); color: #3730a3; }
            .sidebar-shadow { box-shadow: 2px 0 16px 0 rgba(60, 116, 168, 0.10); }
            .sidebar-link { transition: background 0.2s, color 0.2s; }
            .sidebar-link i { min-width: 1.5rem; }
            .sidebar-link.selected-section { font-weight: 600; }
            .logout-btn { font-weight: 600; }
            .card { box-shadow: 0 2px 16px 0 rgba(60, 116, 168, 0.07); border-radius: 1rem; }
            .table-row-hover:hover { background: #f1f5f9; }
            @media (max-width: 900px) {
                aside { position: fixed; left: -100vw; transition: left 0.3s; }
                aside.open { left: 0; }
                main { margin-left: 0 !important; }
            }
        </style>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body class="bg-[#f7fafc]">
        <!-- Sidebar -->
        <div class="flex">
            <aside id="sidebar" class="sidebar-shadow fixed top-0 left-0 h-screen w-[18rem] bg-white text-gray-700 p-4 z-50 flex flex-col border-r border-gray-200 shadow-r transition-all duration-300">
                <div class="flex flex-col items-center mb-6">
                    <img src="{{ asset('images/Page prestations 2/logo-350100.png') }}" alt="Logo Pharmacol" class="h-16 mb-2">
                    <span class="text-lg font-bold text-[#3C74A8] tracking-wide">Admin</span>
                </div>
                <nav class="flex flex-col gap-1 min-w-[200px] p-2 text-base text-gray-700 flex-1">
                    <button type="button" onclick="showSection('blog')" class="sidebar-link flex items-center w-full p-3 rounded-lg hover:bg-blue-50 hover:text-blue-900 transition">
                        <i class="fas fa-blog mr-3"></i> Blog
                    </button>
                    <button type="button" onclick="showSection('recrutement')" class="sidebar-link flex items-center w-full p-3 rounded-lg hover:bg-blue-50 hover:text-blue-900 transition">
                        <i class="fas fa-briefcase mr-3"></i> Suivi recrutement
                    </button>
                    <button type="button" onclick="showSection('newsletter')" class="sidebar-link flex items-center w-full p-3 rounded-lg hover:bg-blue-50 hover:text-blue-900 transition">
                        <i class="fas fa-envelope-open-text mr-3"></i> Newsletter
                    </button>
                    <button type="button" onclick="showSection('entreprises')" class="sidebar-link flex items-center w-full p-3 rounded-lg hover:bg-blue-50 hover:text-blue-900 transition">
                        <i class="fas fa-building mr-3"></i> Entreprises
                    </button>
                    @if(session('role') === 'admin')
                    <button type="button" onclick="showSection('utilisateurs')" class="sidebar-link flex items-center w-full p-3 rounded-lg hover:bg-blue-50 hover:text-blue-900 transition">
                        <i class="fas fa-users mr-3"></i> Utilisateurs
                    </button>
                    @endif
                    <div class="flex-1"></div>
                    <a href="{{ route('admin.logout') }}"
                    class="logout-btn flex items-center w-full p-3 rounded-lg bg-red-600 text-white hover:bg-red-700 transition mt-4 mb-2 justify-center">
                        <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
                    </a>
                </nav>
            </aside>
            <!-- Burger menu for mobile -->
            <button id="burger" class="fixed top-4 left-4 z-50 bg-white border border-gray-300 rounded-lg p-2 shadow md:hidden">
                <i class="fas fa-bars text-2xl text-[#3C74A8]"></i>
            </button>

            <!-- Main content -->
            <main class="ml-[18rem] w-full p-6 flex flex-col transition-all duration-300">
                <h1 class="text-3xl font-bold text-[#3C74A8] mb-8">Tableau de bord</h1>

                <!-- Section Blog -->
                <section id="blog" class="section-content hidden">
                    <div class="card bg-white p-6 mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-2xl font-semibold text-[#437305]">Articles du blog</h2>
                            <a href="{{ route('admin.blog.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                                <i class="fas fa-plus mr-2"></i> Ajouter un article
                            </a>
                        </div>
                        <div class="overflow-x-auto">
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
                                    @foreach($blogs as $blog)
                                    <tr class="bg-white border-b table-row-hover">
                                        <td class="px-4 py-2">
                                            @if($blog->image)
                                                <img src="{{ asset($blog->image) }}" alt="Image de l'article" class="w-16 h-16 object-cover rounded">
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 font-semibold">{{ $blog->titre }}</td>
                                        <td class="px-4 py-2 text-gray-600">{{ Str::limit(strip_tags($blog->texte), 80) }}</td>
                                        <td class="px-4 py-2">{{ $blog->date }}</td>
                                        <td class="px-4 py-2">
                                            <span class="inline-block px-2 py-1 rounded text-xs
                                                {{ $blog->etat === 'en ligne' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                                                {{ $blog->etat }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2 space-x-2 flex gap-2">
                                            <a href="{{ route('admin.blog.edit', $blog->id) }}" class="text-blue-600 hover:underline">Modifier</a>
                                            <form method="POST" action="{{ route('admin.blog.destroy', $blog->id) }}" onsubmit="return confirm('Supprimer cet article ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <!-- Section Recrutement -->
                <section id="recrutement" class="section-content hidden">
                    <div class="card bg-white p-6 mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-2xl font-semibold text-[#437305]">Postes à pourvoir</h2>
                            <a href="{{ route('admin.poste.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                                <i class="fas fa-plus mr-2"></i> Ajouter un poste
                            </a>
                        </div>
                        <div class="overflow-x-auto">
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
                                    @foreach($postes as $poste)
                                    <tr class="bg-white border-b table-row-hover">
                                        <td class="px-4 py-2 font-semibold">{{ $poste->titre }}</td>
                                        <td class="px-4 py-2 text-gray-600">{{ Str::limit(strip_tags($poste->descriptif), 80) }}</td>
                                        <td class="px-4 py-2">{{ $poste->localisation }}</td>
                                        <td class="px-4 py-2 space-x-2 flex gap-2">
                                            <a href="{{ route('admin.poste.edit', $poste->id) }}" class="text-blue-600 hover:underline">Modifier</a>
                                            <form method="POST" action="{{ route('admin.poste.destroy', $poste->id) }}" onsubmit="return confirm('Supprimer ce poste ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <!-- Section Newsletter -->
                <section id="newsletter" class="section-content hidden">
                    <div class="card bg-white p-6 mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-2xl font-semibold text-[#437305]">Newsletter</h2>
                            <a href="{{ route('admin.newsletter.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                                <i class="fas fa-plus mr-2"></i> Ajouter
                            </a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto">
                                <thead class="bg-gray-800 text-gray-300">
                                    <tr>
                                        <th class="px-6 py-3 text-left">Email</th>
                                        <th class="px-6 py-3 text-left">Prénom</th>
                                        <th class="px-6 py-3 text-left">Nom</th>
                                        <th class="px-6 py-3 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-200">
                                    @foreach($newsletters as $newsletter)
                                        <tr class="bg-white border-b border-gray-300 table-row-hover">
                                            <td class="px-6 py-3">{{ $newsletter->mail }}</td>
                                            <td class="px-6 py-3">{{ $newsletter->prenom }}</td>
                                            <td class="px-6 py-3">{{ $newsletter->nom }}</td>
                                            <td class="px-6 py-3 text-center flex gap-2 justify-center">
                                                <a href="{{ route('admin.newsletter.edit', $newsletter->mail) }}" class="text-blue-600 hover:underline">Modifier</a>
                                                <form method="POST" action="{{ route('admin.newsletter.destroy', $newsletter->mail) }}" onsubmit="return confirm('Supprimer cette newsletter ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <!-- Section Entreprises -->
                <section id="entreprises" class="section-content hidden">
                    <div class="card bg-white p-6 mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-2xl font-semibold text-[#437305]">Entreprises</h2>
                            <a href="{{ route('admin.entreprise.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                                <i class="fas fa-plus mr-2"></i> Ajouter une entreprise
                            </a>
                        </div>
                        <div class="flex flex-col gap-6">
                            @foreach(['Niger', 'Bénin', 'Togo'] as $pays)
                            <div>
                                <h3 class="text-xl font-bold mb-2">{{ $pays }}</h3>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full table-auto mb-4">
                                        <thead>
                                            <tr class="bg-gray-800 text-gray-300">
                                                <th class="px-4 py-2">Nom</th>
                                                <th class="px-4 py-2">Ville</th>
                                                <th class="px-4 py-2">Coordonnées</th>
                                                <th class="px-4 py-2">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($entreprises->where('pays', $pays) as $entreprise)
                                            <tr class="bg-white border-b table-row-hover">
                                                <td class="px-4 py-2">{{ $entreprise->nom }}</td>
                                                <td class="px-4 py-2">{{ $entreprise->ville }}</td>
                                                <td class="px-4 py-2 text-xs">
                                                    <span>Lon: {{ $entreprise->longitude }}</span><br>
                                                    <span>Lat: {{ $entreprise->latitude }}</span>
                                                </td>
                                                <td class="px-4 py-2 flex gap-2">
                                                    <a href="{{ route('admin.entreprise.edit', $entreprise->id) }}" class="text-blue-600 hover:underline">Modifier</a>
                                                    <form method="POST" action="{{ route('admin.entreprise.destroy', $entreprise->id) }}" onsubmit="return confirm('Supprimer cette entreprise ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-8">
                            <h3 class="text-xl font-bold mb-4 text-center">Carte des entreprises</h3>
                            <div id="map-entreprises" style="height: 400px; border-radius: 1rem; overflow: hidden;"></div>
                        </div>
                    </div>
                </section>

                <!-- Section Utilisateurs (admin uniquement) -->
                @if(session('role') === 'admin')
                <section id="utilisateurs" class="section-content hidden">
                    <div class="card bg-white p-6 mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-2xl font-semibold text-[#437305]">Utilisateurs</h2>
                            <form method="POST" action="{{ route('admin.utilisateur.store') }}" class="flex gap-2 items-end">
                                @csrf
                                <div>
                                    <label class="block text-xs">Email</label>
                                    <input type="email" name="mail" class="border rounded p-1" required>
                                </div>
                                <div>
                                    <label class="block text-xs">Mot de passe</label>
                                    <input type="password" name="mot_de_passe" class="border rounded p-1" required>
                                </div>
                                <div>
                                    <label class="block text-xs">Rôle</label>
                                    <select name="role" class="border rounded p-1" required>
                                        <option value="user">user</option>
                                        <option value="admin">admin</option>
                                    </select>
                                </div>
                                <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">Créer</button>
                            </form>
                        </div>
                        @if($errors->any())
                            <div class="bg-red-100 text-red-700 p-2 rounded mb-2">
                                <ul class="list-disc pl-5">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto">
                                <thead class="bg-gray-800 text-gray-300">
                                    <tr>
                                        <th class="px-4 py-2">Email</th>
                                        <th class="px-4 py-2">Rôle</th>
                                        <th class="px-4 py-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($utilisateurs as $user)
                                    <tr class="bg-white border-b table-row-hover">
                                        <td class="px-4 py-2">{{ $user->mail }}</td>
                                        <td class="px-4 py-2">
                                            <select class="border rounded p-1 user-role-select" data-mail="{{ $user->mail }}" @if(session('admin') === $user->mail) disabled @endif>
                                                <option value="user" @if($user->role === 'user') selected @endif>user</option>
                                                <option value="admin" @if($user->role === 'admin') selected @endif>admin</option>
                                            </select>
                                        </td>
                                        <td class="px-4 py-2">
                                            @if(session('admin') !== $user->mail)
                                            <form method="POST" action="{{ route('admin.utilisateur.destroy', $user->mail) }}" onsubmit="return confirm('Supprimer cet utilisateur ?')" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                            </form>
                                            @else
                                            <span class="text-gray-400 text-xs">(Vous)</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                @endif

            </main>
        </div>
        <script>
        function showSection(sectionId) {
            document.querySelectorAll('.section-content').forEach(sec => sec.classList.add('hidden'));
            document.getElementById(sectionId).classList.remove('hidden');
            // Style sélectionné
            document.querySelectorAll('.sidebar-link').forEach(btn => btn.classList.remove('selected-section'));
            const activeBtn = Array.from(document.querySelectorAll('.sidebar-link')).find(btn => {
                const onclickAttr = btn.getAttribute('onclick');
                return onclickAttr && onclickAttr.includes(`'${sectionId}'`);
            });
            if (activeBtn) activeBtn.classList.add('selected-section');
        }
        // Affiche la section selon le hash de l'URL
        document.addEventListener('DOMContentLoaded', () => {
            const hash = window.location.hash.replace('#', '');
            if (hash && document.getElementById(hash)) {
                showSection(hash);
            } else {
                showSection('blog');
            }
        });

        // Affiche la première section par défaut
        document.addEventListener('DOMContentLoaded', () => showSection('blog'));

        // Burger menu mobile
        const burger = document.getElementById('burger');
        const sidebar = document.getElementById('sidebar');
        if (burger && sidebar) {
            burger.addEventListener('click', () => {
                sidebar.classList.toggle('open');
            });
            // Fermer le menu si on clique en dehors sur mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth < 900 && !sidebar.contains(e.target) && !burger.contains(e.target)) {
                    sidebar.classList.remove('open');
                }
            });
        }

        // Changement de rôle AJAX
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.user-role-select').forEach(function(select) {
                select.addEventListener('change', function() {
                    const mail = this.dataset.mail;
                    const role = this.value;
                    fetch(`/admin/utilisateur/${encodeURIComponent(mail)}/role`, {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({role})
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            this.classList.add('bg-green-100');
                            setTimeout(() => this.classList.remove('bg-green-100'), 800);
                        }
                    });
                });
            });
        });

        // Changement d'état Blog AJAX
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.blog-etat-select').forEach(function(select) {
                select.addEventListener('change', function() {
                    const id = this.dataset.id;
                    const etat = this.value;
                    fetch(`/admin/blog/${encodeURIComponent(id)}/etat`, {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({etat})
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            this.classList.add('bg-green-100');
                            setTimeout(() => this.classList.remove('bg-green-100'), 800);
                        }
                    });
                });
            });
        });

        // Carte Leaflet des entreprises
        document.addEventListener('DOMContentLoaded', function() {
            if(document.getElementById('map-entreprises')) {
                var map = L.map('map-entreprises').setView([9.5, 2.5], 6);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                @foreach($entreprises as $e)
                    L.marker([{{ $e->latitude }}, {{ $e->longitude }}])
                        .addTo(map)
                        .bindPopup('<b>{{ addslashes($e->nom) }}</b><br>{{ addslashes($e->ville) }}<br>{{ addslashes($e->pays) }}');
                @endforeach
            }
        });
        </script>
    </body>
</html>


