<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'vote_id',
        'transaction_id',
        'event_type',
        'request_data',
        'response_data',
        'status',
        'error_message',
        'ip_address',
    ];

    protected $casts = [
        'request_data' => 'array',
        'response_data' => 'array',
    ];

    /**
     * Relation avec le vote
     */
    public function vote()
    {
        return $this->belongsTo(Vote::class);
    }

    /**
     * Créer un log
     */
    public static function logEvent($data)
    {
        return self::create([
            'vote_id' => $data['vote_id'] ?? null,
            'transaction_id' => $data['transaction_id'] ?? 'N/A',
            'event_type' => $data['event_type'] ?? 'unknown',
            'request_data' => $data['request_data'] ?? null,
            'response_data' => $data['response_data'] ?? null,
            'status' => $data['status'] ?? 'info',
            'error_message' => $data['error_message'] ?? null,
            'ip_address' => request()->ip(),
        ]);
    }
}