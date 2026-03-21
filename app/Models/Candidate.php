<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
      'first_name',
       'last_name',
       'school',
       'city',
       'birth_date',
       'image',
       'votes'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($candidate) {

            // Première lettre du nom en majuscule
            $firstLetter = strtoupper(substr($candidate->name, 0, 1));

            // Récupère le dernier ID + 1
            $lastId = Candidate::max('id') + 1;

            // Génère la partie numérique à 4 chiffres
            $number = str_pad($lastId, 3, '0', STR_PAD_LEFT);

            // Construit le code final : 000 + 4 chiffres + première lettre
            $candidate->code = 'SHV' . $number . $firstLetter;
        });
    }
}