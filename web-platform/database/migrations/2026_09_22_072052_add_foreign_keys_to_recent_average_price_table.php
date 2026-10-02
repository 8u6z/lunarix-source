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
        Schema::table('recent_average_price', function (Blueprint $table) {
            $table->foreign(['asset_id'], 'recent_average_price_asset_id_fkey')->references(['id'])->on('assets')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recent_average_price', function (Blueprint $table) {
            $table->dropForeign('recent_average_price_asset_id_fkey');
        });
    }
};
