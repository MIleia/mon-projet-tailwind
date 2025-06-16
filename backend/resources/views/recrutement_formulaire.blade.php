{{-- filepath: backend/resources/views/recrutement_formulaire.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Candidature à : {{ $poste->titre }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4 text-[#3C74A8]">Postuler à : {{ $poste->titre }}</h1>
        <p class="text-gray-700 mb-6">{!! nl2br(e($poste->descriptif)) !!}</p>

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

            <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded hover:bg-[#2b5e8c]">Envoyer</button>
        </form>
    </div>
</body>
</html>