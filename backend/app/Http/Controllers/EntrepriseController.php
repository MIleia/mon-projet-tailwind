<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entreprise;

class EntrepriseController extends Controller
{
    public function create()
    {
        return view('admin.entreprise_create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'pays' => 'required|string|max:100',
            'ville' => 'required|string|max:100',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
        ]);
        Entreprise::create($data);
        return redirect()->to(route('admin.dashboard', [], false) . '#entreprises');
    }

    public function edit($id)
    {
        $entreprise = Entreprise::findOrFail($id);
        return view('admin.entreprise_edit', compact('entreprise'));
    }

    public function update(Request $request, $id)
    {
        $entreprise = Entreprise::findOrFail($id);
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'pays' => 'required|string|max:100',
            'ville' => 'required|string|max:100',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
        ]);
        $entreprise->update($data);
        return redirect()->to(route('admin.dashboard', [], false) . '#entreprises');
    }

    public function destroy($id)
    {
        $entreprise = Entreprise::findOrFail($id);
        $entreprise->delete();
        return redirect()->to(route('admin.dashboard', [], false) . '#entreprises');
    }
}