<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Candidate;


// use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        return redirect()->route('dashboard');
    }
    public function dashboard()
    {
        $candidates = Candidate::all();

       


        return view('admin.dashboard.index',compact('candidates'));

        // return view('admin.dashboard.index');
    }
    
    
}