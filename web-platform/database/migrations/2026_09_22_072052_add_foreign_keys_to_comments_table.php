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
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign(['asset_id'], 'comments_asset_id_fkey')->references(['id'])->on('assets')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['user_id'], 'comments_user_id_fkey')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('comments_asset_id_fkey');
            $table->dropForeign('comments_user_id_fkey');
        });
    }
};
