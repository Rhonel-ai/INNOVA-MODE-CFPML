<?php
namespace App\Listeners;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;

class UpdateUserStatusToActive
{
    public function handle(Login $event)
    {
        $event->user->status ='Active' ;
        $event->user->save();
        
        
    }
}