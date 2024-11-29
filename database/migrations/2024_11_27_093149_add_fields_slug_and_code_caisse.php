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
        Schema::table('accounts', function(Blueprint $table){
            $table->string('slug')->nullable()->default(null)->after('name');
        });
        Schema::table('product_states', function(Blueprint $table){
            $table->string('code_caisse')->nullable()->default(null)->after('prix_bon_achat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('accounts', function(Blueprint $table){
            $table->dropColumn('slug');
        });
        Schema::table('product_states', function(Blueprint $table){
            $table->dropColumn('code_caisse');
        });
    }
};