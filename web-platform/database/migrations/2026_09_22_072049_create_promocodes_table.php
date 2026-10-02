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
        Schema::create('promocodes', function (Blueprint $table) {
            $table->text('code');
            $table->timestamp('created_at');
            $table->timestamp('expires_at')->nullable();
            $table->bigInteger('bytes_reward')->nullable();
            $table->json('assets_reward')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promocodes');
    }
};
