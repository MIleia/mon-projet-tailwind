{{-- filepath: backend/resources/views/admin/poste_edit.blade.php --}}
@extends('admin.layout')

@section('content')
<div class="card bg-white p-6 mb-8 max-w-xl mx-auto">
    <a href="{{ route('admin.dashboard') }}#recrutement" class="text-blue-600 hover:underline mb-4 inline-block"><i class="fas fa-arrow-left mr-1"></i> Retour au dashboard</a>
    <h2 class="text-2xl font-semibold text-[#437305] mb-4">Modifier le poste</h2>
    <form method="POST" action="{{ route('admin.poste.update', $poste->id) }}" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block mb-1">Titre</label>
            <input type="text" name="titre" class="w-full border rounded p-2" value="{{ $poste->titre }}" required>
        </div>
        <div>
            <label class="block mb-1">Descriptif</label>
            <textarea name="descriptif" rows="5" class="w-full border rounded p-2" required>{{ $poste->descriptif }}</textarea>
        </div>
        <div>
            <label class="block mb-1">Localisation</label>
            <input type="text" name="localisation" class="w-full border rounded p-2" value="{{ $poste->localisation }}" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Enregistrer</button>
    </form>
</div>
@endsection