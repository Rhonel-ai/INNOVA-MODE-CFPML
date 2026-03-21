<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Candidate;
use App\Models\PaymentLog;
use App\Services\KKiaPayService;
use App\Rules\BeninPhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class VoteController extends Controller
{
    protected $kkiapay;

    public function __construct(KKiaPayService $kkiapay)
    {
        $this->kkiapay = $kkiapay;
    }

    /**
     * Créer un vote initial (avant paiement)
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'candidate_id' => 'required|exists:candidates,id',
            'vote_count' => 'required|integer|min:1',
            'voter_name' => 'nullable|string|max:255',
            'voter_phone' => ['required', 'string', new BeninPhoneNumber()],
            'is_anonymous' => 'boolean',
            'amount_paid' => 'required|integer|min:100',
            'prime_id' => 'nullable|integer',
            'transaction_id' => 'required|string|unique:votes,transaction_id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $candidate = Candidate::findOrFail($request->candidate_id);

            $vote = Vote::create([
                'candidate_id' => $request->candidate_id,
                'voter_name' => $request->is_anonymous ? null : $request->voter_name,
                'voter_phone' => $request->voter_phone,
                'is_anonymous' => $request->is_anonymous ?? false,
                'vote_count' => $request->vote_count,
                'amount_paid' => $request->amount_paid,
                'prime_id' => $request->prime_id,
                'transaction_id' => $request->transaction_id,
                'payment_status' => 'pending',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            PaymentLog::logEvent([
                'vote_id' => $vote->id,
                'transaction_id' => $vote->transaction_id,
                'event_type' => 'vote_created',
                'request_data' => $request->except(['voter_phone']),
                'status' => 'success',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Vote créé en attente de paiement',
                'data' => [
                    'vote_id' => $vote->id,
                    'transaction_id' => $vote->transaction_id,
                    'candidate' => [
                        'id' => $candidate->id,
                        'name' => $candidate->first_name . ' ' . $candidate->last_name,
                        'code' => $candidate->code,
                    ],
                    'amount' => $vote->amount_paid,
                ],
            ], 201);

        } catch (\Exception $e) {
            Log::error('Vote creation error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all(),
            ]);

            PaymentLog::logEvent([
                'transaction_id' => $request->transaction_id,
                'event_type' => 'vote_creation_error',
                'request_data' => $request->all(),
                'status' => 'error',
                'error_message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création du vote',
                'error' => config('app.debug') ? $e->getMessage() : 'Une erreur est survenue',
            ], 500);
        }
    }

    /**
     * Compléter un paiement après succès KKiaPay
     */
    public function completePayment(Request $request)
    {
        Log::info('💰 Complete payment request', [
            'data' => $request->all(),
        ]);

        $validator = Validator::make($request->all(), [
            'transaction_id' => 'required|string',
            'kkiapay_transaction_id' => 'required|string',
            'kkiapay_response' => 'required|array',
        ]);

        if ($validator->fails()) {
            Log::error('❌ Validation failed', [
                'errors' => $validator->errors(),
            ]);

            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $transactionId = $request->transaction_id;
            $kkiapayTxId = $request->kkiapay_transaction_id;
            $kkiapayResponse = $request->kkiapay_response;

            // Trouver le vote avec verrou pour éviter les problèmes de concurrence
            $vote = Vote::where('transaction_id', $transactionId)
                ->with('candidate')
                ->lockForUpdate()
                ->first();

            if (!$vote) {
                Log::error('❌ Vote not found', [
                    'transaction_id' => $transactionId,
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Vote non trouvé',
                ], 404);
            }

            Log::info('📋 Vote found', [
                'vote_id' => $vote->id,
                'current_status' => $vote->payment_status,
                'candidate_id' => $vote->candidate_id,
            ]);

            // Vérifier que le candidat existe
            if (!$vote->candidate) {
                Log::error('❌ Candidate not found for vote', [
                    'vote_id' => $vote->id,
                    'candidate_id' => $vote->candidate_id,
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Candidat non trouvé',
                ], 404);
            }

            // Si déjà payé, retourner succès
            if ($vote->payment_status === 'success') {
                Log::info('⚠️ Vote already paid', ['vote_id' => $vote->id]);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Vote déjà enregistré',
                    'data' => [
                        'vote_id' => $vote->id,
                        'payment_status' => $vote->payment_status,
                        'candidate_votes' => $vote->candidate->votes,
                    ],
                ]);
            }

            // Traiter le paiement dans une transaction DB
            DB::beginTransaction();
            
            try {
                // Mettre à jour le vote directement sans créer de nouvelle ligne
                $updateData = [
                    'payment_status' => 'success',
                    'kkiapay_response' => $kkiapayResponse,
                    'payment_verified_at' => now(),
                ];

                // Ajouter kkiapay_transaction_id seulement s'il n'existe pas
                if (!$vote->kkiapay_transaction_id) {
                    $updateData['kkiapay_transaction_id'] = $kkiapayTxId;
                }

                // Mise à jour en UNE SEULE requête
                DB::table('votes')
                    ->where('id', $vote->id)
                    ->where('payment_status', 'pending') // Condition pour éviter double update
                    ->update($updateData);

                Log::info('💾 Vote marked as paid', [
                    'vote_id' => $vote->id,
                    'vote_count' => $vote->vote_count,
                ]);

                // Incrémenter les votes du candidat
                $candidateId = $vote->candidate_id;
                $voteCount = $vote->vote_count;

                DB::table('candidates')
                    ->where('id', $candidateId)
                    ->increment('votes', $voteCount);

                $updatedCandidate = Candidate::find($candidateId);

                Log::info('📊 Candidate votes updated', [
                    'candidate_id' => $candidateId,
                    'new_votes' => $updatedCandidate->votes,
                    'increment' => $voteCount,
                ]);

                // Logger le succès
                PaymentLog::logEvent([
                    'vote_id' => $vote->id,
                    'transaction_id' => $vote->transaction_id,
                    'event_type' => 'payment_processed_success',
                    'response_data' => [
                        'kkiapay_data' => $kkiapayResponse,
                        'candidate_new_votes' => $updatedCandidate->votes,
                    ],
                    'status' => 'success',
                ]);

                DB::commit();

                Log::info('🎉 Payment completed successfully', [
                    'vote_id' => $vote->id,
                    'candidate_votes' => $updatedCandidate->votes,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Vote enregistré avec succès',
                    'data' => [
                        'vote_id' => $vote->id,
                        'payment_status' => 'success',
                        'candidate_votes' => $updatedCandidate->votes,
                        'candidate_name' => $updatedCandidate->first_name . ' ' . $updatedCandidate->last_name,
                    ],
                ]);

            } catch (\Exception $e) {
                DB::rollBack();
                
                Log::error('💥 Transaction failed', [
                    'vote_id' => $vote->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);

                throw $e;
            }

        } catch (\Illuminate\Database\UniqueConstraintViolationException $e) {
            Log::error('💥 UNIQUE CONSTRAINT VIOLATION in completePayment', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'transaction_id' => $request->transaction_id ?? 'unknown',
                'request' => $request->all(),
            ]);

            PaymentLog::logEvent([
                'transaction_id' => $request->transaction_id ?? 'unknown',
                'event_type' => 'payment_completion_unique_error',
                'status' => 'error',
                'error_message' => $e->getMessage(),
                'request_data' => $request->all(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Ce vote a déjà été traité',
                'error' => config('app.debug') ? $e->getMessage() : 'Erreur de duplication',
            ], 409);

        } catch (\Exception $e) {
            Log::error('💥 Complete payment error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            PaymentLog::logEvent([
                'transaction_id' => $request->transaction_id ?? 'unknown',
                'event_type' => 'payment_completion_error',
                'status' => 'error',
                'error_message' => $e->getMessage(),
                'request_data' => $request->all(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'enregistrement du vote',
                'error' => config('app.debug') ? $e->getMessage() : 'Une erreur est survenue',
            ], 500);
        }
    }

    /**
     * Vérifier un paiement manuellement
     */
    public function verify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'transaction_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $transactionId = $request->transaction_id;

            Log::info('🔍 Verify payment request', [
                'transaction_id' => $transactionId,
            ]);

            $vote = Vote::where('transaction_id', $transactionId)
                ->with('candidate')
                ->first();

            if (!$vote) {
                Log::warning('⚠️ Vote not found', [
                    'transaction_id' => $transactionId,
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Vote non trouvé',
                ], 404);
            }

            if ($vote->payment_status === 'success') {
                Log::info('✅ Vote already paid', ['vote_id' => $vote->id]);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Paiement déjà vérifié',
                    'data' => [
                        'vote_id' => $vote->id,
                        'payment_status' => $vote->payment_status,
                        'candidate_votes' => $vote->candidate->votes,
                    ],
                ]);
            }

            $kkiapayTxId = $vote->kkiapay_transaction_id ?? $transactionId;

            Log::info('🔎 Verifying with KKiaPay', [
                'kkiapay_transaction_id' => $kkiapayTxId,
            ]);

            $result = $this->kkiapay->verifyTransaction($kkiapayTxId);

            if ($result['success'] && isset($result['data']['status'])) {
                $kkiapayStatus = strtolower($result['data']['status']);

                if ($kkiapayStatus === 'success' || $kkiapayStatus === 'successful') {
                    $completeRequest = new Request([
                        'transaction_id' => $transactionId,
                        'kkiapay_transaction_id' => $kkiapayTxId,
                        'kkiapay_response' => $result['data'],
                    ]);

                    return $this->completePayment($completeRequest);
                }
            }

            return response()->json([
                'success' => false,
                'message' => 'Impossible de vérifier le paiement',
            ], 400);

        } catch (\Exception $e) {
            Log::error('💥 Payment verification error', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la vérification',
            ], 500);
        }
    }

    /**
     * Webhook KKiaPay
     */
    public function webhook(Request $request)
    {
        Log::info('🔔 KKiaPay Webhook received', [
            'payload' => $request->all(),
        ]);

        try {
            $payload = $request->all();
            $transactionId = $payload['transactionId'] ?? null;
            $status = $payload['status'] ?? null;

            if (!$transactionId) {
                return response()->json(['error' => 'Missing transaction ID'], 400);
            }

            $vote = Vote::where('transaction_id', $transactionId)
                ->orWhere('kkiapay_transaction_id', $transactionId)
                ->first();

            if (!$vote) {
                return response()->json(['error' => 'Vote not found'], 404);
            }

            if (strtolower($status) === 'success' || strtolower($status) === 'successful') {
                $completeRequest = new Request([
                    'transaction_id' => $vote->transaction_id,
                    'kkiapay_transaction_id' => $transactionId,
                    'kkiapay_response' => $payload,
                ]);

                $this->completePayment($completeRequest);
            }

            return response()->json(['success' => true], 200);

        } catch (\Exception $e) {
            Log::error('💥 Webhook processing error', [
                'error' => $e->getMessage(),
            ]);

            return response()->json(['error' => 'Internal server error'], 500);
        }
    }

    /**
     * Callback après paiement KKiaPay
     */
    public function callback(Request $request)
    {
        $transactionId = $request->query('transaction_id');
        
        if (!$transactionId) {
            return redirect('/')->with('error', 'Transaction ID manquant');
        }

        $vote = Vote::where('transaction_id', $transactionId)->first();

        if (!$vote) {
            return redirect('/')->with('error', 'Vote non trouvé');
        }

        return redirect('/#candidates')->with('success', 'Vote en cours de traitement');
    }

    /**
     * Obtenir la configuration KKiaPay
     */
    public function getConfig()
    {
        return response()->json([
            'success' => true,
            'config' => $this->kkiapay->getPublicConfig(),
        ]);
    }
}