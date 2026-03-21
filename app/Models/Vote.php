<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'voter_name',
        'voter_phone',
        'is_anonymous',
        'vote_count',
        'amount_paid',
        'prime_id',
        'transaction_id',
        'payment_status',
        'payment_method',
        'payment_verified_at',
        'kkiapay_response',
        'kkiapay_transaction_id',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
        'vote_count' => 'integer',
        'amount_paid' => 'integer',
        'payment_verified_at' => 'datetime',
        'kkiapay_response' => 'array',
    ];

    /**
     * Relation avec le candidat
     */
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    /**
     * Logs de paiement associés
     */
    public function paymentLogs()
    {
        return $this->hasMany(PaymentLog::class);
    }

    /**
     * Scopes
     */
    public function scopeSuccessful($query)
    {
        return $query->where('payment_status', 'success');
    }

    public function scopePending($query)
    {
        return $query->where('payment_status', 'pending');
    }

    public function scopeFailed($query)
    {
        return $query->where('payment_status', 'failed');
    }

    public function scopeForCandidate($query, $candidateId)
    {
        return $query->where('candidate_id', $candidateId);
    }

    /**
     * Vérifier si le vote est payé
     */
    public function isPaid()
    {
        return $this->payment_status === 'success';
    }

    /**
     * Marquer comme payé
     */
    public function markAsPaid($kkiapayData = null)
    {
        $this->update([
            'payment_status' => 'success',
            'payment_verified_at' => now(),
            'kkiapay_response' => $kkiapayData,
        ]);
    }

    /**
     * Marquer comme échoué
     */
    public function markAsFailed($reason = null)
    {
        $this->update([
            'payment_status' => 'failed',
            'kkiapay_response' => ['error' => $reason],
        ]);
    }

    /**
     * Obtenir le nom du votant (masqué si anonyme)
     */
    public function getDisplayNameAttribute()
    {
        return $this->is_anonymous ? 'Anonyme' : ($this->voter_name ?: 'Non spécifié');
    }

    /**
     * Obtenir le téléphone (masqué si anonyme)
     */
    public function getDisplayPhoneAttribute()
    {
        return $this->is_anonymous ? 'Masqué' : $this->voter_phone;
    }
}