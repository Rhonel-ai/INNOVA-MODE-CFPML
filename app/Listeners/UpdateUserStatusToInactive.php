<?php
namespace App\Listeners;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Log;

class UpdateUserStatusToInactive
{
    public function handle(Logout $event)
    {
        $event->user->status ='Inactive' ;
        $event->user->save();
        
    }
}