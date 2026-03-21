<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Candidate; // <-- C’est ici qu’on importe le modèle
use App\Models\Link;


class SiteController extends Controller
{
  public function index()
  {


   // On prépare les données
    $stats = [
        'total_primes' => 0, // Remplacez par vos calculs réels (ex: Phase::count())
        'in_progress'  => 0,
        'upcoming'     => 0,
    ];

    $eventsInProgress = []; // Ou Event::where('status', 'active')->get();
    $upcomingEvents   = []; 
    $completedEvents  = []; 

    // Récupérer tous les candidats triés par votes décroissants
    $candidates = Candidate::orderBy('votes', 'desc')->get();
    $totalVotes = Candidate::sum('votes');
    $topUser = Candidate::orderBy('votes', 'desc')->first();
    $totalCandidats = Candidate::count();

    // Calculer le pourcentage pour chaque candidat
    $totalVotes = $candidates->sum('votes');
    $candidates->transform(function ($c) use ($totalVotes) {
      $c->percentage = $totalVotes > 0 ? round(($c->votes / $totalVotes) * 100, 2) : 0;
      return $c;
    });

    return view('sites.pages.index', compact('candidates', 'totalVotes', 'topUser', 'totalCandidats', 'stats', 'eventsInProgress', 'upcomingEvents', 'completedEvents')); // ✅ ici $candidates est passé
    
    }


  public function prime()
  {
    $topUser = Candidate::orderBy('votes', 'desc')->first();
    $totalCandidats = Candidate::count();
    $totalVotes = Candidate::sum('votes');


    return view('sites.pages.prime', compact('topUser', 'totalCandidats', 'totalVotes'));
  }

}