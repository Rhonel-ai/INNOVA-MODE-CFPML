<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BeninPhoneNumber implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Nettoyer le numéro (retirer espaces, tirets, parenthèses, points)
        $cleaned = preg_replace('/[\s\-\(\)\.]/u', '', $value);
        
        // Format béninois 10 chiffres: 01 suivi de 6 ou 9, puis 7 chiffres
        // Exemples valides: 0197000000, 0196123456, 01 97 00 00 00
        return preg_match('/^01[69][0-9]{7}$/', $cleaned) === 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Le numéro de téléphone doit être au format béninois: 01 6x xx xx xx ou 01 9x xx xx xx (10 chiffres).';
    }
}