<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Poste;

    class PosteController extends Controller
    {
        public function create()
        {
            return view('admin.poste_create');
        }

        public function store(Request $request)
        {
            $data = $request->validate([
                'titre' => 'required|string|max:255',
                'descriptif' => 'required|string',
                'localisation' => 'required|string|max:255',
            ]);
            Poste::create($data);
            return redirect()->to(route('admin.dashboard', [], false) . '#recrutement');
        }

        public function edit($id)
        {
            $poste = Poste::findOrFail($id);
            return view('admin.poste_edit', compact('poste'));
        }

        public function update(Request $request, $id)
        {
            $poste = Poste::findOrFail($id);
            $data = $request->validate([
                'titre' => 'required|string|max:255',
                'descriptif' => 'required|string',
                'localisation' => 'required|string|max:255',
            ]);
            $poste->update($data);
            return redirect()->to(route('admin.dashboard', [], false) . '#recrutement');
        }

        public function destroy($id)
        {
            $poste = Poste::findOrFail($id);
            $poste->delete();
            return redirect()->to(route('admin.dashboard', [], false) . '#recrutement');
        }
    }
?>


