{{-- filepath: backend/resources/views/admin/layout.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Admin')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700&display=swap');
        body { font-family: 'Lexend', sans-serif; }
    </style>
</head>
<body class="bg-[#f7fafc]">
    <div class="min-h-screen flex flex-col items-center justify-center">
        @yield('content')
    </div>
</body>
</html>