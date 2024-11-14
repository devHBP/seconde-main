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
        Schema::table('product_panier', function(Blueprint $table){
            $table->unique(['product_id', 'state', 'panier_id'], 'product_state_panier_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_panier', function(Blueprint $table){
            $table->dropUnique('product_state_panier_unique');
        });
    }
};
