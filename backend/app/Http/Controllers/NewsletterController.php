<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Newsletter;

    class NewsletterController extends Controller
    {
        public function create()
        {
            return view('admin.newsletter_create');
        }

        public function store(Request $request)
        {
            $data = $request->validate([
                'mail' => 'required|email|unique:newsletter,mail',
                'prenom' => 'required|string|max:255',
                'nom' => 'nullable|string|max:255'
            ]);
            Newsletter::create($data);
            return redirect()->to(route('admin.dashboard', [], false) . '#newsletter')->with('success', 'Newsletter ajoutée !');
        }

        public function edit($mail)
        {
            $newsletter = Newsletter::findOrFail($mail);
            return view('admin.newsletter_edit', compact('newsletter'));
        }

        public function update(Request $request, $mail)
        {
            $newsletter = Newsletter::findOrFail($mail);
            $data = $request->validate([
                'mail' => 'required|email|unique:newsletter,mail,'.$newsletter->mail.',mail',
                'prenom' => 'required|string|max:255',
                'nom' => 'nullable|string|max:255'
            ]);
            $newsletter->update($data);
            return redirect()->to(route('admin.dashboard', [], false) . '#newsletter')->with('success', 'Newsletter modifiée !');
        }

        public function destroy($mail)
        {
            $newsletter = Newsletter::findOrFail($mail);
            $newsletter->delete();
            return redirect()->to(route('admin.dashboard', [], false) . '#newsletter')->with('success', 'Newsletter supprimée !');
        }
    }
?>


