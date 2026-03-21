<?php
namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Rôle : Montrer la liste de TOUS les événements.
     * Analogie : Le chef regarde son grand livre de toutes les recettes jamais créées.
     * Utilité : Une page dans votre panneau admin pour voir toutes les primes (passées, présentes, futures).
     */
    public function index()
    {
        // 1. Va chercher tous les événements dans la base de données.
        $events = Event::orderBy('start_date', 'desc')->get();
        
        // 2. Renvoie à une vue qui affichera cette liste.
        return view('admin.evenementes.index', ['events' => $events]);
    }

    /**
     * Rôle : Afficher une page avec un formulaire VIDE.
     * Analogie : Le chef prend une page blanche pour écrire une nouvelle recette.
     * Utilité : La page où vous tapez le nom, la description et les dates d'un NOUVEL événement.
     */
    public function create()
    {
        return view('admin.evenementes.create');
    }

    /**
     * Rôle : Recevoir les informations du formulaire de `create()` et les SAUVEGARDER.
     * Analogie : Le chef termine d'écrire sa recette et la range dans le livre.
     * Utilité : C'est l'action qui se produit quand vous cliquez sur le bouton "Enregistrer" du nouveau formulaire.
     */
    public function store(Request $request)
    {
        // 1. Vérifie que les données envoyées sont correctes (nom non vide, dates valides, etc.).
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // 2. Crée une nouvelle ligne dans la table 'events' avec ces données.
        Event::create($validatedData);

        // 3. Vous redirige vers la liste de tous les événements avec un message de succès.
        return redirect()->route('events.index')->with('success', 'Événement créé avec succès !');
    }

    /**
     * Rôle : Afficher une page avec un formulaire PRÉ-REMPLI pour un événement existant.
     * Analogie : Le chef ouvre son livre à la page d'une recette pour la corriger.
     * Utilité : La page où vous pouvez changer le nom, les dates, ou DÉSIGNER LE GAGNANT d'un événement.
     */
    public function edit(Event $event)
    {
        // 1. Récupère la liste de tous les utilisateurs pour les afficher dans un menu déroulant.
        $users = User::all(); 
        
        // 2. Renvoie la vue du formulaire de modification avec les infos de l'événement ET la liste des utilisateurs.
        return view('admin.evenementes.index', [
            'event' => $event, // L'événement à modifier
            'users' => $users  // La liste des gagnants potentiels
        ]);
    }

    /**
     * Rôle : Recevoir les informations du formulaire de `edit()` et METTRE À JOUR l'événement.
     * Analogie : Le chef sauvegarde les corrections apportées à sa recette.
     * Utilité : C'est l'action qui se produit quand vous cliquez sur "Mettre à jour" sur la page de modification.
     */
    public function update(Request $request, Event $event)
    {
        // 1. Valide les données (similaire à store). Notez la nouvelle ligne pour le gagnant !
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'leader_user_id' => 'nullable|exists:users,id' // Vérifie que l'ID du gagnant est valide.
        ]);

        // 2. Met à jour l'événement existant avec les nouvelles données.
        $event->update($validatedData);

        // 3. Redirige vers la liste.
        return redirect()->route('events.index')->with('success', 'Événement mis à jour avec succès !');
    }

    /**
     * Rôle : Supprimer un événement.
     * Analogie : Le chef déchire une page de recette de son livre.
     * Utilité : Pour effacer une prime si vous avez fait une erreur.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Événement supprimé.');
    }
}