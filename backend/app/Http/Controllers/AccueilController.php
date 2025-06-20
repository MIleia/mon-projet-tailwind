<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;

    class AccueilController extends Controller
    {
        public function index()
        {
            $chiffres = [];
            if (Storage::exists('chiffres.json')) {
                $chiffres = json_decode(Storage::get('chiffres.json'), true) ?? [];
            }
            $general = collect($chiffres)->firstWhere('pays', 'general') ?? [];

            // Additionne uniquement les laboratoires des 3 pays
            $paysList = ['Togo', 'Bénin', 'Niger'];
            $laboratoires = 0;
            foreach ($paysList as $pays) {
                $data = collect($chiffres)->firstWhere('pays', $pays) ?? [];
                $laboratoires += intval($data['laboratoires'] ?? 0);
            }

            // Utilise le nombre de collaborateurs du bloc général
            $collaborateurs = intval($general['collaborateurs'] ?? 0);

            return view('accueil', compact('general', 'collaborateurs', 'laboratoires'));
        }
    }
?>


