<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;


use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class ProfileController extends Controller
{
    public function account(){
        $user= auth::user();
        return view('admin.profile.account', compact('user'));
    }
    public function user()
    {
      
        $user= auth::user();
        $nbrUser= User::count();
        return view('admin.profile.user', compact('user','nbrUser'));
    }
public function update(Request $request)
{
     $user= auth::user();
     $request->validate( [
            'name' => 'required',
            'email' => ['required','email' ,Rule::unique('users')->ignore($user->id)],
            'phone' => '',
            'ville' => '',
            'region' => '',
            'adresse' => '',
            'username' => '',

        ]);
        // dd($request->all());
        $user=Auth::user();
        $user->update($request->all());
        return redirect()->route('profile.account')->with('success','Profile mise ajout avec success');
   }
   public function updatePassword(Request $request)
   {
    $request->validate([
        'current_password'=>'required',
        'new_password'=>'required|confirmed',
    ]);
    $user=Auth::user();
    if(!Hash::check($request->current_password,$user->password)){
        return back()->withErrors(['current_password'=>'l\'ancien mot de passe  est incorrect']);
    }
    $user->password = Hash::make($request->new_password);
    $user->save();
    return redirect()->route('profile.account')->with('succes','Mot de passe mis à jour avec succes');
   }
    
}