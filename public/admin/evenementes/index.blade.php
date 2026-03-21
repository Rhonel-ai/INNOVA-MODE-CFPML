@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Liste des Événements (Primes)</h1>
        {{-- Bouton pour aller vers la page de création --}}
        <a href="{{ route('events.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter un événement
        </a>
    </div>

    {{-- Affiche un message de succès après une création, mise à jour ou suppression --}}
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Statut</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Gagnant</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- On vérifie s'il y a des événements. Sinon, on affiche un message. --}}
                    @forelse ($events as $event)
                    <tr>
                        <td>{{ $event->name }}</td>
                        <td>
                            {{-- Logique pour afficher le statut de l'événement --}}
                            @if ($event->end_date < now()) <span class="badge bg-secondary">Terminé</span>
                                @elseif ($event->start_date > now())
                                <span class="badge bg-info">À venir</span>
                                @else
                                <span class="badge bg-success">En cours</span>
                                @endif
                        </td>
                        <td>{{ $event->start_date->format('d/m/Y') }}</td>
                        <td>{{ $event->end_date->format('d/m/Y') }}</td>
                        <td>
                            {{-- Affiche le nom du gagnant s'il est défini --}}
                            @if ($event->leader)
                            {{ $event->leader->name }} {{-- Assurez-vous que votre modèle User a un attribut 'name' --}}
                            @else
                            <span class="text-muted">Non désigné</span>
                            @endif
                        </td>
                        <td class="text-end">
                            {{-- Bouton pour modifier (pointe vers la méthode edit) --}}
                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Modifier
                            </a>

                            {{-- Formulaire pour supprimer (pointe vers la méthode destroy) --}}
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');">
                                @csrf
                                @method('DELETE') {{-- Indique à Laravel que c'est une requête DELETE --}}
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i> Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Aucun événement trouvé.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection