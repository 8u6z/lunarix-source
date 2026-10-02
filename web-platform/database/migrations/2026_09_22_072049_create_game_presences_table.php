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
        Schema::create('game_presences', function (Blueprint $table) {
            $table->bigInteger('user_id')->primary();
            $table->string('job_id');
            $table->bigInteger('place_id');
            $table->timestamp('last_seen_at')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_presences');
    }
};
