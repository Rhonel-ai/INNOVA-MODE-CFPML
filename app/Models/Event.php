<?php
 namespace App\Models;
  use Illuminate\Database\Eloquent\Factories\HasFactory; 
  use Illuminate\Database\Eloquent\Model;
    use Carbon\Carbon; 
class Event extends Model
{
    use HasFactory;

    // Important pour la création et mise à jour de masse
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'leader_user_id',
    ];

     protected $casts= [
        'start_date'=>'datetime',
        'end_date'=>'datetime',
    ];

    /**
    * Définit la relation "un événement a un leader (qui est un utilisateur)".
    */
    public function leader()
    {
    // belongsTo = "appartient à"
    return $this->belongsTo(User::class, 'leader_user_id');
    }

    /**
    * Un "accesseur" pour calculer le temps restant.
    * Vous pourrez appeler $event->time_remaining dans Blade.
    */
    public function getTimeRemainingAttribute()
    {
    if ($this->end_date->isFuture()) {
    return $this->end_date->diffForHumans(null, true, false, 2); // ex: "3 jours 8 heures"
    }
    return 'Terminé';
    }
}