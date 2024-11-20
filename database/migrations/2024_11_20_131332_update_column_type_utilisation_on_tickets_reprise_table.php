<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE tickets_reprise MODIFY COLUMN type_utilisation ENUM('bon_achat', 'remboursement', 'mixte', 'annule') NOT NULL DEFAULT 'bon_achat'");

        Schema::table('accounts', function(Blueprint $table){
            $table->string('name')->nullable()->default(null)->after('login');
            $table->string('icon_path')->nullable()->default(null)->after('password');
        });

        Schema::table('types', function(Blueprint $table){
            $table->string('icon_path')->nullable()->default(null)->after('name');
        });

        Schema::table('brands', function(Blueprint $table){
            $table->string('icon_path')->nullable()->default(null)->after('name');
        });

        Schema::create('pictures', function(Blueprint $table){
            $table->id();
            $table->string('name')->nullable();
            $table->string('path');
            $table->string('type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE tickets_reprise MODIFY COLUMN type_utilisation ENUM('bon_achat', 'remboursement', 'mixte') NOT NULL DEFAULT 'bon_achat'");
        Schema::table("accounts", function(Blueprint $table){
            $table->dropColumn('icon_path');
        });
        Schema::table("types", function(Blueprint $table){
            $table->dropColumn('icon_path');
        });
        Schema::table("brands", function(Blueprint $table){
            $table->dropColumn('icon_path');
        });
        Schema::dropIfExists('pictures');
    }
};
