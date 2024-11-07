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
        // Correction sur la table states , le champ definition peut etre null
        Schema::table('states', function (Blueprint $table){
            $table->string('definition')->nullable()->change();
        });

        // Création de la table products, contient essentiellement des relations
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->foreignId('type_id')->constrained()->onDelete('cascade');
            $table->foreignId('account_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Création de la table pivot, qui effectue la jonction product<->state 
        Schema::create('product_states', function(Blueprint $table){
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('state_id')->constrained()->onDelete('cascade');
            $table->decimal('prix_remboursement', 6, 2)->nullable();
            $table->decimal('prix_bon_achat', 6, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('states', function(Blueprint $table){
            $table->string('definition')->nullable(false)->change();
        });
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_state');
    }
};
