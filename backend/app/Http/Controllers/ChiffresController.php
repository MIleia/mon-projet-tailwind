<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Storage;

    class ChiffresController extends Controller
    {
        public function edit()
        {
            $chiffres = [];
            if (Storage::exists('chiffres.json')) {
                $chiffres = json_decode(Storage::get('chiffres.json'), true) ?? [];
            }
            return view('admin.dashboard', compact('chiffres'));
        }

        public function update(Request $request)
        {
            $chiffres = [];
            foreach (['Togo','Bénin','Niger'] as $pays) {
                $data = $request->input("chiffres.$pays", []);
                $data['pays'] = $pays;

                // Gestion de l'image
                if ($request->hasFile("equipe_image_$pays")) {
                    $file = $request->file("equipe_image_$pays");
                    $ext = strtolower($file->getClientOriginalExtension());
                    if (!in_array($ext, ['jpg','jpeg','png'])) {
                        return back()->with('success', "Format d'image non supporté pour $pays (jpg, jpeg, png uniquement).");
                    }
                    $filename = "equipe-" . strtolower($pays) . "." . $ext;
                    $file->move(public_path('images/Pharmacol'), $filename);
                    $data['equipe_image'] = "images/Pharmacol/$filename";
                } else {
                    // On garde le lien existant si présent, sinon .png par défaut
                    $data['equipe_image'] = $data['equipe_image'] ?? "images/Pharmacol/equipe-" . strtolower($pays) . ".png";
                }

                $chiffres[] = $data;
            }
            $general = $request->input('chiffres.general', []);
            $general['pays'] = 'general';
            $chiffres[] = $general;

            \Storage::put('chiffres.json', json_encode($chiffres, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            return back()->with('success', 'Chiffres mis à jour !');
        }

        public function index()
        {
            $chiffres = [];
            if (Storage::exists('chiffres.json')) {
                $chiffres = json_decode(Storage::get('chiffres.json'), true) ?? [];
            }
            return view('admin.dashboard', compact('blogs', 'postes', 'entreprises', 'utilisateurs', 'newsletters', 'chiffres'));
        }
    }
?>


