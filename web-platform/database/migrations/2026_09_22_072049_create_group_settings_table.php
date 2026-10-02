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
        Schema::create('group_settings', function (Blueprint $table) {
            $table->integer('group_id');
            $table->boolean('approval')->nullable()->default(true);
            $table->boolean('enemies_allowed')->nullable()->default(false);
            $table->boolean('funds_visible')->nullable()->default(true);
            $table->boolean('games_visible')->nullable()->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_settings');
    }
};
