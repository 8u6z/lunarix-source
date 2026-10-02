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
        Schema::table('forums', function (Blueprint $table) {
            $table->foreign(['forum_group_id'], 'forums_forum_group_id_fkey')->references(['id'])->on('forum_groups')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('forums', function (Blueprint $table) {
            $table->dropForeign('forums_forum_group_id_fkey');
        });
    }
};
