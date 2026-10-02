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
        Schema::table('video_comments', function (Blueprint $table) {
            $table->foreign(['user_id'], 'video_comments_user_id_fkey')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['video_id'], 'video_comments_video_id_fkey')->references(['id'])->on('videos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('video_comments', function (Blueprint $table) {
            $table->dropForeign('video_comments_user_id_fkey');
            $table->dropForeign('video_comments_video_id_fkey');
        });
    }
};
