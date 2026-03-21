<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_events_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom de l'événement, ex: "Édition 2025"
            $table->text('description')->nullable();
            $table->date('start_date'); // Date de début
            $table->date('end_date');   // Date de fin
            
            // Clé étrangère pour le leader (l'utilisateur qui a gagné)
            // 'nullable' car le leader n'est connu qu'à la fin.
            $table->foreignId('leader_user_id')->nullable()->constrained('candidates')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};