<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();

            // Informations du candidat
            $table->string('last_name');      // Nom
            $table->string('first_name');     // Prénoms
            $table->string('school');         // École
            $table->string('city');           // Ville
            $table->date('birth_date');       // Date de naissance

            // Code automatique (ex: 0001A)
            $table->string('code')->unique();

            // Image optionnelle
            $table->string('image')->nullable();

            // Votes (par défaut 0)
            $table->integer('votes')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};