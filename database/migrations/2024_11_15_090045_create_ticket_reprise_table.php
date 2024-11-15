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
        Schema::create('tickets_reprise', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('client_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('panier_id')->constrained()->onDelete('cascade');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->string('created_by_name');
            $table->foreignId('deactivated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->string('deactivated_by_name');

            $table->enum('type_utilisation', ['remboursement', 'bon_achat', 'mixte'])->default('bon_achat');

            $table->dateTime('deactivation_date')->nullable();
            $table->dateTime('date_limite')->nullable();

            $table->boolean('is_activated')->default(false);
            $table->timestamps();
        });

        Schema::table('paniers', function(Blueprint $table){
            $table->dropColumn('is_validated');
            $table->enum('status', ['en_cours', 'valide', 'annule', 'restitue'])->default('en_cours');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_reprise');
        Schema::table('paniers', function(Blueprint $table){
            $table->boolean('is_validated')->default(false);
            $table->dropColumn('status');
        });
    }
};
