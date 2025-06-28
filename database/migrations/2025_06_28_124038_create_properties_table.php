<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
           Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom du bien immobilier (ex: "Appartement de luxe")
            $table->text('description'); // Description détaillée de la propriété
            $table->decimal('price_per_night', 8, 2); // Prix par nuit (ex: 150.00 TND)
            $table->timestamps(); // Ajoute les colonnes `created_at` et `updated_at`
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
