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
        Schema::table('forum_thread_views', function (Blueprint $table) {
            $table->foreign(['user_id'], 'forum_thread_views_user_id_fkey')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('forum_thread_views', function (Blueprint $table) {
            $table->dropForeign('forum_thread_views_user_id_fkey');
        });
    }
};
