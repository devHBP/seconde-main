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
            $table->string('custom_background_primary')->nullable()->default(null)->after('icon_path');
            $table->string('custom_background_secondary')->nullable()->default(null)->after('custom_background_primary');
            $table->string('custom_font_primary')->nullable()->default(null)->after('custom_background_secondary');
            $table->string('custom_font_secondary')->nullable()->default(null)->after('custom_font_primary');
            $table->string('pattern_logo')->nullable()->default(null)->after('custom_font_secondary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('accounts', function(Blueprint $table){
            $table->dropColumn('custom_background_primary');
            $table->dropColumn('custom_background_secondary');
            $table->dropColumn('custom_font_primary');
            $table->dropColumn('custom_font_secondary');
            $table->dropColumn('pattern_logo');
        });
    }
};
