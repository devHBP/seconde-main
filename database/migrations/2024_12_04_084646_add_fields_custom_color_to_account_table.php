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
        Schema::table('accounts', function (Blueprint $table) {
            $table->renameColumn('custom_background_primary', 'header_background');
            $table->renameColumn('custom_background_secondary', 'header_title');
            $table->renameColumn('custom_font_primary', 'header_subtitle');
            $table->renameColumn('custom_font_secondary', 'header_button_background');
            $table->string('header_button_font')->nullable()->default(null)->after('header_button_background');
            
            $table->string('subheader_background')->nullable()->default(null)->after('header_button_font');
            $table->string('subheader_title')->nullable()->default(null)->after('subheader_background');
            $table->string('subheader_subtitle')->nullable()->default(null)->after('subheader_title');
            $table->string('subheader_button')->nullable()->default(null)->after('subheader_subtitle');
            $table->string('subheader_button_font')->nullable()->default(null)->after('subheader_button');
            
            $table->string('main_background')->nullable()->default(null)->after('subheader_button_font');
            $table->string('main_cards_background')->nullable()->default(null)->after('main_background');
            $table->string('main_cards_title')->nullable()->default(null)->after('main_cards_background');
            $table->string('main_cards_font')->nullable()->default(null)->after('main_cards_title');
            $table->string('main_cards_svg')->nullable()->default(null)->after('main_cards_font');
            $table->string('main_cards_button')->nullable()->default(null)->after('main_cards_svg');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->renameColumn('header_background', 'custom_background_primary');
            $table->renameColumn('header_title', 'custom_background_secondary');
            $table->renameColumn('header_subtitle', 'custom_font_primary');
            $table->renameColumn('header_button_background', 'custom_font_secondary');
            $table->dropColumn('header_button_font');
            $table->dropColumn('subheader_background');
            $table->dropColumn('subheader_title');
            $table->dropColumn('subheader_subtitle');
            $table->dropColumn('subheader_button');
            $table->dropColumn('subheader_button_font');
            $table->dropColumn('main_background');
            $table->dropColumn('main_cards_background');
            $table->dropColumn('main_cards_title');
            $table->dropColumn('main_cards_font');
            $table->dropColumn('main_cards_svg');
            $table->dropColumn('main_cards_button');
        });
    }
};
