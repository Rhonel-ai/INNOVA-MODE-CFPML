<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User; // Assurez-vous d'avoir un modèle User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use App\Models\Candidate; // Assurez-vous d'avoir un modèle User

class DashboardController extends Controller
{
    public function prime()
    {
        $today = Date::today();
        // 1. Récupérer tous les événements avec les informations du leader
        // La méthode with('leader') est une optimisation pour éviter trop de requêtes
        $allEvents = Event::with('leader')->orderBy('start_date', 'desc')->get();

        // 2. Classer les événements
        $eventsInProgress = $allEvents->where('start_date', '<=', $today)->where('end_date', '>=', $today);
        $upcomingEvents = $allEvents->where('start_date', '>', $today);
        $completedEvents = $allEvents->where('end_date', '<', $today);

        // 3. Récupérer les statistiques pour la section "Stats"
        // Ces données devront être calculées selon votre logique métier
        // Voici un exemple simple :
        $stats = [
            'total_primes' => $allEvents->count(),
            'in_progress' => $eventsInProgress->count(),
            'upcoming' => $upcomingEvents->count(),
            'topUser' => Candidate::orderBy('votes', 'desc')->first(), // Exemple pour le leader actuel
            'totalCandidats' => Candidate::count(), // Exemple
            'totalVotes' => Candidate::sum('votes'), // À calculer
        ];

        // 4. Passer toutes les données à la vue
        return view('sites.pages.prime', [ // Remplacez par le nom de votre fichier, ex: 'primes'
            'eventsInProgress' => $eventsInProgress,
            'upcomingEvents' => $upcomingEvents,
            'completedEvents' => $completedEvents,
            'stats' => $stats,
        ]);
    }
}