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
        Schema::table('players', function (Blueprint $table) {
            $table->foreign(['job_id'], 'players_job_id_fkey')->references(['id'])->on('jobs')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['user_id'], 'players_user_id_fkey')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('players', function (Blueprint $table) {
            $table->dropForeign('players_job_id_fkey');
            $table->dropForeign('players_user_id_fkey');
        });
    }
};
