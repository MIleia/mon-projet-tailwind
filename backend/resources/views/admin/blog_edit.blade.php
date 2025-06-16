{{-- filepath: backend/resources/views/admin/blog_edit.blade.php --}}
@extends('admin.layout')

@section('content')
<div class="card bg-white p-6 mb-8 max-w-xl mx-auto">
    <h2 class="text-2xl font-semibold text-[#437305] mb-4">Modifier l'article</h2>
    <form method="POST" action="{{ route('admin.blog.update', $blog->id) }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block mb-1">Titre</label>
            <input type="text" name="titre" class="w-full border rounded p-2" value="{{ $blog->titre }}" required>
        </div>
        <div>
            <label class="block mb-1">Contenu</label>
            <textarea name="texte" rows="6" class="w-full border rounded p-2" required>{{ $blog->texte }}</textarea>
        </div>
        <div>
            <label class="block mb-1">Image</label>
            <input type="file" name="image" class="w-full border rounded p-2">
            @if($blog->image)
                <img src="{{ asset($blog->image) }}" class="h-16 mt-2">
            @endif
        </div>
        <div>
            <label class="block mb-1">État</label>
            <select name="etat" class="w-full border rounded p-2" required>
                <option value="en ligne" @if($blog->etat == 'en ligne') selected @endif>En ligne</option>
                <option value="brouillon" @if($blog->etat == 'brouillon') selected @endif>Brouillon</option>
                <option value="newsletter" @if($blog->etat == 'newsletter') selected @endif>Newsletter</option>
                <option value="les 2" @if($blog->etat == 'les 2') selected @endif>Les 2</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Enregistrer</button>
    </form>
</div>
@endsection