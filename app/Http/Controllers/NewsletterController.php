<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
   public function store(Request $request)
{

$request->validate([
    
'email' => 'required|email',
]);

Newsletter::create([
'email' => $request->email,
]);

return back()->with('success', 'Message sent successfully!');
}


 public function destroy($id)
    {
        $newsletter = Newsletter::find($id);
        $newsletter->delete();
        return redirect()->route('users.index');
    }
}