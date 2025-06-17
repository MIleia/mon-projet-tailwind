<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $articles = Blog::whereIn('etat', ['en ligne', 'les 2'])
            ->orderBy('date', 'desc')
            ->get();
        return view('blog', compact('articles'));
    }

    public function create()
    {
        return view('admin.blog_create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titre' => 'required|string|max:255',
            'texte' => 'required|string',
            'etat' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $image->getClientOriginalName());
            $image->move(public_path('images/blog'), $filename);
            $data['image'] = 'images/blog/' . $filename;
        }

        $data['date'] = now();
        Blog::create($data);

        return redirect()->route('admin.dashboard')->with('success', 'Article ajouté !');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog_edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $data = $request->validate([
            'titre' => 'required|string|max:255',
            'texte' => 'required|string',
            'etat' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $image->getClientOriginalName());
            $image->move(public_path('images/blog'), $filename);
            $data['image'] = 'images/blog/' . $filename;
        }

        $blog->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Article modifié !');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Article supprimé !');
    }
}


