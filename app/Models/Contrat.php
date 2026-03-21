<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\Loggable;

class Contrat extends Model
{
    use HasFactory,Loggable;
     protected $table = 'contrats';
     protected $fillable = [
        'name', 'email','phone','pays','obejetDemande','date',
     ];
     
     
}