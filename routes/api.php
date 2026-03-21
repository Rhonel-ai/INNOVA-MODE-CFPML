<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\EventController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| API Routes pour les votes
|--------------------------------------------------------------------------
*/

Route::prefix('votes')->group(function () {
    // Créer un vote (avant paiement)
    Route::post('/create', [VoteController::class, 'store']);
    
    // Compléter le paiement (appelé après succès KKiaPay)
    Route::post('/complete-payment', [VoteController::class, 'completePayment']);
    
    // Vérifier un paiement manuellement
    Route::post('/verify', [VoteController::class, 'verify']);
    
    // Mettre à jour l'ID KKiaPay
    Route::post('/update-kkiapay-id', [VoteController::class, 'updateKkiapayId']);
    
    // Obtenir la config KKiaPay
    Route::get('/config', [VoteController::class, 'getConfig']);
});

/*
|--------------------------------------------------------------------------
| Webhook Routes
|--------------------------------------------------------------------------
*/

Route::prefix('webhook')->group(function () {
    // Webhook KKiaPay (sans middleware CSRF)
    Route::post('/kkiapay', [VoteController::class, 'webhook']);
});

/*
|--------------------------------------------------------------------------
| Payment Callback Route
|--------------------------------------------------------------------------
*/

Route::get('/payment/callback', [VoteController::class, 'callback'])->name('payment.callback');
