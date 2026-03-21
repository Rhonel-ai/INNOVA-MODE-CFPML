<?php

  

namespace App\Models;

  

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\Log;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use App\Traits\Loggable;

class User extends Authenticatable

{

    use HasFactory, Notifiable, HasRoles,Loggable;
    
    
    

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'name',
        'email',
        'upload',
        'status',
        'password',
        
        //ajoute des nouveaux champs
        
        'username',
        'phone',
        'pays',
        'ville',
        'region',
        'adresse',

    ];

  

    /**

     * The attributes that should be hidden for arrays.

     *

     * @var array

     */

    protected $hidden = [

        'password',

        'remember_token',

    ];

  

    /**

     * The attributes that should be cast to native types.

     *

     * @var array

     */

   
   
      

}