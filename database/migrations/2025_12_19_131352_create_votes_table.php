<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            
            // Candidate information
            $table->foreignId('candidate_id')->constrained('candidates')->onDelete('cascade');
            
            // Voter information
            $table->string('voter_name')->nullable();
            $table->string('voter_phone', 20);
            $table->boolean('is_anonymous')->default(false);
            
            // Vote details
            $table->integer('vote_count')->default(1);
            $table->integer('amount_paid'); // en FCFA
            
            // Prime information
            $table->unsignedBigInteger('prime_id')->nullable();
            
            // Payment information
            $table->string('transaction_id', 100)->unique();
            $table->enum('payment_status', ['pending', 'success', 'failed', 'refunded'])->default('pending');
            $table->string('payment_method')->nullable();
            $table->timestamp('payment_verified_at')->nullable();
            
            // KKiaPay specific
            $table->text('kkiapay_response')->nullable(); // JSON response from KKiaPay
            $table->string('kkiapay_transaction_id')->nullable();
            
            // Metadata
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('candidate_id');
            $table->index('transaction_id');
            $table->index('payment_status');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('votes');
    }
};