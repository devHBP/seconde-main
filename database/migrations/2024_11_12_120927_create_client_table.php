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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('lastname');
            $table->string('firstname');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->boolean('consent')->default(false);
            $table->foreignId('account_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('paniers', function(Blueprint $table){
            $table->id();
            $table->decimal('total_remboursement', 8, 2 )->default(0);
            $table->decimal('total_bon_achat', 8, 2)->default(0);
            $table->boolean('is_validated')->default(false);
            $table->foreignId('account_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('client_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });

        Schema::create('product_panier', function(Blueprint $table){
            $table->id();
            $table->decimal('prix_remboursement', 6, 2)->nullable();
            $table->decimal('prix_bon_achat', 6, 2)->nullable();
            $table->string('state')->nullable();
            $table->integer('quantity')->default(1);
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('panier_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Ajout du champ infos sur la table state_product, null par defaut pour éviter les erreurs.  
        Schema::table('product_states', function(Blueprint $table){
            $table->string('infos')->nullable()->after('prix_bon_achat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
        Schema::table('product_states', function(Blueprint $table){
            $table->dropColumn('infos');
        });
        Schema::table('product_panier', function(Blueprint $table){
            $table->dropForeign(['product_id']);
            $table->dropForeign(['panier_id']);
        });
        
        Schema::dropIfExists('paniers');
        Schema::dropIfExists('product_panier');
    }
};
