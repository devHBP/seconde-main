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
        Schema::table('paniers', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('client_id')->constrained()->onDelete('set null');
        });

        Schema::table('states', function(Blueprint $table){
            $table->string('infos')->nullable()->default(null)->after('definition');
        });

        Schema::table('product_states', function (Blueprint $table){
            $table->dropColumn('infos');
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paniers', function (Blueprint $table){
            $table->dropForeign(['user_id']);
        });
        Schema::table('states', function (Blueprint $table){
            $table->dropColumn('infos');
        });
        Schema::table('product_states', function(Blueprint $table){
            $table->string('infos')->nullable()->default(null)->after('prix_bon_achat');
        });
    }
};
