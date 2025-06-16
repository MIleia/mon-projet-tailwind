<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    class AccueilController extends Controller
    {
        public function index()
        {
            // Ici tu peux passer des données à la vue si besoin
            return view('accueil');
        }
    }
?>


