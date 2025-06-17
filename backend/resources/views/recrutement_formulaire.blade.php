<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Candidature à : {{ $poste->titre }}</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body class="bg-gray-100 p-4 sm:p-8">
        <div class="max-w-xl mx-auto bg-white shadow-md rounded-lg p-4 sm:p-6">
            <a href="{{ route('recrutement') }}"
               class="inline-flex items-center gap-2 mb-6 px-5 py-2 rounded-full bg-white border-2 border-[#3C74A8] hover:bg-[#3C74A8] hover:text-white text-[#3C74A8] font-semibold shadow transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#3C74A8] focus:ring-offset-2 w-full sm:w-auto justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="font-bold tracking-wide">Retour à la liste des offres</span>
            </a>
            
            <h1 class="text-xl sm:text-2xl font-bold mb-4 text-[#3C74A8] break-words">Postuler à : {{ $poste->titre }}</h1>
            <p class="text-gray-700 mb-6 break-words">{!! nl2br(e($poste->descriptif)) !!}</p>

            <form action="https://formspree.io/f/xzzrwanv" method="POST" enctype="multipart/form-data" class="space-y-4">
                <input type="hidden" name="_subject" value="Nouvelle candidature reçue via le site Pharmacol">
                <input type="hidden" name="Poste" value="{{ $poste->titre }}">

                <div>
                    <label class="block mb-1">Nom :</label>
                    <input type="text" name="Nom" class="w-full border border-gray-300 p-2 rounded" required>
                </div>
                <div>
                    <label class="block mb-1">Email :</label>
                    <input type="email" name="Email" class="w-full border border-gray-300 p-2 rounded" required>
                </div>
                <div>
                    <label class="block mb-1">Message :</label>
                    <textarea name="Message" rows="4" class="w-full border border-gray-300 p-2 rounded"></textarea>
                </div>
                <div>
                    <label class="block mb-1">Lien vers votre CV (Google Drive, Dropbox, etc.) :</label>
                    <input type="url" name="cv_link" class="w-full border border-gray-300 p-2 rounded" placeholder="https://..." required>
                </div>

                <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded hover:bg-[#2b5e8c] w-full sm:w-auto font-semibold shadow">Envoyer</button>
            </form>
        </div>
    </body>
</html>