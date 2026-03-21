@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            {{-- Le titre est dynamique et affiche le nom de l'événement --}}
            <h1>Modifier l'événement : {{ $event->name }}</h1>
        </div>
        <div class="card-body">
            {{-- Le formulaire pointe vers la route 'events.update' et passe l'ID de l'événement --}}
            <form action="{{ route('events.update', $event->id) }}" method="POST">
                @csrf {{-- Sécurité CSRF --}}
                @method('PUT')
                {{-- Très important : Indique à Laravel que c'est une mise à jour (méthode PUT/PATCH) --}}

                {{-- Champ pour le nom de l'événement --}}
                <div class="form-group mb-3">
                    <label for="name">Nom de l'événement</label>
                    {{-- La valeur est pré-remplie avec la donnée actuelle de l'événement --}}
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                        value="{{ old('name', $event->name) }}" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Champ pour la description --}}
                <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                        name="description" rows="3">{{ old('description', $event->description) }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    {{-- Champ pour la date de début --}}
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="start_date">Date de début</label>
                            {{-- On utilise format('Y-m-d') car c'est le format attendu par l'input type="date" --}}
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                id="start_date" name="start_date"
                                value="{{ old('start_date', $event->start_date->format('Y-m-d')) }}" required>
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
                                id="end_date" name="end_date"
                                value="{{ old('end_date', $event->end_date->format('Y-m-d')) }}" required>
                            @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr>

                {{-- NOUVELLE SECTION : Sélection du Gagnant --}}
                <div class="form-group mb-3">
                    <label for="leader_user_id">
                        <strong>🏆 Gagnant de l'événement</strong>
                    </label>
                    <select class="form-control @error('leader_user_id') is-invalid @enderror" id="leader_user_id"
                        name="leader_user_id">
                        {{-- Option par défaut si aucun gagnant n'est choisi --}}
                        <option value="">-- Pas encore de gagnant --</option>

                        {{-- Boucle sur tous les utilisateurs passés par le contrôleur --}}
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}" @if(old('leader_user_id', $event->leader_user_id) == $user->id)
                            selected @endif>
                            {{-- Affichez le nom ou l'identifiant que vous préférez --}}
                            {{ $user->first_name }} {{ $user->last_name }} (ID: {{ $user->id }})
                        </option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">
                        Sélectionnez le gagnant de cet événement. Vous pouvez le faire une fois l'événement terminé.
                    </small>
                    @error('leader_user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Mettre à jour l'événement</button>
                <a href="{{ route('events.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection