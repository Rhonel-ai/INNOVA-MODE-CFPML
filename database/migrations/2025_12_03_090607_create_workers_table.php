<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            // Étape 1 : informations personnelles
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('password');

            // Étape 2 : métier / compétences
            $table->string('profession');
            $table->text('skills');
            $table->integer('experience_years');

            // Étape 3 : localisation
            $table->string('city');
            $table->string('neighborhood');
            $table->string('zone');

            // Étape 4 : documents
            $table->string('photo')->nullable();
            $table->string('id_card')->nullable();
            $table->string('cv')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};