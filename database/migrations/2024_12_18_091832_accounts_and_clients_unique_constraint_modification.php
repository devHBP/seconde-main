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
        Schema::table('clients', function(Blueprint $table){
            $table->dropUnique('clients_email_unique');
            $table->unique(['email', 'account_id']);
        });
        Schema::table('accounts', function(Blueprint $table){
            $table->boolean('compacted_mode')->default(false)->after('main_cards_button');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function(Blueprint $table){
            $table->dropUnique(['email', 'account_id']);
            $table->unique('email');
        });
        Schema::table('accounts', function(Blueprint $table){
            $table->dropColumn('compacted_mode');
        });
    }
};
