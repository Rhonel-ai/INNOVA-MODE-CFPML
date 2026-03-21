<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payment_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vote_id')->nullable()->constrained('votes')->onDelete('set null');
            $table->string('transaction_id', 100)->index(); // ⭐ REMPLACER unique() par index()
            $table->string('event_type');
            $table->text('request_data')->nullable();
            $table->text('response_data')->nullable();
            $table->string('status');
            $table->text('error_message')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
            
            // Index pour rechercher rapidement les logs d'une transaction
            $table->index(['transaction_id', 'event_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_logs');
    }
};