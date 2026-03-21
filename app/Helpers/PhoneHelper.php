<?php

namespace App\Helpers;

class PhoneHelper
{
    /**
     * Nettoyer un numéro de téléphone (retirer espaces, tirets, etc.)
     * 
     * @param string $phone
     * @return string
     */
    public static function clean($phone)
    {
        return preg_replace('/[\s\-\(\)\.]/u', '', $phone);
    }

    /**
     * Formater un numéro béninois pour l'affichage
     * Format: 01 97 00 00 00
     * 
     * @param string $phone
     * @return string
     */
    public static function format($phone)
    {
        $cleaned = self::clean($phone);
        
        // Si le numéro est valide (10 chiffres commençant par 01)
        if (preg_match('/^(01[69][0-9]{7})$/', $cleaned, $matches)) {
            // Format: 01 97 00 00 00
            return substr($cleaned, 0, 2) . ' ' . 
                   substr($cleaned, 2, 2) . ' ' . 
                   substr($cleaned, 4, 2) . ' ' . 
                   substr($cleaned, 6, 2) . ' ' . 
                   substr($cleaned, 8, 2);
        }
        
        return $phone; // Retourner tel quel si pas valide
    }

    /**
     * Valider un numéro béninois
     * 
     * @param string $phone
     * @return bool
     */
    public static function validate($phone)
    {
        $cleaned = self::clean($phone);
        return preg_match('/^01[69][0-9]{7}$/', $cleaned) === 1;
    }

    /**
     * Masquer partiellement un numéro (pour anonymat)
     * Format: 01 97 ** ** **
     * 
     * @param string $phone
     * @return string
     */
    public static function mask($phone)
    {
        $cleaned = self::clean($phone);
        
        if (strlen($cleaned) === 10) {
            return substr($cleaned, 0, 2) . ' ' . 
                   substr($cleaned, 2, 2) . ' ' . 
                   '** ** **';
        }
        
        return '** ** ** ** **';
    }

    /**
     * Obtenir l'opérateur depuis le numéro
     * 
     * @param string $phone
     * @return string|null
     */
    public static function getOperator($phone)
    {
        $cleaned = self::clean($phone);
        
        if (strlen($cleaned) !== 10 || !self::validate($phone)) {
            return null;
        }
        
        $prefix = substr($cleaned, 2, 1); // 3e chiffre après 01
        
        switch ($prefix) {
            case '9':
                return 'MTN';
            case '6':
                return 'MOOV';
            default:
                return 'INCONNU';
        }
    }
}