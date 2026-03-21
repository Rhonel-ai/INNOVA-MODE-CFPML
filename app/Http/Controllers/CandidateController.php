<?php

namespace App\Http\Controllers;
use App\Models\Candidate;

use Illuminate\Http\Request;

class CandidateController extends Controller
{
 public function index()
{
    // Récupérer tous les candidats **triés par votes décroissants**
    $candidates = Candidate::orderBy('votes', 'desc')->get();

    // Calculer le pourcentage pour chaque candidat
    $totalVotes = $candidates->sum('votes');
    $candidates->transform(function ($c) use ($totalVotes) {
        $c->percentage = $totalVotes > 0 ? round(($c->votes / $totalVotes) * 100, 2) : 0;
        return $c;
    });

    return view('admin.dashboard.index', compact('candidates'));
}
public function create()
{
    return view('admin.candidates.create');
}

public function store(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name'  => 'required|string|max:255',
        'school'     => 'required|string|max:255',
        'city'       => 'required|string|max:255',
        'birth_date' => 'required|date',
        'image'      => 'nullable|image|mimes:jpg,jpeg,png',
    ]);

    $imageName = null;

    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/candidates'), $imageName);
    }

    Candidate::create([
        'first_name' => $request->first_name,
        'last_name'  => $request->last_name,
        'school'     => $request->school,
        'city'       => $request->city,
        'birth_date' => $request->birth_date, // <-- corrigé ici
        'image'      => $imageName,
        'votes'      => 0, 
    ]);

    return redirect()->back()->with('success', 'Candidat créé avec succès !');
}
public function destroy($id)
{
    $candidate = Candidate::findOrFail($id);

    // Supprime l'image si elle existe
    if ($candidate->image && file_exists(public_path('uploads/candidates/' . $candidate->image))) {
        unlink(public_path('uploads/candidates/' . $candidate->image));
    }

    $candidate->delete();

    return redirect()->route('dashboard.index')->with('success', 'Candidat supprimé avec succès !');
}




}