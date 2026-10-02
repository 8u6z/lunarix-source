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
        Schema::table('trade_items', function (Blueprint $table) {
            $table->foreign(['trade_id'], 'trade_items_trade_id_fkey')->references(['id'])->on('trades')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['user_id'], 'trade_items_user_id_fkey')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trade_items', function (Blueprint $table) {
            $table->dropForeign('trade_items_trade_id_fkey');
            $table->dropForeign('trade_items_user_id_fkey');
        });
    }
};
