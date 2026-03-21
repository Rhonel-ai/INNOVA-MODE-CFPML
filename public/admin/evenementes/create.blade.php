{{-- On hérite de votre layout d'administration principal --}}
@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Créer un nouvel événement (Prime)</h1>
        </div>
        <div class="card-body">
            {{-- Le formulaire pointe vers la route 'events.store' qui exécute la méthode store() du contrôleur --}}
            <form action="{{ route('events.store') }}" method="POST">
                @csrf {{-- Sécurité indispensable dans Laravel pour se protéger des attaques CSRF --}}

                {{-- Champ pour le nom de l'événement --}}
                <div class="form-group mb-3">
                    <label for="name">Nom de l'événement</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                        value="{{ old('name') }}" required>
                    {{-- Affiche une erreur si la validation échoue pour le champ 'name' --}}
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Champ pour la description --}}
                <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                        name="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    {{-- Champ pour la date de début --}}
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="start_date">Date de début</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                            @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- Champ pour la date de fin --}}
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="end_date">Date de fin</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                            @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Créer l'événement</button>
                <a href="{{ route('events.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection