<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    class AccueilPaysController extends Controller
    {
        public function benin() {
            return view('accueil_benin');
        }
        public function togo() {
            return view('accueil_togo');
        }
        public function niger() {
            return view('accueil_niger');
        }
    }
?>


