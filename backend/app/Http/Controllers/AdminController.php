<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Utilisateur;
    use App\Models\Newsletter;
    use App\Models\Blog;
    use App\Models\Poste;
    use App\Models\Entreprise;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Storage;

    class AdminController extends Controller
    {
        public function showLogin()
        {
            return view('admin.connexion');
        }

        public function login(Request $request)
        {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $user = Utilisateur::where('mail', $credentials['email'])->first();

            if ($user && Hash::check($credentials['password'], $user->mot_de_passe)) {
                session(['admin' => $user->mail, 'role' => $user->role]);
                return redirect()->route('admin.dashboard');
            }

            return back()->withErrors(['email' => 'Identifiants incorrects.']);
        }

        public function logout()
        {
            session()->forget(['admin', 'role']);
            return redirect()->route('admin.login');
        }

        public function dashboard()
        {
            if (!session('admin')) {
                return redirect()->route('admin.login');
            }
            $newsletters = Newsletter::all();
            $blogs = Blog::all();
            $postes = Poste::all();
            $utilisateurs = Utilisateur::all();
            $entreprises = Entreprise::all();

            // Ajout pour les chiffres
            $chiffres = [];
            if (Storage::exists('chiffres.json')) {
                $chiffres = json_decode(Storage::get('chiffres.json'), true) ?? [];
            }

            return view('admin.dashboard', compact(
                'newsletters', 'blogs', 'postes', 'utilisateurs', 'entreprises', 'chiffres'
            ));
        }
    }
?>


