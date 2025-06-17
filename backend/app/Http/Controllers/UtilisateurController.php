<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Utilisateur;
    use Illuminate\Support\Facades\Hash;

    class UtilisateurController extends Controller
    {
        public function store(Request $request)
        {
            $data = $request->validate([
                'mail' => 'required|email|unique:utilisateur,mail|min:6',
                'mot_de_passe' => 'required|string|min:6',
                'role' => 'required|string'
            ], [
                'mail.required' => 'L\'email est obligatoire.',
                'mail.email' => 'L\'email doit être valide.',
                'mail.unique' => 'Cet email est déjà utilisé.',
                'mail.min' => 'L\'email doit comporter au moins 6 caractères.',
                'mot_de_passe.required' => 'Le mot de passe est obligatoire.',
                'mot_de_passe.min' => 'Le mot de passe doit comporter au moins 6 caractères.',
                'role.required' => 'Le rôle est obligatoire.'
            ]);
            $data['mot_de_passe'] = Hash::make($data['mot_de_passe']);
            Utilisateur::create($data);
            return redirect()->to(route('admin.dashboard', [], false) . '#utilisateurs');
        }

        public function destroy($mail)
        {
            if (session('admin') === $mail) {
                return back()->withErrors(['mail' => 'Vous ne pouvez pas supprimer votre propre compte.']);
            }
            Utilisateur::where('mail', $mail)->delete();
            return redirect()->to(route('admin.dashboard', [], false) . '#utilisateurs');
        }

        public function updateRole(Request $request, $mail)
        {
            $request->validate(['role' => 'required|string']);
            $user = Utilisateur::findOrFail($mail);
            $user->role = $request->role;
            $user->save();
            // Si l'utilisateur modifie son propre rôle, mettre à jour la session
            if (session('admin') === $mail) {
                session(['role' => $request->role]);
            }
            return response()->json(['success' => true]);
        }
    }
?>


