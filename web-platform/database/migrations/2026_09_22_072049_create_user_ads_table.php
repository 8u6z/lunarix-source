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
        Schema::create('user_ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('target_id');
            $table->text('type');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->bigInteger('impressions')->default(0);
            $table->bigInteger('clicks')->default(0);
            $table->bigInteger('bid_amount')->default(0);
            $table->bigInteger('impressions_last_run')->default(0);
            $table->bigInteger('clicks_last_run')->default(0);
            $table->bigInteger('bid_amount_last_run')->default(0);
            $table->bigInteger('image_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_ads');
    }
};
