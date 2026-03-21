<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\PaymentLog;

class KKiaPayService
{
    protected $publicKey;
    protected $privateKey;
    protected $secret;
    protected $apiUrl;
    protected $sandbox;

    public function __construct()
    {
        $this->publicKey = config('kkiapay.public_key');
        $this->privateKey = config('kkiapay.private_key');
        $this->secret = config('kkiapay.secret');
        $this->apiUrl = config('kkiapay.api_url');
        $this->sandbox = config('kkiapay.sandbox');
    }

    /**
     * Vérifier une transaction via l'API KKiaPay
     */
    public function verifyTransaction($transactionId)
    {
        try {
            $response = Http::withHeaders([
                'x-api-key' => $this->privateKey,
                'Content-Type' => 'application/json',
            ])->get("{$this->apiUrl}/api/v1/transactions/{$transactionId}");

            $data = $response->json();

            // Logger la vérification
            PaymentLog::logEvent([
                'transaction_id' => $transactionId,
                'event_type' => 'verify_transaction',
                'response_data' => $data,
                'status' => $response->successful() ? 'success' : 'error',
            ]);

            if ($response->successful() && isset($data['status'])) {
                return [
                    'success' => true,
                    'data' => $data,
                    'status' => $data['status'],
                ];
            }

            return [
                'success' => false,
                'error' => $data['message'] ?? 'Transaction verification failed',
            ];

        } catch (\Exception $e) {
            Log::error('KKiaPay verification error', [
                'transaction_id' => $transactionId,
                'error' => $e->getMessage(),
            ]);

            PaymentLog::logEvent([
                'transaction_id' => $transactionId,
                'event_type' => 'verify_transaction_error',
                'status' => 'error',
                'error_message' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Vérifier la signature du webhook
     */
    public function verifyWebhookSignature($payload, $signature)
    {
        $computedSignature = hash_hmac('sha256', json_encode($payload), $this->secret);
        
        $isValid = hash_equals($computedSignature, $signature);
        
        Log::info('Webhook signature verification', [
            'computed' => $computedSignature,
            'received' => $signature,
            'valid' => $isValid,
        ]);

        return $isValid;
    }

    /**
     * Obtenir les détails d'une transaction
     */
    public function getTransactionDetails($transactionId)
    {
        $result = $this->verifyTransaction($transactionId);
        
        if ($result['success']) {
            return $result['data'];
        }

        return null;
    }

    /**
     * Vérifier si une transaction est réussie
     */
    public function isTransactionSuccessful($transactionId)
    {
        $result = $this->verifyTransaction($transactionId);
        
        return $result['success'] && 
               isset($result['status']) && 
               strtolower($result['status']) === 'success';
    }

    /**
     * Obtenir la configuration publique pour le frontend
     */
    public function getPublicConfig()
    {
        return [
            'public_key' => $this->publicKey,
            'sandbox' => $this->sandbox,
            'callback_url' => config('kkiapay.callback_url'),
        ];
    }

    /**
     * Formater le montant pour KKiaPay (XOF n'a pas de décimales)
     */
    public function formatAmount($amount)
    {
        return (int) $amount;
    }
}