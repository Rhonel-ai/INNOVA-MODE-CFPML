<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkerLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.worker-login'); // Créer cette vue séparée
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // On utilise un guard spécifique si tu veux séparer utilisateurs/ouvriers
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/worker/dashboard'); // Dashboard spécifique
        }

        return back()->with('error', 'Email ou mot de passe incorrect');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('worker.login');
    }
}