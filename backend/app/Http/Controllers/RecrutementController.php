<?php

namespace App\Http\Controllers;

use App\Models\Poste;
use Illuminate\Http\Request;

class RecrutementController extends Controller
{
    public function index()
    {
        $postes = Poste::all();
        return view('recrutement', compact('postes'));
    }

    public function formulaire($id)
    {
        $poste = Poste::findOrFail($id);
        return view('recrutement_formulaire', compact('poste'));
    }
}