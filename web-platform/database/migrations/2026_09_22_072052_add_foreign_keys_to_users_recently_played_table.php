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
        Schema::table('users_recently_played', function (Blueprint $table) {
            $table->foreign(['user_id'], 'users_recently_played_user_id_fkey')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users_recently_played', function (Blueprint $table) {
            $table->dropForeign('users_recently_played_user_id_fkey');
        });
    }
};
