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
        Schema::table('forum_threads', function (Blueprint $table) {
            $table->foreign(['forum_id'], 'forum_posts_forum_id_fkey')->references(['id'])->on('forums')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('forum_threads', function (Blueprint $table) {
            $table->dropForeign('forum_posts_forum_id_fkey');
        });
    }
};
