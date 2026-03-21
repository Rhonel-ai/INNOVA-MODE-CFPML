<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

  trait Loggable  

{
     use HasFactory,LogsActivity;
    
   public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(class_basename($this))
            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) =>class_basename($this)."User has been {$eventName}");
    }

   
}