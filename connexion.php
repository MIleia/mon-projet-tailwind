<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Accueil</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        <script src="main.js"></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700&display=swap');
            body {
                font-family: 'Lexend', sans-serif;
            }
        </style>
    </head>
    <body>

        <div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
            <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Sign In</h2>
                
                <form class="space-y-4" action="connexion.php" method="POST">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input 
                        type="email" 
                        name="email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                        placeholder="your@email.com"
                        required
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input 
                        type="password" 
                        name="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                        placeholder="••••••••"
                        required
                        />
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg transition-colors">
                        Sign In
                    </button>
                </form>


                
            </div>
        </div>






        <?php
            require_once './bdd_pharmacol/config.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = $_POST['email'] ?? '';
                $password = $_POST['password'] ?? '';

                if (!empty($email) && !empty($password)) {
                    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE mail = ? AND mot_de_passe = ?");
                    $stmt->execute([$email, $password]);
                    $user = $stmt->fetch();

                    if ($user) {
                        header("Location: admin.html");
                        exit;
                    } else {
                        echo "❌ Email ou mot de passe incorrect.";
                    }
                } else {
                    echo "❗ Veuillez remplir tous les champs.";
                }
            }
        ?>


    </body>
</html>
