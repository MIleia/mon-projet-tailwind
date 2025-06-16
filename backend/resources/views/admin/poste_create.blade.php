{{-- filepath: backend/resources/views/admin/poste_create.blade.php --}}
@extends('admin.layout')

@section('content')
<div class="card bg-white p-6 mb-8 max-w-xl mx-auto">
    <a href="{{ route('admin.dashboard') }}#recrutement" class="text-blue-600 hover:underline mb-4 inline-block"><i class="fas fa-arrow-left mr-1"></i> Retour au dashboard</a>
    <h2 class="text-2xl font-semibold text-[#437305] mb-4">Ajouter un poste</h2>
    <form method="POST" action="{{ route('admin.poste.store') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block mb-1">Titre</label>
            <input type="text" name="titre" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block mb-1">Descriptif</label>
            <textarea name="descriptif" rows="5" class="w-full border rounded p-2" required></textarea>
        </div>
        <div>
            <label class="block mb-1">Localisation</label>
            <input type="text" name="localisation" class="w-full border rounded p-2" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Ajouter</button>
    </form>
</div>
@endsection