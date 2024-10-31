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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('login');
            $table->string('password');
            $table->timestamps();
        });

        Schema::create('roles', function(Blueprint $table){
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('role_user', function (Blueprint $table){
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table){
            $table->foreignId('account_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function(Blueprint $table){
            $table->dropForeign(['account_id']);
            $table->dropColumn('account_id');
        });
        Schema::dropIfExists('accounts');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('role_user');
    }
};
