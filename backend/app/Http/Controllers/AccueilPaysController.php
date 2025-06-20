<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;

    class AccueilPaysController extends Controller
    {
        public function benin()
        {
            $chiffres = [];
            if (Storage::exists('chiffres.json')) {
                $chiffres = json_decode(Storage::get('chiffres.json'), true) ?? [];
            }
            $benin = collect($chiffres)->firstWhere('pays', 'Bénin') ?? [];
            $general = collect($chiffres)->firstWhere('pays', 'general') ?? [];
            return view('accueil_benin', compact('benin', 'general'));
        }
        public function togo()
        {
            $chiffres = [];
            if (Storage::exists('chiffres.json')) {
                $chiffres = json_decode(Storage::get('chiffres.json'), true) ?? [];
            }
            $togo = collect($chiffres)->firstWhere('pays', 'Togo') ?? [];
            $general = collect($chiffres)->firstWhere('pays', 'general') ?? [];
            return view('accueil_togo', compact('togo', 'general'));
        }
        public function niger()
        {
            $chiffres = [];
            if (Storage::exists('chiffres.json')) {
                $chiffres = json_decode(Storage::get('chiffres.json'), true) ?? [];
            }
            $niger = collect($chiffres)->firstWhere('pays', 'Niger') ?? [];
            $general = collect($chiffres)->firstWhere('pays', 'general') ?? [];
            return view('accueil_niger', compact('niger', 'general'));
        }
    }
?>


